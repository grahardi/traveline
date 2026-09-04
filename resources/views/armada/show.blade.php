@extends('layouts.app')

@section('title', $armada->nama.' — '.$setting->nama_perusahaan)

@section('content')
<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('armada.index') }}">Armada</a></li>
                <li class="breadcrumb-item active">{{ $armada->nama }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-7">
                {{-- FOTO UTAMA --}}
                @if($armada->foto_utama_url)
                    <img src="{{ $armada->foto_utama_url }}" class="img-fluid rounded-4 mb-3 w-100" style="max-height:420px;object-fit:cover;" alt="{{ $armada->nama }}">
                @else
                    <div class="hero-fallback rounded-4 mb-3" style="min-height:280px;"></div>
                @endif

                {{-- GALERI FOTO --}}
                @if($armada->fotos->isNotEmpty())
                    <div class="row g-2 mb-4">
                        @foreach($armada->fotos as $foto)
                            <div class="col-4 col-md-3">
                                <a href="{{ $foto->foto_url }}" target="_blank" rel="noopener">
                                    <img src="{{ $foto->foto_url }}" class="img-fluid rounded-3" style="height:90px;width:100%;object-fit:cover;" alt="Galeri {{ $armada->nama }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h1 class="text-tl-blue fw-bold mb-0">{{ $armada->nama }}</h1>
                    <span class="badge {{ $armada->status_badge_class }} fs-6">{{ $armada->status_ketersediaan_label }}</span>
                </div>
                @if($armada->deskripsi)
                    <p class="text-muted">{{ $armada->deskripsi }}</p>
                @endif

                @if($armada->kapasitas_seat)
                    <div class="card border-0 bg-tl-cream mb-4">
                        <div class="card-body d-flex align-items-center gap-3">
                            <i class="bi bi-person-fill fs-2 text-tl-orange"></i>
                            <div>
                                <p class="fw-600 mb-0" style="font-weight:600;">Kapasitas {{ $armada->kapasitas_seat }} Seat</p>
                                @if(!is_null($armada->seat_tersedia))
                                    <small class="text-muted">Ketersediaan saat ini: {{ $armada->seat_tersedia }} seat ({{ $armada->status_ketersediaan_label }})</small>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row g-4">
                    @if(!empty($armada->fitur_utama))
                        <div class="col-md-6">
                            <h6 class="text-tl-blue mb-3"><i class="bi bi-star-fill text-tl-orange me-1"></i>Fitur Utama</h6>
                            <ul class="list-unstyled">
                                @foreach($armada->fitur_utama as $fitur)
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-tl-orange me-2"></i>{{ $fitur }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(!empty($armada->fitur_lainnya))
                        <div class="col-md-6">
                            <h6 class="text-tl-blue mb-3"><i class="bi bi-plus-circle-fill text-tl-orange me-1"></i>Fitur Lainnya</h6>
                            <ul class="list-unstyled">
                                @foreach($armada->fitur_lainnya as $fitur)
                                    <li class="mb-2"><i class="bi bi-check-circle text-muted me-2"></i>{{ $fitur }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0 sticky-top" style="top:100px;">
                    <div class="card-body p-4">
                        <h5 class="text-tl-blue mb-3">Tersedia di Trayek</h5>
                        @if($armada->layanans->isEmpty())
                            <p class="text-muted small">Belum ada trayek yang ditautkan untuk armada ini.</p>
                        @else
                            <ul class="list-group list-group-flush mb-3">
                                @foreach($armada->layanans as $layanan)
                                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                                        <div>
                                            <a href="{{ route('layanan.show', $layanan->slug) }}" class="text-decoration-none text-tl-blue fw-600" style="font-weight:600;">{{ $layanan->rute }}</a>
                                            <br><small class="text-muted">{{ $layanan->kategori_label }}</small>
                                        </div>
                                        @if($layanan->harga_format)
                                            <span class="text-tl-orange fw-bold small">{{ $layanan->harga_format }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <a href="{{ $setting->whatsapp_link }}?text={{ rawurlencode('Halo Traveline, saya ingin tanya ketersediaan armada '.$armada->nama.'.') }}" target="_blank" class="btn btn-tl-orange btn-lg w-100 rounded-pill">
                            <i class="bi bi-whatsapp me-1"></i> Tanya Ketersediaan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
