<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>
<body>

<div class="d-flex">
    
    <div class="sidebar col-lg-3">
        <div class="sidebar-header">
            <i class="fas fa-graduation-cap university-icon mb-2" style="font-size: 2rem;"></i>
            <h4>Portal Mahasiswa</h4>
        </div>

        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a class="nav-link nav-link-custom active" href="{{ url('/dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/lengkapi-profil') }}">
                    <i class="fas fa-address-card me-2"></i> Data Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/pembayaran') }}">
                    <i class="fas fa-wallet me-2"></i> Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/jadwal-test') }}">
                    <i class="fas fa-calendar-alt me-2"></i> Jadwal Tes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/bantuan') }}">
                    <i class="fas fa-question-circle me-2"></i> Bantuan
                </a>
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
            
            <div class="welcome-header d-flex justify-content-between align-items-center">
                <div>
                    {{-- Mengambil Nama User Login --}}
                    <h1 class="display-5 fw-bold text-dark">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="lead mb-0 text-muted">Ini adalah ringkasan status pendaftaran Anda.</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    
                    <h5 class="mb-3 fw-bold text-secondary">Status Pendaftaran</h5>
                    
                    <div class="card status-card mb-4">
                        <div class="card-header card-header-custom bg-white">
                            <i class="fas fa-user-shield me-2 text-primary"></i> Status Akun Pendaftaran
                        </div>
                        
                        <div class="card-body d-flex align-items-center">
                            
                            {{-- LOGIKA STATUS --}}
                            @if(Auth::user()->status == 'tervalidasi')
                                
                                {{-- TAMPILAN JIKA SUDAH DIVALIDASI --}}
                                <i class="fas fa-check-circle status-icon text-success" style="font-size: 2.5rem; margin-right: 15px;"></i> 
                                <div>
                                    <h5 class="card-title fw-bold text-success">Akun Tervalidasi</h5>
                                    <p class="card-text text-muted mb-0">
                                        Selamat! Data Anda telah diverifikasi oleh admin.
                                    </p>
                                </div>

                            @elseif(Auth::user()->status == 'ditolak')
                                
                                {{-- TAMPILAN JIKA DITOLAK (BARU) --}}
                                <i class="fas fa-times-circle status-icon text-danger" style="font-size: 2.5rem; margin-right: 15px;"></i> 
                                <div>
                                    <h5 class="card-title fw-bold text-danger">Akun Ditolak</h5>
                                    <p class="card-text text-muted mb-0">
                                        Mohon maaf, akun anda ditolak.
                                        <br><small class="text-secondary">Silakan perbaiki data profil.</small>
                                    </p>
                                </div>
                    
                            @else
                                
                                {{-- TAMPILAN JIKA BELUM DIVALIDASI (DEFAULT) --}}
                                <i class="fas fa-clock status-icon text-warning" style="font-size: 2.5rem; margin-right: 15px;"></i> 
                                <div>
                                    <h5 class="card-title fw-bold text-warning">Menunggu Verifikasi Admin</h5>
                                    <p class="card-text text-muted mb-0">
                                        Dokumen Anda sedang diperiksa oleh tim admisi.
                                    </p>
                                </div>
                    
                            @endif
                        </div>
                    
                        {{-- <div class="card-footer bg-light">
                            <a href="{{ url('/status-detail') }}" class="btn btn-sm btn-outline-primary">
                                Lihat Dokumen yang Diunggah
                            </a>
                        </div> --}}
                    </div>
                        
                    <div class="card status-card mb-4">
                        <div class="card-header card-header-custom bg-white">
                            <i class="fas fa-receipt me-2 text-success"></i> Status Pembayaran Formulir
                        </div>
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-exclamation-circle status-icon text-danger"></i> 
                            <div>
                                <h5 class="card-title fw-bold text-danger">BELUM DIBAYAR</h5>
                                <p class="card-text text-muted mb-0">
                                    Harap segera lunasi biaya pendaftaran untuk melanjutkan proses verifikasi.
                                </p>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <a href="{{ url('/pembayaran') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-wallet me-2"></i> Lanjutkan Pembayaran (Rp 250.000)
                            </a>
                        </div>
                    </div>

                    <div class="card status-card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-3">Langkah Terakhir</h5>
                    
                            {{-- LOGIKA TOMBOL --}}
                            
                            @if(Auth::user()->status == 'tervalidasi')
                                
                                <div class="alert alert-success border-0 bg-success-subtle text-success mb-3">
                                    <i class="fas fa-check-circle me-2"></i> Akun Anda telah tervalidasi. Silakan lanjutkan.
                                </div>
                                <a href="{{ url('/pendaftaranmahasiswa') }}" class="btn btn-primary w-100 py-2 fw-bold">
                                    <i class="fas fa-user-check me-2"></i> Mendaftar Sebagai Mahasiswa
                                </a>

                            @elseif(Auth::user()->status == 'ditolak')

                                {{-- TOMBOL JIKA DITOLAK (DISABLED MERAH) --}}
                                <div class="alert alert-danger border-0 bg-danger-subtle text-danger mb-3">
                                    <i class="fas fa-ban me-2"></i> Akun Anda ditolak.
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-danger w-100 py-2 fw-bold" disabled style="cursor: not-allowed; opacity: 0.6;">
                                        <i class="fas fa-times me-2"></i> Pendaftaran Ditolak
                                    </button>
                                </div>
                                <small class="text-secondary d-block mt-2 text-center">
                                    *Silakan perbaiki data Anda di menu Profil.
                                </small>

                            @else
                               
                                {{-- TOMBOL JIKA PENDING (DISABLED ABU-ABU) --}}
                                <div class="d-grid gap-2">
                                    <button class="btn btn-secondary w-100 py-2 fw-bold" disabled style="cursor: not-allowed; opacity: 0.6;">
                                        <i class="fas fa-lock me-2"></i> Mendaftar Sebagai Mahasiswa
                                    </button>
                                </div>
                                <small class="text-danger d-block mt-2 text-center">
                                    *Tombol akan aktif otomatis setelah Status Akun menjadi "Tervalidasi".
                                </small>

                            @endif
                        </div>
                    </div>

                    {{-- <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                           **Perhatian:** Batas akhir pembayaran adalah **31 Desember 2025**.
                        </div>
                    </div> --}}
                    
                </div> 
                
                <div class="col-lg-4">
                     <h5 class="mb-3 fw-bold text-secondary">Download & Info</h5>
                    <div class="card status-card p-3">
                        <h5 class="card-title text-center fw-bold mb-3">Dokumen & Informasi</h5>
                        <a href="{{ url('/download-formulir') }}" class="btn btn-action btn-secondary mb-3">
                            <i class="fas fa-download me-2"></i> Unduh Bukti Pendaftaran
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-action btn-outline-dark">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div> 
            </div>
                
        </div>
        
        <div class="d-flex align-items-center mb-3 mt-5">
            <h5 class="fw-bold text-secondary m-0">📢 Papan Pengumuman</h5>
            <span class="badge bg-primary ms-2">{{ $pengumuman->count() }} Baru</span>
        </div>
        
        <div class="row">
            @forelse($pengumuman as $info)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm"> <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="fw-bold text-dark mb-0 text-truncate" style="max-width: 150px;" title="{{ $info->judul }}">
                                    {{ $info->judul }}
                                </h5>
                                <small class="text-muted" style="font-size: 0.8rem;">
                                    <i class="far fa-clock me-1"></i> {{ $info->created_at->format('d M') }}
                                </small>
                            </div>
                        </div>
        
                        <div class="card-body d-flex flex-column">
                            @if($info->gambar)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $info->gambar) }}" class="img-fluid rounded w-100" 
                                         alt="Gambar Pengumuman" style="height: 150px; object-fit: cover;">
                                </div>
                            @endif
                            
                            <p class="card-text text-secondary flex-grow-1">
                                {{ Str::limit($info->isi, 100) }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-secondary d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>Belum ada pengumuman dari pihak kampus saat ini.</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>