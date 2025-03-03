<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemAdminController extends Controller
{
    public function loan()
    {
        return view('system-admin.loan.loan');
    }
    public function release()
    {
        return view('system-admin.loan.release');
    }
    public function review()
    {
        return view('system-admin.loan.review');
    }
    public function client()
    {
        return view('system-admin.client');
    }
    
    public function investor()
    {
        return view('system-admin.investor');
    }

    public function payment_client()
    {
        return view('system-admin.payment_info.client_info');
    }
    public function payment_investor()
    {
        return view('system-admin.payment_info.investor_info');
    }
    public function users()
    {
        return view('system-admin.maintenance.users');
    }
    public function branch()
    {
        return view('system-admin.maintenance.branch');
    }
}
