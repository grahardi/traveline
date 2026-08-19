<div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="judul" value="{{ old('judul', $banner->judul ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Subjudul</label>
    <input type="text" name="subjudul" value="{{ old('subjudul', $banner->subjudul ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Tautan (opsional)</label>
    <input type="url" name="link_url" value="{{ old('link_url', $banner->link_url ?? '') }}" class="form-control" placeholder="https://...">
</div>
<div class="mb-3">
    <label class="form-label">Gambar {{ isset($banner) && $banner->gambar ? '(kosongkan jika tidak ganti)' : '' }}</label>
    <input type="file" name="gambar" class="form-control" accept="image/*" {{ isset($banner) && $banner->gambar ? '' : 'required' }}>
    @if(isset($banner) && $banner->gambar)
        <img src="{{ asset('storage/'.$banner->gambar) }}" class="mt-2 rounded" style="max-height:120px;">
    @endif
    <small class="text-muted">Disarankan ukuran lebar (misal 1600x800px).</small>
</div>
<div class="mb-3">
    <label class="form-label">Urutan</label>
    <input type="number" name="urutan" value="{{ old('urutan', $banner->urutan ?? 0) }}" class="form-control" style="max-width:120px;">
</div>
<div class="form-check form-switch mb-4">
    <input type="checkbox" name="aktif" value="1" class="form-check-input" id="aktif" {{ old('aktif', $banner->aktif ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="aktif">Aktif (ditampilkan di beranda)</label>
</div>
