<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJIPay - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #dc3545;
            --primary-dark: #c82333;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            margin: 0 auto;
        }
        
        .login-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 500px;
        }
        
        .login-right {
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 500px;
        }
        
        .brand-logo {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .demo-cards {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            backdrop-filter: blur(5px);
            width: 100%;
        }
        
        .demo-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px;
            margin: 5px 0;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            width: 100%;
            text-align: left;
        }
        
        .demo-card:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
            height: 60px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            height: 60px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
            color: white;
        }
        
        .form-floating > label {
            color: #6c757d;
            padding: 1rem 0.75rem;
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary-color);
        }
        
        @media (max-width: 768px) {
            .login-left, .login-right {
                min-height: auto;
                padding: 2rem 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="login-container">
            <div class="row g-0 h-100">
                <!-- Left Side -->
                <div class="col-md-6">
                    <div class="login-left">
                        <div class="brand-logo">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Welcome to DJIPay</h2>
                        <p class="mb-4">Sistem Kepegawaian & Penggajian Modern</p>
                        
                        <div class="demo-cards">
                            <h6 class="fw-bold mb-3">Demo Accounts:</h6>
                            <div class="demo-card" onclick="fillLogin('gm@djipay.com', 'password')">
                                <i class="fas fa-crown me-2"></i>
                                <strong>General Manager</strong><br>
                                <small>gm@djipay.com</small>
                            </div>
                            <div class="demo-card" onclick="fillLogin('akuntansi@djipay.com', 'password')">
                                <i class="fas fa-calculator me-2"></i>
                                <strong>Akuntansi</strong><br>
                                <small>akuntansi@djipay.com</small>
                            </div>
                            <div class="demo-card" onclick="fillLogin('karyawan@djipay.com', 'password')">
                                <i class="fas fa-user me-2"></i>
                                <strong>Karyawan</strong><br>
                                <small>karyawan@djipay.com</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Side -->
                <div class="col-md-6">
                    <div class="login-right">
                        <h3 class="text-center mb-4 fw-bold text-dark">
                            <i class="fas fa-sign-in-alt text-danger me-2"></i>Login
                        </h3>
                        
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf
                            
                            <!-- Email Address -->
                            <div class="form-floating mb-3">
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus 
                                       autocomplete="username" 
                                       placeholder="Email Address">
                                <label for="email">
                                    <i class="fas fa-envelope me-2"></i>Email Address
                                </label>
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password" 
                                       class="form-control" 
                                       id="password" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password" 
                                       placeholder="Password">
                                <label for="password">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Remember Me -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label" for="remember_me">
                                    Remember me
                                </label>
                            </div>
                            
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-login">
                                    <i class="fas fa-sign-in-alt me-2"></i>LOG IN
                                </button>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <div class="text-center">
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-danger">
                                        <i class="fas fa-key me-1"></i>Forgot your password?
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fillLogin(email, password) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            
            // Trigger focus to activate floating labels
            document.getElementById('email').focus();
            document.getElementById('password').focus();
            document.getElementById('email').blur();
            
            // Visual feedback
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            emailInput.style.borderColor = '#28a745';
            passwordInput.style.borderColor = '#28a745';
            
            setTimeout(() => {
                emailInput.style.borderColor = '#dc3545';
                passwordInput.style.borderColor = '#dc3545';
            }, 1000);
        }
        
        // Add loading animation on form submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-login');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Logging in...';
            btn.disabled = true;
        });
    </script>
</body>
</html>