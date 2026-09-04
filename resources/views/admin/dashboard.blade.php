@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <i class="bi bi-signpost-split fs-2 text-tl-orange"></i>
                <h3 class="mt-2 mb-0">{{ $stats['layanan'] }}</h3>
                <small class="text-muted">Total Layanan</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <i class="bi bi-bus-front fs-2 text-info"></i>
                <h3 class="mt-2 mb-0">{{ $stats['armada'] }}</h3>
                <small class="text-muted">Armada</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <i class="bi bi-images fs-2 text-primary"></i>
                <h3 class="mt-2 mb-0">{{ $stats['banner'] }}</h3>
                <small class="text-muted">Banner</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <i class="bi bi-chat-quote fs-2 text-warning"></i>
                <h3 class="mt-2 mb-0">{{ $stats['testimoni'] }}</h3>
                <small class="text-muted">Testimoni</small>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <h5 class="text-tl-blue">Selamat datang di Panel Admin Traveline Turen</h5>
        <p class="text-muted mb-0">Kelola banner beranda, layanan/rute, armada, testimoni pelanggan, dan pengaturan situs (kontak, sosial media, alamat) lewat menu di samping.</p>
    </div>
</div>
@endsection
