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

    // Handle login authentication
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || $request->password !== $user->password) {
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }
    
        Auth::login($user);
    
        // Redirect based on role
        return $user->role === 'admin' ? redirect()->route('admin.loan.loan') : redirect()->route('/login');

        
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     Log::info('User authenticated: ' . Auth::user()->email); // Debug log
        //     return $this->authenticated($request, Auth::user());
        // }

        // Log::warning('Login failed for email: ' . $request->email);
        // return redirect()->back()->with('error', 'Invalid email or password.');
    }

    // Redirect user after authentication
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->intended('/admin/loan/loan'); // Redirect admin
        }
        return redirect()->intended('/home'); // Redirect normal users
    }


    // // Logout function
    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/login');
    // }
}

