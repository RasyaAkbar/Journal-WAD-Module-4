<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        // ===============1==============
        // If the requested route is 'login', 'register', or '/', allow access without authentication check.
        if () {
            return $next($request);
        }

        //// ===============2==============
        // If the user is not authenticated, redirect to the login page with an error message.
        if () {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan!');
        }

        return $next($request);
    }
}
