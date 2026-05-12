<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FourYourCatering')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS (Animate On Scroll) -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Glassmorphism utilities */
        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .nav-container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            width: 100%;
        }
        
        .nav-logo { justify-self: start; }
        .nav-menu { justify-self: center; }
        .nav-auth { justify-self: end; }
        
        /* Modern Hover Effects */
        .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            color: #4b5563;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, #036EA6, #00A3FF);
            border-radius: 4px;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover {
            color: #036EA6;
        }

        .nav-link:hover::before {
            width: 80%;
        }

        /* Gradient Button */
        .btn-gradient {
            background: linear-gradient(135deg, #036EA6 0%, #00A3FF 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, #00A3FF 0%, #036EA6 100%);
            z-index: -1;
            transition: opacity 0.3s ease;
            opacity: 0;
        }

        .btn-gradient:hover::before {
            opacity: 1;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(3, 110, 166, 0.3);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9; 
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #036EA6; 
        }
    </style>
</head>

<body class="bg-slate-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="glass-nav sticky top-0 z-50 transition-all duration-300" id="main-header">
        <nav class="max-w-[1440px] mx-auto px-6 py-4 nav-container">
            <!-- Logo -->
            <div class="nav-logo">
                <a href="{{ url('/') }}" class="flex-shrink-0 group flex items-center gap-2">
                    <div class="bg-white p-1.5 rounded-xl shadow-sm border border-gray-100 group-hover:shadow-md transition-all duration-300">
                        <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering Logo" class="h-9 lg:h-11 object-contain group-hover:scale-105 transition-transform">
                    </div>
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-[#036EA6] to-[#00A3FF] hidden lg:block">
                        FourYourCatering
                    </span>
                </a>
            </div>

            <!-- Nav Links - Posisi Tengah -->
            <div class="nav-menu hidden md:flex space-x-2 lg:space-x-4 bg-white/50 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-100 shadow-sm">
                <a href="{{ url('/') }}" class="nav-link rounded-full">Home</a>
                <a href="{{ url('/profile') }}" class="nav-link rounded-full">Profile</a>
                <a href="{{ url('/menu') }}" class="nav-link rounded-full">Menu</a>
            </div>

            <!-- Auth & Actions -->
            <div class="nav-auth flex items-center space-x-3 sm:space-x-5">
                <!-- Cart Icon -->
                <a href="{{ url('/cart-checkout') }}" class="relative p-2 text-gray-500 hover:text-[#036EA6] transition-colors group">
                    <div class="absolute inset-0 bg-blue-50 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 z-0"></div>
                    <i class="fas fa-shopping-cart text-xl relative z-10"></i>
                    <!-- Badge Example -->
                    <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full border-2 border-white text-[10px] text-white flex items-center justify-center font-bold z-20">3</span>
                </a>

                <!-- Orders Icon -->
                <a href="{{ url('/my-order') }}" class="relative p-2 text-gray-500 hover:text-[#036EA6] transition-colors group hidden sm:block">
                    <div class="absolute inset-0 bg-blue-50 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 z-0"></div>
                    <i class="fas fa-receipt text-xl relative z-10"></i>
                </a>

                <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>

                @auth
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 bg-white border border-gray-200 text-gray-700 font-medium px-4 py-2 rounded-full hover:border-[#036EA6] hover:text-[#036EA6] transition-all duration-300 shadow-sm hover:shadow">
                            <div class="w-7 h-7 bg-gradient-to-tr from-[#036EA6] to-[#00A3FF] rounded-full flex items-center justify-center text-white text-xs">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </div>
                            <span class="hidden sm:inline text-sm">{{ explode(' ', Auth::user()->name ?? 'User')[0] }}</span>
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 top-full mt-3 w-56 bg-white rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.1)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 border border-gray-100 translate-y-2 group-hover:translate-y-0 overflow-hidden">
                            <div class="p-4 bg-gray-50 border-b border-gray-100">
                                <p class="font-semibold text-gray-800 truncate">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ url('/profile') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#036EA6] transition-colors">
                                    <i class="fas fa-user-circle w-5 text-center mr-2"></i> My Profile
                                </a>
                                <a href="{{ url('/my-order') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-[#036EA6] transition-colors sm:hidden">
                                    <i class="fas fa-receipt w-5 text-center mr-2"></i> My Orders
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-colors font-medium">
                                        <i class="fas fa-sign-out-alt w-5 text-center mr-2"></i> Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="btn-gradient text-white font-medium px-6 py-2.5 rounded-full shadow-sm hover:shadow-md text-sm flex items-center gap-2">
                        <i class="fas fa-user"></i>
                        <span>Sign In</span>
                    </a>
                @endauth
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-600 p-2 rounded-full hover:bg-gray-100 transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </nav>
        
        <!-- Mobile Menu (Glassmorphism) -->
        <div id="mobile-menu" class="md:hidden absolute top-full left-0 w-full bg-white/95 backdrop-blur-xl border-t border-gray-100 shadow-xl opacity-0 invisible transition-all duration-300 transform -translate-y-2">
            <div class="flex flex-col p-4 space-y-1">
                <a href="{{ url('/') }}" class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-blue-50 hover:text-[#036EA6] transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-[#036EA6]"><i class="fas fa-home"></i></div>
                    <span>Home</span>
                </a>
                <a href="{{ url('/profile') }}" class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-blue-50 hover:text-[#036EA6] transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-[#036EA6]"><i class="fas fa-user"></i></div>
                    <span>Profile</span>
                </a>
                <a href="{{ url('/menu') }}" class="flex items-center space-x-3 p-3 rounded-xl text-gray-700 font-medium hover:bg-blue-50 hover:text-[#036EA6] transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-[#036EA6]"><i class="fas fa-utensils"></i></div>
                    <span>Menu</span>
                </a>
                
                @guest
                <div class="pt-4 border-t border-gray-100 mt-2 flex flex-col space-y-3">
                    <a href="{{ route('login') }}" class="w-full btn-gradient text-white font-medium px-4 py-3 rounded-xl text-center shadow-md">
                        Sign In / Register
                    </a>
                </div>
                @endguest
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full overflow-hidden">
        @yield('content')
    </main>

    <!-- Modern Premium Footer -->
    <footer class="bg-white border-t border-gray-100 mt-auto relative overflow-hidden">
        <!-- Decorative bg -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-b from-blue-50 to-transparent rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/3 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 pt-16 pb-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-16 mb-12">
                <!-- Brand Column -->
                <div class="md:col-span-5 lg:col-span-4">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-white p-2 rounded-xl shadow-sm border border-gray-100">
                            <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering Logo" class="h-10 w-auto">
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">FourYour<span class="text-[#036EA6]">Catering</span></h3>
                    </div>
                    <p class="text-gray-500 mb-8 leading-relaxed">
                        Elevating your daily meals with premium, fresh, and affordable catering delivered straight to you. Fuel your success with every bite.
                    </p>
                    <div class="flex items-center space-x-3">
                        <a href="https://wa.me/6287758456674" target="_blank" class="w-10 h-10 rounded-full bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1">
                            <i class="fab fa-whatsapp text-lg"></i>
                        </a>
                        <a href="https://www.instagram.com/foryourcatering_" target="_blank" class="w-10 h-10 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-pink-500 hover:to-purple-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-1">
                            <i class="fab fa-instagram text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Links Column 1 -->
                <div class="md:col-span-3 lg:col-span-2 lg:col-start-7">
                    <h4 class="text-gray-900 font-bold mb-5 uppercase tracking-wider text-sm">Explore</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}" class="text-gray-500 hover:text-[#036EA6] hover:translate-x-1 inline-block transition-all">Home</a></li>
                        <li><a href="{{ url('/menu') }}" class="text-gray-500 hover:text-[#036EA6] hover:translate-x-1 inline-block transition-all">Our Menu</a></li>
                        <li><a href="{{ url('/profile') }}" class="text-gray-500 hover:text-[#036EA6] hover:translate-x-1 inline-block transition-all">About Us</a></li>
                    </ul>
                </div>

                <!-- Links Column 2 -->
                <div class="md:col-span-4 lg:col-span-3">
                    <h4 class="text-gray-900 font-bold mb-5 uppercase tracking-wider text-sm">Customer Support</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/my-order') }}" class="text-gray-500 hover:text-[#036EA6] hover:translate-x-1 inline-block transition-all">Track Order</a></li>
                        <li><a href="{{ url('/cart-checkout') }}" class="text-gray-500 hover:text-[#036EA6] hover:translate-x-1 inline-block transition-all">Checkout</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-[#036EA6] hover:translate-x-1 inline-block transition-all">FAQs</a></li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-100 my-8"></div>

            <!-- Bottom Section -->
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                <div class="text-gray-400 text-sm">
                    &copy; {{ date('Y') }} FourYourCatering. All rights reserved.
                </div>
                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-gray-600 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Init Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Init AOS
            if(typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: "ease-out-cubic",
                    once: true,
                    offset: 50,
                });
            }

            // Mobile Menu Toggle
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');
            
            if(btn && menu) {
                btn.addEventListener('click', function() {
                    const isHidden = menu.classList.contains('invisible');
                    if (isHidden) {
                        menu.classList.remove('invisible', 'opacity-0', '-translate-y-2');
                        menu.classList.add('visible', 'opacity-100', 'translate-y-0');
                    } else {
                        menu.classList.add('invisible', 'opacity-0', '-translate-y-2');
                        menu.classList.remove('visible', 'opacity-100', 'translate-y-0');
                    }
                });
            }

            // Header Scroll Effect
            const header = document.getElementById('main-header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    header.classList.add('shadow-md', 'bg-white/95');
                    header.classList.remove('bg-white/85');
                } else {
                    header.classList.remove('shadow-md', 'bg-white/95');
                    header.classList.add('bg-white/85');
                }
            });
        });
    </script>
</body>
</html>