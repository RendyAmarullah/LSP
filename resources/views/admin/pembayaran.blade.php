<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Pembayaran</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>
<body class="bg-light">

<div class="d-flex">
    
    {{-- SIDEBAR ADMIN --}}
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
                <a class="nav-link nav-link-custom" href="{{ url('/admin/calonmahasiswa') }}">
                    <i class="fas fa-users me-2"></i> Data Pendaftar
                </a>
            </li>
            {{-- Menu Aktif --}}
            <li class="nav-item">
                <a class="nav-link nav-link-custom active" href="{{ url('/admin/pembayaran') }}">
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
            
            <div class="welcome-header mb-4">
                <h1 class="display-6 fw-bold text-dark">Validasi Pembayaran</h1>
                <p class="text-muted">Cek bukti transfer dan konfirmasi pembayaran mahasiswa.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary">
                        <i class="fas fa-receipt me-2"></i> Daftar Transaksi Masuk
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-secondary">
                                <tr>
                                    <th>No</th>
                                    <th>Kode TRX</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Tanggal Upload</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pembayaran as $key => $trx)
                                <tr>
                                    <td>{{ $pembayaran->firstItem() + $key }}</td>
                                    <td><span class="text-monospace fw-bold">{{ $trx->kode_transaksi }}</span></td>
                                    
                                    <td>
                                        <div class="fw-bold">{{ $trx->calonMahasiswa->nama_lengkap ?? 'User Dihapus' }}</div>
                                        <small class="text-muted">{{ $trx->calonMahasiswa->prodi->nama_prodi ?? '-' }}</small>
                                    </td>
                                    
                                    <td>Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y H:i') }}</td>
                                    
                                    <td class="text-center">
                                        @if($trx->status == 'lunas')
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif($trx->status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        {{-- TOMBOL LIHAT BUKTI / PROSES --}}
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#trxModal{{ $trx->id }}">
                                            <i class="fas fa-search me-1"></i> Periksa
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-file-invoice-dollar fa-3x mb-3"></i><br>
                                        Belum ada data pembayaran masuk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-end">
                        {{ $pembayaran->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@foreach($pembayaran as $trx)
<div class="modal fade" id="trxModal{{ $trx->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered"> 
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-money-check-alt me-2"></i> Detail Pembayaran
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body p-0">
                <div class="row g-0">
                    
                    {{-- KOLOM KIRI: GAMBAR BUKTI --}}
                    <div class="col-md-7 bg-dark text-center d-flex align-items-center justify-content-center p-3">
                        @if($trx->bukti_bayar)
                            <img src="{{ asset('storage/' . $trx->bukti_bayar) }}" class="img-fluid rounded" 
                                 style="max-height: 400px;" alt="Bukti Bayar">
                        @else
                            <div class="text-white">
                                <i class="fas fa-image fa-3x mb-3"></i><br>
                                Tidak ada bukti gambar
                            </div>
                        @endif
                    </div>

                   {{-- KOLOM KANAN: FORM VALIDASI --}}
                   <div class="col-md-5 p-4">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Info Transaksi</h6>
                    
                    {{-- (Info Transaksi di atas tetap sama...) --}}
                    <div class="mb-2">
                        <small class="text-muted d-block">Pengirim:</small>
                        <span class="fw-bold">{{ $trx->calonMahasiswa->nama_lengkap ?? 'Data Terhapus' }}</span>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted d-block">Program Studi:</small>
                        <div class="fw-bold text-dark">
                            {{ $trx->calonMahasiswa->prodi->nama_prodi ?? '-' }} 
                        </div>
                    </div>
                    <div class="mb-2">
                        <small class="text-muted d-block">Nominal Tagihan:</small>
                        <span class="fw-bold text-success fs-5">
                            Rp {{ number_format($trx->jumlah_bayar, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="mb-4">
                        <small class="text-muted d-block">Status Saat Ini:</small>
                        @if($trx->status == 'lunas')
                            <span class="badge bg-success w-100 py-2">LUNAS</span>
                        @elseif($trx->status == 'ditolak')
                            <span class="badge bg-danger w-100 py-2">DITOLAK</span>
                        @else
                            <span class="badge bg-warning text-dark w-100 py-2">PENDING</span>
                        @endif
                    </div>

                    <hr>

                    {{-- LOGIKA TOMBOL AKSI (DIUBAH AGAR SELALU MUNCUL) --}}
                    
                    {{-- 1. TOMBOL SET LUNAS (Muncul jika status BUKAN Lunas) --}}
                    @if($trx->status != 'lunas')
                        <form action="{{ route('admin.pembayaran.update', $trx->id) }}" method="POST" class="mb-2" onsubmit="return confirm('Verifikasi pembayaran ini sebagai LUNAS?')">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="lunas">
                            <button type="submit" class="btn btn-success w-100 fw-bold py-2">
                                <i class="fas fa-check-circle me-2"></i> Set Status LUNAS
                            </button>
                        </form>
                    @endif

                    {{-- 2. TOMBOL TOLAK/BATALKAN (Muncul jika status BUKAN Ditolak) --}}
                    @if($trx->status != 'ditolak')
                        <button class="btn btn-outline-danger w-100 fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#formTolak{{ $trx->id }}">
                            <i class="fas fa-times-circle me-2"></i> 
                            {{ $trx->status == 'lunas' ? 'Batalkan / Tolak' : 'Tolak Pembayaran' }}
                        </button>

                        <div class="collapse mt-3" id="formTolak{{ $trx->id }}">
                            <div class="card card-body bg-light border-0">
                                <form action="{{ route('admin.pembayaran.update', $trx->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    
                                    <label class="small fw-bold mb-1">Alasan Penolakan / Pembatalan:</label>
                                    <textarea name="keterangan_admin" class="form-control mb-2" rows="2" placeholder="Contoh: Bukti salah / Salah transfer" required></textarea>
                                    
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        Konfirmasi Penolakan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    {{-- 3. TOMBOL TUTUP --}}
                    <button type="button" class="btn btn-secondary w-100 mt-3" data-bs-dismiss="modal">Tutup</button>

                </div>

                        <hr>

                        

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>