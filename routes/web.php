<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserlistController;
use Illuminate\Support\Facades\Route;

// route untuk view
Route::get('/berandaadmin', function () {
    return view('BerandaAdmin');
})->middleware('auth');

Route::get('/beranda', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/anggota', function () {
    return view('anggota');
})->middleware('auth');

Route::get('/listbuku', function () {
    return view('listbuku');
})->middleware('auth')->name('listbuku');

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/pinjam', function () {
    return view('pinjam');
});

Route::get('/',[RouteController::class, 'routehome']);


//route menampilkan list user
Route::get('/anggota', [UserlistController::class, 'userlist'])->middleware('auth');

// route tambah buku
Route::get('/tambahbuku', [BukuController::class, 'halaman'])->name('tambahbuku')->middleware('auth');
Route::post('/tambahbuku',[BukuController::class, 'storebuku'])->middleware('auth');

// route edit data buku
Route::put('/updatebuku/{id}', [BukuController::class, 'updatebuku'])->name('updatebuku');

// route delete buku
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('deletebuku');

// route registrasi akun 
Route::get('/registrasi',[RegistrasiController::class, 'index'])->middleware('guest');
Route::post('/registrasi',[RegistrasiController::class, 'post'])->name('registrasi akun');

// route login dan logout
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate'])->name('verifikasi');
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

// route baca buku
Route::get('/bacabuku/{id}', [BukuController::class, 'baca'])->name('bacabuku')->middleware('auth');

// pinjam buku
Route::post('/pinjam', [BukuController::class, 'pinjam'])->name('pinjam.buku')->middleware('auth');