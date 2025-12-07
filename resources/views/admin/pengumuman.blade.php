<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Pengumuman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>


<body>
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
                    <a class="nav-link nav-link-custom active" href="{{ url('/admin/pengumuman') }}">
                        <i class="fas fa-wallet me-2"></i> Pengumuman
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
    <div class="container p-4 bg-light" style="max-width: 900px;">
        
        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif
        
        {{-- BAGIAN 1: TABEL PENGUMUMAN (Tampil jika page = 'index') --}}
        @if($page == 'index')
            <div class="d-flex justify-content-between mb-4">
                <h3>📢 Kelola Pengumuman</h3>
                <a href="{{ route('pengumuman.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Baru
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Gambar</th>
                                <th>Judul & Isi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengumuman as $item)
                            <tr>
                                <td width="15%">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid rounded border" style="max-height: 80px;">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <h6 class="fw-bold mb-1">{{ $item->judul }}</h6>
                                    <small class="text-muted">{{ Str::limit($item->isi, 80) }}</small>
                                    <div class="text-secondary" style="font-size: 12px;">
                                        <i class="far fa-clock"></i> {{ $item->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('pengumuman.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('pengumuman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr><td colspan="3" class="text-center">Belum ada pengumuman.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $pengumuman->links() }}
                </div>
            </div>

        {{-- BAGIAN 2: FORM CREATE (Tampil jika page = 'create') --}}
        @elseif($page == 'create')
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Tambah Pengumuman</div>
                <div class="card-body">
                    <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('admin.partials.form-pengumuman') <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

        {{-- BAGIAN 3: FORM EDIT (Tampil jika page = 'edit') --}}
        @elseif($page == 'edit')
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">Edit Pengumuman</div>
                <div class="card-body">
                    <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        {{-- Field Gambar Khusus Edit (Preview gambar lama) --}}
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label><br>
                            @if($pengumuman->gambar)
                                <img src="{{ asset('storage/' . $pengumuman->gambar) }}" height="100" class="rounded border mb-2">
                            @endif
                        </div>

                        {{-- Include Form Inputan sama seperti create --}}
                        @include('admin.partials.form-pengumuman', ['data' => $pengumuman]) 
                        
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</body>
</html>