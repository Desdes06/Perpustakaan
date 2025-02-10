<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserlistController;
use Illuminate\Support\Facades\Route;

Route::get('/',[RouteController::class, 'routehome']);
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('deletebuku');
Route::post('/kembalikan/{id_buku}', [BukuController::class, 'pengembalian'])->name('kembalikanbuku');

// route view halaman admin
Route::group(['prefix'=>'Admin','as'=>'Admin.', 'middleware'=>['auth']], function(){
    Route::get('/berandaadmin', ['as' => 'beranda', 'uses' => 'App\Http\Controllers\AdminViewController@beranda']);
    Route::get('/listbuku', ['as' => 'buku', 'uses' => 'App\Http\Controllers\AdminViewController@listbuku']);
    Route::get('/listpinjam', ['as' => 'pinjam', 'uses' => 'App\Http\Controllers\AdminViewController@listpinjam']);
    Route::get('/listpengembalian', ['as' => 'pengembalian', 'uses' => 'App\Http\Controllers\AdminViewController@listpengembalian']);
    Route::get('/tambahbuku', ['as' => 'tambahbuku', 'uses' => 'App\Http\Controllers\AdminViewController@tambahbuku']);
    Route::get('/anggota', ['as' => 'anggota', 'uses' => 'App\Http\Controllers\AdminViewController@anggota']);

    //route menampilkan data list user
    Route::get('/anggota', ['as' => 'listanggota', 'uses' => 'App\Http\Controllers\UserlistController@userlist']);
    // route menambah data buku
    Route::post('/tambahbuku',['as' => 'tambahbuku', 'uses' => 'App\Http\Controllers\BukuController@storebuku']);
    // route edit data buku
    Route::put('/updatebuku/{id}',['as' => 'updatebuku', 'uses' => 'App\Http\Controllers\BukuController@updatebuku']);
});

//route view halaman user
Route::group(['prefix'=>'User','as'=>'User.', 'middleware'=>['auth']], function(){
    Route::get('/beranda', ['as' => 'beranda', 'uses' => 'App\Http\Controllers\UserViewController@berandauser']);
    Route::get('/pinjam', ['as' => 'pinjam', 'uses' => 'App\Http\Controllers\UserViewController@halamanpinjam']);

    // route pinjam buku
    Route::post('/pinjam', ['as' => 'pinjamcreate', 'uses' => 'App\Http\Controllers\BukuController@pinjam']);
    //route list buku dipinjam 
    Route::get('/pinjam', ['as' => 'pinjamlist', 'uses' => 'App\Http\Controllers\BukuController@listbukupinjam']);
    Route::get('/bacabuku/{id}',  ['as' => 'baca.buku', 'uses' => 'App\Http\Controllers\BukuController@baca']);
});

//route view halaman Auth
Route::group(['prefix'=>'Auth','as'=>'Auth.','middleware'=>['auth']], function(){
    Route::get('/profile', ['as' => 'profile', 'uses' => 'App\Http\Controllers\UserlistController@profile']);

    // profile data dan update
    Route::put('/profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\UserlistController@editprofile']);
    Route::get('/logout',['as' => 'logout', 'uses' => 'App\Http\Controllers\LoginController@logout']);
});

// route halaman login
Route::group(['prefix'=>'Auth', 'middleware' => ['guest']], function(){
    Route::get('/login',['as' => 'login', 'uses' => 'App\Http\Controllers\LoginController@index']);
    Route::post('/login',['as' => 'verifikasi', 'uses' => 'App\Http\Controllers\LoginController@authenticate']);
    Route::get('/registrasi',['as' => 'verifikasi', 'uses' => 'App\Http\Controllers\RegistrasiController@index']);
    Route::post('/registrasi',['as' => 'registrasiakun', 'uses' => 'App\Http\Controllers\RegistrasiController@post']);
});

// Routes untuk serch dengan filter
Route::get('/User/beranda/{filter?}', [BukuController::class, 'filter'])->name('user.beranda')->middleware('autth');
Route::get('/User/pinjam/{filter?}', [BukuController::class, 'filter'])->name('user.pinjam')->middleware('auth');
Route::get('/Admin/listbuku/{filter?}', [BukuController::class, 'filter'])->name('admin.listbuku')->middleware('auth');
Route::get('/Admin/listpinjam/{filter?}', [BukuController::class, 'filter'])->name('admin.listpinjam')->middleware('auth');
Route::get('/Admin/listpengembalian/{filter?}', [BukuController::class, 'filter'])->name('admin.listpengembalian')->middleware('auth');

// Routes untuk search
Route::get('/User/beranda', [BukuController::class, 'filter'])->name('user.beranda.search')->middleware('auth');
Route::get('/User/pinjam', [BukuController::class, 'filter'])->name('user.pinjam.search')->middleware('auth');
Route::get('/Admin/listbuku', [BukuController::class, 'filter'])->name('admin.listbuku.search')->middleware('auth');
Route::get('/Admin/listpinjam', [BukuController::class, 'filter'])->name('admin.listpinjam.search')->middleware('auth');
Route::get('/Admin/listpengembalian', [BukuController::class, 'filter'])->name('admin.listpengembalian.search')->middleware('auth');
Route::get('/Admin/anggota', [UserlistController::class, 'userlist'])->name('admin.anggota.search')->middleware('auth');