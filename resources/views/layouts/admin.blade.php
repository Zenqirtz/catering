<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - FourYourCatering')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .card-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        }
        .sidebar {
            transition: all 0.3s ease;
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
        
        /* PERBAIKAN: Logo styling untuk collapsed state */
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

        /* Style untuk logo image */
        .logo-image {
            transition: all 0.3s ease;
        }
        
        .logo-image-expanded {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }
        
        .logo-image-collapsed {
            width: 32px;
            height: 32px;
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
<body class="bg-gray-50">
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar sidebar-expanded fixed top-0 left-0 h-full bg-white shadow-lg z-40">
        <!-- Logo - DENGAN GAMBAR -->
        <div class="p-4 border-b border-gray-200">
            <!-- Expanded Logo -->
            <div id="logo-expanded" class="flex items-center space-x-3">
                <!-- Logo Image -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="FourYourCatering Logo" 
                         class="logo-image logo-image-expanded">
                </div>
                <!-- Logo Text -->
                <div class="flex flex-col">
                    <h1 class="text-lg font-bold text-gray-800 leading-tight">FourYourCatering</h1>
                    <p class="text-xs text-gray-500 leading-tight">Catering Admin</p>
                </div>
            </div>
            
            <!-- Collapsed Logo (hidden by default) -->
            <div id="logo-collapsed" class="logo-collapsed hidden">
                <!-- Logo Image Only -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/logo.png') }}" 
                         alt="FourYourCatering" 
                         class="logo-image logo-image-collapsed">
                </div>
                <!-- Mini Text -->
                <div class="logo-text-collapsed text-gray-800">
                    <div class="font-semibold">Four</div>
                    <div class="text-[8px] text-gray-500">Admin</div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-[#036EA6] hover:text-white transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#036EA6] text-white' : '' }}">
                <i class="fas fa-tachometer-alt w-5 flex-shrink-0"></i>
                <span class="nav-text">Dashboard</span>
            </a>

            <a href="{{ route('admin.menu.index') }}" 
               class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-[#036EA6] hover:text-white transition-all {{ request()->routeIs('admin.menu.*') ? 'bg-[#036EA6] text-white' : '' }}">
                <i class="fas fa-utensils w-5 flex-shrink-0"></i>
                <span class="nav-text">Manajemen Menu</span>
            </a>

            <!-- Back to User View -->
            <div class="pt-4 border-t border-gray-200">
                <a href="{{ route('home') }}" 
                   class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-blue-500 hover:text-white transition-all">
                    <i class="fas fa-arrow-left w-5 flex-shrink-0"></i>
                    <span class="nav-text">Kembali ke User</span>
                </a>
            </div>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="pt-4 border-t border-gray-200">
                @csrf
                <button type="submit" 
                        class="nav-item flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-red-500 hover:text-white transition-all w-full text-left">
                    <i class="fas fa-sign-out-alt w-5 flex-shrink-0"></i>
                    <span class="nav-text">Logout</span>
                </button>
            </form>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="content-expanded min-h-screen transition-all duration-300">
        <!-- Top Header -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 sticky top-0 z-30">
            <div class="flex items-center justify-between p-4 lg:px-8">
                <!-- Left: Toggle Button -->
                <button id="sidebar-toggle" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-all">
                    <i class="fas fa-bars text-lg"></i>
                </button>

                <!-- Right: User Info -->
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 bg-[#036EA6] rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-6">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                <p class="text-gray-600 mt-1">@yield('page-description', 'Halaman administrasi FourYourCatering')</p>
            </div>

            <!-- Content -->
            @yield('content')
        </main>
    </div>

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <script>
        // Sidebar Toggle
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
                // Desktop behavior
                if (isCollapsed) {
                    sidebar.classList.remove('sidebar-expanded');
                    sidebar.classList.add('sidebar-collapsed');
                    mainContent.classList.remove('content-expanded');
                    mainContent.classList.add('content-collapsed');
                    
                    // Switch to collapsed logo
                    logoExpanded.classList.add('hidden');
                    logoCollapsed.classList.remove('hidden');
                    
                    // Hide navigation text
                    document.querySelectorAll('.nav-text').forEach(el => {
                        el.classList.add('hidden');
                    });
                    
                    // Center align nav items
                    document.querySelectorAll('.nav-item').forEach(el => {
                        el.classList.add('justify-center');
                        el.classList.remove('space-x-3');
                    });
                    
                } else {
                    sidebar.classList.remove('sidebar-collapsed');
                    sidebar.classList.add('sidebar-expanded');
                    mainContent.classList.remove('content-collapsed');
                    mainContent.classList.add('content-expanded');
                    
                    // Switch to expanded logo
                    logoExpanded.classList.remove('hidden');
                    logoCollapsed.classList.add('hidden');
                    
                    // Show navigation text
                    document.querySelectorAll('.nav-text').forEach(el => {
                        el.classList.remove('hidden');
                    });
                    
                    // Reset nav items alignment
                    document.querySelectorAll('.nav-item').forEach(el => {
                        el.classList.remove('justify-center');
                        el.classList.add('space-x-3');
                    });
                }
            } else {
                // Mobile behavior
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

        // Auto-close sidebar on mobile when clicking a link
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });
    </script>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <div class="flex items-center space-x-2">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('.fixed.bg-green-500');
            if (toast) toast.remove();
        }, 5000);
    </script>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <div class="flex items-center space-x-2">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const toast = document.querySelector('.fixed.bg-red-500');
            if (toast) toast.remove();
        }, 5000);
    </script>
    @endif
</body>
</html>