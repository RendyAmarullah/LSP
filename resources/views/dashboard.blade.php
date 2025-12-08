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

{{-- CEK STATUS PENDAFTARAN --}}
@php
    // Mengecek apakah User ID ini sudah ada di tabel calon_mahasiswas
   $camaba = \App\Models\Calon_Mahasiswa::where('user_id', Auth::id())->first();
    $sudahMendaftar = \App\Models\Calon_Mahasiswa::where('user_id', Auth::id())->exists();
    // Ambil status (jika belum daftar, anggap null)
    $statusPendaftaran = $camaba ? $camaba->status : null;
@endphp

<div class="d-flex">
    
    {{-- SIDEBAR --}}
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
                @if(Auth::user()->status == 'tervalidasi')
                    <a class="nav-link nav-link-custom" href="{{ url('/profile') }}">
                        <i class="fas fa-address-card me-2"></i> Data Profil
                    </a>
                @else
                    <a class="nav-link nav-link-custom text-secondary" href="#" onclick="return false;" style="cursor: not-allowed; opacity: 0.6;">
                        <i class="fas fa-address-card me-2"></i> Data Profil 
                        <i class="fas fa-lock ms-2" style="font-size: 0.8rem;"></i> 
                    </a>
                @endif
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
    
    {{-- KONTEN UTAMA --}}
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
                    
                    {{-- CARD STATUS AKUN --}}
                    <div class="card status-card mb-4">
                        <div class="card-header card-header-custom bg-white">
                            <i class="fas fa-user-shield me-2 text-primary"></i> Status Akun Pendaftaran
                        </div>
                        
                        <div class="card-body d-flex align-items-center">
                            @if(Auth::user()->status == 'tervalidasi')
                                <i class="fas fa-check-circle status-icon text-success" style="font-size: 2.5rem; margin-right: 15px;"></i> 
                                <div>
                                    <h5 class="card-title fw-bold text-success">Akun Tervalidasi</h5>
                                    <p class="card-text text-muted mb-0">Selamat! Data Anda telah diverifikasi oleh admin.</p>
                                </div>
                            @elseif(Auth::user()->status == 'ditolak')
                                <i class="fas fa-times-circle status-icon text-danger" style="font-size: 2.5rem; margin-right: 15px;"></i> 
                                <div>
                                    <h5 class="card-title fw-bold text-danger">Akun Ditolak</h5>
                                    <p class="card-text text-muted mb-0">Mohon maaf, akun anda ditolak. <br><small class="text-secondary">Silakan perbaiki data profil.</small></p>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#editAkunModal">
                                        <i class="fas fa-user-edit me-1"></i> Perbaiki Data Akun
                                    </button>
                                </div>
                            @else
                                <i class="fas fa-clock status-icon text-warning" style="font-size: 2.5rem; margin-right: 15px;"></i> 
                                <div>
                                    <h5 class="card-title fw-bold text-warning">Menunggu Verifikasi Admin</h5>
                                    <p class="card-text text-muted mb-0">Dokumen Anda sedang diperiksa oleh tim admisi.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                        
                    

                    {{-- CARD LANGKAH TERAKHIR --}}
                    <div class="card status-card mb-4 shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="fw-bold text-dark mb-3">Langkah Terakhir</h5>
                            @if(Auth::user()->status == 'tervalidasi')
                                <div class="alert alert-success border-0 bg-success-subtle text-success mb-3">
                                    <i class="fas fa-check-circle me-2"></i> Akun Anda telah tervalidasi. Silakan lanjutkan.
                                </div>
                                <a href="{{ url('/pendaftaranmahasiswa') }}" class="btn btn-primary w-100 py-2 fw-bold">
                                    <i class="fas fa-user-check me-2"></i> Mendaftar Sebagai Mahasiswa
                                </a>
                            @elseif(Auth::user()->status == 'ditolak')
                                <div class="alert alert-danger border-0 bg-danger-subtle text-danger mb-3">
                                    <i class="fas fa-ban me-2"></i> Akun Anda ditolak.
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-danger w-100 py-2 fw-bold" disabled style="cursor: not-allowed; opacity: 0.6;">
                                        <i class="fas fa-times me-2"></i> Pendaftaran Ditolak
                                    </button>
                                </div>
                            @else
                                <div class="d-grid gap-2">
                                    <button class="btn btn-secondary w-100 py-2 fw-bold" disabled style="cursor: not-allowed; opacity: 0.6;">
                                        <i class="fas fa-lock me-2"></i> Mendaftar Sebagai Mahasiswa
                                    </button>
                                </div>
                                <small class="text-danger d-block mt-2 text-center">*Tombol akan aktif otomatis setelah Status Akun menjadi "Tervalidasi".</small>
                            @endif
                        </div>
                    </div>
                </div> 
                
                <div class="col-lg-4">
                     <h5 class="mb-3 fw-bold text-secondary"></h5>
                    
                        <a href="{{ url('/') }}" class="btn btn-action btn-outline-dark">
                            <i class="fas fa-home me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div> 
            </div>
            
            {{-- BAGIAN PENGUMUMAN --}}
            <div class="d-flex align-items-center mb-3 mt-5">
                <h5 class="fw-bold text-secondary m-0">📢 Papan Pengumuman</h5>
                <span class="badge bg-primary ms-2">{{ $pengumuman->count() }} Baru</span>
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

                                <button type="button" class="btn btn-sm btn-outline-primary mt-3 stretched-link" 
                                        data-bs-toggle="modal" data-bs-target="#pengumumanModal{{ $info->id }}">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </button>
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
</div>

{{-- MODAL DETAIL PENGUMUMAN --}}
@foreach($pengumuman as $info)
<div class="modal fade" id="pengumumanModal{{ $info->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark w-100">
                    {{ $info->judul }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3 text-muted border-bottom pb-2">
                    <i class="far fa-calendar-alt me-2"></i> Diposting pada: {{ $info->created_at->translatedFormat('l, d F Y') }}
                </div>
                @if($info->gambar)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $info->gambar) }}" class="img-fluid rounded shadow-sm" alt="Detail Gambar">
                    </div>
                @endif
                <div class="text-dark" style="line-height: 1.8; white-space: pre-wrap;">{{ $info->isi }}</div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- MODAL EDIT DATA AKUN --}}
<div class="modal fade" id="editAkunModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold">Perbaiki Data Akun</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('akun.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required>
                    </div>
                    <div class="alert alert-warning small">
                        <i class="fas fa-info-circle me-1"></i> Setelah disimpan, status akun akan kembali menjadi <strong>Menunggu Verifikasi</strong>.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>