<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index() 
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
    
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
        
            if (Auth::user()->role_id == '2') {
                return redirect()->intended('/berandaadmin');
            }
        
            return redirect()->intended('/beranda');
        }
        
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message', 'Anda telah berhasil logout');
    }
}
