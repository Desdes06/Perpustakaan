<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\VerificationController;
use App\Http\Middleware\HasAdminMiddleware;
use App\Http\Middleware\HasUserMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/',[RouteController::class, 'routehome']);

Route::group(['middleware'=>['auth']], function(){
    // route view halaman admin
    Route::group(['prefix'=>'Admin','as'=>'Admin.', 'middleware' => [HasAdminMiddleware::class]], function(){
        Route::get('/berandaadmin', ['as' => 'beranda', 'uses' => 'App\Http\Controllers\AdminViewController@beranda']);
        Route::get('/listbuku', ['as' => 'listbuku', 'uses' => 'App\Http\Controllers\AdminViewController@listbuku']);
        Route::get('/listpinjam', ['as' => 'pinjam', 'uses' => 'App\Http\Controllers\AdminViewController@listpinjam']);
        Route::get('/listpengembalian', ['as' => 'pengembalian', 'uses' => 'App\Http\Controllers\AdminViewController@listpengembalian']);
        Route::get('/tambahbuku', ['as' => 'tambahbuku', 'uses' => 'App\Http\Controllers\AdminViewController@tambahbuku']);
        Route::get('/anggota', ['as' => 'anggota', 'uses' => 'App\Http\Controllers\AdminViewController@anggota']);
        Route::get('/kategori', ['as' => 'viewkategori', 'uses' => 'App\Http\Controllers\KategoriController@kategoridata']);
        

        //route menampilkan data list user
        Route::get('/anggota', ['as' => 'listanggota', 'uses' => 'App\Http\Controllers\UserlistController@userlist']);
        // route menambah data buku
        Route::post('/tambahbuku',['as' => 'tambahbuku', 'uses' => 'App\Http\Controllers\BukuController@storebuku']);
        // route tambah kategori
        Route::post('/tambahkategori', ['as' => 'tambahkategori', 'uses' => 'App\Http\Controllers\KategoriController@tambahkategori']);
        // route edit data buku
        Route::put('/updatebuku/{id}',['as' => 'updatebuku', 'uses' => 'App\Http\Controllers\BukuController@updatebuku']);
        // route edit kategori
        Route::put('/updatekategori/{id}',['as' => 'updatekategori', 'uses' => 'App\Http\Controllers\KategoriController@update']);
    });

    //route view halaman user
    Route::group(['prefix'=>'User','as'=>'User.','middleware' => [HasUserMiddleware::class]], function(){
        Route::get('/beranda', ['as' => 'beranda', 'uses' => 'App\Http\Controllers\UserViewController@berandauser']);
        Route::get('/pinjam', ['as' => 'pinjam', 'uses' => 'App\Http\Controllers\UserViewController@halamanpinjam']);
        Route::get('/buku', ['as' => 'buku', 'uses' => 'App\Http\Controllers\UserViewController@buku']);
        Route::get('/riwayat', ['as' => 'riwayat', 'uses' => 'App\Http\Controllers\UserViewController@riwayat']);

        // route pinjam buku
        Route::post('/pinjam', ['as' => 'pinjamcreate', 'uses' => 'App\Http\Controllers\BukuController@pinjam']);
        //route list buku dipinjam 
        Route::get('/pinjam', ['as' => 'pinjamlist', 'uses' => 'App\Http\Controllers\BukuController@listbukupinjam']);
        Route::get('/bacabuku/{id}',  ['as' => 'baca.buku', 'uses' => 'App\Http\Controllers\BukuController@baca']);
        
        Route::get('/buku-detail/{id}', ['as' => 'detail', 'uses' => 'App\Http\Controllers\BukuController@detail']);
        Route::post('/komentar', ['as' => 'komentar', 'uses' => 'App\Http\Controllers\BukuController@storekomen']);
        Route::delete('/comment/{id}', ['as' => 'comment', 'uses' => 'App\Http\Controllers\BukuController@rmkomen']);

        Route::delete('/riwayat/{id}', ['as' => 'riwayat', 'uses' => 'App\Http\Controllers\BukuController@hpsriwayat']);
    });

    //route view halaman profile
    Route::group(['prefix'=>'Auth','as'=>'Auth.'], function(){
        Route::get('/profile', ['as' => 'profile', 'uses' => 'App\Http\Controllers\UserlistController@profile']);

        // profile data dan update
        Route::put('/profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\UserlistController@editprofile']);
        Route::get('/logout',['as' => 'logout', 'uses' => 'App\Http\Controllers\LoginController@logout']);
    });

    // Routes untuk search dengan filter
    Route::get('/User/pinjam/{filter?}', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('user.pinjam');
    Route::get('/User/buku/{filter?}', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('user.buku');
    Route::get('/Admin/listbuku/{filter?}', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('admin.listbuku');
    Route::get('/Admin/listpinjam/{filter?}', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('admin.listpinjam');
    Route::get('/Admin/listpengembalian/{filter?}', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('admin.listpengembalian');

    // Routes untuk search
    Route::get('/User/pinjam', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('user.pinjam.search');
    Route::get('/User/buku', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('user.buku.search');
    Route::get('/Admin/listbuku', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('admin.listbuku.search');
    Route::get('/Admin/listpinjam', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('admin.listpinjam.search');
    Route::get('/Admin/listpengembalian', ['uses' => 'App\Http\Controllers\BukuController@filter'])->name('admin.listpengembalian.search');
    Route::get('/Admin/anggota', ['uses' => 'App\Http\Controllers\UserlistController@userlist'])->name('admin.anggota.search');

    //route action delete
    Route::delete('/buku/hapus-multiple', ['uses' => 'App\Http\Controllers\BukuController@destroyMultiple'])->name('deletebuku');
    Route::post('/kembalikan/{id_buku}', ['uses' => 'App\Http\Controllers\BukuController@pengembalian'])->name('kembalikanbuku');
    Route::delete('/Admin/delete-pengembalian', ['uses' => 'App\Http\Controllers\BukuController@deleteSelected'])->name('admin.delete.pengembalian');
    Route::delete('/Admin/delete-pinjam', ['uses' => 'App\Http\Controllers\BukuController@deletepinjam'])->name('admin.delete.pinjam');
    Route::delete('/kategori', ['uses' => 'App\Http\Controllers\KategoriController@destroy'])->name('deletekategori');

    // export
    Route::get('/admin/export-pengembalian', ['uses' => 'App\Http\Controllers\ExportController@exportpengembalian'])->name('admin.export.pengembalian');
    Route::get('/admin/exportpdf-pengembalian', ['uses' => 'App\Http\Controllers\ExportController@pdfpengembalian'])->name('admin.export.pengembalian.pdf');

    Route::get('/admin/export-pinjam', ['uses' => 'App\Http\Controllers\ExportController@exportpinjam'])->name('admin.export.pinjam');
    Route::get('/admin/exportpdf-pinjam', ['uses' => 'App\Http\Controllers\ExportController@pdfpinjam'])->name('admin.export.pinjam.pdf');

});

// route halaman login
Route::group(['prefix'=>'Auth', 'middleware' => ['guest']], function(){
    Route::get('/login',['as' => 'login', 'uses' => 'App\Http\Controllers\LoginController@index']);
    Route::post('/login',['as' => 'verifikasi', 'uses' => 'App\Http\Controllers\LoginController@authenticate']);
    Route::get('/registrasi',['as' => 'verifikasi', 'uses' => 'App\Http\Controllers\RegistrasiController@index']);
    Route::post('/registrasi',['as' => 'registrasiakun', 'uses' => 'App\Http\Controllers\RegistrasiController@post']);
    Route::get('/forgotpassword',['as' => 'forgot', 'uses' => 'App\Http\Controllers\ForgotpasswordController@forgotpassword']);
    Route::post('/forgotpassword',['as' => 'forgot.password', 'uses' => 'App\Http\Controllers\ForgotpasswordController@email']);
    Route::get('/reset-password/{token}', function (string $token) {
        return view('Auth.reset-password', ['token' => $token]);
    })->name('password.reset');
    Route::post('/reset-password',['as' => 'password.update', 'uses' => 'App\Http\Controllers\ForgotpasswordController@handling']);
});

// kode otp
Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.show')->middleware('guest');
Route::post('/email/verify', [VerificationController::class, 'verify'])->name('verification.verify')->middleware('guest');