<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Pinjam extends Model
{

    protected $table = 'pinjam';

    protected $fillable = [
        'id_buku', 
        'id_user', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
        'status_buku'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pinjam) {
            if (!$pinjam->tanggal_kembali) {
                $pinjam->tanggal_kembali = Carbon::parse($pinjam->tanggal_pinjam)->addDays(5);
            }
        });
    }

    // public static function autoReturnBooks()
    // {
    //     $today = Carbon::today();

    //     $peminjaman = self::where('status_buku', 'dipinjam')
    //                     ->where('tanggal_kembali', '<', $today)
    //                     ->get();

    //     foreach ($peminjaman as $pinjam) {
            
    //         Pengembalian::create([
    //             'id_buku' => $pinjam->id_buku,
    //             'id_user' => $pinjam->id_user,
    //             'tanggal_pengembalian' => $today,
    //         ]);

    //         Riwayat::create([
    //             'id_buku' => $pinjam->id_buku,
    //             'id_user' => $pinjam->id_user,
    //             'tanggal_pinjam' => $pinjam->tanggal_pinjam,
    //             'tanggal_kembali' => $today,
    //         ]);

    //         // Update status buku menjadi dikembalikan
    //         $pinjam->update(['status_buku' => 'dikembalikan']);
    //     }
    // }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
