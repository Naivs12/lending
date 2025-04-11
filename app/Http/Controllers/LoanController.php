<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Branch;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index_loan(Request $request)
    {
        $branches = Branch::all();
        $query = Loan::with('client')->where('status', 'loan');

        // Check if branch filter is applied
        if ($request->has('branch') && $request->branch != '') {
            $query->where('loans.branch_id', $request->branch);

        }

        // Check if name sort is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*');
        }

        $loans = $query->paginate(10);

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.loan.loan', ['page' => 1]);
        }

        return view('system-admin.loan.loan', compact('loans', 'branches'));
    }



    public function index_review(Request $request)
    {
        $branches = Branch::all();
        $query = Loan::with('client')->where('status', 'review');

        // Check if branch filter is applied
        if ($request->has('branch') && $request->branch != '') {
            $query->where('loans.branch_id', $request->branch);

        }

        // Check if name sort is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*');
        }

        $loans = $query->paginate(10);

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.loan.loan', ['page' => 1]);
        }

        return view('system-admin.loan.review', compact('loans', 'branches'));
    }




    public function index_release(Request $request)
    {
        $branches = Branch::all();
        $query = Loan::with('client')->where('status', 'release');

        // Check if branch filter is applied
        if ($request->has('branch') && $request->branch != '') {
            $query->where('loans.branch_id', $request->branch);

        }

        // Check if name sort is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*');
        }

        $loans = $query->paginate(10);

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.loan.loan', ['page' => 1]);
        }

        return view('system-admin.loan.release', compact('loans', 'branches'));
    }

    public function index_loan_admin(Request $request)
    {
        $branches = Branch::all();
        $admin = auth()->user(); // Assuming admin is authenticated
        $adminBranchId = $admin->branch_id;

        // Start query
        $query = Loan::with('client')
            ->where('loans.status', 'loan')
            ->where('loans.branch_id', $adminBranchId);

        // Handle search input
        if ($request->has('query') && $request->query('query') != '') {
            $search = $request->query('query');
            $query->whereHas('client', function ($q) use ($search) {
                $q->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%");
            });
        }

        // Handle sorting by full name
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // avoid ambiguous column error
        }

        // Paginate results
        $loans = $query->paginate(10)->withQueryString(); // keep query params in pagination

        // Redirect if no data found and on a higher page
        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('admin.loan.loan', ['page' => 1]);
        }

        return view('admin.loan.loan', compact('loans', 'branches'));
    }


    public function index_release_admin(Request $request)
    {
        // Get the admin's branch ID
        $admin = auth()->user();
        $adminBranchId = $admin->branch_id;
    
        // Start query for loans that are in 'release' status and for the admin's branch
        $query = Loan::with('client')
            ->where('status', 'release')
            ->where('loans.branch_id', $adminBranchId);
    
        // Handle sorting by client full name (asc or desc)
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // avoid ambiguous column error
        }
    
        // Paginate results and keep query parameters in the pagination links
        $loans = $query->paginate(10)->withQueryString();
    
        // Redirect if no data found and on a higher page
        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('admin.loan.release', ['page' => 1]);
        }
    
        return view('admin.loan.release', compact('loans'));
    }

    public function index_review_admin(Request $request)
    {
        // Get the admin's branch ID
        $admin = auth()->user();
        $adminBranchId = $admin->branch_id;
    
        // Start query for loans that are in 'review' status and for the admin's branch
        $query = Loan::with('client')
            ->where('status', 'review')
            ->where('loans.branch_id', $adminBranchId);
    
        // Handle sorting by client full name (asc or desc)
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // avoid ambiguous column error
        }
    
        // Paginate results and keep query parameters in the pagination links
        $loans = $query->paginate(10)->withQueryString();
    
        // Redirect if no data found and on a higher page
        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('admin.loan.review', ['page' => 1]);
        }
    
        return view('admin.loan.review', compact('loans'));
    }
    
    

    public function updateStatus(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|string',
            'status' => 'required|string'
        ]);

        $loan = Loan::where('loan_id', $request->loan_id)->first();

        if (!$loan) {
            return response()->json(['success' => false, 'message' => 'Loan not found']);
        }

        $loan->status = $request->status;
        $loan->save();

        return response()->json(['success' => true]);
    }


    public function create_loan(Request $request)
    {
        $request->validate([
            'client_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'interest' => 'required|numeric|min:0',
            'terms' => 'required|string',
            'payment_schedule' => 'required|in:weekly,two_weeks,monthly,interest_only',
            'date_release' => 'required|date',
        ]);

        $lastLoan = Loan::orderBy('loan_id', 'desc')->first();
        $status = 'Review';
        $branch_id = Auth::user()->branch_id;

        if ($lastLoan) {
            $numericPart = (int) substr($lastLoan->loan_id, 2); // Extract numeric part after 'L-'
            $newLoanId = 'L-' . str_pad($numericPart + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newLoanId = 'L-0000001';
        }

        $loan = Loan::create([
            'loan_id' => $newLoanId,
            'client_id' => $request->client_id,
            'branch_id' => $branch_id,
            'amount' => $request->amount,
            'payment_schedule' => $request->payment_schedule,
            'term' => $request->terms,
            'interest' => $request->interest,
            'date_release' => $request->date_release,
            'status' => $status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Loan successfully added!',
            'loan' => $loan,
        ], 201);
    }

    public function search(Request $request)
    {
        $query = $request->query('query');

        if (!$query) {
            return response()->json([]);
        }

        // Query by client_id or full name (handles cases with or without middle names)
        $clients = Client::select('client_id', 'first_name', 'middle_name', 'last_name')
            ->where('client_id', 'LIKE', "%{$query}%")
            ->orWhere(DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name)"), 'LIKE', "%{$query}%")
            ->orWhere(DB::raw("CONCAT_WS(' ', first_name, last_name)"), 'LIKE', "%{$query}%")
            ->limit(5)
            ->get();

        // Format the client names properly
        $clients = $clients->map(function ($client) {
            $client->full_name = trim("{$client->first_name} " . ($client->middle_name ? "{$client->middle_name} " : "") . "{$client->last_name}");
            return $client;
        });

        return response()->json($clients);
    }
    
}
