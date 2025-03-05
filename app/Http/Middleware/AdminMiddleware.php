<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has a system-admin role
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return abort(403, 'Unauthorized Access');
        }

        return $next($request);
    }
}
