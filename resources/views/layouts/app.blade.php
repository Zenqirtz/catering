<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FourYourCatering')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- AOS (Animate On Scroll) -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<!-- Smooth page load effect -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.body.style.opacity = 0;
    window.addEventListener("load", () => {
      setTimeout(() => {
        document.body.style.transition = "opacity 1s ease-out";
        document.body.style.opacity = 1;
        AOS.init({
          duration: 900,
          easing: "ease-in-out",
          once: true,
          mirror: false,
        });
      }, 200);
    });
  });
</script>

<body class="font-sans antialiased bg-white text-[#222] flex flex-col min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="max-w-[1440px] mx-auto px-4 py-6 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex-shrink-0">
                <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering Logo" class="h-12 lg:h-50">
            </a>

            <!-- Nav Links -->
            <div class="hidden md:flex space-x-8 lg:space-x-12">
                <a href="{{ url('/') }}" class="text-[#222] font-semibold hover:text-[#036EA6] transition duration-200">Home</a>
                <a href="{{ url('/profile') }}" class="text-[#222] font-semibold hover:text-[#036EA6] transition duration-200">Profile</a>
                <a href="{{ url('/menu') }}" class="text-[#222] font-semibold hover:text-[#036EA6] transition duration-200">Menu</a>
                <a href="{{ url('/cart-checkout') }}" class="text-[#222] font-semibold hover:text-[#036EA6] transition duration-200">Cart & Checkout</a>
                <a href="{{ url('/my-order') }}" class="text-[#222] font-semibold hover:text-[#036EA6] transition duration-200">My Order</a>
            </div>

            <!-- Login / Logout -->
            <div>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-[#036EA6] text-white font-semibold px-7 py-2 rounded-lg hover:bg-[#025a87] transition">
                            LOG OUT
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-[#036EA6] text-white font-semibold px-7 py-2 rounded-lg hover:bg-[#025a87] transition">
                        LOG IN
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#036EA6] text-white py-4 mt-auto">
        <div class="max-w-6xl mx-auto px-6 flex flex-col items-center justify-center text-center space-y-2">

            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering Logo" class="h-8 w-auto object-contain">
                <span class="text-lg font-semibold tracking-wide">FourYourCatering</span>
            </div>

            <!-- Social Media -->
            <div class="flex space-x-4 mt-1">
                <a href="https://wa.me/6287758456674" target="_blank" class="hover:scale-110 transition-transform duration-200">
                    <img src="{{ asset('img/wa.png') }}" alt="WhatsApp" class="h-7 w-7 object-contain">
                </a>
                <a href="https://www.instagram.com/foryourcatering_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="hover:scale-110 transition-transform duration-200">
                    <img src="{{ asset('img/ig.png') }}" alt="Instagram" class="h-7 w-7 object-contain">
                </a>
            </div>

            <!-- Copyright -->
            <p class="text-sm font-medium opacity-90 mt-1">
                &copy; {{ date('Y') }} <span class="font-semibold">FourYourCatering</span>. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>
