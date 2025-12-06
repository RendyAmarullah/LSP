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
                            <i class="fas fa-clock status-icon text-warning"></i> 
                            <div>
                                <h5 class="card-title fw-bold text-warning">Menunggu Verifikasi Admin</h5>
                                <p class="card-text text-muted mb-0">
                                    Dokumen Anda sedang diperiksa oleh tim admisi.
                                </p>
                            </div>
                        </div>
                        <div class="card-footer bg-light">
                            <a href="{{ url('/status-detail') }}" class="btn btn-sm btn-outline-primary">
                                Lihat Dokumen yang Diunggah
                            </a>
                        </div>
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
                    
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        <div>
                           **Perhatian:** Batas akhir pembayaran adalah **31 Desember 2025**.
                        </div>
                    </div>

                </div> <div class="col-lg-4">
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
                </div> </div>
        </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>