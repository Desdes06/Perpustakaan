<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

use function Symfony\Component\String\b;

Route::get('/berandaadmin', function () {
    return view('BerandaAdmin');
})->middleware('auth');


Route::get('/beranda', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/pinjam', function () {
    return view('pinjam');
});

Route::get('/beranda', [BukuController::class, 'get']);
Route::get('/tambahbuku', [BukuController::class, 'halaman'])->name('tambahbuku')->middleware('auth');
Route::post('/tambahbuku',[BukuController::class, 'storebuku'])->middleware('auth');
Route::get('/',[RouteController::class, 'routehome']);
Route::get('/registrasi',[RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/registrasi',[RegistrasiController::class, 'post'])->name('registrasi akun');
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate'])->name('verifikasi');
Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');