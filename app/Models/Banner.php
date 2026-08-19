<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['judul', 'subjudul', 'gambar', 'link_url', 'tampilkan_teks', 'urutan', 'aktif'];

    protected $casts = [
        'aktif' => 'boolean',
        'tampilkan_teks' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }

    /**
     * URL gambar banner. Mendukung dua sumber:
     * - Upload lewat admin panel -> disimpan di storage disk "public" (path relatif, contoh: "banners/xxx.jpg")
     * - Aset statis yang ikut di-commit ke repo (path diawali "images/", contoh: "images/promo/xxx.png")
     */
    public function getGambarUrlAttribute(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }

        return asset('storage/'.$this->gambar);
    }
}
