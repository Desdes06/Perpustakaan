<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pinjam;
use App\Models\Pengembalian;
use App\Models\Riwayat;
use App\Models\User;
use App\Models\Buku;
use App\Notifications\OverdueBookNotification;
use Carbon\Carbon;

class AutoReturnBooks extends Command
{
    protected $signature = 'books:auto-return';
    protected $description = 'Otomatis mengembalikan buku yang melewati tanggal kembali dan mengirim email notifikasi';

    public function handle()
    {
        $today = Carbon::today();

        $peminjaman = Pinjam::where('status_buku', 'dipinjam')
                            ->where('tanggal_kembali', '<', $today)
                            ->get();

        foreach ($peminjaman as $pinjam) {

            $user = User::find($pinjam->id_user);
            $buku = Buku::find($pinjam->id_buku);

            if ($user && $buku) {

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

                $user->notify(new OverdueBookNotification($buku->judul_buku, $today));
            }
        }

        $this->info(count($peminjaman) . " buku telah dikembalikan otomatis dan notifikasi email telah dikirim.");
    }
}