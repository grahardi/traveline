<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'nama_perusahaan', 'tagline', 'deskripsi',
        'alamat_kepanjen', 'alamat_turen',
        'whatsapp', 'telepon', 'email',
        'instagram', 'facebook', 'tiktok', 'youtube',
        'maps_url', 'logo',
    ];

    /**
     * Ambil satu-satunya baris pengaturan situs (buat default jika belum ada).
     */
    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1], [
            'nama_perusahaan' => 'Traveline Turen',
            'tagline' => 'Jasa Tiket & Travel Segala Jurusan',
        ]);
    }

    public function getWhatsappLinkAttribute(): ?string
    {
        if (! $this->whatsapp) {
            return null;
        }

        $number = preg_replace('/\D/', '', $this->whatsapp);

        return 'https://api.whatsapp.com/send?phone='.$number;
    }
}
