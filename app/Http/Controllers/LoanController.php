<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Branch;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            'terms' => 'required|numeric|min:1|max:12',
            'payment_schedule' => 'required|in:weekly,two_weeks,monthly,interest_only',
            'date_release' => 'required|date',
        ]);
    
        $lastLoan = Loan::orderBy('loan_id', 'desc')->first();
        $newLoanId = $lastLoan 
            ? 'L-' . str_pad((int) substr($lastLoan->loan_id, 2) + 1, 7, '0', STR_PAD_LEFT)
            : 'L-0000001';
    
        $terms = (int) $request->terms;
    
        // Total payment count
        switch ($request->payment_schedule) {
            case 'weekly':
                $totalProgress = $terms * 4;
                break;
            case 'two_weeks':
                $totalProgress = $terms * 2;
                break;
            case 'monthly':
            case 'interest_only':
                $totalProgress = $terms;
                break;
            default:
                $totalProgress = 0;
        }

        
        $totalAmountWInterest = $request->amount + ($request->amount * ($request->interest / 100));
        $paymentPerTerm = $totalAmountWInterest / $terms;

        $loan = Loan::create([
            'loan_id' => $newLoanId,
            'client_id' => $request->client_id,
            'branch_id' => auth()->user()->branch_id,
            'loan_amount' => $request->amount,
            'tot_amnt_w_int' => $totalAmountWInterest,
            'pay_per_term' => $paymentPerTerm, 
            'rem_balance' => $totalAmountWInterest,
            'tot_amnt_pd' => 0,
            'interest' => $request->interest,
            'payment_schedule' => $request->payment_schedule,
            'term' => $terms,
            'date_release' => $request->date_release,
            'status' => 'Review',
            'progress' => 0,
            'total_progress' => $totalProgress,
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Loan created successfully.',
            'loan' => $loan,
        ], 201);
    }
    
    

    
    
    public function search(Request $request)
    {
        $query = $request->query('query');
        $branchId = auth()->user()->branch_id; // Get the current user's branch ID
    
        if (!$query) {
            return response()->json([]);
        }
    
        // Query by client_id or full name, filtered by branch_id
        $clients = Client::select('client_id', 'first_name', 'middle_name', 'last_name')
            ->where('branch_id', $branchId)
            ->where(function ($q) use ($query) {
                $q->where('client_id', 'LIKE', "%{$query}%")
                  ->orWhere(DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name)"), 'LIKE', "%{$query}%")
                  ->orWhere(DB::raw("CONCAT_WS(' ', first_name, last_name)"), 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get();
    
        // Format the full name
        $clients = $clients->map(function ($client) {
            $client->full_name = trim("{$client->first_name} " . ($client->middle_name ? "{$client->middle_name} " : "") . "{$client->last_name}");
            return $client;
        });
    
        return response()->json($clients);
    }
    public function search_loan(Request $request)
{
    $query = $request->input('query');
    $clientId = $request->input('client_id');

    $loans = Loan::where('status', 'loan')
                 ->where('client_id', $clientId) // ensure loans are filtered by selected client
                 ->where(function($q) use ($query) {
                     $q->where('loan_id', 'LIKE', "%$query%");
                 })
                 ->get(['loan_id']);

    // Format the display text
    $loans = $loans->map(function ($loan) {
        $loan->formatted = "{$loan->loan_id}";
        return $loan;
    });

    return response()->json($loans);
}


}
