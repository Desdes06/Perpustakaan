<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        ]);

        User::create([
        'username' => $request['username'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        ]);

        return redirect('/Auth/login')->with('message', 'Registrasi berhasil, silakan login.');
    }
}
