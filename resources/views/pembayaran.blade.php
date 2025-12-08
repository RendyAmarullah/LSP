<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> 
</head>
<body class="bg-light">

<div class="d-flex">
    
    {{-- SIDEBAR (Sama seperti sebelumnya) --}}
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
                <a class="nav-link nav-link-custom" href="{{ url('/profile') }}">
                    <i class="fas fa-address-card me-2"></i> Data Profil
                </a>
            </li>
            {{-- MENU AKTIF --}}
            <li class="nav-item">
                <a class="nav-link nav-link-custom active" href="{{ url('/pembayaran') }}">
                    <i class="fas fa-wallet me-2"></i> Pembayaran
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
                <h1 class="display-6 fw-bold text-dark">Pembayaran</h1>
                <p class="text-muted">Selesaikan pembayaran untuk memvalidasi pendaftaran Anda.</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                
                {{-- KOLOM KIRI: INVOICE TAGIHAN --}}
                <div class="col-lg-7 mb-4">
                    <div class="card shadow border-0 h-100">
                        <div class="card-header bg-primary text-white py-3">
                            <h5 class="mb-0"><i class="fas fa-file-invoice-dollar me-2"></i> Rincian Tagihan</h5>
                        </div>
                        <div class="card-body p-4">
                            
                            <div class="text-center mb-4">
                                <p class="text-muted mb-1">Total Tagihan</p>
                                {{-- MENGAMBIL HARGA DARI RELASI PRODI --}}
                                <h1 class="fw-bold text-primary display-5">
                                    Rp {{ number_format($data->prodi->biaya_kuliah, 0, ',', '.') }}
                                </h1>
                                @if($pembayaran && $pembayaran->status == 'lunas')
                                <span class="badge bg-success text-dark px-3 py-2 mt-2">Pembayaran Selesai</span>
                                @elseif($pembayaran && $pembayaran->status == 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2 mt-2">Menunggu Pembayaran</span>
                                @endif
                            </div>

                            <hr>

                            <div class="row mb-2">
                                <div class="col-6 text-muted">Nomor Pendaftaran</div>
                                <div class="col-6 text-end fw-bold">REG-{{ str_pad($data->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 text-muted">Nama Calon Mahasiswa</div>
                                <div class="col-6 text-end fw-bold">{{ $data->nama_lengkap }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 text-muted">Program Studi</div>
                                <div class="col-6 text-end fw-bold text-primary">{{ $data->prodi->nama_prodi }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 text-muted">Jenjang</div>
                                <div class="col-6 text-end fw-bold">{{ $data->prodi->jenjang }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 text-muted">Fakultas</div>
                                <div class="col-6 text-end fw-bold">{{ $data->prodi->fakultas }}</div>
                            </div>

                            <div class="alert alert-light border mt-4">
                                <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Biaya di atas sudah termasuk biaya pendaftaran, jas almamater, dan KTM.</small>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: LOGIKA STATUS PEMBAYARAN --}}
                <div class="col-lg-5">
                    
                    {{-- KONDISI 1: PEMBAYARAN DITERIMA (LUNAS) --}}
                    @if($pembayaran && $pembayaran->status == 'lunas')
                        <div class="card shadow-sm border-0 border-start border-success border-5">
                            <div class="card-body p-5 text-center">
                                <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                                <h4 class="fw-bold text-success">Pembayaran Lunas!</h4>
                                <p class="text-muted">Terima kasih, pembayaran Anda telah diverifikasi.</p>
                                <div class="alert alert-light border">
                                    <small class="fw-bold text-dark">Kode Transaksi:</small><br>
                                    <span class="text-monospace">{{ $pembayaran->kode_transaksi }}</span>
                                </div>
                                <a href="{{ url('/jadwal-test') }}" class="btn btn-primary w-100 mt-2">
                                    <i class="fas fa-calendar-alt me-2"></i> Cek Jadwal Tes
                                </a>
                            </div>
                        </div>

                    {{-- KONDISI 2: PEMBAYARAN SEDANG DICEK (PENDING) --}}
                    @elseif($pembayaran && $pembayaran->status == 'pending')
                        <div class="card shadow-sm border-0 border-start border-warning border-5">
                            <div class="card-body p-5 text-center">
                                <i class="fas fa-clock text-warning fa-5x mb-3"></i>
                                <h4 class="fw-bold text-dark">Menunggu Verifikasi</h4>
                                <p class="text-muted">Bukti pembayaran Anda sedang diperiksa oleh admin. Mohon tunggu maksimal 1x24 jam.</p>
                                <hr>
                                <small class="text-muted">Diunggah pada: {{ \Carbon\Carbon::parse($pembayaran->tanggal)->format('d M Y H:i') }}</small>
                            </div>
                        </div>

                    {{-- KONDISI 3: BELUM BAYAR ATAU DITOLAK (TAMPILKAN FORM) --}}
                    @else
                        
                        {{-- Jika Ditolak, tampilkan alert merah --}}
                        @if($pembayaran && $pembayaran->status == 'ditolak')
                            <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <div>
                                    <strong>Pembayaran Ditolak!</strong><br>
                                    Alasan: {{ $pembayaran->keterangan_admin ?? 'Bukti tidak valid.' }} <br>
                                    Silakan upload ulang bukti yang benar.
                                </div>
                            </div>
                        @endif

                        {{-- Rekening Transfer --}}
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="mb-0 fw-bold">Metode Pembayaran (Transfer)</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/1200px-Bank_Central_Asia.svg.png" alt="BCA" style="height: 30px;" class="me-3">
                                    <div>
                                        <div class="fw-bold">Bank BCA</div>
                                        <div class="text-muted small">8830-1234-5678 (A.n Universitas X)</div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary ms-auto" onclick="navigator.clipboard.writeText('883012345678')"><i class="far fa-copy"></i></button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" style="height: 30px;" class="me-3">
                                    <div>
                                        <div class="fw-bold">Bank Mandiri</div>
                                        <div class="text-muted small">112-00-9876543-2 (A.n Universitas X)</div>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary ms-auto" onclick="navigator.clipboard.writeText('1120098765432')"><i class="far fa-copy"></i></button>
                                </div>
                            </div>
                        </div>

                        {{-- Form Upload Bukti --}}
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-white py-3">
                                <h6 class="mb-0 fw-bold">Konfirmasi Pembayaran</h6>
                            </div>
                            <div class="card-body">
                                <p class="small text-muted">Sudah melakukan transfer? Silakan unggah bukti transfer Anda di sini untuk verifikasi.</p>
                                
                                <form action="{{ route('pembayaran.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Upload Bukti (JPG/PNG/PDF)</label>
                                        <input type="file" class="form-control" name="bukti_bayar" required>
                                        @error('bukti_bayar')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success fw-bold">
                                            <i class="fas fa-upload me-2"></i> Kirim Bukti Bayar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endif

                </div>

            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>