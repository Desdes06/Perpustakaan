<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RouteController extends Controller
{
    public function routehome()
    {
        if (Auth::check()) {
            return redirect('/beranda');
        }
        return view('homepage');
    }

}
