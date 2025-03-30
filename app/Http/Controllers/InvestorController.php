<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;


class InvestorController extends Controller
{
    public function index(Request $request) {
        $investors = Investor::paginate(10); 
            
        if ($investors->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.maintenance.user', ['page' => 1]);
        }

        return view('system-admin.investor', compact('investors'));
    }

    public function add_investor(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'amount_invest' => 'required|numeric',
            'percentage' => 'required|numeric'
        ]);
    
        $lastInvestor = Investor::orderBy('investor_id', 'desc')->first();
    
        if ($lastInvestor) {
            $numericPart = (int) substr($lastInvestor->investor_id, 4); // Fixed variable name
            $newInvestorId = 'INV-' . str_pad($numericPart + 1, 7, '0', STR_PAD_LEFT);
        } else {
            $newInvestorId = 'INV-0000001';
        }
    
        Investor::create([
            'investor_id' => $newInvestorId,
            'first_name' => $request->first_name,
            'middle_name'=> $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'amount_invest'  => $request->amount_invest,
            'payment_percent'  => $request->percentage
        ]);
    
        return response()->json(['success' => true, 'message' => 'Investor added successfully!']);
    }

    public function show_investor_details($investor_id)
    {
        $investor = Investor::where('investor_id', $investor_id)->firstOrFail();
        return view('system-admin.investor_detail', compact('investor'));
    }
    
}
