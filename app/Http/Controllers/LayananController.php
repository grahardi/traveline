<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Layanan;
use App\Models\SiteSetting;

class LayananController extends Controller
{
    public function index(Request $request = null)
    {
        $request = $request ?: request();
        $setting = SiteSetting::current();

        $query = Layanan::aktif()->orderBy('urutan')->orderBy('nama');

        if ($kategori = $request->query('kategori')) {
            $query->where('kategori', $kategori);
        }

        if ($cari = $request->query('cari')) {
            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'ilike', "%{$cari}%")
                    ->orWhere('asal', 'ilike', "%{$cari}%")
                    ->orWhere('tujuan', 'ilike', "%{$cari}%");
            });
        }

        $layanans = $query->paginate(12)->withQueryString();
        $kategoriList = Layanan::KATEGORI;

        return view('layanan.index', compact('layanans', 'kategoriList', 'setting'));
    }

    public function show(string $slug)
    {
        $layanan = Layanan::aktif()->where('slug', $slug)->firstOrFail();
        $setting = SiteSetting::current();
        $terkait = Layanan::aktif()
            ->where('kategori', $layanan->kategori)
            ->where('id', '!=', $layanan->id)
            ->take(4)
            ->get();

        return view('layanan.show', compact('layanan', 'setting', 'terkait'));
    }
}
