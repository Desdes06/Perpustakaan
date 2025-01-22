<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table ='buku';

    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit',
        'tanggal_terbit',
        'deskripsi',
        'kategori',
        'status',
        'foto'
    ];
}
