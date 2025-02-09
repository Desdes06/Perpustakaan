<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pengembalian;
use App\Models\Pinjam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminViewController extends Controller
{
    public function beranda(){
        $tanggalSekarang = Carbon::now()->locale('id');
        $jumlahUser = User::where('role_id', 1)->count();
        $jumlahpinjam = Pinjam::all()->count();
        $jumlahbuku = Buku::all()->count();
        $pengembalian = Pengembalian::all()->count();
        return view('Admin.Berandaadmin', compact('tanggalSekarang', 'jumlahUser', 'jumlahpinjam', 'jumlahbuku', 'pengembalian'));
    }

    public function listbuku(){
        return view('Admin.listbuku');
    }

    public function listpinjam(){
        return view('Admin.listpinjam');
    }

    public function listpengembalian(){
        return view('Admin.listpengembalian');
    }

    public function tambahbuku(){
        return view('Admin.tambahbuku');
    }

    public function anggota(){
        return view('Admin.anggota');
    }
}
