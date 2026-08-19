@extends('layouts.admin')

@section('title', 'Pengaturan Situs')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <h6 class="text-tl-blue mb-3">Informasi Perusahaan</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $setting->nama_perusahaan) }}" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $setting->tagline) }}" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $setting->deskripsi) }}</textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Logo (opsional)</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    @if($setting->logo)
                        <img src="{{ asset('storage/'.$setting->logo) }}" class="mt-2 rounded" style="max-height:60px;">
                    @endif
                </div>
            </div>

            <h6 class="text-tl-blue mb-3">Alamat</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Alamat Kantor Pusat (Kepanjen)</label>
                    <input type="text" name="alamat_kepanjen" value="{{ old('alamat_kepanjen', $setting->alamat_kepanjen) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Alamat Kantor Cabang (Turen)</label>
                    <input type="text" name="alamat_turen" value="{{ old('alamat_turen', $setting->alamat_turen) }}" class="form-control">
                </div>
                <div class="col-12">
                    <label class="form-label">URL Google Maps Embed (opsional)</label>
                    <input type="url" name="maps_url" value="{{ old('maps_url', $setting->maps_url) }}" class="form-control" placeholder="https://www.google.com/maps/embed?...">
                </div>
            </div>

            <h6 class="text-tl-blue mb-3">Kontak</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}" class="form-control" placeholder="6285103578000">
                    <small class="text-muted">Format 62xxxxxxxxxx tanpa tanda + atau spasi.</small>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $setting->telepon) }}" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $setting->email) }}" class="form-control">
                </div>
            </div>

            <h6 class="text-tl-blue mb-3">Sosial Media</h6>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
                    <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-facebook me-1"></i>Facebook</label>
                    <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-tiktok me-1"></i>TikTok</label>
                    <input type="url" name="tiktok" value="{{ old('tiktok', $setting->tiktok) }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="bi bi-youtube me-1"></i>YouTube</label>
                    <input type="url" name="youtube" value="{{ old('youtube', $setting->youtube) }}" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-tl-orange">Simpan Pengaturan</button>
        </form>
    </div>
</div>
@endsection
