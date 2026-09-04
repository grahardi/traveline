@extends('layouts.app')

@section('title', $layanan->rute.' — '.$setting->nama_perusahaan)

@section('content')
<section class="py-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('layanan.index') }}">Layanan</a></li>
                <li class="breadcrumb-item active">{{ $layanan->rute }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-7">
                @if($layanan->gambar)
                    <img src="{{ asset('storage/'.$layanan->gambar) }}" class="img-fluid rounded-4 mb-4 w-100" style="max-height:360px;object-fit:cover;" alt="{{ $layanan->nama }}">
                @else
                    <div class="hero-fallback rounded-4 mb-4" style="min-height:280px;"></div>
                @endif
                <span class="badge badge-kategori mb-2">{{ $layanan->kategori_label }}</span>
                <h1 class="text-tl-blue fw-bold">{{ $layanan->rute }}</h1>
                @if($layanan->deskripsi)
                    <p class="text-muted">{{ $layanan->deskripsi }}</p>
                @endif

                @if($layanan->armadas->isNotEmpty())
                    <hr class="my-4">
                    <h5 class="text-tl-blue mb-3"><i class="bi bi-bus-front me-1"></i>Armada Tersedia di Trayek Ini</h5>
                    <div class="row g-3">
                        @foreach($layanan->armadas as $armada)
                            <div class="col-md-6">
                                <div class="card card-layanan h-100 shadow-sm">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            @if($armada->foto_utama_url)
                                                <img src="{{ $armada->foto_utama_url }}" class="w-100 h-100 rounded-start" style="object-fit:cover;min-height:100px;" alt="{{ $armada->nama }}">
                                            @else
                                                <div class="hero-fallback h-100 rounded-start" style="min-height:100px;"></div>
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body py-2 px-3">
                                                <p class="fw-600 mb-1 text-tl-blue" style="font-weight:600;">{{ $armada->nama }}</p>
                                                <span class="badge {{ $armada->status_badge_class }} mb-1">{{ $armada->status_ketersediaan_label }}</span>
                                                @if($armada->kapasitas_seat)
                                                    <p class="small text-muted mb-1">{{ $armada->kapasitas_seat }} seat @if(!is_null($armada->seat_tersedia)) &middot; sisa {{ $armada->seat_tersedia }} @endif</p>
                                                @endif
                                                <a href="{{ route('armada.show', $armada->slug) }}" class="small text-tl-orange fw-600" style="font-weight:600;">Lihat Detail &rarr;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 sticky-top" style="top:100px;">
                    <div class="card-body p-4">
                        <h5 class="text-tl-blue mb-3">Rincian Layanan</h5>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-muted">Kategori</span>
                                <span class="fw-600">{{ $layanan->kategori_label }}</span>
                            </li>
                            @if($layanan->asal)
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-muted">Asal</span>
                                <span class="fw-600">{{ $layanan->asal }}</span>
                            </li>
                            @endif
                            @if($layanan->tujuan)
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-muted">Tujuan</span>
                                <span class="fw-600">{{ $layanan->tujuan }}</span>
                            </li>
                            @endif
                            @if($layanan->harga_format)
                            <li class="list-group-item d-flex justify-content-between px-0">
                                <span class="text-muted">Harga</span>
                                <span class="fw-bold text-tl-orange">{{ $layanan->harga_format }} <small class="text-muted fw-normal">{{ $layanan->satuan_harga }}</small></span>
                            </li>
                            @endif
                        </ul>
                        <a href="{{ $layanan->whatsapp_order_link }}" target="_blank" class="btn btn-tl-orange btn-lg w-100 rounded-pill">
                            <i class="bi bi-whatsapp me-1"></i> Pesan via WhatsApp
                        </a>
                        <p class="small text-muted mt-3 mb-0">Pemesanan &amp; pembayaran dikonfirmasi langsung oleh admin kami melalui WhatsApp.</p>
                    </div>
                </div>
            </div>
        </div>

        @if($terkait->isNotEmpty())
            <hr class="my-5">
            <h4 class="text-tl-blue mb-4">Layanan Terkait</h4>
            <div class="row g-4">
                @foreach($terkait as $item)
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-layanan h-100 shadow-sm">
                            <div class="card-body">
                                <span class="badge badge-kategori mb-2">{{ $item->kategori_label }}</span>
                                <h6 class="text-tl-blue">{{ $item->rute }}</h6>
                                <a href="{{ route('layanan.show', $item->slug) }}" class="btn btn-outline-tl btn-sm rounded-pill w-100 mt-2">Lihat</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
