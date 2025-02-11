<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $roleId): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/Auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Jika user role_id = 1 (User) mencoba akses halaman Admin (role_id = 2), redirect ke user dashboard
        if ($roleId == 2 && $user->role_id != 2) {
            return redirect('/User/beranda')->with('error', 'Anda tidak memiliki akses ke halaman admin.');
        }

        // Jika user role_id = 2 (Admin) mencoba akses halaman User (role_id = 1), redirect ke admin dashboard
        if ($roleId == 1 && $user->role_id != 1) {
            return redirect('/Admin/berandaadmin')->with('error', 'Admin tidak bisa mengakses halaman user.');
        }

        return $next($request);
    }
}
