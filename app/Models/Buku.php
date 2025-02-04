<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'foto',
        'file_buku'
    ];

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'id_buku');
    }

    public function pinjam(): HasMany
    {
        return $this->hasMany(Pinjam::class, 'id_buku');
    }

    public function scopeFilter(Builder $query): void
    {
        
        $query->where('judul_buku', 'like', '%' . request('search') . '%');
    }

}
