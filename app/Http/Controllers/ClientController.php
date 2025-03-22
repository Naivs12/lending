<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class ClientController extends Controller
{
    public function index(Request $request) {
        $clients = Client::paginate(10); 
        $branches = Branch::all(); // Fetch all branches
            
        if ($clients->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.maintenance.user', ['page' => 1]);
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

        $name = trim("{$request->first_name} {$request->middle_name} {$request->last_name}");

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
            'name' => $name,
            'address' => $request->address,
            'age' => $request->age,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'soc_med' => $request->facebook,
            'co_borrower' => $request->co_borrower,
            'relationship_co' => $request->relationship_co_borrower,
            'branch_id' => $branch_id,
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
}