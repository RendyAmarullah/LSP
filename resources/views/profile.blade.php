<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Saya</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>

@php
    // Mengecek apakah User ID ini sudah ada di tabel calon_mahasiswas
   $camaba = \App\Models\Calon_Mahasiswa::where('user_id', Auth::id())->first();
    $sudahMendaftar = \App\Models\Calon_Mahasiswa::where('user_id', Auth::id())->exists();
    // Ambil status (jika belum daftar, anggap null)
    $statusPendaftaran = $camaba ? $camaba->status : null;
@endphp
<body class="bg-light">

<div class="d-flex">
    
    {{-- SIDEBAR --}}
    <div class="sidebar col-lg-3">
        <div class="sidebar-header">
            <i class="fas fa-graduation-cap university-icon mb-2" style="font-size: 2rem;"></i>
            <h4>Portal Mahasiswa</h4>
        </div>

        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom active" href="{{ url('/lengkapi-profil') }}">
                    <i class="fas fa-address-card me-2"></i> Data Profil
                </a>
            </li>
            <li class="nav-item">
                @if($statusPendaftaran == 'tervalidasi')
                    <a class="nav-link nav-link-custom" href="{{ url('/pembayaran') }}">
                        <i class="fas fa-wallet me-2"></i> Pembayaran
                    </a>
                @else
                    <a class="nav-link nav-link-custom" href="#" onclick="alert('Daftar sebagai mahasiswa terlebih dahulu!'); return false;">
                        <i class="fas fa-wallet me-2"></i> Pembayaran
                    </a>
                @endif
            </li>
        </ul>

        <div class="px-3">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-logout w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

   
    <div class="main-content col-lg-9 p-4">
        <div class="container-fluid">
            
            <div class="welcome-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-6 fw-bold text-dark">Profil Saya</h1>
                    <p class="text-muted">Berikut adalah data diri yang telah Anda daftarkan.</p>
                </div>
                <a href="{{ url('/dashboard') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>

           
            <div class="row mb-4">
                <div class="col-12">
                    
                    {{-- 1. JIKA STATUS TERVALIDASI --}}
                    @if($data->status == 'tervalidasi')
                        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center p-4">
                            <div class="me-4 text-center">
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="alert-heading fw-bold mb-1">Status: Tervalidasi</h4>
                                <p class="mb-0 fs-5">
                                    Selamat! Data pendaftaran Anda telah valid. 
                                    Silakan lanjutkan ke menu <strong>Pembayaran</strong>.
                                </p>
                            </div>
                            <div class="ms-3">
                                <a href="{{ url('/pembayaran') }}" class="btn btn-light text-success fw-bold shadow-sm px-4 py-2">
                                    <i class="fas fa-wallet me-2"></i> Bayar Sekarang
                                </a>
                            </div>
                        </div>

                    {{-- 2. JIKA STATUS DITOLAK --}}
                    @elseif($data->status == 'ditolak')
                        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center p-4">
                            <div class="me-4 text-center">
                                <i class="fas fa-times-circle fa-3x text-danger"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h4 class="alert-heading fw-bold mb-1">Status: Ditolak</h4>
                                <p class="mb-0">
                                    Mohon maaf, data pendaftaran Anda ditolak karena tidak memenuhi syarat atau terdapat kesalahan data. 
                                    <br><strong>Silakan perbaiki data Anda untuk diverifikasi ulang.</strong>
                                </p>
                            </div>
                            <div class="ms-3">
                                <a href="{{ route('pendaftaranmahasiswa.edit') }}" class="btn btn-light text-danger fw-bold shadow-sm px-4 py-2">
                                    <i class="fas fa-pencil-alt me-2"></i> Edit Data
                                </a>
                            </div>
                        </div>

                    {{-- 3. JIKA STATUS PENDING (Menunggu) --}}
                    @else
                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center p-4">
                            <div class="me-4 text-center">
                                <i class="fas fa-clock fa-3x text-warning"></i>
                            </div>
                            <div>
                                <h4 class="alert-heading fw-bold mb-1">Status: Menunggu Verifikasi</h4>
                                <p class="mb-0">
                                    Data Anda sedang dalam proses pemeriksaan oleh admin. Mohon ditunggu.
                                </p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            {{-- ================================================= --}}


            <div class="row">
                
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 text-center p-3 h-100">
                        <div class="card-body">
                            <div class="mb-3">
                                @if($data->foto_diri)
                                    <img src="{{ asset('storage/' . $data->foto_diri) }}" class="img-thumbnail rounded-circle shadow-sm" 
                                         style="width: 200px; height: 200px; object-fit: cover;" alt="Foto Profil">
                                @else
                                    <img src="https://via.placeholder.com/200?text=No+Photo" class="img-thumbnail rounded-circle shadow-sm" 
                                         alt="No Photo">
                                @endif
                            </div>
                            
                            <h4 class="fw-bold text-dark">{{ $data->nama_lengkap }}</h4>
                            <p class="text-muted mb-1">{{ $data->email }}</p>
                            
                            {{-- Tampilkan Jurusan --}}
                            <span class="badge bg-primary px-3 py-2 mt-2">{{ $data->jurusan_pilihan }}</span>
                            
                            {{-- Tampilkan Fakultas --}}
                            <p class="text-secondary small mt-2 fw-bold">{{ $data->fakultas }}</p>
                            
                            <hr class="my-4">
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-user-check me-2"></i> Detail Informasi</h5>
                            
                            {{-- Tombol edit kecil juga muncul jika status pending (opsional) --}}
                            @if($data->status == 'pending')
                                <a href="{{ route('pendaftaranmahasiswa.edit') }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-pencil-alt me-1"></i> Edit
                                </a>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle">
                                    <tbody>
                                        <tr>
                                            <td width="35%" class="text-secondary fw-bold">Nama Lengkap</td>
                                            <td width="5%">:</td>
                                            <td class="fw-bold text-dark">{{ $data->nama_lengkap }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="text-secondary fw-bold">Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>{{ $data->jenis_kelamin }}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-secondary fw-bold">Agama</td>
                                            <td>:</td>
                                            <td>{{ $data->agama }}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-secondary fw-bold">Tempat, Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>{{ $data->tempat_lahir }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-secondary fw-bold">Nomor WhatsApp</td>
                                            <td>:</td>
                                            <td>{{ $data->nomor_hp }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-secondary fw-bold">Email Terdaftar</td>
                                            <td>:</td>
                                            <td>{{ $data->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-secondary fw-bold">Asal Sekolah</td>
                                            <td>:</td>
                                            <td>{{ $data->asal_sekolah }}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-secondary fw-bold">Fakultas</td>
                                            <td>:</td>
                                            <td>{{ $data->fakultas }}</td>
                                        </tr>

                                        <tr>
                                            <td class="text-secondary fw-bold">Jurusan Pilihan</td>
                                            <td>:</td>
                                            <td class="text-primary fw-bold">{{ $data->jurusan_pilihan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-secondary fw-bold">Alamat Lengkap</td>
                                            <td>:</td>
                                            <td>{{ $data->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-secondary fw-bold">Tanggal Mendaftar</td>
                                            <td>:</td>
                                            <td>{{ $data->created_at->format('d/m/Y H:i') }} WIB</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-info d-flex align-items-center mt-3" role="alert">
                                <i class="fas fa-info-circle me-3 fa-lg"></i>
                                <div>
                                    Pastikan data di atas sudah benar. Jika terdapat kesalahan, silakan hubungi bagian administrasi kampus.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>