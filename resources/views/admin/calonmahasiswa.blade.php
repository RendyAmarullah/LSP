<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Calon Mahasiswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>
<body class="bg-light">

<div class="d-flex">
    
    <div class="sidebar col-lg-3">
        <div class="sidebar-header">
            <i class="fas fa-graduation-cap university-icon mb-2" style="font-size: 2rem;"></i>
            <h4>Portal Admin</h4>
        </div>

        <ul class="nav flex-column px-3">
            <li class="nav-item">
                <a class="nav-link nav-link-custom" href="{{ url('/admin/dashboard') }}">
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
                <a class="nav-link nav-link-custom active" href="{{ url('/admin/calonmahasiswa') }}">
                    <i class="fas fa-users me-2"></i> Data Pendaftar
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
            
            <div class="welcome-header mb-4">
                <h1 class="display-6 fw-bold text-dark">Data Pendaftar Masuk</h1>
                <p class="text-muted">Kelola data calon mahasiswa baru yang telah mendaftar.</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-users me-2"></i> Daftar Calon Mahasiswa
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan Pilihan</th>
                                    <th>Asal Sekolah</th>
                                    <th>Tanggal Daftar</th>
                                    <th width="10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftar as $key => $item)
                                <tr>
                                    <td>{{ $pendaftar->firstItem() + $key }}</td>
                                    
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->nama_lengkap }}</div>
                                        <small class="text-muted"><i class="fas fa-envelope me-1"></i> {{ $item->email }}</small>
                                    </td>
                                    
                                    <td>
                                        <span class="badge bg-info text-dark">{{ $item->jurusan_pilihan }}</span>
                                    </td>
        
                                    <td>{{ $item->asal_sekolah }}</td>
                                    
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    
                                    <td class="text-center">
                                        {{-- TOMBOL PEMICU MODAL --}}
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3"></i><br>
                                        Belum ada calon mahasiswa yang mendaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
        
                    {{-- Pagination --}}
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $pendaftar->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@foreach($pendaftar as $item)
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <div class="modal-content border-0 shadow">
            
            {{-- Header Modal --}}
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-id-card me-2"></i> Biodata Lengkap
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            {{-- Body Modal --}}
            <div class="modal-body p-4">
                <div class="row">
                    
                    {{-- Kolom Kiri: Foto --}}
                    <div class="col-md-4 text-center mb-3">
                        <div class="card p-2 shadow-sm">
                            @if($item->foto_diri)
                                <img src="{{ asset('storage/' . $item->foto_diri) }}" class="img-fluid rounded" alt="Foto Diri">
                            @else
                                <img src="https://via.placeholder.com/300x400?text=No+Photo" class="img-fluid rounded" alt="No Photo">
                            @endif
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-secondary p-2 w-100">ID: {{ $item->id }}</span>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Data Teks --}}
                    <div class="col-md-8">
                        <h4 class="fw-bold text-dark border-bottom pb-2 mb-3">{{ $item->nama_lengkap }}</h4>

                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">Jurusan Pilihan</div>
                            <div class="col-8">: <span class="badge bg-success">{{ $item->jurusan_pilihan }}</span></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">Email</div>
                            <div class="col-8">: {{ $item->email }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">No. WhatsApp</div>
                            <div class="col-8">: {{ $item->nomor_hp }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">TTL</div>
                            <div class="col-8">: {{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d F Y') }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">Asal Sekolah</div>
                            <div class="col-8">: {{ $item->asal_sekolah }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-4 fw-bold text-secondary">Alamat</div>
                            <div class="col-8 text-break">: {{ $item->alamat }}</div>
                        </div>

                        <div class="alert alert-light border mt-4 mb-0">
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i> Mendaftar pada: {{ $item->created_at->translatedFormat('l, d F Y H:i') }}
                            </small>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer Modal --}}
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-outline-primary"><i class="fas fa-print me-1"></i> Cetak Data</button>
            </div>

        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>