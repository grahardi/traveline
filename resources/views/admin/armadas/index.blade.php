@extends('layouts.admin')

@section('title', 'Armada')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.armadas.create') }}" class="btn btn-tl-orange"><i class="bi bi-plus-lg me-1"></i>Tambah Armada</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kapasitas</th>
                    <th>Ketersediaan</th>
                    <th>Galeri</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($armadas as $armada)
                    <tr>
                        <td style="width:100px;">
                            @if($armada->foto_utama_url)
                                <img src="{{ $armada->foto_utama_url }}" style="width:80px;height:56px;object-fit:cover;" class="rounded">
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="fw-600">{{ $armada->nama }}</td>
                        <td>{{ $armada->kapasitas_seat ?? '-' }} {{ $armada->kapasitas_seat ? 'seat' : '' }}</td>
                        <td>
                            <span class="badge {{ $armada->status_badge_class }}">{{ $armada->status_ketersediaan_label }}</span>
                            @if(!is_null($armada->seat_tersedia))
                                <div class="small text-muted">Sisa {{ $armada->seat_tersedia }}</div>
                            @endif
                        </td>
                        <td>{{ $armada->fotos_count }} foto</td>
                        <td>
                            @if($armada->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.armadas.edit', $armada) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.armadas.destroy', $armada) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus armada ini beserta seluruh galerinya?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data armada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $armadas->links() }}</div>
@endsection
