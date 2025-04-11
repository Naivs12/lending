<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class ClientController extends Controller
{
    public function index(Request $request)
{
    $branches = Branch::all(); // Fetch all branches

    // Start the query
    $query = Client::query();

    // Filter by branch if selected
    if ($request->has('branch') && $request->branch != '') {
        $query->where('branch_id', $request->branch);
    }

    // Sort by name if requested
    if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
        $query->orderByRaw("CONCAT(first_name, ' ', last_name) " . $request->nameSort);
    }

    // Paginate the result
    $clients = $query->paginate(10);

    // Redirect to first page if current page is empty
    if ($clients->isEmpty() && $request->page > 1) {
        return redirect()->route('system-admin.client', ['page' => 1]);
    }

    return view('system-admin.client', compact('clients', 'branches'));
}


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'age' => 'required|integer',
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'contact_number' => 'required|string',
            'facebook' => 'nullable|url',
            'co_borrower' => 'nullable|string',
            'relationship_co_borrower' => 'nullable|string',
        ]);

        $branch_id = Auth::user()->branch_id;
        // Generate client_id starting from CL-0000001
        $lastClient = Client::orderBy('client_id', 'desc')->first();

        if ($lastClient) {
            // Extract numeric part and increment
            $numericPart = (int) substr($lastClient->client_id, 3);
            $newClientId = 'CL-' . str_pad($numericPart + 1, 7, '0', STR_PAD_LEFT);
        } else {
            // If no clients exist, start from CL-0000001
            $newClientId = 'CL-0000001';
        }

        Client::create([
            'client_id' => $newClientId,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'soc_med' => $request->facebook,
            'co_borrower' => $request->co_borrower,
            'relationship_co' => $request->relationship_co_borrower,
            'branch_id' => $branch_id
        ]);

        return response()->json(['success' => true, 'message' => 'Client added successfully!']);
    }

    public function show_client_details($client_id)
    {
        $client = Client::where('client_id', $client_id)->firstOrFail();
        return view('system-admin.client_detail', compact('client'));
    }

    public function delete_client($id)
    {
        try {
            $deleted = Client::destroy($id);
    
            if (!$deleted) {
                return response()->json(['success' => false, 'message' => 'User not found!'], 404);
            }
    
            return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            // Validate request data
            $request->validate([
                'editClientId' => 'required|exists:clients,id', // Use id instead of client_id
                'edit_first_name' => 'required|string|max:255',
                'edit_middle_name' => 'nullable|string|max:255',
                'edit_last_name' => 'required|string|max:255',
                'edit_address' => 'required|string',
                'edit_age' => 'required|integer',
                'edit_birthday' => 'required|date',
                'edit_gender' => 'required|string',
                'edit_contact_number' => 'required|numeric',
                'edit_soc_med' => 'nullable|url',
                'edit_co_borrower' => 'nullable|string',
                'edit_relationship_co' => 'nullable|string',
            ]);
    

            $client = Client::where('id', $request->editClientId)->first();
    
            if (!$client) {
                return response()->json(['success' => false, 'message' => 'Client not found!'], 404);
            }
            
            // Update client details
            $client->id = $request->editClientId;
            $client->first_name = $request->edit_first_name;
            $client->middle_name = $request->edit_middle_name;
            $client->last_name = $request->edit_last_name;
            $client->address = $request->edit_address;
            $client->age = $request->edit_age;
            $client->birthday = $request->edit_birthday;
            $client->gender = $request->edit_gender;
            $client->contact_number = $request->edit_contact_number;
            $client->soc_med = $request->edit_soc_med;
            $client->co_borrower = $request->edit_co_borrower;
            $client->relationship_co = $request->edit_relationship_co;
    
            $client->save();
    
            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function index_admin(Request $request)
    {
        $user = Auth::user(); // Get the logged-in user
        $branchId = $user->branch_id; // Assume your User model has branch_id

        $query = Client::where('branch_id', $branchId); // Filter clients by user's branch

        // Search filter
        $search = $request->input('query');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('middle_name', 'like', '%' . $search . '%')
                ->orWhere('client_id', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Sort by name
        $nameSort = $request->input('nameSort');
        if ($nameSort == 'asc' || $nameSort == 'desc') {
            $query->orderBy('first_name', $nameSort)->orderBy('last_name', $nameSort);
        }

        // Paginate results
        $clients = $query->paginate(10);

        // Redirect if page is empty but not the first
        if ($clients->isEmpty() && $request->input('page', 1) > 1) {
            return redirect()->route('admin.client', ['page' => 1]);
        }

        // Fetch all branches (optional, if needed in view)
        $branches = Branch::all();

        return view('admin.client', compact('clients', 'branches'));
    }



}