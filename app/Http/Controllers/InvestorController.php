<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;

class InvestorController extends Controller
{
    public function index(Request $request)
    {
        $branches = Branch::all(); // Fetch all branches
        // Start the query builder
        $query = Investor::query();

        // Filter by branch if selected
        if ($request->has('branch') && $request->branch != '') {
            $query->where('branch_id', $request->branch);
        }

        // Example sorting by name (if applicable)
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->orderByRaw("CONCAT(first_name, ' ', last_name) " . $request->nameSort);
        }

        // Paginate the results
        $investors = $query->paginate(10);

        // Redirect if no data found on the requested page
        if ($investors->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.investor', ['page' => 1]);
        }

        return view('system-admin.investor', compact('investors', 'branches'));
    }


    public function add_investor(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'amount_invest' => 'required|numeric',
            'percentage' => 'required|numeric'
        ]);

        $branch_id = Auth::user()->branch_id;
    
        $lastInvestor = Investor::orderBy('investor_id', 'desc')->first();
    
        if ($lastInvestor) {
            $numericPart = (int) substr($lastInvestor->investor_id, 4); // Fixed variable name
            $newInvestorId = 'INV-' . str_pad($numericPart + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newInvestorId = 'INV-0000001';
        }
    
        Investor::create([
            'investor_id' => $newInvestorId,
            'first_name' => $request->first_name,
            'middle_name'=> $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'amount_invest'  => $request->amount_invest,
            'payment_percent'  => $request->percentage,
            'branch_id' => $branch_id
        ]);
    
        return response()->json(['success' => true, 'message' => 'Investor added successfully!']);
    }

    public function show_investor_details($investor_id)
    {
        $investor = Investor::where('investor_id', $investor_id)->firstOrFail();
        return view('system-admin.investor_detail', compact('investor'));
    }

    public function index_investor(Request $request)
    {
        $user = auth()->user(); // Get the currently logged-in user
    
        $query = Investor::where('branch_id', $user->branch_id); // Filter by user's branch
    
        // Search filter
        $search = $request->input('query');
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                  ->orWhere('last_name', 'like', '%' . $search . '%')
                  ->orWhere('middle_name', 'like', '%' . $search . '%')
                  ->orWhere('investor_id', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }
    
        // Sort by name
        $nameSort = $request->input('nameSort');
        if ($nameSort === 'asc' || $nameSort === 'desc') {
            $query->orderBy('last_name', $nameSort)->orderBy('first_name', $nameSort);
        }
    
        // Paginate results
        $investors = $query->paginate(10);
    
        // Redirect if no results found on a non-first page
        if ($investors->isEmpty() && $request->input('page', 1) > 1) {
            return redirect()->route('admin.investor', ['page' => 1]);
        }
    
        return view('admin.investor', compact('investors'));
    }
    
    
}