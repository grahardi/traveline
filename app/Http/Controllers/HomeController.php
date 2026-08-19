<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Layanan;
use App\Models\SiteSetting;
use App\Models\Testimoni;

class HomeController extends Controller
{
    public function index()
    {
        $setting = SiteSetting::current();
        $banners = Banner::aktif()->get();
        $unggulan = Layanan::aktif()->unggulan()->orderBy('urutan')->take(8)->get();
        $testimonis = Testimoni::aktif()->take(6)->get();

        return view('home', compact('setting', 'banners', 'unggulan', 'testimonis'));
    }
}
