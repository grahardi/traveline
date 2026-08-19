@extends('layouts.app')

@section('title', 'Testimoni — '.$setting->nama_perusahaan)

@section('content')
<section class="py-5">
    <div class="container">
        <h1 class="section-title text-center mb-1">Kata Pelanggan Kami</h1>
        <p class="text-center text-muted mb-5">Pengalaman nyata dari pelanggan yang sudah menggunakan layanan kami.</p>

        @if($testimonis->isEmpty())
            <div class="alert alert-light border text-center py-5">Belum ada testimoni.</div>
        @else
            <div class="row g-4">
                @foreach($testimonis as $t)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    @if($t->foto)
                                        <img src="{{ asset('storage/'.$t->foto) }}" class="rounded-circle me-3" width="48" height="48" style="object-fit:cover;" alt="{{ $t->nama }}">
                                    @else
                                        <div class="rounded-circle bg-tl-cream d-flex align-items-center justify-content-center me-3 text-tl-blue fw-bold" style="width:48px;height:48px;">
                                            {{ strtoupper(substr($t->nama, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="fw-bold text-tl-blue mb-0">{{ $t->nama }}</p>
                                        @if($t->asal_daerah)<small class="text-muted">{{ $t->asal_daerah }}</small>@endif
                                    </div>
                                </div>
                                <div class="text-tl-orange mb-2">
                                    @for($i=0;$i<5;$i++)
                                        <i class="bi {{ $i < $t->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    @endfor
                                </div>
                                <p class="fst-italic mb-0">&ldquo;{{ $t->pesan }}&rdquo;</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $testimonis->links() }}</div>
        @endif
    </div>
</section>
@endsection
