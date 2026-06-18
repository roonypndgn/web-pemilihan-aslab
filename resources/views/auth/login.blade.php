<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | SIMASLAB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-500: #3B82F6;
            --primary-600: #2563EB;
            --primary-700: #1D4ED8;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --bg-primary: #F8FAFC;
            --bg-secondary: #FFFFFF;
            --text-primary: #0F172A;
            --text-secondary: #64748B;
            --border-color: #E2E8F0;
            --success: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
        }

        [data-theme="dark"] {
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --text-primary: #F1F5F9;
            --text-secondary: #94A3B8;
            --border-color: #334155;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
        }
        .login-container {
            max-width: 420px;
            width: 100%;
            background: var(--bg-secondary);
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
            position: relative;
            z-index: 1;
            transition: all 0.3s ease;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-text h2 {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-primary);
        }

        .logo-text h2 .sima {
            color: var(--text-primary);
        }

        .logo-text h2 .aslab {
            background: linear-gradient(135deg, #FFD700, #FFA500, #FF8C00);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .logo-subtitle {
            font-size: 13px;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            border: 1px solid;
        }

        .alert-danger {
            background: #FEF2F2;
            border-color: #FECACA;
            color: #991B1B;
        }

        .alert-success {
            background: #F0FDF4;
            border-color: #BBF7D0;
            color: #065F46;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.08);
        }

        .input-group input::placeholder {
            color: var(--text-secondary);
            font-weight: 400;
        }

        .input-group .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 16px;
        }

        .input-group .toggle-password:hover {
            color: var(--text-primary);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .checkbox input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--primary-500);
        }

        .forgot-link {
            font-size: 13px;
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: var(--primary-500);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--primary-500);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-login:hover {
            background: var(--primary-600);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            gap: 16px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        .divider span {
            font-size: 12px;
            color: var(--text-secondary);
            white-space: nowrap;
        }

        .btn-social {
            width: 100%;
            padding: 11px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-family: 'Inter', sans-serif;
        }

        .btn-social:hover {
            background: var(--gray-50);
            border-color: var(--gray-300);
        }

        .btn-social i {
            font-size: 18px;
        }

        .btn-social .google-icon {
            color: #EA4335;
        }

        .btn-social .apple-icon {
            color: var(--text-primary);
        }

        .register-link {
            text-align: center;
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 4px;
        }

        .register-link a {
            color: var(--primary-500);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .login-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            font-size: 11px;
            color: var(--text-secondary);
        }

        .login-footer .footer-links {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .login-footer .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 11px;
        }

        .login-footer .footer-links a:hover {
            color: var(--primary-500);
            text-decoration: underline;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            color: var(--text-secondary);
        }

        .theme-toggle:hover {
            transform: scale(1.05);
            border-color: var(--gray-300);
        }

        .theme-toggle .light-icon { display: inline-block; }
        .theme-toggle .dark-icon { display: none; }
        [data-theme="dark"] .theme-toggle .light-icon { display: none; }
        [data-theme="dark"] .theme-toggle .dark-icon { display: inline-block; }

        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
            }
            
            .logo-text h2 {
                font-size: 20px;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            animation: fadeInUp 0.4s ease;
        }
    </style>
</head>
<body>
    <div class="theme-toggle" id="themeToggle">
        <i class="fas fa-sun light-icon"></i>
        <i class="fas fa-moon dark-icon"></i>
    </div>

    <div class="login-container">
        <!-- Logo -->
        <div class="logo-section">
            <div class="logo-wrapper">
                <div class="logo-icon">
                    <img src="{{ asset('build/assets/images/logo-umi.png') }}" alt="Logo UMI">
                </div>
                <div class="logo-text">
                    <h2>
                        <span class="sima">SIM</span><span class="aslab">ASLAB</span>
                    </h2>
                </div>
            </div>
            <p class="logo-subtitle">Universitas Methodist Indonesia</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                    <span style="font-size: 12px; color: var(--danger); margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                </div>
                @error('password')
                    <span style="font-size: 12px; color: var(--danger); margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="checkbox">
                    <input type="checkbox" name="remember">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="forgot-link">Lupa password?</a>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="register-link">
            Belum punya akun? <a href="{{route('register')}}">Daftar sebagai Calon Aslab</a>
        </div>

        <div class="login-footer">
            <div class="footer-links">
                <a href="#">Terms of Use</a>
                <span>·</span>
                <a href="#">Privacy Policy</a>
                <span>·</span>
                <a href="#">Contact Us</a>
            </div>
            <span>© {{ date('Y') }} SIMASLAB · Universitas Methodist Indonesia</span>
        </div>
    </div>

    <script>
        const themeToggle = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        
        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    </script>
</body>
</html>