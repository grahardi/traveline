<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArmadaFoto extends Model
{
    protected $fillable = ['armada_id', 'foto', 'urutan'];

    public function armada(): BelongsTo
    {
        return $this->belongsTo(Armada::class);
    }

    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        return asset('storage/'.$this->foto);
    }
}
