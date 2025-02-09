<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserViewController extends Controller
{
    public function berandauser(){
        return view('User.dashboard');
    }

    public function halamanpinjam(){
        return view('User.pinjam');
    }
}
