@extends('layouts.app')

@section('title', 'Layanan — '.$setting->nama_perusahaan)

@section('content')
<section class="bg-tl-cream py-5">
    <div class="container">
        <h1 class="section-title mb-1">Semua Layanan</h1>
        <p class="text-muted mb-4">Cari rute atau kategori layanan yang kamu butuhkan.</p>

        <form method="GET" class="row g-2 mb-4">
            <div class="col-md-4">
                <input type="text" name="cari" value="{{ request('cari') }}" class="form-control" placeholder="Cari nama, asal, atau tujuan...">
            </div>
            <div class="col-md-3">
                <select name="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoriList as $key => $label)
                        <option value="{{ $key }}" @selected(request('kategori') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-tl-orange w-100" type="submit">Cari</button>
            </div>
            @if(request('cari') || request('kategori'))
                <div class="col-md-2">
                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-tl w-100">Reset</a>
                </div>
            @endif
        </form>

        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('layanan.index') }}" class="btn btn-sm {{ !request('kategori') ? 'btn-tl-orange' : 'btn-outline-tl' }} rounded-pill">Semua</a>
            @foreach($kategoriList as $key => $label)
                <a href="{{ route('layanan.index', ['kategori' => $key]) }}" class="btn btn-sm {{ request('kategori') === $key ? 'btn-tl-orange' : 'btn-outline-tl' }} rounded-pill">{{ $label }}</a>
            @endforeach
        </div>

        @if($layanans->isEmpty())
            <div class="alert alert-light border text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted d-block mb-2"></i>
                Belum ada layanan yang cocok dengan pencarianmu.
            </div>
        @else
            <div class="row g-4">
                @foreach($layanans as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-layanan h-100 shadow-sm">
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" style="height:180px;object-fit:cover;" alt="{{ $item->nama }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <span class="badge badge-kategori mb-2 align-self-start">{{ $item->kategori_label }}</span>
                                <h5 class="card-title text-tl-blue">{{ $item->rute }}</h5>
                                @if($item->harga_format)
                                    <p class="text-tl-orange fw-bold mb-2">{{ $item->harga_format }} <small class="text-muted fw-normal">{{ $item->satuan_harga }}</small></p>
                                @endif
                                <p class="card-text small text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($item->deskripsi, 90) }}</p>
                                <div class="d-flex gap-2 mt-2">
                                    <a href="{{ route('layanan.show', $item->slug) }}" class="btn btn-outline-tl btn-sm rounded-pill flex-grow-1">Detail</a>
                                    <a href="{{ $item->whatsapp_order_link }}" target="_blank" class="btn btn-tl-orange btn-sm rounded-pill flex-grow-1">
                                        <i class="bi bi-whatsapp"></i> Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">{{ $layanans->links() }}</div>
        @endif
    </div>
</section>
@endsection
