<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\SiteSetting;

class ArmadaController extends Controller
{
    public function index()
    {
        $setting = SiteSetting::current();
        $armadas = Armada::aktif()->withCount('fotos')->get();

        return view('armada.index', compact('armadas', 'setting'));
    }

    public function show(string $slug)
    {
        $setting = SiteSetting::current();
        $armada = Armada::aktif()
            ->with(['fotos', 'layanans' => fn ($q) => $q->aktif()])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('armada.show', compact('armada', 'setting'));
    }
}
