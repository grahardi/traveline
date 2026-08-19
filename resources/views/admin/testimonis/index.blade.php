@extends('layouts.admin')

@section('title', 'Testimoni')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.testimonis.create') }}" class="btn btn-tl-orange"><i class="bi bi-plus-lg me-1"></i>Tambah Testimoni</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Pesan</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonis as $t)
                    <tr>
                        <td>
                            <div class="fw-600">{{ $t->nama }}</div>
                            <small class="text-muted">{{ $t->asal_daerah }}</small>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($t->pesan, 60) }}</td>
                        <td>{{ $t->rating }} <i class="bi bi-star-fill text-warning"></i></td>
                        <td>
                            @if($t->aktif)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.testimonis.edit', $t) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.testimonis.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus testimoni ini?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada testimoni.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $testimonis->links() }}</div>
@endsection
