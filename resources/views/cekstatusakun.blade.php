<!DOCTYPE html>
<html>
<head>
    <title>Status Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card text-center">
            <div class="card-header bg-success text-white">
                Pendaftaran Berhasil
            </div>
            <div class="card-body">
                <h5 class="card-title">Halo, {{ Auth::user()->name }}!</h5>
                <p class="card-text">Akun Anda telah berhasil dibuat.</p>
                <hr>
                <p>Status Pendaftaran Anda saat ini:</p>
                <button class="btn btn-warning">Menunggu Verifikasi Admin</button>
            </div>
        </div>
    </div>
</body>
</html>