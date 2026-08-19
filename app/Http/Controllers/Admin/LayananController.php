<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $query = Layanan::query()->orderBy('urutan')->orderBy('nama');

        if ($kategori = $request->query('kategori')) {
            $query->where('kategori', $kategori);
        }

        $layanans = $query->paginate(15)->withQueryString();
        $kategoriList = Layanan::KATEGORI;

        return view('admin.layanans.index', compact('layanans', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList = Layanan::KATEGORI;

        return view('admin.layanans.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nama'], $data['asal'] ?? null, $data['tujuan'] ?? null);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('layanans', 'public');
        }

        Layanan::create($data);

        return redirect()->route('admin.layanans.index')->with('status', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        $kategoriList = Layanan::KATEGORI;

        return view('admin.layanans.edit', compact('layanan', 'kategoriList'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $data = $this->validated($request, $layanan);

        if ($request->hasFile('gambar')) {
            if ($layanan->gambar) {
                Storage::disk('public')->delete($layanan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('layanans', 'public');
        }

        $layanan->update($data);

        return redirect()->route('admin.layanans.index')->with('status', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->gambar) {
            Storage::disk('public')->delete($layanan->gambar);
        }
        $layanan->delete();

        return back()->with('status', 'Layanan berhasil dihapus.');
    }

    private function validated(Request $request, ?Layanan $layanan = null): array
    {
        $data = $request->validate([
            'kategori' => ['required', 'string', 'in:'.implode(',', array_keys(Layanan::KATEGORI))],
            'nama' => ['required', 'string', 'max:255'],
            'asal' => ['nullable', 'string', 'max:255'],
            'tujuan' => ['nullable', 'string', 'max:255'],
            'harga' => ['nullable', 'numeric', 'min:0'],
            'satuan_harga' => ['nullable', 'string', 'max:100'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer'],
            'gambar' => ['nullable', 'image', 'max:4096'],
        ]);

        unset($data['gambar']);
        $data['urutan'] = $request->integer('urutan');
        $data['unggulan'] = $request->boolean('unggulan');
        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }

    private function uniqueSlug(string $nama, ?string $asal, ?string $tujuan): string
    {
        $base = Str::slug($nama.'-'.$asal.'-'.$tujuan);
        $slug = $base;
        $i = 1;

        while (Layanan::where('slug', $slug)->exists()) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
