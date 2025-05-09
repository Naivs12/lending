<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientPayment;
use App\Models\Loan;
use App\Models\Branch;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClientPaymentController extends Controller
{
    // This function is not necessary in the controller as it's outside your context
    // public function client() { return $this->belongsTo(Client::class, 'client_id'); }

    public function index(Request $request)
    {

        $branches = Branch::where('branch_id', auth()->user()->branch_id)->get(); // Non-admin sees only their branch

        // Start the query for client payments
        $query = ClientPayment::query();

        // Check if name sorting is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'transactions.client_id')
                  ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                  ->select('transactions.*');
        }

        // Paginate the results (10 clients per page) and preserve query parameters for pagination
        $payments = $query->paginate(10)->appends($request->except('page'));

        // Redirect to the first page if the current page is empty
        if ($payments->isEmpty() && $request->page > 1) {
            return redirect()->route('admin.payment_info.client_info', ['page' => 1]);
        }

        // Return the view with payments and branches
        return view('admin.payment_info.client_info', compact('payments', 'branches'));
    }
    
    public function index_sysad(Request $request)
    {
        // Fetch all branches
        $branches = Branch::all(); 

        // Start the query for client payments
        $query = ClientPayment::query();

        // Check if a branch filter is applied (System admin only)
        if ($request->has('branch') && $request->branch != '') {
            $query->where('transactions.branch_id', $request->branch);
        } elseif (auth()->user()->role !== 'system-admin') {
            // If not a system-admin, filter by the user's branch
            $query->where('transactions.branch_id', auth()->user()->branch_id);
        }

        // Check if name sorting is applied
        if ($request->has('nameSort') && in_array($request->nameSort, ['asc', 'desc'])) {
            $query->join('clients', 'clients.client_id', '=', 'transactions.client_id')
                  ->orderBy(DB::raw("CONCAT(clients.first_name, ' ', clients.last_name)"), $request->nameSort)
                  ->select('transactions.*');
        }

        // Paginate the results (10 clients per page) and preserve query parameters for pagination
        $clients = $query->paginate(10)->appends($request->except('page'));

        // Redirect to the first page if the current page is empty
        if ($clients->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.payment_info.client_info', ['page' => 1]);
        }

        // Return the view with clients and branches
        return view('system-admin.payment_info.client_info', compact('clients', 'branches'));
    }

    public function create_payment(Request $request)
    {
        $user = auth()->user();

        // Validate client and loan, and optionally branch_id for system-admin only
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'loan_id' => 'required|exists:loans,loan_id',
            'amount' => 'required|numeric|min:0',
            'branch_id' => $user->role === 'system-admin' ? 'required|exists:branches,branch_id' : 'nullable',
        ]);

        // Get current number of payments and increment for this payment
        $terms = Loan::where('loan_id', $request->loan_id)->value('progress');
        $terms = $terms + 1;

        // Get the payment per term
        $amount_due = Loan::where('loan_id', $request->loan_id)->value('pay_per_term');
        $today = Carbon::now()->toDateString();

        // Get loan details
        $loan = Loan::where('loan_id', $request->loan_id)->first();
        $dateRelease = Carbon::parse($loan->date_release);
        $paymentSched = strtolower($loan->payment_schedule);

        // Update loan progress and balances
        $loan->progress = $terms;
        $loan->rem_balance = $loan->rem_balance - $request->amount;
        $loan->tot_amnt_pd = $loan->tot_amnt_pd + $request->amount;

        // Check if loan is completed
        if ($loan->progress >= $loan->total_progress && $loan->rem_balance <= 0) {
            $loan->status = 'completed';
        }

        $loan->save();

        // Determine due date based on schedule
        switch ($paymentSched) {
            case 'weekly':
                $dueDate = $dateRelease->copy()->addWeek();
                break;
            case 'monthly':
                $dueDate = $dateRelease->copy()->addMonth();
                break;
            default:
                $dueDate = $dateRelease;
                break;
        }

        // Use the system-admin's branch_id if available, otherwise use the logged-in user's branch_id
        $branch_id = $request->branch_id ?? $user->branch_id;

        // Create payment record
        $payment = new ClientPayment([
            'loan_id' => $request->loan_id,
            'client_id' => $request->client_id,
            'branch_id' => $branch_id,
            'term' => $terms,
            'amount_pd' => $request->amount,
            'amount_due' => $amount_due,
            'payment_date' => $today,
            'due_date' => $dueDate->toDateString(),
        ]);

        $payment->save();

        return response()->json(['message' => 'Payment successfully recorded.']);
    }
}
