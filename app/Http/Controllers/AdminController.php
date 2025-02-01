<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loan()
    {
        return view('admin.loan.loan');
    }
    
    public function client()
    {
        return view('admin.client');
    }
    
    public function investor()
    {
        return view('admin.investor');
    }

    public function payment()
    {
        return view('admin.payment');
    }
}
