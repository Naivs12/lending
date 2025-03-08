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

    public function create_user(Request $request)
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

    public function edit_user(Request $request)
    {
        try {
            // Validate request data
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'username' => 'required|string|unique:users,username,' . $request->user_id,
                'name' => 'required|string',
                'password' => 'nullable|min:6',
                'confirm_password' => 'nullable|same:password',
            ]);

            // Find user by ID
            $user = User::find($request->user_id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found!'], 404);
            }

            // Update user details
            $user->name = $request->name;
            $user->username = $request->username;

            // Update password only if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return response()->json(['success' => true, 'message' => 'User updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function delete_user($id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found!'], 404);
            }

            $user->delete();

            return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    
}
