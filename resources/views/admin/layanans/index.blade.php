@extends('layouts.admin')

@section('title', 'Layanan / Rute')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <form method="GET" class="d-flex gap-2">
        <select name="kategori" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            @foreach($kategoriList as $key => $label)
                <option value="{{ $key }}" @selected(request('kategori') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </form>
    <a href="{{ route('admin.layanans.create') }}" class="btn btn-tl-orange"><i class="bi bi-plus-lg me-1"></i>Tambah Layanan</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kategori</th>
                    <th>Nama / Rute</th>
                    <th>Harga</th>
                    <th>Unggulan</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $item)
                    <tr>
                        <td><span class="badge bg-light text-dark border">{{ $item->kategori_label }}</span></td>
                        <td>
                            <div class="fw-600">{{ $item->nama }}</div>
                            @if($item->asal || $item->tujuan)
                                <small class="text-muted">{{ $item->asal }} @if($item->asal && $item->tujuan) &rarr; @endif {{ $item->tujuan }}</small>
                            @endif
                        </td>
                        <td>{{ $item->harga_format ?? '-' }}</td>
                        <td>{!! $item->unggulan ? '<i class="bi bi-star-fill text-warning"></i>' : '' !!}</td>
                        <td>
                            @if($item->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.layanans.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.layanans.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus layanan ini?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Belum ada layanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $layanans->links() }}</div>
@endsection
