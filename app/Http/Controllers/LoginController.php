<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() 
    {
        return view('Auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && is_null($user->email_verified_at)) {
            return redirect()->route('verification.show', ['email' => $request->email])
            ->with('loginError', 'Akun belum terverifikasi! Silakan masukkan kode OTP yang dikirim ke email Anda.');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role_id == '2') {
                return redirect()->intended('/Admin/berandaadmin');
            }

            return redirect()->intended('/User/beranda');
        }

        return redirect()->back()->with('loginError', 'Login Gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/Auth/login')->with('message', 'Anda telah berhasil logout');
    }
}
