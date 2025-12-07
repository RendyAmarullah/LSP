<div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $data->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Isi Pengumuman</label>
    <textarea name="isi" class="form-control" rows="5" required>{{ old('isi', $data->isi ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Upload Gambar {{ isset($data) ? '(Kosongkan jika tidak ganti)' : '' }}</label>
    <input type="file" name="gambar" class="form-control">
</div>