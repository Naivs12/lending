<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        // Find user by username
        $user = User::where('username', $request->username)->first();
    
        // FOR TESTING ONLY: Compare raw password (remove this in production)
        if (!$user || $request->password !== $user->password) {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    
        // Log in the user
        Auth::login($user);

        // Redirect based on role
        return match ($user->role) {
            'system-admin' => redirect()->route('system-admin.loan.loan'),
            'admin' => redirect()->route('admin.loan.loan'),
            default => redirect()->route('login'), // Redirect other users back to login
        };
    }
}

