<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penerbit extends Model
{
    protected $table = 'penerbit';

    protected $fillable = [
        'kode_isbn',
        'nama_penerbit'
    ];

    public function buku(): HasMany
    {
        return $this->hasMany(Buku::class, 'penerbit_id');
    }
}
