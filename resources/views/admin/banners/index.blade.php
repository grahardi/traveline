@extends('layouts.admin')

@section('title', 'Banner')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.banners.create') }}" class="btn btn-tl-orange"><i class="bi bi-plus-lg me-1"></i>Tambah Banner</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr>
                        <td style="width:120px;">
                            @if($banner->gambar)
                                <img src="{{ asset('storage/'.$banner->gambar) }}" style="width:100px;height:60px;object-fit:cover;" class="rounded">
                            @else
                                <span class="text-muted small">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-600">{{ $banner->judul }}</div>
                            <small class="text-muted">{{ $banner->subjudul }}</small>
                        </td>
                        <td>{{ $banner->urutan }}</td>
                        <td>
                            @if($banner->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus banner ini?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada banner.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
