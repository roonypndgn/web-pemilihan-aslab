<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | SIMASLAB</title>
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
            padding: 32px 16px;
            color: var(--text-primary);
            line-height: 1.5;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .register-container {
            max-width: 540px;
            width: 100%;
            background: var(--bg-secondary);
            border-radius: 24px;
            padding: 44px 40px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            animation: fadeInUp 0.4s ease;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 4px;
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

        .register-title {
            text-align: center;
            margin-top: 18px;
        }

        .register-title h1 {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .register-title p {
            font-size: 14px;
            color: var(--text-secondary);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
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

        .alert i {
            margin-top: 2px;
            flex-shrink: 0;
        }

        .alert ul {
            margin: 4px 0 0 16px;
            font-size: 12px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .form-label .required {
            color: var(--danger);
            margin-left: 2px;
        }

        .form-label .optional {
            color: var(--text-secondary);
            font-weight: 400;
            font-size: 11px;
        }

        .input-group {
            position: relative;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 11px 16px;
            font-size: 14px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            appearance: none;
        }

        .input-group select {
            cursor: pointer;
            padding-right: 40px;
        }

        .input-group .select-arrow {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            font-size: 12px;
        }

        .input-group input:focus,
        .input-group select:focus {
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
            transition: color 0.2s;
        }

        .input-group .toggle-password:hover {
            color: var(--text-primary);
        }

        .error-message {
            font-size: 12px;
            color: var(--danger);
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            padding-top: 2px;
        }

        .radio-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-secondary);
            transition: color 0.2s;
        }

        .radio-label input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--primary-500);
        }

        .radio-label:has(input:checked) {
            color: var(--text-primary);
        }

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin: 20px 0 24px;
        }

        .terms input {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: var(--primary-500);
            margin-top: 2px;
            flex-shrink: 0;
        }

        .terms label {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.5;
        }

        .terms a {
            color: var(--primary-500);
            text-decoration: none;
            font-weight: 500;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .btn-register {
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

        .btn-register:hover {
            background: var(--primary-600);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-register:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
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

        .login-link {
            text-align: center;
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 18px;
        }

        .login-link a {
            color: var(--primary-500);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .register-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .register-footer .footer-links {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .register-footer .footer-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 11px;
            transition: color 0.2s;
        }

        .register-footer .footer-links a:hover {
            color: var(--primary-500);
            text-decoration: underline;
        }

        .register-footer .footer-links span {
            color: var(--text-secondary);
        }

        .register-footer .copyright {
            font-size: 11px;
            color: var(--text-secondary);
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

        @media (max-width: 600px) {
            .register-container {
                padding: 32px 24px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .register-title h1 {
                font-size: 20px;
            }

            .logo-text h2 {
                font-size: 20px;
            }

            .radio-group {
                flex-direction: column;
                gap: 6px;
            }
        }

        @media (max-width: 400px) {
            .register-container {
                padding: 24px 16px;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
            }

            .logo-text h2 {
                font-size: 18px;
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
    </style>
</head>
<body>
    <div class="theme-toggle" id="themeToggle">
        <i class="fas fa-sun light-icon"></i>
        <i class="fas fa-moon dark-icon"></i>
    </div>

    <div class="register-container">
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

            <div class="register-title">
                <h1>Daftar Calon Aslab</h1>
                <p>Lengkapi data diri untuk mendaftar</p>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Mohon perbaiki:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="hidden" name="role" value="calon_aslab">

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="required">*</span></label>
                    <div class="input-group">
                        <input type="text" name="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                    </div>
                    @error('nama')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">NPM <span class="required">*</span></label>
                    <div class="input-group">
                        <input type="text" name="npm" placeholder="Masukkan NPM" value="{{ old('npm') }}" required>
                    </div>
                    @error('npm')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <div class="input-group">
                        <input type="email" name="email" placeholder="contoh@student.methodist.ac.id" value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">WhatsApp <span class="optional">(opsional)</span></label>
                    <div class="input-group">
                        <input type="text" name="nomor_hp" placeholder="081234567890" value="{{ old('nomor_hp') }}">
                    </div>
                    @error('nomor_hp')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Program Studi <span class="required">*</span></label>
                    <div class="input-group">
                        <select name="program_studi" required>
                            <option value="">Pilih Program Studi</option>
                            <option value="Informatika" {{ old('program_studi') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                            <option value="Sistem Informasi" {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                            <option value="Teknik Komputer" {{ old('program_studi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                    @error('program_studi')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Angkatan <span class="required">*</span></label>
                    <div class="input-group">
                        <select name="angkatan" required>
                            <option value="">Pilih Tahun</option>
                            @for($year = 2020; $year <= date('Y'); $year++)
                                <option value="{{ $year }}" {{ old('angkatan') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </div>
                    @error('angkatan')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                <div class="radio-group">
                    <label class="radio-label">
                        <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                        Laki-laki
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                        Perempuan
                    </label>
                </div>
                @error('jenis_kelamin')
                    <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Password <span class="required">*</span></label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" placeholder="Minimal 8 karakter" required>
                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <div class="error-message"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Konfirmasi Password <span class="required">*</span></label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="passwordConfirmation" placeholder="Ulangi password" required>
                        <i class="fas fa-eye toggle-password" id="togglePasswordConfirm"></i>
                    </div>
                </div>
            </div>

            <div class="terms">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">
                    Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a>
                </label>
            </div>

            <button type="submit" class="btn-register">Daftar</button>

            <div class="login-link">
                Sudah punya akun? <a href="{{route('login')}}">Login</a>
            </div>
        </form>

        <div class="register-footer">
            <div class="footer-links">
                <a href="#">Terms of Use</a>
                <span>·</span>
                <a href="#">Privacy Policy</a>
                <span>·</span>
                <a href="#">Contact Us</a>
            </div>
            <div class="copyright">© {{ date('Y') }} SIMASLAB · Universitas Methodist Indonesia</div>
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
        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirmInput = document.getElementById('passwordConfirmation');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
        
        if (togglePasswordConfirm) {
            togglePasswordConfirm.addEventListener('click', function() {
                const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirmInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }

        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('passwordConfirmation');
            
            if (password.value !== passwordConfirm.value) {
                e.preventDefault();
                passwordConfirm.style.borderColor = '#EF4444';
                passwordConfirm.style.boxShadow = '0 0 0 4px rgba(239, 68, 68, 0.1)';
                alert('Password dan konfirmasi password tidak sama!');
                passwordConfirm.focus();
            }
        });

        document.getElementById('passwordConfirmation').addEventListener('focus', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
        });
    </script>
</body>
</html>