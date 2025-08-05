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
        // Get filter values from request
        $selectedYear = $request->get('year');
        $selectedMonth = $request->get('month');

        // Get all unique year/months from transactions
        $dateQuery = Transaction::select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"))
            ->groupBy('ym')
            ->orderBy('ym', 'asc');

        $allMonths = $dateQuery->pluck('ym')->toArray();

        // If filter is set, use only that year/month
        if ($selectedYear && $selectedMonth) {
            $months = [$selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT)];
        } elseif ($selectedYear) {
            $months = array_filter($allMonths, fn($m) => strpos($m, $selectedYear . '-') === 0);
        } else {
            $months = $allMonths;
        }

        $monthlyPrincipal = [];
        $monthlyPaid = [];
        $monthlyUnpaid = [];

        foreach ($months as $month) {
            // Principal: sum of all loan_amounts created in this month
            $principal = Loan::where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $month)->sum('tot_amnt_w_int');
            // Paid: sum of all payments made in this month
            $paid = Transaction::where(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), $month)->sum('amount_pd');
            // Unpaid: principal - paid
            $unpaid = $principal - $paid;

            $monthlyPrincipal[] = $principal;
            $monthlyPaid[] = $paid;
            $monthlyUnpaid[] = $unpaid;
        }

        // For AJAX requests (when filter changes)
        if ($request->ajax()) {
            return response()->json([
                'labels' => $months,
                'principal' => $monthlyPrincipal,
                'paid' => $monthlyPaid,
                'unpaid' => $monthlyUnpaid,
            ]);
        }

        // For filter dropdowns
        $years = array_unique(array_map(fn($m) => substr($m, 0, 4), $allMonths));
        $monthsList = array_unique(array_map(fn($m) => substr($m, 5, 2), $allMonths));

        // For initial page load
        return view('system-admin.finance', [
            'labels' => $months,
            'principalData' => $monthlyPrincipal,
            'paidData' => $monthlyPaid,
            'unpaidData' => $monthlyUnpaid,
            'filter' => 'monthly',
            'years' => $years,
            'monthsList' => $monthsList,
            'selectedYear' => $selectedYear,
            'selectedMonth' => $selectedMonth,
        ]);
    }
}