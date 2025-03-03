<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HasUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role "admin"
        if (Auth::check() && Auth::user()->role_id === 1) {
            return $next($request);
        }

        return redirect('/Admin/berandaadmin')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
