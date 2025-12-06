<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tampilan.css') }}">
    
    <!-- <style>
        body {
            background-color: #f0f2f5; 
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            max-width: 400px;
            padding: 30px;
            border-radius: 15px; 
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15); 
            border: none;
        }
        .card-title {
            color: #007bff; 
            font-weight: 700;
        }
        .input-group-text {
            background-color: #f8f9fa;
            color: #6c757d;
        }
        .btn-login {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style> -->
</head>
<body class="body">
    <div class="overlay"></div>
    <div class="container ">
        <div class="card login-card mx-auto">
            
            <h2 class="card-title text-center mb-4">
                <i class="fas fa-user-lock me-2"></i> Login Akun
            </h2>
            <p class="text-center text-muted mb-4">Masukkan kredensial pendaftaran Anda.</p>

            <form method="POST" action="{{ url('/login') }}">
                @csrf 

                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Alamat Email" required autofocus>
                    
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Password" required>
                    
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-lg btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> LOGIN
                    </button>
                </div>

                <div class="text-center mt-3">
                    Belum punya akun? <a href="{{ url('/pendaftaran') }}">Daftar di sini</a>
                </div>
            </form>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>