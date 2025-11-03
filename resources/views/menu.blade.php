@extends('layouts.app')

@section('title', 'Menu - FourYourCatering')

@section('content')
<main class="max-w-7xl mx-auto py-16 px-6">
    <!-- Special Foods Section -->
    <section class="mb-20">
        <h2 class="text-4xl md:text-5xl font-extrabold text-center text-gray-900 mb-4 animate-fade-in-down hide-before-animation">
            Our Special Foods
        </h2>
        <p class="text-center text-gray-600 mb-12 text-lg animate-fade-in-up hide-before-animation">
            This lesson provides a basic framework for conducting a recipe demonstration
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
            @foreach([
                ['id' => 'food_1', 'img' => 'menu1.png', 'title' => 'Ricebowl Ayam Sushi', 'price' => 'Rp 10.000'],
                ['id' => 'food_2', 'img' => 'menu2.png', 'title' => 'Ricebowl Chicken Pepperoni', 'price' => 'Rp 15.000'],
                ['id' => 'food_3', 'img' => 'menu3.png', 'title' => 'Ricebowl Chicken Fillet', 'price' => 'Rp 16.000'],
                ['id' => 'food_4', 'img' => 'menu4.png', 'title' => 'Chicken Katsu', 'price' => 'Rp 18.000'],
                ['id' => 'food_5', 'img' => 'menu5.png', 'title' => 'Nasi Kotak Beef Teriyaki', 'price' => 'Rp 18.000'],
                ['id' => 'food_6', 'img' => 'menu6.png', 'title' => 'Nasi Kotak Campur', 'price' => 'Rp 15.000'],
                ['id' => 'food_7', 'img' => 'menu7.png', 'title' => 'Nasi Kotak Chicken Teriyaki', 'price' => 'Rp 15.000'],
            ] as $item)
            <div class="bg-white rounded-2xl shadow-lg flex flex-col items-center p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl min-h-[350px] animate-fade-in-right hide-before-animation">
                <img src="{{ asset('img/'.$item['img']) }}" alt="{{ $item['title'] }}" class="object-contain w-full h-32 mb-4 rounded">
                <h3 class="font-semibold text-lg text-gray-800 mb-2 text-center flex-grow">{{ $item['title'] }}</h3>
                <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <span class="text-gray-600 text-sm ml-1">4.0</span>
                </div>
                <p class="text-[#036EA6] font-bold text-xl mb-4">{{ $item['price'] }}</p>

                <!-- Tombol tambah ke keranjang -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}"> {{-- Menggunakan ID unik --}}
                    <input type="hidden" name="name" value="{{ $item['title'] }}">
                    <input type="hidden" name="price" value="{{ preg_replace('/[^0-9]/', '', $item['price']) }}">
                    <input type="hidden" name="img" value="{{ $item['img'] }}">
                    <button type="submit" class="bg-[#036EA6] hover:bg-[#025a87] active:scale-95 rounded-full w-10 h-10 flex items-center justify-center transition-all duration-200 mt-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Special Beverages Section -->
    <section class="mb-20">
        <h2 class="text-4xl md:text-5xl font-extrabold text-center text-gray-900 mb-4 animate-fade-in-down hide-before-animation">
            Our Special Beverages
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach([
                ['id' => 'drink_1', 'img' => 'esteh.png', 'title' => 'Ice Tea', 'price' => 'Rp 10.000'],
                ['id' => 'drink_2', 'img' => 'aqua.png', 'title' => 'Aqua 1 Box', 'price' => 'Rp 13.000'],
                ['id' => 'drink_3', 'img' => 'club.png', 'title' => 'Club 1 Box', 'price' => 'Rp 15.000'],
                ['id' => 'drink_4', 'img' => 'cleo.png', 'title' => 'Cleo 1 Box', 'price' => 'Rp 18.000'],
            ] as $item)
            <div class="bg-white rounded-2xl shadow-lg flex flex-col items-center p-6 transition-all duration-300 hover:scale-105 hover:shadow-2xl min-h-[350px] animate-fade-in-left hide-before-animation">
                <img src="{{ asset('img/'.$item['img']) }}" alt="{{ $item['title'] }}" class="object-contain w-full h-32 mb-4 rounded">
                <h3 class="font-semibold text-lg text-gray-800 mb-2 text-center flex-grow">{{ $item['title'] }}</h3>
                <div class="flex items-center justify-center mb-2">
                    <i class="fas fa-star text-yellow-400 text-sm"></i>
                    <span class="text-gray-600 text-sm ml-1">4.0</span>
                </div>
                <p class="text-[#036EA6] font-bold text-xl mb-4">{{ $item['price'] }}</p>

                <!-- Tombol tambah ke keranjang -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item['id'] }}"> {{-- Menggunakan ID unik --}}
                    <input type="hidden" name="name" value="{{ $item['title'] }}">
                    <input type="hidden" name="price" value="{{ preg_replace('/[^0-9]/', '', $item['price']) }}">
                    <input type="hidden" name="img" value="{{ $item['img'] }}">
                    <button type="submit" class="bg-[#036EA6] hover:bg-[#025a87] active:scale-95 rounded-full w-10 h-10 flex items-center justify-center transition-all duration-200 mt-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </button>
                </form>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Stats Section -->
    <section class="flex flex-col sm:flex-row justify-center items-center gap-8 mb-12">
        <div class="bg-[#036EA6] text-white rounded-xl p-8 text-center shadow-lg w-full max-w-xs transition-all duration-300 hover:scale-105 hover:bg-[#025a87] animate-fade-in hide-before-animation" style="animation-delay: 1s;">
            <p class="text-4xl font-bold mb-2">10K+</p>
            <p class="text-lg">Total customers</p>
        </div>
        <div class="bg-[#036EA6] text-white rounded-xl p-8 text-center shadow-lg w-full max-w-xs transition-all duration-300 hover:scale-105 hover:bg-[#025a87] animate-fade-in hide-before-animation" style="animation-delay: 1.1s;">
            <p class="text-4xl font-bold mb-2">12K</p>
            <p class="text-lg">Total destinations</p>
        </div>
    </section>
</main>
@endsection