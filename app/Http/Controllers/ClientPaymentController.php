<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientPayment;
use App\Models\Loan;
use App\Models\Branch;
use Carbon\Carbon;

class ClientPaymentController extends Controller
{
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function index()
    {
        $payments = ClientPayment::with('client')->get();
        return view('admin.payment_info.client_info', compact('payments'));
    }

    public function create_payment(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,client_id',
            'loan_id' => 'required|exists:loans,loan_id',
            'amount' => 'required|numeric|min:0',
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
        $loan->progress = $terms;
        $loan->rem_balance = $loan->rem_balance - $request->amount;
        $loan->tot_amnt_pd = $loan->tot_amnt_pd + $request->amount;
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

        // Create payment record
        $payment = new ClientPayment([
            'loan_id' => $request->loan_id,
            'client_id' => $request->client_id,
            'branch_id' => auth()->user()->branch_id,
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
