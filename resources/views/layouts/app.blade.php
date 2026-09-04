<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $setting->nama_perusahaan ?? 'Traveline Turen')</title>
    <meta name="description" content="@yield('meta_description', $setting->deskripsi ?? 'Jasa tiket bus, travel, pesawat, kapal laut, dan kirim paket segala jurusan.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --tl-orange: #FF6B35;
            --tl-blue: #0B3C5D;
            --tl-blue-light: #145C8C;
            --tl-cream: #FFF8F1;
        }
        body { font-family: 'Poppins', sans-serif; color: #222; background-color: #fff; }
        .navbar-brand { font-weight: 800; color: var(--tl-blue) !important; letter-spacing: -.5px; }
        .navbar-brand span { color: var(--tl-orange); }
        .btn-tl-orange { background-color: var(--tl-orange); border-color: var(--tl-orange); color: #fff; font-weight: 600; }
        .btn-tl-orange:hover { background-color: #e85a26; border-color: #e85a26; color: #fff; }
        .btn-outline-tl { border-color: var(--tl-blue); color: var(--tl-blue); font-weight: 600; }
        .btn-outline-tl:hover { background-color: var(--tl-blue); color: #fff; }
        .text-tl-blue { color: var(--tl-blue); }
        .text-tl-orange { color: var(--tl-orange); }
        .bg-tl-blue { background-color: var(--tl-blue); }
        .bg-tl-cream { background-color: var(--tl-cream); }
        .hero-fallback {
            background: linear-gradient(135deg, var(--tl-blue) 0%, var(--tl-blue-light) 60%, var(--tl-orange) 150%);
        }
        .hero-slide {
            height: 34vw;
            min-height: 200px;
            max-height: 360px;
        }
        .hero-title {
            font-weight: 800;
            font-size: 1.4rem;
            line-height: 1.25;
        }
        @media (min-width: 576px) {
            .hero-title { font-size: 1.9rem; }
        }
        @media (min-width: 992px) {
            .hero-title { font-size: 2.4rem; }
        }
        .card-layanan { transition: transform .15s ease, box-shadow .15s ease; border: 1px solid #eee; }
        .card-layanan:hover { transform: translateY(-4px); box-shadow: 0 .75rem 1.5rem rgba(0,0,0,.08); }
        .badge-kategori { background-color: var(--tl-cream); color: var(--tl-blue); font-weight: 600; }
        .wa-float {
            position: fixed; right: 20px; bottom: 20px; z-index: 1050;
            background: #25D366; color: #fff; width: 58px; height: 58px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 28px;
            box-shadow: 0 6px 16px rgba(0,0,0,.25); text-decoration: none;
        }
        .wa-float:hover { color: #fff; filter: brightness(1.05); }
        footer a { color: #cfe3f0; text-decoration: none; }
        footer a:hover { color: #fff; }
        .section-title { font-weight: 800; color: var(--tl-blue); }
        .pagination .page-link { color: var(--tl-blue); border-color: #e5e5e5; }
        .pagination .page-item.active .page-link { background-color: var(--tl-orange); border-color: var(--tl-orange); }
        .pagination .page-item.disabled .page-link { color: #bbb; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
    <div class="container">
        <a class="navbar-brand fs-4" href="{{ route('home') }}">Travel<span>ine</span> Turen</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('layanan.index') }}">Layanan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('armada.index') }}">Armada</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('testimoni') }}">Testimoni</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Kontak</a></li>
                <li class="nav-item ms-lg-2">
                    @if(!empty($setting->whatsapp))
                        <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya ingin bertanya seputar layanan.') }}"
                           target="_blank" rel="noopener" class="btn btn-tl-orange rounded-pill px-3">
                            <i class="bi bi-whatsapp me-1"></i> Pesan Sekarang
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-tl-blue text-white pt-5 pb-4 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="fw-bold mb-3">Travel<span class="text-tl-orange">ine</span> Turen</h5>
                <p class="small text-white-50">{{ $setting->deskripsi ?? 'Jasa tiket bus, travel, pesawat, kapal laut dan kirim paket segala jurusan.' }}</p>
                <div class="d-flex gap-3 fs-5 mt-3">
                    @if($setting->instagram)<a href="{{ $setting->instagram }}" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>@endif
                    @if($setting->facebook)<a href="{{ $setting->facebook }}" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>@endif
                    @if($setting->tiktok)<a href="{{ $setting->tiktok }}" target="_blank" rel="noopener"><i class="bi bi-tiktok"></i></a>@endif
                    @if($setting->youtube)<a href="{{ $setting->youtube }}" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a>@endif
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Tautan</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('layanan.index') }}">Semua Layanan</a></li>
                    <li class="mb-2"><a href="{{ route('armada.index') }}">Armada Kami</a></li>
                    <li class="mb-2"><a href="{{ route('testimoni') }}">Testimoni Pelanggan</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Kontak</h6>
                <ul class="list-unstyled small text-white-50">
                    @if($setting->alamat_turen)<li class="mb-2"><i class="bi bi-geo-alt me-2"></i>{{ $setting->alamat_turen }}</li>@endif
                    @if($setting->alamat_kepanjen)<li class="mb-2"><i class="bi bi-geo-alt me-2"></i>{{ $setting->alamat_kepanjen }} (Kantor Pusat)</li>@endif
                    @if($setting->whatsapp)<li class="mb-2"><i class="bi bi-whatsapp me-2"></i>{{ $setting->whatsapp }}</li>@endif
                    @if($setting->email)<li class="mb-2"><i class="bi bi-envelope me-2"></i>{{ $setting->email }}</li>@endif
                </ul>
            </div>
        </div>
        <hr class="border-white-50 mt-3">
        <p class="small text-white-50 mb-0 text-center">&copy; {{ date('Y') }} {{ $setting->nama_perusahaan }}. Semua hak cipta dilindungi.</p>
    </div>
</footer>

@if(!empty($setting->whatsapp))
    <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya ingin bertanya seputar layanan.') }}"
       target="_blank" rel="noopener" class="wa-float" title="Chat via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
