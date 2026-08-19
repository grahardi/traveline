<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    protected $fillable = [
        'kategori', 'nama', 'slug', 'asal', 'tujuan',
        'harga', 'satuan_harga', 'deskripsi', 'gambar',
        'unggulan', 'aktif', 'urutan',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'unggulan' => 'boolean',
        'aktif' => 'boolean',
    ];

    public const KATEGORI = [
        'bus' => 'Tiket Bus',
        'travel' => 'Travel / Shuttle',
        'pesawat' => 'Tiket Pesawat',
        'kapal' => 'Tiket Kapal Laut',
        'paket' => 'Kirim Paket',
    ];

    protected static function booted(): void
    {
        static::saving(function (Layanan $layanan) {
            if (blank($layanan->slug)) {
                $layanan->slug = Str::slug($layanan->nama.'-'.$layanan->asal.'-'.$layanan->tujuan.'-'.uniqid());
            }
        });
    }

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeUnggulan($query)
    {
        return $query->where('unggulan', true);
    }

    public function getKategoriLabelAttribute(): string
    {
        return self::KATEGORI[$this->kategori] ?? $this->kategori;
    }

    public function getRuteAttribute(): string
    {
        if ($this->asal && $this->tujuan) {
            return "{$this->asal} - {$this->tujuan}";
        }

        return $this->nama;
    }

    public function getHargaFormatAttribute(): ?string
    {
        if (! $this->harga) {
            return null;
        }

        return 'Rp '.number_format((float) $this->harga, 0, ',', '.');
    }

    public function getWhatsappOrderLinkAttribute(): string
    {
        $setting = SiteSetting::current();
        $number = preg_replace('/\D/', '', (string) $setting->whatsapp);
        $pesan = "Halo Traveline, saya ingin memesan {$this->kategori_label}: {$this->rute}. Mohon info ketersediaan dan cara pemesanannya. Terima kasih.";

        return 'https://api.whatsapp.com/send?phone='.$number.'&text='.rawurlencode($pesan);
    }
}
