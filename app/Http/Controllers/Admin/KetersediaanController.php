<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use Illuminate\Http\Request;

class KetersediaanController extends Controller
{
    public function index()
    {
        $armadas = Armada::orderBy('urutan')->orderBy('nama')->get();

        return view('admin.ketersediaan.index', compact('armadas'));
    }

    public function update(Request $request, Armada $armada)
    {
        $data = $request->validate([
            'kursi_terbooking' => ['required', 'integer', 'min:0'],
        ]);

        if ($armada->kapasitas_seat && $data['kursi_terbooking'] > $armada->kapasitas_seat) {
            return back()->withErrors([
                'kursi_terbooking' => "Kursi terbooking ({$data['kursi_terbooking']}) tidak boleh melebihi kapasitas {$armada->nama} ({$armada->kapasitas_seat} seat).",
            ]);
        }

        $armada->update($data);

        return back()->with('status', "Ketersediaan {$armada->nama} berhasil diperbarui.");
    }
}
