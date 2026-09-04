@extends('layouts.admin')

@section('title', 'Ketersediaan Kursi')

@section('content')
<p class="text-muted">Isi jumlah kursi yang sudah terbooking untuk tiap armada. Kursi tersedia &amp; status dihitung otomatis (kapasitas &minus; terbooking). Kalau belum ada booking, biarkan 0 — otomatis berstatus <span class="badge bg-success">Tersedia</span>.</p>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Armada</th>
                    <th class="text-center">Kapasitas</th>
                    <th class="text-center" style="width:220px;">Kursi Terbooking</th>
                    <th class="text-center">Kursi Tersedia</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($armadas as $armada)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($armada->foto_utama_url)
                                    <img src="{{ $armada->foto_utama_url }}" style="width:56px;height:40px;object-fit:cover;" class="rounded">
                                @endif
                                <span class="fw-600">{{ $armada->nama }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($armada->kapasitas_seat)
                                {{ $armada->kapasitas_seat }} seat
                            @else
                                <span class="text-muted small">Belum diisi</span>
                            @endif
                        </td>
                        <td>
                            @if($armada->kapasitas_seat)
                                <form action="{{ route('admin.ketersediaan.update', $armada) }}" method="POST" class="d-flex gap-2 justify-content-center">
                                    @csrf @method('PUT')
                                    <input type="number" name="kursi_terbooking" value="{{ old('kursi_terbooking', $armada->kursi_terbooking) }}" min="0" max="{{ $armada->kapasitas_seat }}" class="form-control form-control-sm" style="width:90px;">
                                    <button type="submit" class="btn btn-sm btn-tl-orange">Simpan</button>
                                </form>
                            @else
                                <p class="text-muted small text-center mb-0">Isi kapasitas seat dulu di menu Armada.</p>
                            @endif
                        </td>
                        <td class="text-center fw-bold text-tl-blue">
                            {{ $armada->seat_tersedia ?? '-' }}
                        </td>
                        <td class="text-center">
                            <span class="badge {{ $armada->status_badge_class }}">{{ $armada->status_ketersediaan_label }}</span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data armada. Tambahkan dulu di menu Armada.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
