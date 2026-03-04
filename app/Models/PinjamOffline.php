<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PinjamOffline extends Model
{
    protected $table = 'table_pinjam_offline';

    protected $fillable = [
        'id_user',
        'id_buku',
        'nama_lengkap',
        'email',
        'no_tel',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku')->withTrashed();
    }
}
