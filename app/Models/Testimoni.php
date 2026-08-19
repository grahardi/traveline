<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
    protected $fillable = ['nama', 'asal_daerah', 'pesan', 'rating', 'foto', 'aktif'];

    protected $casts = [
        'aktif' => 'boolean',
        'rating' => 'integer',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->latest();
    }
}
