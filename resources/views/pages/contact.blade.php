@extends('layouts.app')

@section('title', 'Kontak — '.$setting->nama_perusahaan)

@section('content')
<section class="py-5 bg-tl-cream">
    <div class="container">
        <h1 class="section-title text-center mb-1">Hubungi Kami</h1>
        <p class="text-center text-muted mb-5">Ada pertanyaan seputar tiket atau layanan? Kontak kami lewat cara di bawah ini.</p>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-whatsapp fs-1 text-tl-orange"></i>
                        <h6 class="text-tl-blue mt-3">WhatsApp</h6>
                        <p class="text-muted small mb-3">{{ $setting->whatsapp }}</p>
                        @if($setting->whatsapp)
                            <a href="{{ $setting->whatsapp_link }}" target="_blank" class="btn btn-tl-orange btn-sm rounded-pill w-100">Chat Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-envelope fs-1 text-tl-orange"></i>
                        <h6 class="text-tl-blue mt-3">Email</h6>
                        <p class="text-muted small mb-3">{{ $setting->email }}</p>
                        @if($setting->email)
                            <a href="mailto:{{ $setting->email }}" class="btn btn-outline-tl btn-sm rounded-pill w-100">Kirim Email</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-geo-alt fs-1 text-tl-orange"></i>
                        <h6 class="text-tl-blue mt-3">Kantor Turen</h6>
                        <p class="text-muted small mb-0">{{ $setting->alamat_turen }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-building fs-1 text-tl-orange"></i>
                        <h6 class="text-tl-blue mt-3">Kantor Pusat Kepanjen</h6>
                        <p class="text-muted small mb-0">{{ $setting->alamat_kepanjen }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($setting->maps_url)
            <div class="ratio ratio-21x9 mt-5 rounded-4 overflow-hidden shadow-sm">
                <iframe src="{{ $setting->maps_url }}" style="border:0;" allowfullscreen loading="lazy"></iframe>
            </div>
        @endif
    </div>
</section>
@endsection
