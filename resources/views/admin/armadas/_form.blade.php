<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Nama Armada</label>
        <input type="text" name="nama" value="{{ old('nama', $armada->nama ?? '') }}" class="form-control" required placeholder="Contoh: PO Haryanto - The Ocean">
    </div>
    <div class="col-md-4">
        <label class="form-label">Urutan</label>
        <input type="number" name="urutan" value="{{ old('urutan', $armada->urutan ?? 0) }}" class="form-control">
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $armada->deskripsi ?? '') }}</textarea>
    </div>

    <div class="col-md-6">
        <label class="form-label">Foto Utama {{ isset($armada) && $armada->foto_utama ? '(kosongkan jika tidak ganti)' : '' }}</label>
        <input type="file" name="foto_utama" class="form-control" accept="image/*">
        @if(isset($armada) && $armada->foto_utama_url)
            <img src="{{ $armada->foto_utama_url }}" class="mt-2 rounded" style="max-height:120px;">
        @endif
    </div>
    <div class="col-md-6">
        <label class="form-label">Tambah Foto Galeri (bisa pilih beberapa sekaligus)</label>
        <input type="file" name="galeri[]" class="form-control" accept="image/*" multiple>
        <small class="text-muted">Foto baru akan ditambahkan ke galeri yang sudah ada, bukan menggantikan.</small>
    </div>

    @if(isset($armada) && $armada->fotos->isNotEmpty())
        <div class="col-12">
            <label class="form-label d-block">Galeri Saat Ini</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach($armada->fotos as $foto)
                    <div class="position-relative">
                        <img src="{{ $foto->foto_url }}" style="width:90px;height:70px;object-fit:cover;" class="rounded border">
                        <form action="{{ route('admin.armadas.foto.destroy', [$armada, $foto]) }}" method="POST" class="position-absolute top-0 end-0" onsubmit="return confirm('Hapus foto ini?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger py-0 px-1" style="font-size:.7rem;line-height:1.4;" title="Hapus foto">&times;</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="col-md-6">
        <label class="form-label">Fitur Utama <small class="text-muted">(satu baris satu fitur)</small></label>
        <textarea name="fitur_utama" class="form-control" rows="5" placeholder="AC&#10;Reclining Seat&#10;TV&#10;Charger">{{ old('fitur_utama', isset($armada) ? implode("\n", $armada->fitur_utama ?? []) : '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Fitur Lainnya <small class="text-muted">(satu baris satu fitur)</small></label>
        <textarea name="fitur_lainnya" class="form-control" rows="5" placeholder="Bantal & Selimut&#10;Toilet&#10;Snack&#10;Air Mineral">{{ old('fitur_lainnya', isset($armada) ? implode("\n", $armada->fitur_lainnya ?? []) : '') }}</textarea>
    </div>

    <div class="col-md-4">
        <label class="form-label">Kapasitas Seat</label>
        <input type="number" name="kapasitas_seat" value="{{ old('kapasitas_seat', $armada->kapasitas_seat ?? '') }}" class="form-control" min="0">
    </div>
    <div class="col-md-4">
        <label class="form-label">Seat Tersedia Saat Ini</label>
        <input type="number" name="seat_tersedia" value="{{ old('seat_tersedia', $armada->seat_tersedia ?? '') }}" class="form-control" min="0">
        <small class="text-muted">Update manual — bukan sistem booking real-time.</small>
    </div>
    <div class="col-md-4">
        <label class="form-label">Status Ketersediaan</label>
        <select name="status_ketersediaan" class="form-select">
            @foreach(\App\Models\Armada::STATUS_KETERSEDIAAN as $key => $label)
                <option value="{{ $key }}" @selected(old('status_ketersediaan', $armada->status_ketersediaan ?? 'tersedia') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label d-block">Tersedia di Trayek</label>
        <div class="row row-cols-1 row-cols-md-2 g-2 border rounded p-3" style="max-height:220px;overflow-y:auto;">
            @forelse($layananList as $layanan)
                <div class="col">
                    <div class="form-check">
                        <input type="checkbox" name="layanan_ids[]" value="{{ $layanan->id }}" class="form-check-input" id="layanan{{ $layanan->id }}"
                               {{ in_array($layanan->id, old('layanan_ids', $selectedLayananIds ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label small" for="layanan{{ $layanan->id }}">{{ $layanan->kategori_label }} — {{ $layanan->rute }}</label>
                    </div>
                </div>
            @empty
                <p class="text-muted small mb-0">Belum ada data layanan/trayek. Tambahkan dulu di menu Layanan / Rute.</p>
            @endforelse
        </div>
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input type="checkbox" name="aktif" value="1" class="form-check-input" id="aktif" {{ old('aktif', $armada->aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="aktif">Aktif (ditampilkan di situs)</label>
        </div>
    </div>
</div>
