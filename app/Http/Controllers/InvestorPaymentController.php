<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestorPayment;
use App\Models\Branch;

class InvestorPaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = InvestorPayment::query();

        // Search by investor name or address
        if ($request->filled('query')) {
            $search = $request->input('query');
            $query->where(function ($q) use ($search) {
                $q->where('investor_name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        // Filter by branch (if payments have branch_id)
        if ($request->filled('branch')) {
            $query->where('branch_id', $request->input('branch'));
        }

        // Sort by investor name
        if ($request->filled('nameSort')) {
            $direction = $request->input('nameSort') === 'desc' ? 'desc' : 'asc';
            $query->orderBy('investor_name', $direction);
        }

        $payments = $query->paginate(10);
        $branches = Branch::all();

        return view('system-admin.payment_info.investor_info', compact('payments', 'branches'));
    }
}