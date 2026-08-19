@extends('layouts.app')

@section('title', $setting->nama_perusahaan.' — '.$setting->tagline)

@section('content')

{{-- HERO --}}
@if($banners->isNotEmpty())
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($banners as $i => $banner)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <div class="hero-fallback d-flex align-items-center" style="min-height: 480px; {{ $banner->gambar ? 'background-image:url('.asset('storage/'.$banner->gambar).');background-size:cover;background-position:center;' : '' }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 text-white py-5">
                                    <h1 class="display-5 fw-800 mb-3" style="font-weight:800;">{{ $banner->judul }}</h1>
                                    @if($banner->subjudul)
                                        <p class="fs-5 mb-4 text-white-50">{{ $banner->subjudul }}</p>
                                    @endif
                                    <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya ingin memesan tiket.') }}" target="_blank" class="btn btn-tl-orange btn-lg rounded-pill px-4">
                                        <i class="bi bi-whatsapp me-1"></i> Pesan via WhatsApp
                                    </a>
                                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 ms-2">Lihat Layanan</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <div class="hero-fallback d-flex align-items-center" style="min-height: 480px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-white py-5">
                    <h1 class="display-5 mb-3" style="font-weight:800;">{{ $setting->tagline ?? 'Agendakan Perjalananmu Bersama Traveline' }}</h1>
                    <p class="fs-5 mb-4 text-white-50">{{ $setting->deskripsi }}</p>
                    <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya ingin memesan tiket.') }}" target="_blank" class="btn btn-tl-orange btn-lg rounded-pill px-4">
                        <i class="bi bi-whatsapp me-1"></i> Pesan via WhatsApp
                    </a>
                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 ms-2">Lihat Layanan</a>
                </div>
            </div>
        </div>
    </div>
@endif

{{-- PROMO SPESIAL --}}
<section class="py-5" style="background: linear-gradient(180deg, var(--tl-blue) 0%, #082c44 100%);">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <div class="col-lg-5 mx-auto text-center">
                <img src="{{ asset('images/promo/malang-jakarta-bogor-tangerang.jpg') }}"
                     alt="Promo Malang - Jakarta, Bogor, Tangerang Rp360.000 per seat"
                     class="img-fluid rounded-4 shadow-lg" style="max-height: 560px;">
            </div>
            <div class="col-lg-6 text-white">
                <span class="badge bg-tl-orange mb-3 px-3 py-2">🔥 Promo Terbatas</span>
                <h2 class="fw-800 mb-3" style="font-weight:800;">Malang &ndash; Jakarta, Bogor, Tangerang</h2>
                <p class="fs-5 text-white-50 mb-4">Harga spesial mulai <span class="text-tl-orange fw-bold">Rp360.000</span> per seat, armada PO Haryanto &ldquo;The Ocean&rdquo; — lengkap AC, TV, charger, leg rest, bantal & selimut, hingga snack. Seat terbatas, booking dari sekarang!</p>
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya mau tanya promo tiket Malang - Jakarta/Bogor/Tangerang 360K per seat.') }}" target="_blank" class="btn btn-tl-orange btn-lg rounded-pill px-4">
                        <i class="bi bi-whatsapp me-1"></i> Booking via WhatsApp
                    </a>
                </div>
                <ul class="list-unstyled small text-white-50 mb-0">
                    <li class="mb-1"><i class="bi bi-telephone-fill text-tl-orange me-2"></i>Traveline Kepanjen — 0851-0357-8000</li>
                    <li><i class="bi bi-telephone-fill text-tl-orange me-2"></i>Traveline Turen — 0812-3096-2150</li>
                </ul>
            </div>
        </div>
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
        <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya ingin memesan tiket.') }}" target="_blank" class="btn btn-tl-orange btn-lg rounded-pill px-5">
            <i class="bi bi-whatsapp me-1"></i> Chat WhatsApp Sekarang
        </a>
    </div>
</section>

@endsection
