<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Testimoni;

class PageController extends Controller
{
    public function about()
    {
        $setting = SiteSetting::current();

        return view('pages.about', compact('setting'));
    }

    public function contact()
    {
        $setting = SiteSetting::current();

        return view('pages.contact', compact('setting'));
    }

    public function testimoni()
    {
        $setting = SiteSetting::current();
        $testimonis = Testimoni::aktif()->paginate(9);

        return view('pages.testimoni', compact('setting', 'testimonis'));
    }
}
