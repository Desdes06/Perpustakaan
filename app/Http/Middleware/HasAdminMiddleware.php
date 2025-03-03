<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasAdminMiddleware
{
        /**
         * Handle an incoming request.
         */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role "admin"
        if (Auth::check() && Auth::user()->role_id === 2) {
            return $next($request);
        }

        return redirect('/User/beranda')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
