<!DOCTYPE html>
<html>
<head>
    <title>Status Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tampilan.css') }}">
</head>

<body class="bg-light body1">
    <div class="container mt-5">
        <div class="card status-card mx-auto" style="max-width: 550px;">
            <div class="card-header header-success text-white">
                <i class="fas fa-check-circle status-icon"></i>
                <h4 class="mb-0">Pendaftaran Berhasil Dibuat</h4>
            </div>

            <div class="card-body p-4">
                <h5 class="card-title fw-bold mb-3">Halo, {{ Auth::user()->name }}!</h5>
                <p class="card-text text-muted">Akun Anda telah berhasil didaftarkan ke sistem kami. Terima kasih!</p>
                
                <hr class="my-4">
                
                <div class="progress-container">
                    <p class="mb-2 text-start fw-bold">Tahap Pendaftaran Saat Ini (Tahap 1 dari 3):</p>
                    
                    <div class="progress" style="height: 18px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 33%" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">33%</div>
                    </div>
                    
                    <div class="text-center mt-3">
                         <span class="status-badge bg-warning text-dark">
                            <i class="fas fa-clock me-2"></i> Menunggu Verifikasi Admin
                        </span>
                    </div>
                </div>
                
                <div class="alert alert-info mt-4" role="alert">
                    Admin sedang memproses data Anda. Anda akan menerima notifikasi melalui email setelah status berubah.
                </div>

                <div class="d-grid gap-2">
                    <a href="{{ url('/profil') }}" class="btn btn-outline-primary btn-sm mt-2">
                        <i class="fas fa-clipboard-list me-2"></i> Lihat Detail Profil Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>