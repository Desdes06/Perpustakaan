<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesans extends Model
{
    protected $table = 'pesans';

    protected $fillable = [ 
        'user_id', 
        'pesan',
        'reply',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getTotalPesan()
    {
        $totalPesan = Pesans::count();
        return response()->json(['jumlah' => $totalPesan]);
    }
}
