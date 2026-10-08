<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - FourYourCatering')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            background-color: var(--cream);
            color: var(--ink);
        }
        .font-display {
            font-family: 'Archivo', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease;
            background-color: var(--ink);
            color: var(--cream);
        }
        .sidebar-collapsed {
            width: 70px;
        }
        .sidebar-expanded {
            width: 260px;
        }
        .content-expanded {
            margin-left: 260px;
        }
        .content-collapsed {
            margin-left: 70px;
        }
        
        .logo-collapsed {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .logo-text-collapsed {
            font-size: 10px;
            line-height: 1;
            text-align: center;
            margin-top: 2px;
        }

        .logo-image {
            transition: all 0.3s ease;
        }
        .logo-image-expanded {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }
        .logo-image-collapsed {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }
            .sidebar-mobile-open {
                transform: translateX(0);
                width: 260px;
            }
            .content-expanded, .content-collapsed {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-[var(--cream)] min-h-screen">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar sidebar-expanded fixed top-0 left-0 h-full shadow-xl z-40 border-r border-[#2c2c2c]">
        <!-- Logo -->
        <div class="p-5 border-b border-[#2c2c2c]">
            <!-- Expanded Logo -->
            <div id="logo-expanded" class="flex items-center space-x-3">
                <div class="flex-shrink-0 bg-white p-1 rounded">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="FourYourCatering Logo" 
                         class="logo-image logo-image-expanded">
                </div>
                <div class="flex flex-col">
                    <h1 class="font-display uppercase text-sm font-extrabold text-[var(--cream)] leading-tight tracking-tight">Four<span class="text-[var(--orange)]">Your</span>Catering</h1>
                    <p class="text-[10px] uppercase tracking-widest text-[#a8a296]">Admin Panel</p>
                </div>
            </div>
            
            <!-- Collapsed Logo -->
            <div id="logo-collapsed" class="logo-collapsed hidden">
                <div class="flex-shrink-0 bg-white p-1 rounded">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="FourYourCatering" 
                         class="logo-image logo-image-collapsed">
                </div>
                <div class="logo-text-collapsed text-[var(--cream)]">
                    <div class="font-bold text-[9px]">FYC</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-item flex items-center space-x-3 p-3 rounded text-sm font-semibold tracking-wide transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--orange)] text-white' : 'text-[#c8c2b6] hover:bg-[#2a2a2a] hover:text-white' }}">
                <i class="fas fa-tachometer-alt w-5 flex-shrink-0"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.menu.index') }}" 
               class="nav-item flex items-center space-x-3 p-3 rounded text-sm font-semibold tracking-wide transition-all {{ request()->routeIs('admin.menu.*') ? 'bg-[var(--orange)] text-white' : 'text-[#c8c2b6] hover:bg-[#2a2a2a] hover:text-white' }}">
                <i class="fas fa-utensils w-5 flex-shrink-0"></i>
                <span class="nav-text">Manajemen Menu</span>
            </a>

            <!-- Back to User View -->
            <div class="pt-4 border-t border-[#2c2c2c] mt-4">
                <a href="{{ route('home') }}" 
                   class="nav-item flex items-center space-x-3 p-3 rounded text-sm font-semibold text-[#c8c2b6] hover:bg-[var(--olive)] hover:text-white transition-all">
                    <i class="fas fa-arrow-left w-5 flex-shrink-0"></i>
                    <span class="nav-text">Kembali ke User</span>
                </a>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="pt-2">
                @csrf
                <button type="submit" 
                        class="nav-item flex items-center space-x-3 p-3 rounded text-sm font-semibold text-red-400 hover:bg-red-950/40 hover:text-red-300 transition-all w-full text-left">
                    <i class="fas fa-sign-out-alt w-5 flex-shrink-0"></i>
                    <span class="nav-text">Logout</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="content-expanded min-h-screen transition-all duration-300">
        <!-- Top Header -->
        <header class="bg-white border-b border-[var(--line)] sticky top-0 z-30">
            <div class="flex items-center justify-between p-4 lg:px-8">
                <!-- Left: Toggle Button -->
                <button id="sidebar-toggle" class="p-2 text-[var(--ink)] hover:bg-[var(--cream)] transition-all">
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <!-- Right: User Info -->
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="font-bold text-sm text-[var(--ink)] uppercase tracking-wide">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-[var(--muted)]">Administrator</p>
                    </div>
                    <div class="w-9 h-9 bg-[var(--olive)] text-white font-bold flex items-center justify-center text-sm">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6 lg:p-8 max-w-[1400px]">
            <!-- Page Title -->
            <div class="mb-8">
                <p class="eyebrow mb-1">Admin Management</p>
                <h1 class="font-display uppercase text-3xl text-[var(--ink)]">@yield('page-title', 'Dashboard')</h1>
                <p class="text-[var(--muted)] text-sm mt-1">@yield('page-description', 'Halaman administrasi FourYourCatering')</p>
            </div>

            <!-- Content -->
            @yield('content')
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const logoExpanded = document.getElementById('logo-expanded');
        const logoCollapsed = document.getElementById('logo-collapsed');
        let isCollapsed = false;

        function toggleSidebar() {
            isCollapsed = !isCollapsed;
            
            if (window.innerWidth >= 768) {
                if (isCollapsed) {
                    sidebar.classList.remove('sidebar-expanded');
                    sidebar.classList.add('sidebar-collapsed');
                    mainContent.classList.remove('content-expanded');
                    mainContent.classList.add('content-collapsed');
                    
                    logoExpanded.classList.add('hidden');
                    logoCollapsed.classList.remove('hidden');
                    
                    document.querySelectorAll('.nav-text').forEach(el => {
                        el.classList.add('hidden');
                    });
                    
                    document.querySelectorAll('.nav-item').forEach(el => {
                        el.classList.add('justify-center');
                        el.classList.remove('space-x-3');
                    });
                    
                } else {
                    sidebar.classList.remove('sidebar-collapsed');
                    sidebar.classList.add('sidebar-expanded');
                    mainContent.classList.remove('content-collapsed');
                    mainContent.classList.add('content-expanded');
                    
                    logoExpanded.classList.remove('hidden');
                    logoCollapsed.classList.add('hidden');
                    
                    document.querySelectorAll('.nav-text').forEach(el => {
                        el.classList.remove('hidden');
                    });
                    
                    document.querySelectorAll('.nav-item').forEach(el => {
                        el.classList.remove('justify-center');
                        el.classList.add('space-x-3');
                    });
                }
            } else {
                if (isCollapsed) {
                    sidebar.classList.add('sidebar-mobile-open');
                    mobileOverlay.classList.remove('hidden');
                } else {
                    sidebar.classList.remove('sidebar-mobile-open');
                    mobileOverlay.classList.add('hidden');
                }
            }
        }

        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', toggleSidebar);

        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });
    </script>

    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-800 text-white px-6 py-3 shadow-lg z-50 text-sm font-semibold">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('.fixed.bg-green-800');
            if (toast) toast.remove();
        }, 5000);
    </script>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 bg-red-800 text-white px-6 py-3 shadow-lg z-50 text-sm font-semibold">
        <div class="flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('.fixed.bg-red-800');
            if (toast) toast.remove();
        }, 5000);
    </script>
    @endif
</body>
</html>
