<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pendaftaran Akun</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow p-4" style="width: 450px; border-radius: 14px;">
            
            <h3 class="text-center mb-4">Daftar Akun</h3>

            <form>

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" placeholder="Masukkan email">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" placeholder="Masukkan kata sandi">
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" placeholder="Masukkan ulang kata sandi">
                </div>

                <button type="button" class="btn btn-primary w-100">Daftar</button>

                <p class="text-center mt-3">
                    Sudah punya akun?
                    <a href="#">Masuk</a>
                </p>

            </form>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
