@extends('layouts.app')

@section('title', 'Cart & Checkout - FourYourCatering')

@section('content')
<main class="max-w-[1280px] mx-auto py-16 px-5 lg:px-8">
    <div class="mb-12">
        <p class="eyebrow mb-3">Checkout</p>
        <h2 class="font-display uppercase text-[clamp(2rem,5vw,3.5rem)] leading-[0.95] text-[var(--ink)]">Your Cart</h2>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="space-y-4">
            @foreach(session('cart') as $id => $item)
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center bg-white border border-[var(--line)] p-5 sm:p-6 transition-all duration-200 hover:border-[var(--ink)]">
                <div class="flex items-center gap-5 w-full md:w-auto">
                    @if($item['img'])
                        @if(str_contains($item['img'], 'img/'))
                            <img src="{{ asset($item['img']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover border border-[var(--line)] shrink-0">
                        @elseif(file_exists(public_path('storage/menus/' . $item['img'])))
                            <img src="{{ asset('storage/menus/' . $item['img']) }}" alt="{{ $item['name'] }}" class="w-20 h-20 object-cover border border-[var(--line)] shrink-0">
                        @else
                            <div class="w-20 h-20 bg-[var(--cream-deep)] border border-[var(--line)] flex items-center justify-center shrink-0">
                                <i class="fas fa-utensils text-[var(--muted)] text-xl"></i>
                            </div>
                        @endif
                    @else
                        <div class="w-20 h-20 bg-[var(--cream-deep)] border border-[var(--line)] flex items-center justify-center shrink-0">
                            <i class="fas fa-utensils text-[var(--muted)] text-xl"></i>
                        </div>
                    @endif
                    
                    <div>
                        <h3 class="font-display uppercase text-lg text-[var(--ink)] leading-tight">{{ $item['name'] }}</h3>
                        <p class="font-display text-xl text-[var(--orange)] mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <p class="text-[var(--muted)] text-xs uppercase tracking-wider mt-1">Qty: {{ $item['quantity'] }} pcs</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 mt-4 md:mt-0 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 border-[var(--line)] pt-4 md:pt-0">
                    <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-[var(--line)] bg-[var(--cream)]">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        
                        <button type="submit" name="action" value="decrease" 
                            class="h-9 w-9 flex items-center justify-center text-[var(--ink)] hover:bg-[var(--cream-deep)] font-bold border-r border-[var(--line)]">
                            -
                        </button>
                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="50" 
                            class="w-14 h-9 text-center text-[var(--ink)] text-sm font-semibold bg-transparent border-0 focus:outline-none"
                            onchange="if(this.value < 50) { alert('Minimal order adalah 50 pcs per item!'); this.value = 50; } this.form.submit();">
                        <button type="submit" name="action" value="increase" 
                            class="h-9 w-9 flex items-center justify-center text-[var(--ink)] hover:bg-[var(--cream-deep)] font-bold border-l border-[var(--line)]">
                            +
                        </button>
                    </form>
                    
                    <form action="{{ route('cart.remove') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="w-9 h-9 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center" title="Remove Item">
                            <i class="fas fa-trash-alt text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-6 bg-white border border-[var(--line)] p-6">
            <div>
                <p class="eyebrow">Ready to order?</p>
                <p class="text-[var(--muted)] text-sm mt-1">Check your quantity before proceeding to checkout.</p>
            </div>
            <a href="{{ route('checkout') }}" class="btn-solid">
                Proceed to Checkout <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    @else
        <div class="bg-white border border-[var(--line)] p-12 text-center">
            <p class="font-display text-2xl uppercase text-[var(--ink)] mb-3">Keranjangmu Kosong</p>
            <p class="text-[var(--muted)] mb-8">Pilih menu lezat kami untuk memulai pemesanan.</p>
            <a href="{{ route('menu') }}" class="btn-solid">
                Explore Menu <i class="fas fa-utensils text-xs"></i>
            </a>
        </div>
    @endif
</main>
@endsection
