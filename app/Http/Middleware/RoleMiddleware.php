<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // ===============1==============
        // Check if the user is authenticated and if their role matches one of the allowed roles.
        if () {
            return redirect()->route('home')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk mengakses halaman tersebut!');
        }

        return $next($request);
    }
}