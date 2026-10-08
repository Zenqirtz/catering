@extends('layouts.app')

@section('title', 'My Profile - FourYourCatering')

@section('content')
<div class="min-h-screen bg-[var(--cream)] px-5 lg:px-8 py-14">
    <div class="max-w-5xl mx-auto bg-white border border-[var(--line)] p-8 sm:p-12 shadow-[0_18px_40px_rgba(25,25,25,0.06)]">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header Profile -->
        <div class="flex items-center gap-6 mb-10 pb-8 border-b border-[var(--line)]">
            <div class="w-24 h-24 rounded-full bg-[var(--cream-deep)] border border-[var(--line)] flex items-center justify-center text-[var(--muted)] text-4xl overflow-hidden shrink-0">
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
                <p class="eyebrow mb-1">User Profile</p>
                <h2 class="font-display uppercase text-2xl sm:text-3xl text-[var(--ink)] leading-tight">{{ $user->name }}</h2>
                <p class="text-[var(--muted)] text-sm mt-1">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Informasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Nama Lengkap</label>
                <p class="px-4 py-3 bg-[var(--cream)] border border-[var(--line)] text-[var(--ink)] font-medium text-sm">{{ $user->name }}</p>
            </div>
            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Alamat</label>
                <p class="px-4 py-3 bg-[var(--cream)] border border-[var(--line)] text-[var(--ink)] font-medium text-sm">{{ $user->address ?? '-' }}</p>
            </div>
        </div>

        <!-- Riwayat Pesanan -->
        <div class="mt-10 pt-8 border-t border-[var(--line)]">
            <h3 class="font-display uppercase text-xl text-[var(--ink)] mb-4">Riwayat Pesanan</h3>
            <div class="bg-[var(--cream)] border border-[var(--line)] p-6">
                @if($orders->isEmpty())
                    <p class="text-[var(--muted)] text-center py-4 text-sm">Belum ada riwayat pesanan.</p>
                @else
                    <ul class="divide-y divide-[var(--line)]">
                        @foreach($orders as $order)
                            @foreach($order->items as $item)
                                <li class="py-4 flex flex-col sm:flex-row justify-between sm:items-center gap-2">
                                    <div>
                                        <p class="text-[var(--ink)] font-bold text-sm uppercase tracking-wide">{{ $item->product_name }}</p>
                                        <p class="text-xs text-[var(--muted)] mt-0.5">Tanggal: {{ $order->created_at->format('d F Y') }}</p>
                                        <p class="text-xs text-[var(--muted)]">Qty: {{ $item->quantity }} × Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                    </div>
                                    <span class="text-[0.7rem] uppercase font-bold tracking-widest px-3 py-1 border self-start sm:self-auto
                                        @if($order->status == 'pending') bg-gray-100 text-gray-800 border-gray-300
                                        @elseif($order->status == 'process') bg-[var(--mustard)]/20 text-[var(--ink)] border-[var(--mustard)]
                                        @elseif($order->status == 'invalid') bg-red-100 text-red-800 border-red-300
                                        @elseif($order->status == 'done') bg-[var(--olive)] text-white border-[var(--olive)]
                                        @else bg-gray-100 text-gray-700 border-gray-300 @endif">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('orders.index') }}" class="text-[var(--orange)] hover:underline font-bold text-xs uppercase tracking-widest inline-flex items-center gap-1">
                            Lihat semua pesanan <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Tombol Edit -->
        <div class="flex justify-end mt-8">
            <a href="{{ route('profile.edit') }}" class="btn-solid">
                Edit Profile <i class="fas fa-edit text-xs"></i>
            </a>
        </div>
    </div>
</div>
@endsection
