<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RouteController extends Controller
{
    public function routehome()
    {   
        if (Auth::check()) {
            
            if (Auth::user()->role_id == '2') {
                return redirect()->intended('/Admin/berandaadmin');
            }

            return redirect('/User/beranda');
        }

        return view('homepage');
    }

}
