<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoriList as $key => $label)
                <option value="{{ $key }}" @selected(old('kategori', $layanan->kategori ?? '') === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Layanan</label>
        <input type="text" name="nama" value="{{ old('nama', $layanan->nama ?? '') }}" class="form-control" required placeholder="Contoh: Tiket Bus Malang - Jakarta">
    </div>
    <div class="col-md-6">
        <label class="form-label">Asal (opsional)</label>
        <input type="text" name="asal" value="{{ old('asal', $layanan->asal ?? '') }}" class="form-control" placeholder="Malang">
    </div>
    <div class="col-md-6">
        <label class="form-label">Tujuan (opsional)</label>
        <input type="text" name="tujuan" value="{{ old('tujuan', $layanan->tujuan ?? '') }}" class="form-control" placeholder="Jakarta">
    </div>
    <div class="col-md-6">
        <label class="form-label">Harga (opsional, angka saja)</label>
        <input type="number" step="0.01" name="harga" value="{{ old('harga', $layanan->harga ?? '') }}" class="form-control" placeholder="380000">
    </div>
    <div class="col-md-6">
        <label class="form-label">Satuan Harga</label>
        <input type="text" name="satuan_harga" value="{{ old('satuan_harga', $layanan->satuan_harga ?? 'per orang') }}" class="form-control" placeholder="per orang">
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control" accept="image/*">
        @if(isset($layanan) && $layanan->gambar)
            <img src="{{ asset('storage/'.$layanan->gambar) }}" class="mt-2 rounded" style="max-height:100px;">
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label">Urutan</label>
        <input type="number" name="urutan" value="{{ old('urutan', $layanan->urutan ?? 0) }}" class="form-control">
    </div>
    <div class="col-md-3 d-flex flex-column justify-content-center">
        <div class="form-check form-switch">
            <input type="checkbox" name="unggulan" value="1" class="form-check-input" id="unggulan" {{ old('unggulan', $layanan->unggulan ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="unggulan">Layanan Unggulan</label>
        </div>
        <div class="form-check form-switch mt-2">
            <input type="checkbox" name="aktif" value="1" class="form-check-input" id="aktif" {{ old('aktif', $layanan->aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="aktif">Aktif</label>
        </div>
    </div>
</div>
<div class="mt-4">
</div>
