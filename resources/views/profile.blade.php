@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white px-6 py-16">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-3xl p-12 border border-gray-200">
        @if(session('success'))
    <div class="mb-6 p-4 rounded-xl bg-green-100 border border-green-300 text-green-800 text-center font-medium">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 p-4 rounded-xl bg-red-100 border border-red-300 text-red-800 text-center font-medium">
        {{ session('error') }}
    </div>
@endif

    <!-- Header Profile -->
        <div class="flex items-center space-x-8 mb-10">
            <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 text-5xl overflow-hidden">
                @if($user->photo)
                    <img src="{{ asset('storage/photos/' . $user->photo) }}" 
                         alt="Profile Photo" 
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <i class="fas fa-user" style="display: none;"></i>
                @else
                    <i class="fas fa-user"></i>
                @endif
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Informasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
            <div>
                <label class="block text-base font-medium text-gray-600 mb-2">Nama Lengkap</label>
                <p class="px-5 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700">{{ $user->name }}</p>
            </div>
            <div>
                <label class="block text-base font-medium text-gray-600 mb-2">Alamat</label>
                <p class="px-5 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-700">{{ $user->address ?? '-' }}</p>
            </div>
        </div>

        <!-- Riwayat Pesanan -->
        <div class="mt-10">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Pesanan</h3>
            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6">
                @if($orders->isEmpty())
                    <p class="text-gray-500 text-center py-4">Belum ada riwayat pesanan.</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                            @foreach($order->items as $item)
                                <li class="py-4 flex justify-between items-center">
                                    <div>
                                        <p class="text-gray-800 font-medium">{{ $item->product_name }}</p>
                                        <p class="text-sm text-gray-500">Tanggal: {{ $order->created_at->format('d F Y') }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                   <span class="text-sm 
                                        @if($order->status == 'pending') bg-gray-100 text-black-700
                                        @elseif($order->status == 'process') bg-yellow-100 text-yellow-700
                                        @elseif($order->status == 'invalid') bg-red-100 text-red-700
                                        @elseif($order->status == 'done') bg-green-100 text-green-700
                                        @else bg-gray-100 text-gray-700 @endif
                                        px-3 py-1 rounded-full font-semibold">
                                        {{ strtoupper($order->status) }}
                                    </span>

                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                    
                    <!-- Link ke My Order -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('orders.index') }}" class="text-[#036EA6] hover:underline font-medium">
                            Lihat semua pesanan →
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tombol Edit -->
        <div class="flex justify-end mt-8">
            <a href="{{ route('profile.edit') }}"
               class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 ease-in-out">
                Edit Profile
            </a>
        </div>
    </div>
</div>
@endsection