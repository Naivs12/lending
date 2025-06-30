<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Branch;
use App\Models\Client;
use App\Models\ClientPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class LoanController extends Controller
{
    public function index_loan(Request $request)
    {
        $branches = Branch::all();
        $query = Loan::with('client')->where('loans.status', 'loan'); // Specify table name for 'status'

        // Check if branch filter is applied
        if ($request->has('branch') && $request->branch != '') {
            $query->where('loans.branch_id', $request->branch);
        }

        // Check if name sort is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // Avoid ambiguous column error
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
        $query = Loan::with('client')->where('loans.status', 'review'); // Specify table name for 'status'

        // Check if branch filter is applied
        if ($request->has('branch') && $request->branch != '') {
            $query->where('loans.branch_id', $request->branch);
        }

        // Check if name sort is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // Avoid ambiguous column error
        }

        $loans = $query->paginate(10);

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.loan.review', ['page' => 1]);
        }

        return view('system-admin.loan.review', compact('loans', 'branches'));
    }

    public function index_release(Request $request)
    {
        $branches = Branch::all();
        $query = Loan::with('client')->where('loans.status', 'release'); // Specify table name for 'status'

        // Check if branch filter is applied
        if ($request->has('branch') && $request->branch != '') {
            $query->where('loans.branch_id', $request->branch);
        }

        // Check if name sort is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // Avoid ambiguous column error
        }

        $loans = $query->paginate(10);

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.loan.release', ['page' => 1]);
        }

        return view('system-admin.loan.release', compact('loans', 'branches'));
    }

    public function index_loan_admin(Request $request)
    {
        $branches = Branch::all();
        $admin = auth()->user(); // Assuming admin is authenticated
        $adminBranchId = $admin->branch_id;

        $query = Loan::with('client')
            ->where('loans.status', 'loan') // Specify table name for 'status'
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
                ->select('loans.*'); // Avoid ambiguous column error
        }

        $loans = $query->paginate(10)->withQueryString();

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('admin.loan.loan', ['page' => 1]);
        }

        return view('admin.loan.loan', compact('loans', 'branches'));
    }

    public function index_release_admin(Request $request)
    {
        $admin = auth()->user();
        $adminBranchId = $admin->branch_id;

        $query = Loan::with('client')
            ->where('loans.status', 'release') // Specify table name for 'status'
            ->where('loans.branch_id', $adminBranchId);

        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // Avoid ambiguous column error
        }

        $loans = $query->paginate(10)->withQueryString();

        if ($loans->isEmpty() && $request->page > 1) {
            return redirect()->route('admin.loan.release', ['page' => 1]);
        }

        return view('admin.loan.release', compact('loans'));
    }

    public function index_review_admin(Request $request)
    {
        $admin = auth()->user();
        $adminBranchId = $admin->branch_id;

        $query = Loan::with('client')
            ->where('loans.status', 'review') // Specify table name for 'status'
            ->where('loans.branch_id', $adminBranchId);

        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'loans.client_id')
                ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                ->select('loans.*'); // Avoid ambiguous column error
        }

        $loans = $query->paginate(10)->withQueryString();

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
        $rules = [
            'client_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'interest' => 'required|numeric|min:0',
            'terms' => 'required|numeric|min:1|max:12',
            'payment_schedule' => 'required|in:weekly,two_weeks,monthly,interest_only',
            'date_release' => 'required|date',
        ];

        // Add branch_id validation for system-admin
        if (auth()->user()->role === 'system-admin') {
            $rules['branch_id'] = 'required|string|exists:branches,branch_id';
        }

        $request->validate($rules);

        $lastLoan = Loan::orderBy('loan_id', 'desc')->first();
        $newLoanId = $lastLoan 
            ? 'L-' . str_pad((int) substr($lastLoan->loan_id, 2) + 1, 7, '0', STR_PAD_LEFT)
            : 'L-0000001';

        $terms = (int) $request->terms;

        // Determine number of payments based on schedule
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

        $principal = $request->amount;
        $interestRate = $request->interest / 100;

        $totalAmountWithInterest = $principal * $interestRate * ($terms/12) + $principal; // Total amount with interest
        $paymentPerTerm = round($totalAmountWithInterest / $totalProgress, 2); // divided by total payments, not term

        // Choose branch_id based on role
        $branchId = auth()->user()->role === 'system-admin'
            ? $request->branch_id
            : auth()->user()->branch_id;

        $loan = Loan::create([
            'loan_id' => $newLoanId,
            'client_id' => $request->client_id,
            'branch_id' => $branchId,
            'loan_amount' => $principal,
            'tot_amnt_w_int' => $totalAmountWithInterest,
            'pay_per_term' => $paymentPerTerm,
            'rem_balance' => $totalAmountWithInterest,
            'tot_amnt_pd' => 0,
            'interest' => $request->interest,
            'payment_schedule' => $request->payment_schedule,
            'term' => $totalProgress,
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
        $selectedBranchId = $request->query('branch_id'); // Get branch from frontend
        $user = auth()->user();
    
        if (!$query) {
            return response()->json([]);
        }
    
        // Determine which branch ID to use
        $branchId = ($user->role === 'system-admin') ? $selectedBranchId : $user->branch_id;
    
        if (!$branchId) {
            return response()->json([]);
        }
    
        // Filter by branch_id and client info
        $clients = Client::select('client_id', 'first_name', 'middle_name', 'last_name')
            ->where('branch_id', $branchId)
            ->where(function ($q) use ($query) {
                $q->where('client_id', 'LIKE', "%{$query}%")
                  ->orWhere(DB::raw("CONCAT_WS(' ', first_name, middle_name, last_name)"), 'LIKE', "%{$query}%")
                  ->orWhere(DB::raw("CONCAT_WS(' ', first_name, last_name)"), 'LIKE', "%{$query}%");
            })
            ->limit(5)
            ->get();
    
        // Format full name
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

    public function show_loan_details($loan_id)
    {
        // Get the loan details by loan_id
        $loan = Loan::where('loan_id', $loan_id)->firstOrFail();
    
        // Get the related payments for the given loan_id
        $payments = ClientPayment::where('loan_id', $loan_id)->get();
    
        // Pass both loan and payments to the view
        return view('admin.loan_details', compact('loan', 'payments'));
    }

    public function show_loan_details_sysad($loan_id)
    {
        // Get the loan details by loan_id
        $loan = Loan::where('loan_id', $loan_id)->firstOrFail();
    
        // Get the related payments for the given loan_id
        $payments = ClientPayment::where('loan_id', $loan_id)->get();
    
        // Pass both loan and payments to the view
        if (auth()->user()->role === 'system-admin') {
            return view('system-admin.loan_details', compact('loan', 'payments'));
        }else{
            return view('admin.loan_details', compact('loan', 'payments'));
        }

    }

}
