<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Armada extends Model
{
    protected $fillable = [
        'nama', 'slug', 'foto_utama', 'deskripsi',
        'fitur_utama', 'fitur_lainnya',
        'kapasitas_seat', 'seat_tersedia', 'status_ketersediaan',
        'aktif', 'urutan',
    ];

    protected $casts = [
        'fitur_utama' => 'array',
        'fitur_lainnya' => 'array',
        'aktif' => 'boolean',
        'kapasitas_seat' => 'integer',
        'seat_tersedia' => 'integer',
    ];

    public const STATUS_KETERSEDIAAN = [
        'tersedia' => 'Tersedia',
        'terbatas' => 'Sisa Terbatas',
        'penuh' => 'Penuh',
    ];

    protected static function booted(): void
    {
        static::saving(function (Armada $armada) {
            if (blank($armada->slug)) {
                $armada->slug = Str::slug($armada->nama.'-'.uniqid());
            }
        });
    }

    public function fotos(): HasMany
    {
        return $this->hasMany(ArmadaFoto::class)->orderBy('urutan');
    }

    public function layanans(): BelongsToMany
    {
        return $this->belongsToMany(Layanan::class, 'armada_layanan');
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }

    public function getStatusKetersediaanLabelAttribute(): string
    {
        return self::STATUS_KETERSEDIAAN[$this->status_ketersediaan] ?? $this->status_ketersediaan;
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status_ketersediaan) {
            'tersedia' => 'bg-success',
            'terbatas' => 'bg-warning text-dark',
            'penuh' => 'bg-secondary',
            default => 'bg-light text-dark',
        };
    }

    public function getFotoUtamaUrlAttribute(): ?string
    {
        if (! $this->foto_utama) {
            return null;
        }

        return asset('storage/'.$this->foto_utama);
    }
}
