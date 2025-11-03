@extends('layouts.app')

@section('title', 'Cart & Checkout')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Your Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        @foreach(session('cart') as $id => $item)
        <div class="flex flex-col md:flex-row justify-between items-center bg-white shadow-lg rounded-xl p-5 mb-5 transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center gap-5 w-full md:w-auto">
                <img src="{{ asset('img/'.$item['img']) }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg shadow-sm">
                <div class="flex-grow">
                    <h3 class="font-bold text-xl text-gray-800">{{ $item['name'] }}</h3>
                    <p class="text-gray-700 text-lg mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
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
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                        class="w-16 h-10 text-center text-gray-900 text-lg 
                               appearance-none focus:outline-none bg-white font-medium"
                        onchange="this.form.submit()"> {{-- Tambahkan ini untuk submit otomatis --}}
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
                    <button type="submit" 
                            class="text-red-600 hover:text-red-800 transition-colors duration-200 
                                   font-medium text-md px-3 py-2 rounded-md hover:bg-red-50">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach

       <div class="text-center mt-8">
    <a href="{{ route('checkout') }}" class="bg-[#036EA6] text-white px-8 py-4 rounded-xl 
                                          text-xl font-semibold tracking-wide 
                                          hover:bg-[#025a87] transition duration-300 
                                          shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-[#036EA6] focus:ring-opacity-50">
        Checkout 🛍️
    </a>
</div>
    @else
        <p class="text-center text-gray-500 text-xl py-10">Keranjangmu kosong 🛍️</p>
    @endif
</div>
@endsection