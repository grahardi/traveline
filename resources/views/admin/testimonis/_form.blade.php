<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="nama" value="{{ old('nama', $testimoni->nama ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Asal Daerah</label>
    <input type="text" name="asal_daerah" value="{{ old('asal_daerah', $testimoni->asal_daerah ?? '') }}" class="form-control">
</div>
<div class="mb-3">
    <label class="form-label">Pesan Testimoni</label>
    <textarea name="pesan" class="form-control" rows="3" required>{{ old('pesan', $testimoni->pesan ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Rating</label>
    <select name="rating" class="form-select" style="max-width:150px;">
        @for($i=5;$i>=1;$i--)
            <option value="{{ $i }}" @selected(old('rating', $testimoni->rating ?? 5) == $i)>{{ $i }} Bintang</option>
        @endfor
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Foto (opsional)</label>
    <input type="file" name="foto" class="form-control" accept="image/*">
    @if(isset($testimoni) && $testimoni->foto)
        <img src="{{ asset('storage/'.$testimoni->foto) }}" class="mt-2 rounded-circle" style="width:64px;height:64px;object-fit:cover;">
    @endif
</div>
<div class="form-check form-switch mb-4">
    <input type="checkbox" name="aktif" value="1" class="form-check-input" id="aktif" {{ old('aktif', $testimoni->aktif ?? true) ? 'checked' : '' }}>
    <label class="form-check-label" for="aktif">Aktif (ditampilkan di situs)</label>
</div>
