<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>
<body class="bg-light">

<div class="d-flex">
    
    {{-- SIDEBAR --}}
    <div class="sidebar col-lg-3">
        <div class="sidebar-header">
            <i class="fas fa-graduation-cap university-icon mb-2" style="font-size: 2rem;"></i>
            <h4>Portal Admin</h4>
        </div>

        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a class="nav-link nav-link-custom active" href="{{ url('/admin/dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/admin/akun') }}">
                    <i class="fas fa-address-card me-2"></i> Akun
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/admin/pengumuman') }}">
                    <i class="fas fa-bullhorn me-2"></i> Pengumuman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/admin/calonmahasiswa') }}">
                    <i class="fas fa-users me-2"></i> Data Pendaftar
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/admin/pembayaran') }}">
                    <i class="fas fa-money-bill-wave me-2"></i> Pembayaran
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

    {{-- KONTEN UTAMA --}}
    <div class="main-content col-lg-9 p-4">
        <div class="container-fluid">
            
            <div class="welcome-header d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="display-6 fw-bold text-dark">Selamat Datang, Admin!</h1>
                    <p class="text-muted">Ringkasan aktivitas pendaftaran mahasiswa baru.</p>
                </div>
            </div>

            {{-- ================================================= --}}
            {{-- KARTU STATISTIK (BAGIAN BARU)                     --}}
            {{-- ================================================= --}}
            <div class="row mb-4">
                
                {{-- Kartu 1: Total Akun Mahasiswa --}}
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100 py-2 border-start border-primary border-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-user-graduate text-primary fa-2x"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Total Akun Mahasiswa</h6>
                                    <h2 class="fw-bold mb-0 text-dark">{{ $totalAkun ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu 2: Total Pendaftar (Sudah Isi Form) --}}
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100 py-2 border-start border-warning border-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-file-alt text-warning fa-2x"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Formulir Masuk</h6>
                                    <h2 class="fw-bold mb-0 text-dark">{{ $totalPendaftar ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kartu 3: Total Pembayaran Lunas --}}
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100 py-2 border-start border-success border-5">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-wallet text-success fa-2x"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="card-title text-muted mb-1">Pembayaran Lunas</h6>
                                    <h2 class="fw-bold mb-0 text-dark">{{ $totalPembayaran ?? 0 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- ================================================= --}}


            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="d-flex align-items-center mb-3 mt-2">
                        <h5 class="fw-bold text-secondary m-0">📢 Papan Pengumuman</h5>
                        <span class="badge bg-primary ms-2">{{ $pengumuman->count() }} Terposting</span>
                    </div>
                    
                    <div class="row">
                        @forelse($pengumuman as $info)
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 border-0 shadow-sm"> 
                                    <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
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
                
                <div class="col-lg-4">
                    {{-- Kosong (Sesuai kode asli Anda) --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>