@extends('layouts.app')

@section('title', 'Tentang Kami — '.$setting->nama_perusahaan)

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1 class="section-title mb-3">Tentang {{ $setting->nama_perusahaan }}</h1>
                <p class="text-muted">{{ $setting->deskripsi }}</p>
                <p class="text-muted">Kami melayani transportasi darat, laut, maupun udara — mulai dari tiket bus AKAP, travel/shuttle antar kota, tiket pesawat domestik &amp; internasional, tiket kapal laut, hingga pengiriman paket kilat.</p>
                <div class="row g-3 mt-3">
                    <div class="col-6">
                        <div class="bg-tl-cream rounded-4 p-3 text-center">
                            <i class="bi bi-geo-alt fs-3 text-tl-orange"></i>
                            <p class="fw-600 mb-0 mt-2" style="font-weight:600;">2 Kantor</p>
                            <small class="text-muted">Kepanjen &amp; Turen</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-tl-cream rounded-4 p-3 text-center">
                            <i class="bi bi-signpost-split fs-3 text-tl-orange"></i>
                            <p class="fw-600 mb-0 mt-2" style="font-weight:600;">Segala Jurusan</p>
                            <small class="text-muted">Darat, Laut, Udara</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="{{ asset('images/tentang/kantor-traveline.jpg') }}" alt="Kantor {{ $setting->nama_perusahaan }}" class="img-fluid rounded-4 shadow-sm w-100" style="min-height:340px;object-fit:cover;">
            </div>
        </div>

        <hr class="my-5">

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="bi bi-building fs-2 text-tl-orange"></i>
                        <h5 class="text-tl-blue mt-3">Kantor Pusat — Kepanjen</h5>
                        <p class="text-muted mb-0">{{ $setting->alamat_kepanjen }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <i class="bi bi-shop fs-2 text-tl-orange"></i>
                        <h5 class="text-tl-blue mt-3">Kantor Cabang — Turen</h5>
                        <p class="text-muted mb-0">{{ $setting->alamat_turen }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ $setting->whatsapp_link }}" target="_blank" class="btn btn-tl-orange btn-lg rounded-pill px-5">
                <i class="bi bi-whatsapp me-1"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection
