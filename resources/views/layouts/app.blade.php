<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FourYourCatering')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts: Archivo (display) + Fraunces (serif accent) + Inter (body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@500;600;700;800;900&family=Fraunces:ital,opsz,wght@1,9..144,400;1,9..144,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --cream: #FBF5EA;
            --cream-deep: #F4EAD9;
            --ink: #191919;
            --olive: #454B21;
            --olive-dark: #3A3F1B;
            --orange: #E8552B;
            --mustard: #E9B92B;
            --muted: #6C6357;
            --line: rgba(25, 25, 25, 0.12);
        }

        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            background-color: var(--cream);
            color: var(--ink);
        }

        .font-display {
            font-family: 'Archivo', sans-serif;
            font-weight: 800;
            letter-spacing: -0.015em;
        }

        .font-serif-accent {
            font-family: 'Fraunces', serif;
            font-style: italic;
            font-weight: 400;
        }

        /* Solid colour buttons - flat, editorial, no gradients */
        .btn-solid {
            background-color: var(--orange);
            color: #fff;
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            font-size: 0.78rem;
            padding: 0.9rem 1.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: background-color 0.2s ease, transform 0.2s ease;
            border: 1px solid var(--orange);
        }
        .btn-solid:hover { background-color: #cf451f; border-color: #cf451f; }

        .btn-yellow {
            background-color: var(--mustard);
            color: var(--ink);
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            font-size: 0.78rem;
            padding: 0.9rem 1.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            transition: background-color 0.2s ease;
            border: 1px solid var(--mustard);
        }
        .btn-yellow:hover { background-color: #d8a916; border-color: #d8a916; }

        .btn-outline {
            background: transparent;
            color: var(--ink);
            font-weight: 700;
            letter-spacing: 0.02em;
            text-transform: uppercase;
            font-size: 0.78rem;
            padding: 0.9rem 1.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            border: 1.5px solid var(--ink);
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .btn-outline:hover { background-color: var(--ink); color: var(--cream); }

        .eyebrow {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--olive);
        }

        .nav-link {
            font-size: 0.9rem;
            font-weight: 500;
            color: #3a352c;
            padding: 0.35rem 0;
            position: relative;
            transition: color 0.2s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0; bottom: -2px;
            width: 0; height: 1.5px;
            background: var(--orange);
            transition: width 0.25s ease;
        }
        .nav-link:hover { color: var(--ink); }
        .nav-link:hover::after { width: 100%; }

        .nav-container {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            width: 100%;
        }
        .nav-logo { justify-self: start; }
        .nav-menu { justify-self: center; }
        .nav-auth { justify-self: end; }

        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: var(--cream-deep); }
        ::-webkit-scrollbar-thumb { background: #c9bda6; }
        ::-webkit-scrollbar-thumb:hover { background: var(--olive); }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-[var(--cream)] border-b border-[rgba(25,25,25,0.08)] sticky top-0 z-50" id="main-header">
        <nav class="max-w-[1280px] mx-auto px-5 lg:px-8 py-4 nav-container">
            <!-- Logo -->
            <div class="nav-logo">
                <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering Logo" class="h-9 lg:h-10 object-contain">
                    <span class="font-display text-lg lg:text-xl tracking-tight text-[var(--ink)] uppercase hidden sm:block">
                        Four<span class="text-[var(--orange)]">Your</span>Catering
                    </span>
                </a>
            </div>

            <!-- Nav Links -->
            <div class="nav-menu hidden md:flex items-center gap-9">
                <a href="{{ url('/') }}" class="nav-link">Home</a>
                <a href="{{ url('/profile') }}" class="nav-link">About</a>
                <a href="{{ url('/menu') }}" class="nav-link">Menu</a>
                <a href="{{ url('/my-order') }}" class="nav-link">Orders</a>
            </div>

            <!-- Auth & Actions -->
            <div class="nav-auth flex items-center gap-2 sm:gap-4">
                <a href="{{ url('/cart-checkout') }}" class="relative p-2 text-[var(--ink)] hover:text-[var(--orange)] transition-colors" aria-label="Cart">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span class="absolute top-0 right-0 h-4 w-4 bg-[var(--orange)] text-[10px] text-white flex items-center justify-center font-bold">3</span>
                </a>

                @auth
                    <div class="relative group">
                        <button class="flex items-center gap-2 border border-[var(--ink)] text-[var(--ink)] font-semibold px-3 sm:px-4 py-2 text-xs uppercase tracking-wide hover:bg-[var(--ink)] hover:text-[var(--cream)] transition-colors">
                            <span class="w-6 h-6 bg-[var(--olive)] text-white flex items-center justify-center text-[11px] font-bold">
                                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                            </span>
                            <span class="hidden sm:inline">{{ explode(' ', Auth::user()->name ?? 'User')[0] }}</span>
                            <i class="fas fa-chevron-down text-[9px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>
                        <div class="absolute right-0 top-full mt-2 w-56 bg-[var(--cream)] border border-[var(--line)] shadow-[0_18px_40px_rgba(25,25,25,0.12)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 translate-y-1 group-hover:translate-y-0">
                            <div class="p-4 border-b border-[var(--line)]">
                                <p class="font-semibold text-[var(--ink)] truncate text-sm">{{ Auth::user()->name ?? 'User' }}</p>
                                <p class="text-xs text-[var(--muted)] truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                            </div>
                            <div class="py-1">
                                <a href="{{ url('/profile') }}" class="flex items-center px-4 py-2.5 text-sm text-[var(--muted)] hover:bg-[var(--cream-deep)] hover:text-[var(--ink)] transition-colors">
                                    <i class="fas fa-user w-5 text-center mr-2"></i> My Profile
                                </a>
                                <a href="{{ url('/my-order') }}" class="flex items-center px-4 py-2.5 text-sm text-[var(--muted)] hover:bg-[var(--cream-deep)] hover:text-[var(--ink)] transition-colors">
                                    <i class="fas fa-receipt w-5 text-center mr-2"></i> My Orders
                                </a>
                                <div class="border-t border-[var(--line)] my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center px-4 py-2.5 text-sm text-[var(--orange)] hover:bg-[var(--cream-deep)] transition-colors font-semibold">
                                        <i class="fas fa-sign-out-alt w-5 text-center mr-2"></i> Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-outline !py-2 !px-5 !text-[0.7rem]">
                        <i class="fas fa-user text-xs"></i>
                        <span>Login</span>
                    </a>
                @endauth

                <button id="mobile-menu-button" class="md:hidden text-[var(--ink)] p-2" aria-label="Menu">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden absolute top-full left-0 w-full bg-[var(--cream)] border-t border-[var(--line)] shadow-xl opacity-0 invisible transition-all duration-200 -translate-y-1">
            <div class="flex flex-col p-5 gap-1">
                <a href="{{ url('/') }}" class="py-3 border-b border-[var(--line)] text-[var(--ink)] font-medium flex items-center gap-3"><i class="fas fa-house w-5 text-[var(--olive)]"></i> Home</a>
                <a href="{{ url('/profile') }}" class="py-3 border-b border-[var(--line)] text-[var(--ink)] font-medium flex items-center gap-3"><i class="fas fa-user w-5 text-[var(--olive)]"></i> About</a>
                <a href="{{ url('/menu') }}" class="py-3 border-b border-[var(--line)] text-[var(--ink)] font-medium flex items-center gap-3"><i class="fas fa-utensils w-5 text-[var(--olive)]"></i> Menu</a>
                <a href="{{ url('/my-order') }}" class="py-3 border-b border-[var(--line)] text-[var(--ink)] font-medium flex items-center gap-3"><i class="fas fa-receipt w-5 text-[var(--olive)]"></i> Orders</a>

                @guest
                <a href="{{ route('login') }}" class="btn-solid justify-center mt-4">
                    <i class="fas fa-user"></i> Login / Register
                </a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow w-full overflow-hidden">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[var(--ink)] text-[var(--cream)] mt-auto">
        <div class="max-w-[1280px] mx-auto px-5 lg:px-8 pt-16 pb-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 lg:gap-16 mb-14">
                <!-- Brand -->
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="font-display text-2xl uppercase tracking-tight text-[var(--cream)]">
                            Four<span class="text-[var(--orange)]">Your</span>Catering
                        </span>
                    </div>
                    <p class="text-[#b8b2a6] leading-relaxed mb-8 max-w-sm">
                        An epicurean buffet experience — a symphony of taste where passion meets precision, creating memories beyond the plate.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="https://wa.me/6287758456674" target="_blank" class="w-10 h-10 border border-[#3a3a3a] text-[var(--cream)] flex items-center justify-center hover:bg-[var(--olive)] hover:border-[var(--olive)] transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.instagram.com/foryourcatering_" target="_blank" class="w-10 h-10 border border-[#3a3a3a] text-[var(--cream)] flex items-center justify-center hover:bg-[var(--olive)] hover:border-[var(--olive)] transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Explore -->
                <div class="md:col-span-3 lg:col-start-7">
                    <h4 class="font-display text-sm uppercase tracking-[0.2em] mb-6 text-[var(--cream)]">Explore</h4>
                    <ul class="space-y-3 text-[#b8b2a6]">
                        <li><a href="{{ url('/') }}" class="hover:text-[var(--mustard)] transition-colors">Home</a></li>
                        <li><a href="{{ url('/menu') }}" class="hover:text-[var(--mustard)] transition-colors">Our Menu</a></li>
                        <li><a href="{{ url('/profile') }}" class="hover:text-[var(--mustard)] transition-colors">About Us</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div class="md:col-span-4">
                    <h4 class="font-display text-sm uppercase tracking-[0.2em] mb-6 text-[var(--cream)]">Customer Support</h4>
                    <ul class="space-y-3 text-[#b8b2a6]">
                        <li><a href="{{ url('/my-order') }}" class="hover:text-[var(--mustard)] transition-colors">Track Order</a></li>
                        <li><a href="{{ url('/cart-checkout') }}" class="hover:text-[var(--mustard)] transition-colors">Checkout</a></li>
                        <li><a href="#" class="hover:text-[var(--mustard)] transition-colors">FAQs</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-[#2c2c2c] pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-[#7d776b] text-sm">
                    &copy; {{ date('Y') }} FourYourCatering. All rights reserved.
                </div>
                <div class="flex gap-6 text-sm text-[#7d776b]">
                    <a href="#" class="hover:text-[var(--cream)] transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-[var(--cream)] transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (btn && menu) {
                btn.addEventListener('click', function() {
                    const isHidden = menu.classList.contains('invisible');
                    if (isHidden) {
                        menu.classList.remove('invisible', 'opacity-0', '-translate-y-1');
                        menu.classList.add('visible', 'opacity-100', 'translate-y-0');
                    } else {
                        menu.classList.add('invisible', 'opacity-0', '-translate-y-1');
                        menu.classList.remove('visible', 'opacity-100', 'translate-y-0');
                    }
                });
            }

            const header = document.getElementById('main-header');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    header.classList.add('shadow-[0_6px_24px_rgba(25,25,25,0.08)]');
                } else {
                    header.classList.remove('shadow-[0_6px_24px_rgba(25,25,25,0.08)]');
                }
            });
        });
    </script>
</body>
</html>
