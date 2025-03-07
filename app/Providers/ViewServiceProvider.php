<?php

namespace App\Providers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::share('kategori', Kategori::all());
        View::share('penerbit', Penerbit::all());
        // View::share('buku', Buku::all());
        // View::share('user', User::all());
        // View::share('pinjam', Pinjam::with('buku', 'user')->get());
        // view::share('pengembalian', Pengembalian::with('buku', 'user')->get());
    }
}
