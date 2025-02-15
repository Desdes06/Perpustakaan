<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Riwayat extends Model
{
    protected $table = 'riwayat';

    protected $fillable = [
        'id_buku', 
        'id_user', 
        'tanggal_pinjam', 
        'tanggal_kembali', 
    ];

    // Relasi ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Buku
    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
