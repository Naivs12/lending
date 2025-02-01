<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemAdminController extends Controller
{
    public function SystemAdminDashboard()
    {
        return view('system-admin.dashboard');
    }
}
