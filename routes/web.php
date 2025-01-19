<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/beranda', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/pinjam', function () {
    return view('pinjam');
});

Route::get('/registrasi',[RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/registrasi',[RegistrasiController::class, 'post'])->name('registrasi akun');
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate'])->name('verifikasi');
Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');