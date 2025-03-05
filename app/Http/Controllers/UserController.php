<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::paginate(10); 
        $branches = Branch::all(); // Fetch all branches
            
        if ($users->isEmpty() && $request->page > 1) {
            return redirect()->route('system-admin.maintenance.user', ['page' => 1]);
        }

        return view('system-admin.maintenance.users', compact('users', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'name' => 'required',
            'branch_id' => 'required', // Ensure branch_id is selected
        ]);

        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), // Encrypt password
            'name' => $request->name,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->back()->with('success', 'User added successfully!');
    }
}
