<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientPayment;

class ClientPaymentController extends Controller
{
    public function index()
    {
        $payments = ClientPayment::all();
        return view('admin.payment_info.client_info', compact('payments'));
    }
}
