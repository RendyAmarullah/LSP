<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Mahasiswa Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-header bg-primary text-white p-4 text-center">
                        <i class="fas fa-university fa-3x mb-2"></i>
                        <h3 class="fw-bold">Formulir Pendaftaran Mahasiswa Baru</h3>
                        <p class="mb-0 text-white-50">Silakan isi data diri Anda dengan benar dan lengkap.</p>
                    </div>
                    
                    <div class="card-body p-5">

                        {{-- Menampilkan Pesan Sukses --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Menampilkan Error Validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('pendaftaranmahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <h5 class="text-primary fw-bold mb-3"><i class="fas fa-user me-2"></i>Data Pribadi</h5>
                            
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Sesuai Ijazah" value="{{ old('nama_lengkap') }}" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label fw-bold">Alamat Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nomor_hp" class="form-label fw-bold">Nomor WhatsApp</label>
                                    <input type="number" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="08xxxxxxxxxx" value="{{ old('nomor_hp') }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                            </div>

                            <hr class="my-4">

                            <h5 class="text-primary fw-bold mb-3"><i class="fas fa-graduation-cap me-2"></i>Data Akademik</h5>

                            <div class="mb-3">
                                <label for="asal_sekolah" class="form-label fw-bold">Asal Sekolah</label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="SMA/SMK/MA..." value="{{ old('asal_sekolah') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="jurusan_pilihan" class="form-label fw-bold">Pilihan Program Studi</label>
                                <select class="form-select" id="jurusan_pilihan" name="jurusan_pilihan" required>
                                    <option value="" selected disabled>-- Pilih Jurusan --</option>
                                    <option value="Teknik Informatika" {{ old('jurusan_pilihan') == 'Teknik Informatika' ? 'selected' : '' }}>S1 Teknik Informatika</option>
                                    <option value="Sistem Informasi" {{ old('jurusan_pilihan') == 'Sistem Informasi' ? 'selected' : '' }}>S1 Sistem Informasi</option>
                                    <option value="Desain Komunikasi Visual" {{ old('jurusan_pilihan') == 'Desain Komunikasi Visual' ? 'selected' : '' }}>S1 Desain Komunikasi Visual</option>
                                    <option value="Manajemen Bisnis" {{ old('jurusan_pilihan') == 'Manajemen Bisnis' ? 'selected' : '' }}>S1 Manajemen Bisnis</option>
                                </select>
                            </div>

                            <hr class="my-4">

                            <h5 class="text-primary fw-bold mb-3"><i class="fas fa-camera me-2"></i>Upload Dokumen</h5>

                            <div class="mb-4">
                                <label for="foto_diri" class="form-label fw-bold">Pas Foto Formal (3x4 atau 4x6)</label>
                                <input type="file" class="form-control" id="foto_diri" name="foto_diri" accept="image/*" required>
                                <div class="form-text text-muted">Format: JPG/PNG. Maksimal ukuran 2MB.</div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Formulir Pendaftaran
                                </button>
                                <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>

                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4 text-muted">
                    <small>&copy; {{ date('Y') }} Portal Mahasiswa. All Rights Reserved.</small>
                </div>

            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>