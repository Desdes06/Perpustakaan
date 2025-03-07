<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\SendOtpNotification;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('Auth.registrasi');
    }

    public function post(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255|email:dns|unique:users,email',
            'username' => 'required',
            'password' => 'required|string|confirmed|min:8'
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'username.required' => 'Nama wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $otp = rand(100000, 999999);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp
        ]);

        $user->notify(new SendOtpNotification($otp));

        return redirect()->route('verification.show', ['email' => $user->email]);
    }
}
