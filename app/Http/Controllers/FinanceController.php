<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    /**
     * Display the finance dashboard.
     */

    public function index(Request $request)
    {
        $filter = $request->get('filter', 'daily');

        // Set date format based on filter
        if ($filter === 'annually') {
            $dateFormat = '%Y';
        } elseif ($filter === 'quarterly') {
            $dateFormat = 'quarter'; // We'll handle this below
        } elseif ($filter === 'monthly') {
            $dateFormat = '%Y-%m'; // monthly
        } elseif ($filter === 'daily') {
            $dateFormat = '%Y-%m-%d';
        }

        // Get all loans for reference
        $loans = Loan::select('loan_id', 'loan_amount')->get()->keyBy('loan_id');

        // Get transactions grouped by date and loan_id
        $transactions = Transaction::select(
                DB::raw('DATE(created_at) as date'),
                'loan_id',
                DB::raw('SUM(interest_per_payment) as total_paid')
            )
            ->groupBy('date', 'loan_id')
            ->orderBy('date')
            ->get();

        // Prepare chart data
        $chart = [];
        foreach ($transactions as $txn) {
            $loan = $loans[$txn->loan_id] ?? null;
            if (!$loan) continue;

            // Grouping by filter
            $date = $txn->date;
            if ($filter === 'annually') {
                $date = date('Y', strtotime($txn->date));
            } elseif ($filter === 'quarterly') {
                $month = date('n', strtotime($txn->date));
                $quarter = ceil($month / 3);
                $date = date('Y', strtotime($txn->date)) . '-Q' . $quarter;
            } elseif ($filter === 'daily') {
                $date = date('Y-m-d', strtotime($txn->date));
            } else {
                $date = date('Y-m', strtotime($txn->date));
            }

            $principal = $loan->loan_amount;
            $profit = $txn->total_paid;

            $chart[$date]['date'] = $date;
            $chart[$date]['principal'] = ($chart[$date]['principal'] ?? 0) + $principal;
            $chart[$date]['profit'] = ($chart[$date]['profit'] ?? 0) + $profit;
        }

        // Sort by date and prepare for JS
        ksort($chart);
        $labels = [];
        $principalData = [];
        $profitData = [];
        foreach ($chart as $row) {
            $labels[] = $row['date'];
            $principalData[] = $row['principal'];
            $profitData[] = $row['profit'];
        }

        // For AJAX requests (when filter changes)
        if ($request->ajax()) {
            return response()->json([
                'labels' => $labels,
                'profit' => $profitData,
                'principal' => $principalData,
            ]);
        }

        // For initial page load
        return view('system-admin.finance', [
            'labels' => $labels,
            'profitData' => $profitData,
            'principalData' => $principalData,
            'filter' => $filter,
        ]);
    }
}