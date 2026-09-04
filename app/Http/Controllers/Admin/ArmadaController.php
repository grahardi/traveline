<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\ArmadaFoto;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArmadaController extends Controller
{
    public function index()
    {
        $armadas = Armada::withCount('fotos')->orderBy('urutan')->paginate(15);

        return view('admin.armadas.index', compact('armadas'));
    }

    public function create()
    {
        $layananList = Layanan::orderBy('kategori')->orderBy('nama')->get();

        return view('admin.armadas.create', compact('layananList'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['nama']);

        if ($request->hasFile('foto_utama')) {
            $data['foto_utama'] = $request->file('foto_utama')->store('armadas', 'public');
        }

        $armada = Armada::create($data);

        $this->simpanGaleri($request, $armada);
        $armada->layanans()->sync($request->input('layanan_ids', []));

        return redirect()->route('admin.armadas.index')->with('status', 'Armada berhasil ditambahkan.');
    }

    public function edit(Armada $armada)
    {
        $armada->load('fotos');
        $layananList = Layanan::orderBy('kategori')->orderBy('nama')->get();
        $selectedLayananIds = $armada->layanans()->pluck('layanans.id')->toArray();

        return view('admin.armadas.edit', compact('armada', 'layananList', 'selectedLayananIds'));
    }

    public function update(Request $request, Armada $armada)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto_utama')) {
            if ($armada->foto_utama) {
                Storage::disk('public')->delete($armada->foto_utama);
            }
            $data['foto_utama'] = $request->file('foto_utama')->store('armadas', 'public');
        }

        $armada->update($data);

        $this->simpanGaleri($request, $armada);
        $armada->layanans()->sync($request->input('layanan_ids', []));

        return redirect()->route('admin.armadas.index')->with('status', 'Armada berhasil diperbarui.');
    }

    public function destroy(Armada $armada)
    {
        if ($armada->foto_utama) {
            Storage::disk('public')->delete($armada->foto_utama);
        }
        foreach ($armada->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }
        $armada->delete();

        return back()->with('status', 'Armada berhasil dihapus.');
    }

    public function hapusFoto(Armada $armada, ArmadaFoto $foto)
    {
        abort_if($foto->armada_id !== $armada->id, 404);

        Storage::disk('public')->delete($foto->foto);
        $foto->delete();

        return back()->with('status', 'Foto galeri berhasil dihapus.');
    }

    private function simpanGaleri(Request $request, Armada $armada): void
    {
        if (! $request->hasFile('galeri')) {
            return;
        }

        $urutanAwal = (int) $armada->fotos()->max('urutan');

        foreach ($request->file('galeri') as $i => $file) {
            $path = $file->store('armadas/galeri', 'public');
            ArmadaFoto::create([
                'armada_id' => $armada->id,
                'foto' => $path,
                'urutan' => $urutanAwal + $i + 1,
            ]);
        }
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'fitur_utama' => ['nullable', 'string'],
            'fitur_lainnya' => ['nullable', 'string'],
            'kapasitas_seat' => ['nullable', 'integer', 'min:0'],
            'seat_tersedia' => ['nullable', 'integer', 'min:0'],
            'status_ketersediaan' => ['required', 'string', 'in:'.implode(',', array_keys(Armada::STATUS_KETERSEDIAAN))],
            'urutan' => ['nullable', 'integer'],
            'foto_utama' => ['nullable', 'image', 'max:4096'],
            'galeri.*' => ['nullable', 'image', 'max:4096'],
        ]);

        unset($data['foto_utama'], $data['galeri']);

        // Textarea satu baris satu fitur -> array JSON
        $data['fitur_utama'] = $this->baristTeksKeArray($request->input('fitur_utama'));
        $data['fitur_lainnya'] = $this->baristTeksKeArray($request->input('fitur_lainnya'));
        $data['urutan'] = $request->integer('urutan');
        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }

    private function baristTeksKeArray(?string $teks): array
    {
        if (blank($teks)) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $teks))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function uniqueSlug(string $nama): string
    {
        $base = Str::slug($nama);
        $slug = $base;
        $i = 1;

        while (Armada::where('slug', $slug)->exists()) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
