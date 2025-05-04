<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;

class ArchiveController extends Controller
{
    public function index()
    {
        // Fetch loans with status 'completed' and paginate with 10 items per page
        $completedLoans = Loan::where('status', 'completed')->paginate(10);
        
        return view("system-admin.maintenance.archive", compact('completedLoans'));
    }
}
