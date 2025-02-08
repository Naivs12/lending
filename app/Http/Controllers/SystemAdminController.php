<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemAdminController extends Controller
{
    public function SystemAdminDashboard()
    {
        return view('layout.system-admin');
    }
}
