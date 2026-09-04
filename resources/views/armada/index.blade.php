@extends('layouts.app')

@section('title', 'Armada — '.$setting->nama_perusahaan)

@section('content')
<section class="bg-tl-cream py-5">
    <div class="container">
        <h1 class="section-title mb-1">Armada Kami</h1>
        <p class="text-muted mb-4">Kenali unit bus yang kami operasikan — fasilitas, kapasitas, dan trayek yang dilayani.</p>

        @if($armadas->isEmpty())
            <div class="alert alert-light border text-center py-5">
                <i class="bi bi-bus-front fs-1 text-muted d-block mb-2"></i>
                Data armada belum tersedia.
            </div>
        @else
            <div class="row g-4">
                @foreach($armadas as $armada)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-layanan h-100 shadow-sm">
                            @if($armada->foto_utama_url)
                                <img src="{{ $armada->foto_utama_url }}" class="card-img-top" style="height:200px;object-fit:cover;" alt="{{ $armada->nama }}">
                            @else
                                <div class="hero-fallback" style="height:200px;"></div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title text-tl-blue mb-0">{{ $armada->nama }}</h5>
                                    <span class="badge {{ $armada->status_badge_class }}">{{ $armada->status_ketersediaan_label }}</span>
                                </div>
                                @if($armada->kapasitas_seat)
                                    <p class="small text-muted mb-2"><i class="bi bi-person-fill me-1"></i>Kapasitas {{ $armada->kapasitas_seat }} seat
                                        @if(!is_null($armada->seat_tersedia))
                                            &middot; Tersisa {{ $armada->seat_tersedia }} seat
                                        @endif
                                    </p>
                                @endif
                                @if(!empty($armada->fitur_utama))
                                    <div class="mb-3">
                                        @foreach(array_slice($armada->fitur_utama, 0, 4) as $fitur)
                                            <span class="badge badge-kategori me-1 mb-1">{{ $fitur }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <a href="{{ route('armada.show', $armada->slug) }}" class="btn btn-outline-tl btn-sm rounded-pill w-100 mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
