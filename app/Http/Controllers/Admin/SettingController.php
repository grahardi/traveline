<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = SiteSetting::current();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = SiteSetting::current();

        $data = $request->validate([
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'alamat_kepanjen' => ['nullable', 'string', 'max:255'],
            'alamat_turen' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:30'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'tiktok' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'maps_url' => ['nullable', 'url', 'max:2000'],
            'logo' => ['nullable', 'image', 'max:2048'],
        ]);

        unset($data['logo']);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo', 'public');
        }

        $setting->update($data);

        return back()->with('status', 'Pengaturan situs berhasil diperbarui.');
    }
}
