<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJIPay - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            min-height: 500px;
        }
        
        .login-left {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
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
        
        .form-control {
            border: none;
            border-bottom: 2px solid #e0e0e0;
            border-radius: 0;
            background: transparent;
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-bottom-color: #dc3545;
            background: rgba(220, 53, 69, 0.05);
        }
        
                .btn-login {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 50px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 53, 69, 0.3);
        }
        
        /* Simplified form styling for better functionality */
        .form-control {
            background-color: #fff !important;
            border: 2px solid #e9ecef !important;
            border-radius: 10px !important;
            height: 60px !important;
            font-size: 16px !important;
            padding: 20px 15px 5px 15px !important;
            transition: all 0.3s ease !important;
            position: relative !important;
            z-index: 10 !important;
        }
        
        .form-control:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            background-color: #fff !important;
        }
        
        .form-floating > label {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            height: 100% !important;
            padding: 20px 15px !important;
            pointer-events: none !important;
            border: 1px solid transparent !important;
            transform-origin: 0 0 !important;
            transition: all 0.1s ease-in-out !important;
            color: #6c757d !important;
            z-index: 5 !important;
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            opacity: 0.65 !important;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem) !important;
            color: #dc3545 !important;
            background-color: #fff !important;
            padding: 2px 5px !important;
        }
        
        .form-floating {
            position: relative;
            margin-bottom: 2rem;
            z-index: 10;
        }
        
        .form-floating .form-control {
            background-color: #fff;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            height: 60px;
            font-size: 16px;
            transition: all 0.3s ease;
            z-index: 2;
            position: relative;
        }
        
        .form-floating .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
            background-color: #fff;
        }
        
        .form-floating label {
            color: #6c757d;
            transition: all 0.3s ease;
            z-index: 1;
            background-color: transparent;
            padding: 0 5px;
        }
        
        .form-floating .form-control:focus ~ label,
        .form-floating .form-control:not(:placeholder-shown) ~ label {
            color: #dc3545;
            transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
            background-color: #fff;
        }
        
        .demo-cards {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-top: 30px;
            backdrop-filter: blur(5px);
        }
        
        .demo-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px;
            margin: 5px 0;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            outline: none;
        }
        
        .demo-card:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
        }
        
        /* Remove all overlay elements that might interfere */
        .form-floating {
            position: relative;
            margin-bottom: 2rem;
        }
        
        /* Ensure all interactive elements are accessible */
        input, button, .demo-card {
            pointer-events: auto !important;
            user-select: auto !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="login-container row g-0">
                    <!-- Left Side -->
                    <div class="col-md-6 login-left">
                        <div>
                            <div class="brand-logo">
                                <i class="fas fa-money-check-alt"></i>
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
                    </div>        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .floating-elements i {
            position: absolute;
            animation: float-around 10s infinite linear;
            opacity: 0.1;
        }
        
        @keyframes float-around {
            0% { transform: translateY(100vh) rotate(0deg); }
            100% { transform: translateY(-100px) rotate(360deg); }
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            animation: slideIn 0.5s ease;
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <i class="fas fa-coins" style="left: 10%; animation-delay: 0s; font-size: 2rem;"></i>
        <i class="fas fa-chart-line" style="left: 20%; animation-delay: 2s; font-size: 1.5rem;"></i>
        <i class="fas fa-users" style="left: 30%; animation-delay: 4s; font-size: 2.5rem;"></i>
        <i class="fas fa-briefcase" style="left: 40%; animation-delay: 6s; font-size: 1.8rem;"></i>
        <i class="fas fa-clock" style="left: 50%; animation-delay: 8s; font-size: 2rem;"></i>
        <i class="fas fa-money-bill" style="left: 60%; animation-delay: 1s; font-size: 1.5rem;"></i>
        <i class="fas fa-building" style="left: 70%; animation-delay: 3s; font-size: 2.2rem;"></i>
        <i class="fas fa-handshake" style="left: 80%; animation-delay: 5s; font-size: 1.8rem;"></i>
        <i class="fas fa-award" style="left: 90%; animation-delay: 7s; font-size: 2rem;"></i>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="login-container row g-0">
                    <!-- Left Side -->
                    <div class="col-md-6 login-left">
                        <div class="position-relative z-3">
                            <div class="brand-logo">
                                <i class="fas fa-money-check-alt"></i>
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
                    <div class="col-md-6 p-5">
                        <div class="h-100 d-flex flex-column justify-content-center">
                            <h3 class="text-center mb-4 fw-bold text-dark">
                                <i class="fas fa-sign-in-alt text-danger me-2"></i>Login
                            </h3>
                            
                            <!-- Session Status -->
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
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
                                    <button type="submit" class="btn btn-danger btn-login text-white">
                                        <i class="fas fa-sign-in-alt me-2"></i>Log in
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fillLogin(email, password) {
            // Clear first
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            
            // Set values
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            
            // Focus to trigger floating label
            document.getElementById('email').focus();
            document.getElementById('password').focus();
            document.getElementById('email').blur();
            
            // Visual feedback
            document.getElementById('email').style.borderColor = '#28a745';
            document.getElementById('password').style.borderColor = '#28a745';
            
            setTimeout(() => {
                document.getElementById('email').style.borderColor = '#dc3545';
                document.getElementById('password').style.borderColor = '#dc3545';
            }, 1000);
        }
        
        // Add loading animation on form submit
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-login');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Logging in...';
            btn.disabled = true;
        });
        
        // Test inputs when page loads
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            // Test if inputs are accessible
            emailInput.addEventListener('click', function() {
                console.log('Email clicked');
                this.focus();
            });
            
            passwordInput.addEventListener('click', function() {
                console.log('Password clicked');
                this.focus();
            });
        });
    </script>
</body>
</html>
