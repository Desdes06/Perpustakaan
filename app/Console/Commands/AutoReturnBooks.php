<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pinjam;
use App\Models\Pengembalian;
use App\Models\Riwayat;
use Carbon\Carbon;

class AutoReturnBooks extends Command
{
    protected $signature = 'books:auto-return';
    protected $description = 'Otomatis mengembalikan buku yang melewati tanggal kembali';

    public function handle()
    {
        $today = Carbon::today();

        $peminjaman = Pinjam::where('status_buku', 'dipinjam')
                            ->where('tanggal_kembali', '<', $today)
                            ->get();

        foreach ($peminjaman as $pinjam) {
            Pengembalian::create([
                'id_buku' => $pinjam->id_buku,
                'id_user' => $pinjam->id_user,
                'tanggal_pengembalian' => $today,
            ]);

            Riwayat::create([
                'id_buku' => $pinjam->id_buku,
                'id_user' => $pinjam->id_user,
                'tanggal_pinjam' => $pinjam->tanggal_pinjam,
                'tanggal_kembali' => $today,
            ]);

            $pinjam->update(['status_buku' => 'dikembalikan']);
        }

        $this->info(count($peminjaman) . " buku telah dikembalikan otomatis.");
    }

}