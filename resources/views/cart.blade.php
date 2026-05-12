@extends('layouts.app')

@section('title', 'Cart & Checkout')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-6">
    <div class="text-center mb-10">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-[#036EA6] font-bold text-sm tracking-widest uppercase mb-4 border border-blue-100">Checkout</span>
        <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight">Your Cart</h2>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-300 text-red-800 text-center font-medium">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-300 text-green-800 text-center font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        @foreach(session('cart') as $id => $item)
        <div class="flex flex-col md:flex-row justify-between items-center bg-white border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] hover:shadow-[0_10px_30px_rgba(3,110,166,0.1)] rounded-[1.5rem] p-6 mb-6 transition-all duration-300">
            <div class="flex items-center gap-6 w-full md:w-auto">
                <!-- PERBAIKAN: Handle gambar dari storage dan public/img -->
                @if($item['img'])
                    @if(str_contains($item['img'], 'img/'))
                        <!-- Gambar dari public/img/ -->
                        <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                    @elseif(file_exists(public_path('storage/menus/' . $item['img'])))
                        <!-- Gambar dari storage -->
                        <img src="{{ asset('storage/menus/' . $item['img']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                    @else
                        <!-- Gambar tidak ditemukan, tampilkan placeholder -->
                        <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center shadow-sm">
                            <i class="fas fa-image text-gray-400 text-xl"></i>
                        </div>
                    @endif
                @else
                    <!-- Jika tidak ada gambar -->
                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center shadow-sm">
                        <i class="fas fa-image text-gray-400 text-xl"></i>
                    </div>
                @endif
                
                <div class="flex-grow">
                    <h3 class="font-bold text-2xl text-gray-900">{{ $item['name'] }}</h3>
                    <p class="text-[#036EA6] font-extrabold text-xl mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    <p class="text-gray-500 font-medium text-sm mt-1">Qty: {{ $item['quantity'] }} pcs</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 mt-4 md:mt-0 md:ml-auto">
                {{-- Form untuk update kuantitas item --}}
                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    
                    <button type="submit" name="action" value="decrease" 
                        class="bg-gray-50 text-gray-700 h-10 w-10 flex items-center justify-center 
                               hover:bg-gray-100 transition-colors duration-200 
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-70 
                               text-xl font-semibold border-r border-gray-300">
                        -
                    </button>
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="50" 
                        class="w-16 h-10 text-center text-gray-900 text-lg 
                               appearance-none focus:outline-none bg-white font-medium"
                        onchange="if(this.value < 50) { alert('Minimal order adalah 50 pcs per item!'); this.value = 50; } this.form.submit();">
                    <button type="submit" name="action" value="increase" 
                        class="bg-gray-50 text-gray-700 h-10 w-10 flex items-center justify-center 
                               hover:bg-gray-100 transition-colors duration-200 
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-70 
                               text-xl font-semibold border-l border-gray-300">
                        +
                    </button>
                </form>
                
                {{-- Form untuk menghapus item --}}
                <form action="{{ route('cart.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm" title="Remove Item">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach

        <div class="text-center mt-12">
            <a href="{{ route('checkout') }}" class="inline-flex btn-gradient text-white px-10 py-5 rounded-full text-xl font-bold tracking-wide shadow-[0_8px_25px_rgba(3,110,166,0.3)] hover:shadow-[0_12px_30px_rgba(3,110,166,0.4)] transition-all items-center gap-3 group">
                Proceed to Checkout <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    @else
        <p class="text-center text-gray-500 text-xl py-10">Keranjangmu kosong 🛍️</p>
    @endif
</div>
@endsection