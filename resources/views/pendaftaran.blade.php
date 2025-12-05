<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body {
            
            background: url('https://i.pinimg.com/736x/8a/91/72/8a91724388cc059649ebf4985dfb50c2.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }

        
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(106, 17, 203, 0.7), rgba(37, 117, 252, 0.6), rgba(0, 210, 255, 0.6));
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2; 
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 500px;
            padding: 40px;
        }

        .card-title {
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
            text-transform: uppercase;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            padding: 10px 5px;
            background: transparent;
        }

        .form-control:focus {
            box-shadow: none;
            border-bottom: 2px solid #57b846;
        }

        
        .input-group-text {
            background: transparent;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0;
            cursor: pointer;
        }

       
        .btn-signup {
            width: 100%;
            border-radius: 25px;
            padding: 12px;
            font-weight: bold;
            color: white;
            border: none;
           
            background: linear-gradient(to right, #91a7ff, #72f7d6);
            margin-top: 20px;
            transition: 0.3s;
        }

        .btn-signup:hover {
            background: linear-gradient(to right, #72f7d6, #91a7ff);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

       
        .form-check-label a {
            color: #333;
            text-decoration: underline;
        }

       
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #666;
        }
        
        .login-link a {
            color: #333;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="container">
        <div class="card">
            <h2 class="card-title">Create Account</h2>
            
            <form action="{{ url('/pendaftaran') }}" method="POST">
                @csrf <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>

                <div class="mb-3 input-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <span class="input-group-text" onclick="togglePassword('password')">
                        <i class="fa fa-eye-slash"></i>
                    </span>
                </div>

                <div class="mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat your password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" required>
                    <label class="form-check-label" for="terms" style="font-size: 13px;">
                        I agree all statements in <a href="#">Terms of service</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-signup">SIGN UP</button>

                <div class="login-link">
                    Have already an account? <a href="{{ url('/login') }}">Login here</a>
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