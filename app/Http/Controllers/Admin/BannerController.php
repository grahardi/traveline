<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();

        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')->with('status', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $this->validated($request, $banner);

        if ($request->hasFile('gambar')) {
            if ($banner->gambar) {
                Storage::disk('public')->delete($banner->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('status', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->gambar) {
            Storage::disk('public')->delete($banner->gambar);
        }
        $banner->delete();

        return back()->with('status', 'Banner berhasil dihapus.');
    }

    private function validated(Request $request, ?Banner $banner = null): array
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'subjudul' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'url', 'max:255'],
            'urutan' => ['nullable', 'integer'],
            'gambar' => [$banner && $banner->gambar ? 'nullable' : 'required', 'image', 'max:4096'],
        ]);

        unset($data['gambar']);
        $data['urutan'] = $request->integer('urutan');
        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
