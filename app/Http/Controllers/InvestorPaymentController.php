<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestorPayment;
use App\Models\Investor;
use App\Models\Branch;

class InvestorPaymentController extends Controller
{
public function index(Request $request)
{
    $query = InvestorPayment::with('investor'); // Eager load the investor relationship

    // Search by investor name or address
    if ($request->filled('query')) {
        $search = $request->input('query');

        $query->whereHas('investor', function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('middle_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('address', 'like', "%{$search}%");
        });
    }

    // Filter by branch
    if ($request->filled('branch')) {
        $query->where('branch_id', $request->input('branch'));
    }

    // Sort by investor first name
    if ($request->filled('nameSort')) {
        $direction = $request->input('nameSort') === 'desc' ? 'desc' : 'asc';

        // Use a subquery to sort by related investor's name
        $query->join('investors', 'transactions_inv.investor_id', '=', 'investors.id')
              ->orderBy('investors.first_name', $direction)
              ->select('transactions_inv.*'); // prevent column conflict
    }

    $payments = $query->paginate(10);
    $branches = Branch::all();
    $investor = Investor::all();

    return view('system-admin.payment_info.investor_info', compact('payments', 'branches', 'investor'));
}



    public function store(Request $request)
    {
        $request->validate([
            'investor_id' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $investor = InvestorPayment::create([
            'investor_id' => $request->investor_id,
            'amount' => $request->amount,
            'payment_date' => now(),
        ]);

        return response()->json(['message' => 'Payment added successfully!']);
    }


public function search(Request $request)
{
    $query = $request->input('query');
    $investors = \App\Models\Investor::where('investor_id', 'like', "%{$query}%")
        ->orWhereRaw("CONCAT_WS(' ', first_name, middle_name, last_name) LIKE ?", ["%{$query}%"])
        ->limit(10)
        ->get(['investor_id', 'first_name', 'middle_name', 'last_name']);

    // Format the results for the suggestion box
    $results = $investors->map(function($inv) {
        return [
            'investor_id' => $inv->investor_id,
            'full_name' => trim("{$inv->first_name} {$inv->middle_name} {$inv->last_name}")
        ];
    });

    return response()->json($results);
}
}