@extends('layouts.app')

@section('title', $setting->nama_perusahaan.' — '.$setting->tagline)

@section('content')

{{-- HERO --}}
<section class="py-3 py-md-4">
    <div class="container">
        @if($banners->isNotEmpty())
            <div id="heroCarousel" class="carousel slide rounded-4 overflow-hidden shadow-sm" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($banners as $i => $banner)
                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                            @if($banner->tampilkan_teks)
                                <div class="hero-fallback hero-slide d-flex align-items-center" style="{{ $banner->gambar ? 'background-image:url('.$banner->gambar_url.');background-size:cover;background-position:center;' : '' }}">
                                    <div class="px-3 px-md-5">
                                        <div class="row">
                                            <div class="col-lg-8 text-white">
                                                <h1 class="hero-title mb-2">{{ $banner->judul }}</h1>
                                                @if($banner->subjudul)
                                                    <p class="mb-3 text-white-50 d-none d-sm-block">{{ $banner->subjudul }}</p>
                                                @endif
                                                <a href="{{ $setting->whatsapp_link }}&text={{ rawurlencode('Halo Traveline, saya ingin memesan tiket.') }}" target="_blank" class="btn btn-tl-orange btn-sm rounded-pill px-3 px-md-4">
                                                    <i class="bi bi-whatsapp me-1"></i> Pesan via WhatsApp
                                                </a>
                                                <a href="{{ route('layanan.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 px-md-4 ms-2 d-none d-sm-inline-block">Lihat Layanan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Gambar sudah memuat teks/desain lengkap sendiri (poster jadi) — tampilkan apa adanya --}}
                                <a href="{{ $banner->link_url ?: ($setting->whatsapp_link.'&text='.rawurlencode('Halo Traveline, saya ingin bertanya soal promo ini.')) }}"
                                   target="_blank" rel="noopener" class="d-block hero-slide">
                                    <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul }}" class="w-100 h-100" style="object-fit: cover; object-position: center;">
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if($banners->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                @endif
            </div>
        @else
            <div class="hero-fallback hero-slide d-flex align-items-center rounded-4 overflow-hidden shadow-sm">
                <div class="px-3 px-md-5">
                    <div class="row">
                        <div class="col-lg-8 text-white">
                            <h1 class="hero-title mb-2">{{ $setting->tagline ?? 'Agendakan Perjalananmu Bersama Traveline' }}</h1>
                            <p class="mb-3 text-white-50 d-none d-sm-block">{{ $setting->deskripsi }}</p>
                            <a href="{{ $setting->whatsapp_link }}&text={{ rawurlencode('Halo Traveline, saya ingin memesan tiket.') }}" target="_blank" class="btn btn-tl-orange btn-sm rounded-pill px-3 px-md-4">
                                <i class="bi bi-whatsapp me-1"></i> Pesan via WhatsApp
                            </a>
                            <a href="{{ route('layanan.index') }}" class="btn btn-outline-light btn-sm rounded-pill px-3 px-md-4 ms-2 d-none d-sm-inline-block">Lihat Layanan</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- KATEGORI LAYANAN --}}
<section class="py-5 bg-tl-cream">
    <div class="container">
        <h2 class="section-title text-center mb-1">Layanan Kami</h2>
        <p class="text-center text-muted mb-4">Darat, laut, dan udara — semua ada di sini</p>
        <div class="row g-3 text-center">
            @foreach(\App\Models\Layanan::KATEGORI as $key => $label)
                <div class="col-6 col-md-4 col-lg-2">
                    <a href="{{ route('layanan.index', ['kategori' => $key]) }}" class="text-decoration-none">
                        <div class="card card-layanan h-100 py-4 border-0 shadow-sm">
                            <div class="fs-1 text-tl-orange mb-2">
                                @switch($key)
                                    @case('bus') <i class="bi bi-bus-front"></i> @break
                                    @case('travel') <i class="bi bi-car-front"></i> @break
                                    @case('pesawat') <i class="bi bi-airplane"></i> @break
                                    @case('kapal') <i class="bi bi-water"></i> @break
                                    @case('paket') <i class="bi bi-box-seam"></i> @break
                                @endswitch
                            </div>
                            <div class="fw-600 text-tl-blue" style="font-weight:600;">{{ $label }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- LAYANAN UNGGULAN --}}
@if($unggulan->isNotEmpty())
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-1">Rute & Layanan Unggulan</h2>
        <p class="text-center text-muted mb-4">Pilihan paling banyak dipesan pelanggan kami</p>
        <div class="row g-4">
            @foreach($unggulan as $item)
                <div class="col-md-6 col-lg-3">
                    <div class="card card-layanan h-100 shadow-sm">
                        <div class="card-body">
                            <span class="badge badge-kategori mb-2">{{ $item->kategori_label }}</span>
                            <h5 class="card-title text-tl-blue">{{ $item->rute }}</h5>
                            @if($item->harga_format)
                                <p class="text-tl-orange fw-bold mb-2">{{ $item->harga_format }} <small class="text-muted fw-normal">{{ $item->satuan_harga }}</small></p>
                            @endif
                            <p class="card-text small text-muted">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</p>
                            <a href="{{ route('layanan.show', $item->slug) }}" class="btn btn-outline-tl btn-sm rounded-pill w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('layanan.index') }}" class="btn btn-tl-orange rounded-pill px-4">Lihat Semua Layanan</a>
        </div>
    </div>
</section>
@endif

{{-- TENTANG SINGKAT --}}
<section class="py-5 bg-tl-cream">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h2 class="section-title mb-3">Kenapa Pilih {{ $setting->nama_perusahaan }}?</h2>
                <p class="text-muted">{{ $setting->deskripsi }}</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-tl-orange me-2"></i>Ruang tunggu nyaman, free wifi & kopi</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-tl-orange me-2"></i>Reservasi cepat lewat WhatsApp</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-tl-orange me-2"></i>Melayani darat, laut, dan udara</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-tl-orange me-2"></i>Dua kantor: Kepanjen & Turen</li>
                </ul>
                <a href="{{ route('about') }}" class="btn btn-outline-tl rounded-pill px-4">Selengkapnya</a>
            </div>
            <div class="col-lg-6">
                <div class="hero-fallback rounded-4" style="min-height:280px;"></div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONI --}}
@if($testimonis->isNotEmpty())
<section class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Kata Pelanggan Kami</h2>
        <div class="row g-4">
            @foreach($testimonis as $t)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="text-tl-orange mb-2">
                                @for($i=0;$i<5;$i++)
                                    <i class="bi {{ $i < $t->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>
                            <p class="fst-italic">&ldquo;{{ $t->pesan }}&rdquo;</p>
                            <p class="fw-bold text-tl-blue mb-0">{{ $t->nama }}</p>
                            @if($t->asal_daerah)<small class="text-muted">{{ $t->asal_daerah }}</small>@endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-5 bg-tl-blue text-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Siap Berangkat?</h2>
        <p class="text-white-50 mb-4">Hubungi kami sekarang untuk reservasi tiket atau info lebih lanjut.</p>
        <a href="{{ $setting->whatsapp_link }}&text={{ rawurlencode('Halo Traveline, saya ingin memesan tiket.') }}" target="_blank" class="btn btn-tl-orange btn-lg rounded-pill px-5">
            <i class="bi bi-whatsapp me-1"></i> Chat WhatsApp Sekarang
        </a>
    </div>
</section>

@endsection
