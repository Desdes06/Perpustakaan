<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Riwayat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserViewController extends Controller
{
    public function berandauser(Request $request)
    {

        $tanggalSekarang = Carbon::now()->locale('id');

        if ($request->has('search')) {

            return redirect()->route('user.buku.search', ['search' => $request->search]);
        }

        $bukuTerbaru = Buku::with('kategori') 
                        ->latest()
                        ->take(7)->get(); 
        $buku = Buku::with('kategori')
                ->take(7)->get();

        return view('User.dashboard', compact('buku', 'bukuTerbaru', 'tanggalSekarang'));
    }

    public function halamanpinjam(){
        return view('User.pinjam');
    }

    public function buku(){
        return view('User.buku');
    }

    public function riwayat(Request $request){

        $userId = Auth::id();

        if ($request->has('search')) {

            return redirect()->route('user.buku.search', ['search' => $request->search]);
        }

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $riwayat = Riwayat::where('id_user', $userId)->paginate(12);

        return view('User.riwayat', compact('riwayat'));
    }
}
