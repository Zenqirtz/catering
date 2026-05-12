@extends('layouts.app')

@section('title', 'Menu - FourYourCatering')

@section('content')
<main class="max-w-7xl mx-auto py-16 px-6">
    <!-- Special Foods Section -->
    <section class="mb-24">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-[#036EA6] font-bold text-sm tracking-widest uppercase mb-4 border border-blue-100">Our Menu</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 animate-fade-in-down hide-before-animation tracking-tight">
                Our Special Foods
            </h2>
            <p class="text-gray-500 text-lg animate-fade-in-up hide-before-animation max-w-2xl mx-auto">
                Discover our delicious selection of premium meals, prepared fresh daily to energize your busy day.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($foods as $menu)
            <div class="group bg-white rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col p-5 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(3,110,166,0.1)] min-h-[380px] animate-fade-in-right hide-before-animation relative overflow-hidden">
                <!-- Image Container -->
                <div class="relative w-full h-48 bg-[#f8fafc] rounded-2xl flex justify-center items-center overflow-hidden mb-5">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/5 z-10"></div>
                @if($menu->image)
                    @if(str_contains($menu->image, 'img/'))
                        <!-- Gambar dari public/img/ -->
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700 relative z-0">
                    @elseif(file_exists(public_path('storage/menus/' . $menu->image)))
                        <!-- Gambar dari storage -->
                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700 relative z-0">
                    @else
                        <!-- Gambar tidak ditemukan -->
                        <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-utensils text-gray-400 text-2xl"></i>
                        </div>
                    @endif
                @else
                    <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                @endif
                </div>
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-xl text-gray-900 group-hover:text-[#036EA6] transition-colors leading-tight line-clamp-2 pr-2">{{ $menu->name }}</h3>
                    <div class="flex items-center bg-yellow-50 px-2 py-1 rounded-md shrink-0">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <span class="font-bold text-gray-700 text-xs ml-1">4.8</span>
                    </div>
                </div>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">Healthy and delicious meal perfectly crafted for your taste.</p>
                
                <div class="mt-auto flex items-end justify-between border-t border-gray-50 pt-4">
                    <div>
                        <p class="text-xs text-gray-400 line-through font-medium mb-0.5">Rp {{ number_format($menu->price + 5000, 0, ',', '.') }}</p>
                        <p class="text-2xl font-extrabold text-[#036EA6] leading-none">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>

                <!-- Tombol tambah ke keranjang -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="menu_{{ $menu->id }}">
                    <input type="hidden" name="name" value="{{ $menu->name }}">
                    <input type="hidden" name="price" value="{{ $menu->price }}">
                    <input type="hidden" name="img" value="{{ $menu->image }}">
                    <button type="submit" class="w-12 h-12 rounded-full bg-blue-50 text-[#036EA6] flex items-center justify-center hover:bg-gradient-to-r hover:from-[#036EA6] hover:to-[#00A3FF] hover:text-white transition-all duration-300 hover:rotate-90 shadow-sm hover:shadow-md mt-auto">
                        <i class="fas fa-plus text-lg"></i>
                    </button>
                </form>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada menu makanan.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Special Beverages Section -->
    <section class="mb-24">
        <div class="text-center mb-16">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-[#036EA6] font-bold text-sm tracking-widest uppercase mb-4 border border-blue-100">Refreshments</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 animate-fade-in-down hide-before-animation tracking-tight">
                Our Special Beverages
            </h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($drinks as $menu)
            <div class="group bg-white rounded-[2rem] border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex flex-col p-5 transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(3,110,166,0.1)] min-h-[380px] animate-fade-in-left hide-before-animation relative overflow-hidden">
                <!-- Image Container -->
                <div class="relative w-full h-48 bg-[#f8fafc] rounded-2xl flex justify-center items-center overflow-hidden mb-5">
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/5 z-10"></div>
                @if($menu->image)
                    @if(str_contains($menu->image, 'img/'))
                        <!-- Gambar dari public/img/ -->
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700 relative z-0">
                    @elseif(file_exists(public_path('storage/menus/' . $menu->image)))
                        <!-- Gambar dari storage -->
                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-700 relative z-0">
                    @else
                        <!-- Gambar tidak ditemukan -->
                        <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-glass-whiskey text-gray-400 text-2xl"></i>
                        </div>
                    @endif
                @else
                    <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                    </div>
                @endif
                </div>
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-xl text-gray-900 group-hover:text-[#036EA6] transition-colors leading-tight line-clamp-2 pr-2">{{ $menu->name }}</h3>
                    <div class="flex items-center bg-yellow-50 px-2 py-1 rounded-md shrink-0">
                        <i class="fas fa-star text-yellow-400 text-xs"></i>
                        <span class="font-bold text-gray-700 text-xs ml-1">4.9</span>
                    </div>
                </div>
                <p class="text-gray-500 text-sm mb-4 line-clamp-2 flex-grow">Refreshing beverages to pair perfectly with your meals.</p>
                
                <div class="mt-auto flex items-end justify-between border-t border-gray-50 pt-4">
                    <div>
                        <p class="text-xs text-gray-400 line-through font-medium mb-0.5">Rp {{ number_format($menu->price + 2000, 0, ',', '.') }}</p>
                        <p class="text-2xl font-extrabold text-[#036EA6] leading-none">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>

          <!-- Tombol tambah ke keranjang -->
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="menu_{{ $menu->id }}">
                <input type="hidden" name="name" value="{{ $menu->name }}">
                <input type="hidden" name="price" value="{{ $menu->price }}">
                <input type="hidden" name="img" value="{{ $menu->image }}"> <!-- Pastikan ini mengirim image path yang benar -->
                <button type="submit" class="w-12 h-12 rounded-full bg-blue-50 text-[#036EA6] flex items-center justify-center hover:bg-gradient-to-r hover:from-[#036EA6] hover:to-[#00A3FF] hover:text-white transition-all duration-300 hover:rotate-90 shadow-sm hover:shadow-md mt-auto">
                    <i class="fas fa-plus text-lg"></i>
                </button>
            </form>
            </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada menu minuman.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Stats Section -->
    <section class="flex flex-col sm:flex-row justify-center items-stretch gap-8 mb-12">
        <div class="bg-gradient-to-tr from-[#036EA6] to-[#00A3FF] text-white rounded-3xl p-10 text-center shadow-[0_10px_30px_rgba(3,110,166,0.3)] w-full max-w-xs transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-fade-in hide-before-animation relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/20 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
            <p class="text-5xl font-extrabold mb-3">10K+</p>
            <p class="text-lg font-medium opacity-90">Total Customers</p>
        </div>
        <div class="bg-white text-gray-900 border border-gray-100 rounded-3xl p-10 text-center shadow-[0_10px_30px_rgba(0,0,0,0.05)] w-full max-w-xs transition-all duration-300 hover:scale-105 hover:-translate-y-2 animate-fade-in hide-before-animation relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-[#036EA6]/5 rounded-full blur-xl group-hover:scale-150 transition-transform duration-700"></div>
            <p class="text-5xl font-extrabold mb-3 text-[#036EA6]">12K</p>
            <p class="text-lg font-medium text-gray-500">Total Orders</p>
        </div>
    </section>
</main>
@endsection