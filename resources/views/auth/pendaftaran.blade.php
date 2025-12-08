<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tampilan.css') }}">
</head>


<body class="body">

    <div class="overlay"></div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card registration-card shadow-lg">
        <h2 class="card-title text-center mb-4">
            <i class="fas fa-graduation-cap university-icon me-2"></i> Buat Akun
        </h2>
        
        <form action="{{ url('/pendaftaran') }}" method="POST">
            @csrf 
            
            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Alamat Email Anda" required>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password (Minimal 8 Karakter)" required>
                <span class="input-group-text toggle-password" onclick="togglePassword('password')">
                    <i id="eye-icon-password" class="fas fa-eye-slash"></i>
                </span>
            </div>

            <div class="mb-3 input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
                <span class="input-group-text toggle-password" onclick="togglePassword('password_confirmation')" style="cursor: pointer;">
                    <i id="eye-icon-password_confirmation" class="fas fa-eye-slash"></i>
                </span>
            </div>

            <button type="submit" class="btn btn-primary w-100 btn-signup">DAFTAR</button>

            <div class="login-link text-center mt-3">
                Sudah punya akun? <a href="{{ url('/login') }}">Masuk di sini</a>
            </div>
        </form>
    </div>
</div>

    <script>
        function togglePassword(fieldId) {
            var input = document.getElementById(fieldId);
            var icon = input.nextElementSibling.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            }
        }
    </script>

</body>
</html>