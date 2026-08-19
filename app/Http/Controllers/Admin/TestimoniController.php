<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->paginate(15);

        return view('admin.testimonis.index', compact('testimonis'));
    }

    public function create()
    {
        return view('admin.testimonis.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('testimonis', 'public');
        }

        Testimoni::create($data);

        return redirect()->route('admin.testimonis.index')->with('status', 'Testimoni berhasil ditambahkan.');
    }

    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimonis.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $data = $this->validated($request);

        if ($request->hasFile('foto')) {
            if ($testimoni->foto) {
                Storage::disk('public')->delete($testimoni->foto);
            }
            $data['foto'] = $request->file('foto')->store('testimonis', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('admin.testimonis.index')->with('status', 'Testimoni berhasil diperbarui.');
    }

    public function destroy(Testimoni $testimoni)
    {
        if ($testimoni->foto) {
            Storage::disk('public')->delete($testimoni->foto);
        }
        $testimoni->delete();

        return back()->with('status', 'Testimoni berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'asal_daerah' => ['nullable', 'string', 'max:255'],
            'pesan' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        unset($data['foto']);
        $data['aktif'] = $request->boolean('aktif');

        return $data;
    }
}
