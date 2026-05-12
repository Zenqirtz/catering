@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="min-h-[90vh] flex items-center justify-center pt-24 pb-12 bg-slate-50 relative overflow-hidden">
    <!-- Decorative Blobs -->
    <div class="absolute top-20 left-10 w-96 h-96 bg-[#036EA6]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
    <div class="absolute top-40 right-10 w-96 h-96 bg-blue-300/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-8 left-1/2 w-96 h-96 bg-cyan-200/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>

    <div class="max-w-7xl mx-auto px-6 w-full relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
            
            <!-- Hero Text -->
            <div class="flex-1 text-center lg:text-left" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-[#036EA6] font-semibold text-sm mb-6 border border-blue-100 shadow-sm transition hover:shadow-md cursor-default">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-[#036EA6]"></span>
                    </span>
                    #1 Student Catering Choice
                </div>
                
                <h1 class="text-5xl lg:text-[4.5rem] font-extrabold text-gray-900 leading-[1.1] mb-6 tracking-tight">
                    Premium Meals, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#036EA6] to-[#00A3FF]">
                        Student Price.
                    </span>
                </h1>
                
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-light">
                    Elevate your daily dining with chef-crafted meals delivered hot to your campus. Healthy, affordable, and irresistibly delicious.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ url('/menu') }}" class="w-full sm:w-auto btn-gradient text-white font-semibold px-8 py-4 rounded-full shadow-[0_8px_20px_rgba(3,110,166,0.25)] hover:shadow-[0_10px_25px_rgba(3,110,166,0.35)] text-lg flex items-center justify-center gap-3 group">
                        Order Now
                        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#how-it-works" class="w-full sm:w-auto px-8 py-4 rounded-full text-gray-700 font-semibold bg-white border border-gray-200 shadow-sm hover:border-[#036EA6] hover:text-[#036EA6] transition-all duration-300 text-lg flex items-center justify-center gap-3">
                        How it Works
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="mt-12 flex items-center justify-center lg:justify-start gap-6 text-sm font-medium text-gray-500">
                    <div class="flex items-center gap-2 bg-white/60 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-100">
                        <i class="fas fa-star text-yellow-400 text-lg"></i>
                        <span><strong class="text-gray-800">4.9/5</strong> Rating</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/60 backdrop-blur-sm px-4 py-2 rounded-full border border-gray-100">
                        <i class="fas fa-truck-fast text-[#036EA6] text-lg"></i>
                        <span>Free Delivery*</span>
                    </div>
                </div>
            </div>

            <!-- Hero Image -->
            <div class="flex-1 relative w-full max-w-lg lg:max-w-full mt-10 lg:mt-0" data-aos="fade-left" data-aos-delay="200">
                <div class="relative w-full aspect-square rounded-full bg-gradient-to-tr from-blue-100 to-white shadow-[0_0_80px_rgba(3,110,166,0.15)] flex items-center justify-center p-8 border border-white/50 backdrop-blur-xl">
                    <!-- Main Image (Assuming menu1.png exists) -->
                    <img src="{{ asset('img/menu1.png') }}" alt="Delicious Meal" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" class="w-full h-full object-cover rounded-full drop-shadow-[0_20px_30px_rgba(0,0,0,0.2)] hover:scale-105 transition-transform duration-700 animate-float border-4 border-white">
                    
                    <!-- Floating Badge 1 -->
                    <div class="absolute top-10 -right-4 lg:-right-10 bg-white/95 backdrop-blur-md shadow-[0_10px_30px_rgba(0,0,0,0.1)] rounded-2xl p-4 flex items-center gap-4 animate-float-delayed border border-white">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 shadow-inner">
                            <i class="fas fa-leaf text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium tracking-wide uppercase">100% Fresh</p>
                            <p class="font-bold text-gray-900">Ingredients</p>
                        </div>
                    </div>

                    <!-- Floating Badge 2 -->
                    <div class="absolute bottom-10 -left-4 lg:-left-10 bg-white/95 backdrop-blur-md shadow-[0_10px_30px_rgba(0,0,0,0.1)] rounded-2xl p-4 flex items-center gap-4 animate-float border border-white">
                        <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 shadow-inner">
                            <i class="fas fa-fire text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-medium tracking-wide uppercase">Served Hot</p>
                            <p class="font-bold text-gray-900">Every Day</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Trending Menu Section -->
<section class="py-24 bg-white relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4" data-aos="fade-up">
            <div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4 tracking-tight">Trending Deals 🔥</h2>
                <p class="text-gray-500 text-lg">Discover what other students are loving today.</p>
            </div>
            <a href="{{ url('/menu') }}" class="hidden sm:flex items-center gap-2 text-[#036EA6] font-semibold bg-blue-50 px-6 py-3 rounded-full hover:bg-[#036EA6] hover:text-white transition-all group">
                See Full Menu <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <!-- Carousel / Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @php
                $menus = [
                    ['img' => 'menu1.png', 'name' => 'Premium Box Set', 'price' => '20.000', 'old' => '25.000'],
                    ['img' => 'menu2.png', 'name' => 'Healthy Bowl', 'price' => '18.000', 'old' => '22.000'],
                    ['img' => 'menu3.png', 'name' => 'Spicy Chicken Rice', 'price' => '15.000', 'old' => '18.000'],
                    ['img' => 'menu4.png', 'name' => 'Vegan Delight', 'price' => '17.000', 'old' => '20.000']
                ];
            @endphp
            @foreach ($menus as $menu)
            <div class="group bg-white rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_20px_40px_rgba(3,110,166,0.1)] hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image Container -->
                <div class="relative h-64 bg-[#f8fafc] p-6 flex items-center justify-center overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/5 z-10"></div>
                    <img src="{{ asset('img/' . $menu['img']) }}" onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'" alt="Menu Item" class="w-full h-full object-cover rounded-2xl group-hover:scale-110 transition-transform duration-700 drop-shadow-xl relative z-0">
                    
                    <!-- Image Container only, removed quick view overlay -->
                    
                    <!-- Badge -->
                    @if($loop->first)
                    <div class="absolute top-4 left-4 z-30 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border border-white/20">
                        Best Seller
                    </div>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-6 flex flex-col flex-grow bg-white relative z-30">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-[#036EA6] transition-colors">{{ $menu['name'] }}</h3>
                        <div class="flex items-center gap-1 text-sm font-bold text-gray-700 bg-yellow-50 px-2 py-1 rounded-md">
                            <i class="fas fa-star text-yellow-400"></i>
                            4.8
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm mb-6 line-clamp-2">Complete balanced meal cooked fresh daily to fuel your busy schedule.</p>
                    
                    <div class="mt-auto flex items-end justify-between border-t border-gray-50 pt-4">
                        <div>
                            <p class="text-xs text-gray-400 line-through font-medium">Rp {{ $menu['old'] }}</p>
                            <p class="text-2xl font-extrabold text-[#036EA6]">Rp {{ $menu['price'] }}</p>
                        </div>
                        <a href="{{ url('/menu') }}" class="w-12 h-12 rounded-full bg-blue-50 text-[#036EA6] flex items-center justify-center hover:bg-[#036EA6] hover:text-white transition-all duration-300 hover:rotate-90 shadow-sm hover:shadow-md cursor-pointer">
                            <i class="fas fa-plus text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-12 text-center sm:hidden">
            <a href="{{ url('/menu') }}" class="inline-flex items-center gap-2 text-[#036EA6] font-semibold border-2 border-[#036EA6] px-8 py-4 rounded-full hover:bg-[#036EA6] hover:text-white transition-colors w-full justify-center">
                See Full Menu <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Features / How it Works -->
<section id="how-it-works" class="py-24 bg-slate-50 relative border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">How It Works</h2>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">Get your favorite meals in four simple steps. We handle the cooking, you handle the eating.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 relative">
            <!-- Connecting Line (Desktop only) -->
            <div class="hidden lg:block absolute top-12 left-[10%] right-[10%] h-[3px] bg-gradient-to-r from-blue-100 via-[#036EA6]/30 to-blue-100 z-0"></div>

            @foreach ([
                ['fa-mobile-screen', 'Browse Menu', 'Choose from our daily updated delicious and nutritious options.'],
                ['fa-cart-shopping', 'Place Order', 'Add to cart, select delivery time, and checkout seamlessly.'],
                ['fa-fire-burner', 'We Prepare', 'Our chefs cook your meal fresh using high-quality ingredients.'],
                ['fa-motorcycle', 'Fast Delivery', 'Delivered straight to your location, hot and ready to eat.']
            ] as [$icon, $title, $desc])
            <div class="relative z-10 flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                <div class="w-24 h-24 rounded-2xl bg-white shadow-[0_10px_30px_rgba(0,0,0,0.05)] flex items-center justify-center mb-8 border border-gray-100 group-hover:-translate-y-3 transition-all duration-300 relative overflow-hidden">
                    <!-- Hover Effect Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-[#036EA6] to-[#00A3FF] opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                    
                    <i class="fas {{ $icon }} text-4xl text-[#036EA6] group-hover:scale-110 transition-transform duration-300"></i>
                    
                    <!-- Step Number -->
                    <div class="absolute -top-3 -right-3 w-10 h-10 rounded-full bg-gradient-to-br from-[#036EA6] to-[#00A3FF] text-white flex items-center justify-center font-extrabold text-base shadow-lg border-4 border-slate-50">
                        {{ $loop->iteration }}
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-[#036EA6] transition-colors">{{ $title }}</h3>
                <p class="text-gray-500 leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-24 bg-white overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-20">
            <!-- Left Image Composite -->
            <div class="lg:w-1/2 relative w-full" data-aos="fade-right">
                <div class="relative z-10 bg-gradient-to-br from-[#036EA6] to-[#00A3FF] p-2 rounded-[2.5rem] transform -rotate-2 hover:rotate-0 transition-transform duration-500 shadow-[0_20px_50px_rgba(3,110,166,0.3)]">
                    <img src="{{ asset('img/about.png') }}" onerror="this.src='https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'" alt="About Us" class="rounded-[2rem] object-cover w-full h-[450px] lg:h-[550px]">
                    <!-- Decorative Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-[2.5rem] pointer-events-none"></div>
                </div>
                <!-- Decor Badge -->
                <div class="absolute -bottom-10 -right-4 sm:-right-10 w-36 h-36 sm:w-44 sm:h-44 bg-white rounded-full z-20 shadow-[0_10px_40px_rgba(0,0,0,0.1)] flex items-center justify-center animate-float border-[8px] border-slate-50">
                    <div class="text-center">
                        <span class="block text-4xl sm:text-5xl font-extrabold text-[#036EA6] mb-1">5+</span>
                        <span class="block text-[10px] sm:text-xs font-bold uppercase tracking-widest text-gray-500">Years<br>Experience</span>
                    </div>
                </div>
                <!-- Abstract Shape -->
                <div class="absolute -top-10 -left-10 w-64 h-64 bg-yellow-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            </div>

            <!-- Right Content -->
            <div class="lg:w-1/2" data-aos="fade-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-[#036EA6] font-bold text-sm tracking-widest uppercase mb-6 border border-blue-100">
                    About Us
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-8 leading-[1.2] tracking-tight">
                    Catering Murah,<br>Favorit Mahasiswa
                </h2>
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed mb-10">
                    <p>
                        <strong class="text-gray-900 font-semibold">FourYourCatering</strong> adalah layanan catering yang dirancang khusus untuk memenuhi kebutuhan mahasiswa akan makanan yang lezat, bergizi, dan terjangkau.
                    </p>
                    <p>
                        Kami memahami kesibukan kuliah sering kali membuat sulit menjaga pola makan sehat. Oleh karena itu, kami hadir memberikan solusi praktis dengan berbagai pilihan menu harian yang bisa disesuaikan dengan selera dan kebutuhan Anda.
                    </p>
                </div>
                
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 mb-12">
                    <li class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-lg"></i></div>
                        <span class="font-bold text-gray-800">Harga Terjangkau</span>
                    </li>
                    <li class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-lg"></i></div>
                        <span class="font-bold text-gray-800">Menu Bervariasi</span>
                    </li>
                    <li class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-lg"></i></div>
                        <span class="font-bold text-gray-800">Bahan Segar</span>
                    </li>
                    <li class="flex items-center gap-4 bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0"><i class="fas fa-check text-lg"></i></div>
                        <span class="font-bold text-gray-800">Gratis Ongkir*</span>
                    </li>
                </ul>

                <a href="{{ url('/menu') }}" class="btn-gradient inline-flex text-white font-bold px-10 py-5 rounded-full shadow-[0_8px_25px_rgba(3,110,166,0.3)] hover:shadow-[0_12px_30px_rgba(3,110,166,0.4)] text-lg items-center gap-3 transition-all">
                    Pesan Sekarang <i class="fas fa-motorcycle text-xl"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Add some custom animations for this page -->
<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    @keyframes float-delayed {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(40px, -60px) scale(1.1); }
        66% { transform: translate(-30px, 30px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: float-delayed 7s ease-in-out infinite;
        animation-delay: 2s;
    }
    .animate-blob {
        animation: blob 8s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>

@endsection
