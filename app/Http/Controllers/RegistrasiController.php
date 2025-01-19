<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }

    public function post(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'username' => 'required',
            'password' => 'required|string|confirmed|min:8'
        ]);

        User::create([
        'username' => $request['username'],
        'email' => $request['email'],
        'password' => bcrypt($request['password']),
        ]);

        return redirect('/login')->with('message', 'Registrasi berhasil, silakan login.');
    }
}
