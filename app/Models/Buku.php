<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{

    use HasFactory, SoftDeletes;

    protected $table ='buku';

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    protected $fillable = [
        'judul_buku',
        'penulis',
        'penerbit_id',
        'tanggal_terbit',
        'deskripsi',
        'rating',
        'id_kategori',
        'status',
        'foto',
        'file_buku',
        'isbn',
    ];

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'id_buku');
    }

    public function pinjam(): HasMany
    {
        return $this->hasMany(Pinjam::class, 'id_buku');
    }

    public function penerbit(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function scopeFilter(Builder $query): void
    {
        
        $query->where('judul_buku', 'like', '%' . request('search') . '%');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'id_buku', 'id');
    }
}
