<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loan()
    {
        return view('admin.loan.loan');
    }
    public function release()
    {
        return view('admin.loan.release');
    }
    public function review()
    {
        return view('admin.loan.review');
    }
    public function client()
    {
        return view('admin.client');
    }
    
    public function investor()
    {
        return view('admin.investor');
    }

    public function payment_client()
    {
        return view('admin.payment_info.client_info');
    }
    public function payment_investor()
    {
        return view('admin.payment_info.investor_info');
    }
}
