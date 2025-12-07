<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    <a class="nav-link nav-link-custom active" href="{{ url('/admin/akun') }}">
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
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Validasi Pendaftaran Mahasiswa</h5>
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-sm btn-light">Kembali ke Dashboard</a>
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Status Validasi</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $key => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                
                                <td>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">Bergabung: {{ $user->created_at->format('d M Y') }}</small>
                                </td>
                                
                                <td>{{ $user->email }}</td>

                                <td>
                                    <span class="badge bg-info text-dark">{{ $user->role }}</span>
                                </td>
                                
                                <td class="text-center">
                                    {{-- Update Tampilan Status --}}
                                    @if($user->status == 'tervalidasi')
                                        <span class="badge bg-success rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i> Tervalidasi
                                        </span>
                                    @elseif($user->status == 'ditolak')
                                        <span class="badge bg-danger rounded-pill">
                                            <i class="fas fa-times-circle me-1"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark rounded-pill">
                                            <i class="fas fa-clock me-1"></i> Menunggu
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    {{-- Logika Tombol Aksi --}}
                                    
                                    {{-- Jika status MASIH MENUNGGU (Belum valid & Belum tolak) --}}
                                    @if($user->status != 'tervalidasi' && $user->status != 'ditolak')
                                        
                                        {{-- 1. Tombol Terima --}}
                                        <form action="{{ route('admin.validasi', $user->id) }}" method="POST" class="mb-1" onsubmit="return confirm('Yakin ingin memvalidasi mahasiswa ini?');">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success w-100">
                                                <i class="fas fa-check me-1"></i> Terima
                                            </button>
                                        </form>

                                        {{-- 2. Tombol Tolak (Pengganti Hapus) --}}
                                        <form action="{{ route('admin.tolak', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin MENOLAK pendaftaran ini?');">
                                            @csrf
                                            @method('PUT') {{-- Menggunakan PUT karena update status --}}
                                            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                                                <i class="fas fa-times me-1"></i> Tolak
                                            </button>
                                        </form>

                                    @else
                                        {{-- Jika sudah diproses (Valid/Tolak), tombol mati --}}
                                        <button class="btn btn-sm btn-secondary w-100 mb-1" disabled style="opacity: 0.7;">
                                            <i class="fas fa-lock me-1"></i> Selesai
                                        </button>
                                    @endif

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                    Tidak ada data mahasiswa baru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>

</body>
</html>