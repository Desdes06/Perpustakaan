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
    public function beranda()
    {
        $tanggalSekarang = Carbon::now()->locale('id');
        $jumlahUser = User::where('role_id', 1)->count();
        $jumlahpinjam = Pinjam::count();
        $jumlahbuku = Buku::count();
        $pengembalian = Pengembalian::count();

        // Get the pengembalian data by month
        $pengembalianPerBulan = Pengembalian::selectRaw('MONTH(tanggal_pengembalian) as bulan, COUNT(*) as jumlah')
            ->whereNotNull('tanggal_pengembalian') 
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Get the pinjam data by month
        $pinjamPerBulan = Pinjam::selectRaw('MONTH(tanggal_pinjam) as bulan, COUNT(*) as jumlah')
            ->whereNotNull('tanggal_pinjam')
            ->where('status_buku', 'dipinjam')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Prepare the arrays for each month (1 to 12)
        $pengembalianPerBulanArray = array_fill(1, 12, 0);
        foreach ($pengembalianPerBulan as $bulan => $jumlah) {
            $pengembalianPerBulanArray[$bulan] = $jumlah;
        }

        $pinjamPerBulanArray = array_fill(1, 12, 0);
        foreach ($pinjamPerBulan as $bulan => $jumlah) {
            $pinjamPerBulanArray[$bulan] = $jumlah;
        }

        return view('Admin.Berandaadmin', compact('tanggalSekarang', 'jumlahUser', 'jumlahpinjam', 'jumlahbuku', 'pengembalian', 'pengembalianPerBulanArray', 'pinjamPerBulanArray'));
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
