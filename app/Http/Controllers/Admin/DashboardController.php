<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armada;
use App\Models\Banner;
use App\Models\Layanan;
use App\Models\Testimoni;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'layanan' => Layanan::count(),
            'layanan_aktif' => Layanan::aktif()->count(),
            'banner' => Banner::count(),
            'testimoni' => Testimoni::count(),
            'armada' => Armada::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
