<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller {

    public function index(Request $request) {
        $branches = Branch::paginate(10); 
            
        if ($branches->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.maintenance.branch', ['page' => 1]);
        }

        return view('system-admin.maintenance.branch', compact('branches'));
    }

    public function store(Request $request) {
        // Validate input
        $request->validate([
            'branch_name' => 'required|string|max:100',
            'address' => 'required|string',
            'contact_number' => 'required|string',
        ]);

        // Generate next branch_id
        $lastBranch = Branch::latest('id')->first();
        $nextNumber = $lastBranch ? (intval(substr($lastBranch->branch_id, 2)) + 1) : 1;
        $branch_id = 'B-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Create new branch
        Branch::create([
            'branch_id' => $branch_id,
            'branch_name' => $request->branch_name,
            'address' => $request->address,
            'contact_number' => $request->contact_number
        ]);

        return response()->json(['message' => 'Branch added successfully!']);
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['error' => 'Branch not found'], 404);
        }

        $branch->delete();
        
        return response()->json(['message' => 'Branch deleted successfully']);
    }

    
}

