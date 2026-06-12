<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | SIMASLAB</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    
    <style>
        /* Sama seperti layout Kepala Lab, ganti warna dan menu sesuai Calon Aslab */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        :root {
            --primary-50: #EFF6FF;
            --primary-500: #3B82F6;
            --primary-600: #2563EB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-700: #374151;
            --bg-primary: #F5F7FA;
            --bg-secondary: #FFFFFF;
            --bg-card: #FFFFFF;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
            --sidebar-bg: #FFFFFF;
            --topbar-bg: #FFFFFF;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 72px;
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
        }

        [data-theme="dark"] {
            --primary-500: #3B82F6;
            --primary-600: #60A5FA;
            --gray-100: #374151;
            --gray-200: #4B5563;
            --gray-400: #9CA3AF;
            --gray-500: #D1D5DB;
            --gray-700: #F3F4F6;
            --bg-primary: #0F172A;
            --bg-secondary: #1E293B;
            --bg-card: #1E293B;
            --text-primary: #F3F4F6;
            --text-secondary: #9CA3AF;
            --border-color: #334155;
            --sidebar-bg: #1E293B;
            --topbar-bg: #1E293B;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.5;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Sidebar (sama seperti Kepala Lab) */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100%;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .sidebar::-webkit-scrollbar { display: none; }
        .sidebar.collapsed { width: var(--sidebar-collapsed-width); }

        .logo-area {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
            flex-shrink: 0;
        }
        .sidebar.collapsed .logo-area { padding: 24px 12px; }
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #1E3A5F, #1A56DB);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .logo-text h2 {
            font-size: 18px;
            font-weight: 800;
            white-space: nowrap;
        }
        .logo-text h2 .sima { color: var(--text-primary); }
        .logo-text h2 .aslab {
            background: linear-gradient(135deg, #FFD700, #FFA500, #FF8C00);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .logo-text p {
            font-size: 10px;
            color: var(--text-secondary);
            white-space: nowrap;
        }
        .sidebar.collapsed .logo-text { display: none; }

        .nav-menu {
            flex: 1;
            padding: 0 12px;
        }
        .nav-section {
            margin-bottom: 20px;
        }
        .nav-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-secondary);
            padding: 0 12px;
            margin-bottom: 8px;
        }
        .sidebar.collapsed .nav-label { display: none; }
        .nav-item { margin-bottom: 2px; }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 10px;
        }
        .sidebar.collapsed .nav-link span { display: none; }
        .nav-link i {
            width: 20px;
            font-size: 18px;
        }
        .nav-link:hover {
            background: var(--gray-100);
            color: var(--primary-600);
        }
        .nav-link.active {
            background: var(--primary-50);
            color: var(--primary-600);
        }
        .nav-badge {
            margin-left: auto;
            background: #FEE2E2;
            color: #DC2626;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 11px;
        }
        .sidebar.collapsed .nav-badge { display: none; }

        /* Tombol Floating Collapse */
        .sidebar-toggle-float {
            position: absolute;
            bottom: 24px;
            right: -14px;
            width: 28px;
            height: 28px;
            background: var(--primary-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            z-index: 101;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            border: 2px solid var(--bg-primary);
        }
        .sidebar-toggle-float:hover {
            background: var(--primary-600);
            transform: scale(1.15);
        }
        .sidebar.collapsed .sidebar-toggle-float i {
            transform: rotate(180deg);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: margin-left 0.3s;
        }
        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Top Bar & Components (sama seperti Kepala Lab) */
        .top-bar {
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .menu-toggle {
            display: none;
            font-size: 20px;
            cursor: pointer;
            width: 36px;
            height: 36px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: var(--gray-100);
        }
        .page-title h1 {
            font-size: 20px;
            font-weight: 700;
        }
        .page-title p {
            font-size: 12px;
            color: var(--text-secondary);
        }
        .top-bar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-input {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--gray-100);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 8px 14px;
        }
        .search-input input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 13px;
            width: 180px;
        }
        .dark-mode-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--gray-100);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .dark-mode-btn .light-icon { display: inline-block; }
        .dark-mode-btn .dark-icon { display: none; }
        [data-theme="dark"] .dark-mode-btn .light-icon { display: none; }
        [data-theme="dark"] .dark-mode-btn .dark-icon { display: inline-block; }
        .notification-btn {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--gray-100);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--danger);
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 20px;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 12px;
            cursor: pointer;
            background: var(--gray-100);
            border: 1px solid var(--border-color);
            position: relative;
        }
        .user-avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 13px;
        }
        .user-info .name {
            font-size: 13px;
            font-weight: 600;
        }
        .user-info .role {
            font-size: 10px;
            color: var(--text-secondary);
        }
        .dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 8px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            min-width: 200px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s;
            z-index: 100;
        }
        .user-menu:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 13px;
        }
        .dropdown-item:hover {
            background: var(--gray-100);
            color: var(--primary-600);
        }
        .dropdown-divider {
            height: 1px;
            background: var(--border-color);
            margin: 4px 0;
        }

        .content-area {
            padding: 24px;
        }
        .welcome-banner {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: 20px;
            padding: 28px 32px;
            margin-bottom: 32px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .welcome-banner h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .status-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }
        .status-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
        }
        .status-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-50);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .status-icon i {
            font-size: 28px;
            color: var(--primary-600);
        }
        .status-value {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-badge.pending {
            background: #FEF3C7;
            color: #D97706;
        }
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .card-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
        }
        .card-title {
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .card-body {
            padding: 20px;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-primary {
            background: var(--primary-500);
            color: white;
        }
        .footer {
            background: var(--topbar-bg);
            border-top: 1px solid var(--border-color);
            padding: 16px 24px;
            text-align: center;
            font-size: 11px;
            color: var(--text-secondary);
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
            }
            .sidebar.open { transform: translateX(0); }
            .main-content, .main-content.expanded { margin-left: 0; }
            .menu-toggle { display: flex; }
            .status-grid { grid-template-columns: 1fr; }
            .search-input input { width: 100px; }
            .user-info { display: none; }
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .sidebar-overlay.active { display: block; }
        .fade-in { animation: fadeInUp 0.3s ease; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="logo-area">
            <div class="logo">
                <div class="logo-icon">
                    <img src="{{ asset('build/assets/images/logo-umi.png') }}" alt="Logo UMI">
                </div>
                <div class="logo-text">
                    <h2><span class="sima">SIM</span><span class="aslab">ASLAB</span></h2>
                    <p>Universitas Methodist Indonesia</p>
                </div>
            </div>
        </div>

        <div class="nav-menu">
            <div class="nav-section">
                <div class="nav-label">Main Menu</div>
                <div class="nav-item"><a href="#" class="nav-link active"><i class="fas fa-home"></i><span>Dashboard</span></a></div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-file-alt"></i><span>Form Pendaftaran</span></a></div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-chart-line"></i><span>Status Seleksi</span></a></div>
            </div>
            <div class="nav-section">
                <div class="nav-label">Informasi</div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-calendar"></i><span>Jadwal Ujian</span></a></div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-trophy"></i><span>Hasil Seleksi</span></a></div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-question-circle"></i><span>Panduan</span></a></div>
            </div>
            <div class="nav-section">
                <div class="nav-label">Akun</div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-user"></i><span>Profil Saya</span></a></div>
                <div class="nav-item"><a href="#" class="nav-link"><i class="fas fa-lock"></i><span>Ubah Password</span></a></div>
            </div>
        </div>

        <div class="sidebar-toggle-float" id="sidebarToggle">
            <i class="fas fa-chevron-left" id="collapseIcon"></i>
        </div>
    </div>

    <div class="main-content" id="mainContent">
        <div class="top-bar">
            <div class="top-bar-left">
                <div class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></div>
                <div class="page-title">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-description', 'Selamat datang, Calon Asisten Laboratorium')</p>
                </div>
            </div>
            <div class="top-bar-right">
                <div class="search-input"><i class="fas fa-search"></i><input type="text" placeholder="Cari..."></div>
                <div class="dark-mode-btn" id="themeToggle"><i class="fas fa-sun light-icon"></i><i class="fas fa-moon dark-icon"></i></div>
                <div class="notification-btn"><i class="far fa-bell"></i><span class="notification-badge">2</span></div>
                <div class="user-menu">
                    <div class="user-avatar">CA</div>
                    <div class="user-info"><div class="name">Calon Aslab</div><div class="role">Calon Asisten</div></div>
                    <i class="fas fa-chevron-down" style="font-size: 10px;"></i>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item"><i class="fas fa-user"></i><span>Profile</span></a>
                        <a href="#" class="dropdown-item"><i class="fas fa-lock"></i><span>Ubah Password</span></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-area fade-in">
            @yield('content')
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} SIMASLAB - Sistem Informasi Manajemen Seleksi Asisten Laboratorium</p>
            <p>Universitas Methodist Indonesia | Powered by AHP</p>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const collapseIcon = document.getElementById('collapseIcon');
        const menuToggle = document.getElementById('menuToggle');
        const overlay = document.getElementById('sidebarOverlay');
        const themeToggle = document.getElementById('themeToggle');
        
        const isCollapsed = localStorage.getItem('sidebarCollapsedCalon') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
            collapseIcon.classList.remove('fa-chevron-left');
            collapseIcon.classList.add('fa-chevron-right');
        }
        
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            const collapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('sidebarCollapsedCalon', collapsed);
            if (collapsed) {
                collapseIcon.classList.remove('fa-chevron-left');
                collapseIcon.classList.add('fa-chevron-right');
            } else {
                collapseIcon.classList.remove('fa-chevron-right');
                collapseIcon.classList.add('fa-chevron-left');
            }
        });
        
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
        themeToggle.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
        
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    </script>
    @stack('scripts')
</body>
</html>