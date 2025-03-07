<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function show(Request $request)
    {
        return view('Auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Kode OTP salah atau email tidak ditemukan.');
        }

        $user->update([
            'email_verified_at' => now(),
            'otp' => null
        ]);

        return redirect('/Auth/login')->with('message', 'Verifikasi berhasil! Silakan login.');
    }
}
