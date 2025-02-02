<?php

use App\Models\Pinjam;
use Illuminate\Console\Scheduling\Schedule;
use App\Models\Pengembalian;
use Illuminate\Support\Carbon;

return function (Schedule $schedule) {
    $schedule->call(function () {
        // Batas waktu: 5 hari yang lalu
        $batasWaktu = Carbon::today()->subDays(5);

        // Ambil semua peminjaman yang sudah lebih dari 5 hari
        $pinjaman = Pinjam::whereDate('tanggal_pinjam', '<=', $batasWaktu)->get();

        foreach ($pinjaman as $pinjam) {
            // Pindahkan ke tabel pengembalian
            Pengembalian::create([
                'id_user' => $pinjam->id_user,
                'id_buku' => $pinjam->id_buku,
                'tanggal_pengembalian' => Carbon::today()
            ]);

            // Hapus dari tabel pinjam
            $pinjam->delete();
        }

        info('Semua buku yang melewati batas waktu telah dikembalikan otomatis.');
    })->dailyAt('00:00'); // Menjalankan setiap tengah malam
};
