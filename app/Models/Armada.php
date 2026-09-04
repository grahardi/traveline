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
        'kapasitas_seat', 'kursi_terbooking',
        'aktif', 'urutan',
    ];

    protected $casts = [
        'fitur_utama' => 'array',
        'fitur_lainnya' => 'array',
        'aktif' => 'boolean',
        'kapasitas_seat' => 'integer',
        'kursi_terbooking' => 'integer',
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

    /**
     * Kursi tersedia dihitung otomatis: kapasitas - kursi terbooking.
     * Kolom "seat_tersedia" lama (manual) sudah tidak dipakai — accessor ini
     * menimpanya supaya kode/view lama yang masih memanggil $armada->seat_tersedia tetap jalan.
     */
    public function getSeatTersediaAttribute(): ?int
    {
        if (is_null($this->kapasitas_seat)) {
            return null;
        }

        return max(0, $this->kapasitas_seat - (int) $this->kursi_terbooking);
    }

    /**
     * Status dihitung otomatis dari sisa kursi. Kalau kapasitas belum diisi,
     * dianggap tersedia (default aman, sesuai kursi_terbooking default 0).
     */
    public function getStatusKetersediaanAttribute(): string
    {
        if (is_null($this->kapasitas_seat) || $this->kapasitas_seat <= 0) {
            return 'tersedia';
        }

        $tersisa = $this->seat_tersedia;
        $ambangTerbatas = max(1, (int) ceil($this->kapasitas_seat * 0.2));

        if ($tersisa <= 0) {
            return 'penuh';
        }

        if ($tersisa <= $ambangTerbatas) {
            return 'terbatas';
        }

        return 'tersedia';
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
