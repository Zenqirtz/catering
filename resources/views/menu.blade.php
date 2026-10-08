@extends('layouts.app')

@section('title', 'Menu - FourYourCatering')

@section('content')
<main class="max-w-[1280px] mx-auto py-16 px-5 lg:px-8">

    <!-- Special Foods Section -->
    <section class="mb-24">
        <div class="mb-14 max-w-2xl">
            <p class="eyebrow mb-4">Our Menu</p>
            <h2 class="font-display uppercase text-[clamp(2rem,5vw,3.5rem)] leading-[0.95] text-[var(--ink)] mb-5">
                Our Special Foods
            </h2>
            <p class="text-[var(--muted)] text-lg">
                Discover our delicious selection of premium meals, prepared fresh daily to energize your busy day.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($foods as $menu)
            <div class="group bg-white border border-[var(--line)] flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(25,25,25,0.08)]">
                <!-- Image -->
                <div class="relative w-full aspect-[4/3] bg-[var(--cream-deep)] overflow-hidden">
                @if($menu->image)
                    @if(str_contains($menu->image, 'img/'))
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                    @elseif(file_exists(public_path('storage/menus/' . $menu->image)))
                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-utensils text-[var(--muted)] text-2xl"></i>
                        </div>
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-image text-[var(--muted)] text-2xl"></i>
                    </div>
                @endif
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <h3 class="font-display text-lg text-[var(--ink)] leading-tight line-clamp-2 uppercase tracking-tight">{{ $menu->name }}</h3>
                        <div class="flex items-center gap-1 shrink-0 text-[var(--mustard)]">
                            <i class="fas fa-star text-xs"></i>
                            <span class="font-bold text-[var(--ink)] text-xs">4.8</span>
                        </div>
                    </div>
                    <p class="text-[var(--muted)] text-sm mb-5 line-clamp-2 flex-grow">Healthy and delicious meal perfectly crafted for your taste.</p>

                    <div class="mt-auto flex items-end justify-between border-t border-[var(--line)] pt-4">
                        <div>
                            <p class="text-xs text-[var(--muted)] line-through mb-0.5">Rp {{ number_format($menu->price + 5000, 0, ',', '.') }}</p>
                            <p class="font-display text-xl text-[var(--ink)] leading-none">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="menu_{{ $menu->id }}">
                            <input type="hidden" name="name" value="{{ $menu->name }}">
                            <input type="hidden" name="price" value="{{ $menu->price }}">
                            <input type="hidden" name="img" value="{{ $menu->image }}">
                            <button type="submit" class="w-11 h-11 bg-[var(--orange)] text-white flex items-center justify-center hover:bg-[#cf451f] transition-colors" aria-label="Add {{ $menu->name }} to cart">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-[var(--muted)] text-lg">Belum ada menu makanan.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Special Beverages Section -->
    <section class="mb-24">
        <div class="mb-14 max-w-2xl">
            <p class="eyebrow mb-4">Refreshments</p>
            <h2 class="font-display uppercase text-[clamp(2rem,5vw,3.5rem)] leading-[0.95] text-[var(--ink)]">
                Our Special Beverages
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($drinks as $menu)
            <div class="group bg-white border border-[var(--line)] flex flex-col transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_18px_40px_rgba(25,25,25,0.08)]">
                <div class="relative w-full aspect-[4/3] bg-[var(--cream-deep)] overflow-hidden">
                @if($menu->image)
                    @if(str_contains($menu->image, 'img/'))
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                    @elseif(file_exists(public_path('storage/menus/' . $menu->image)))
                        <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-glass-water text-[var(--muted)] text-2xl"></i>
                        </div>
                    @endif
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-image text-[var(--muted)] text-2xl"></i>
                    </div>
                @endif
                </div>

                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <h3 class="font-display text-lg text-[var(--ink)] leading-tight line-clamp-2 uppercase tracking-tight">{{ $menu->name }}</h3>
                        <div class="flex items-center gap-1 shrink-0 text-[var(--mustard)]">
                            <i class="fas fa-star text-xs"></i>
                            <span class="font-bold text-[var(--ink)] text-xs">4.9</span>
                        </div>
                    </div>
                    <p class="text-[var(--muted)] text-sm mb-5 line-clamp-2 flex-grow">Refreshing beverages to pair perfectly with your meals.</p>

                    <div class="mt-auto flex items-end justify-between border-t border-[var(--line)] pt-4">
                        <div>
                            <p class="text-xs text-[var(--muted)] line-through mb-0.5">Rp {{ number_format($menu->price + 2000, 0, ',', '.') }}</p>
                            <p class="font-display text-xl text-[var(--ink)] leading-none">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="menu_{{ $menu->id }}">
                            <input type="hidden" name="name" value="{{ $menu->name }}">
                            <input type="hidden" name="price" value="{{ $menu->price }}">
                            <input type="hidden" name="img" value="{{ $menu->image }}">
                            <button type="submit" class="w-11 h-11 bg-[var(--orange)] text-white flex items-center justify-center hover:bg-[#cf451f] transition-colors" aria-label="Add {{ $menu->name }} to cart">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-[var(--muted)] text-lg">Belum ada menu minuman.</p>
            </div>
            @endforelse
        </div>
    </section>

    <!-- Stats Section -->
    <section class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-[var(--olive)] text-[var(--cream)] p-10 text-center">
            <p class="font-display text-5xl mb-3 text-white">10K+</p>
            <p class="uppercase tracking-widest text-xs text-[#c4bfa6]">Total Customers</p>
        </div>
        <div class="bg-[var(--mustard)] text-[var(--ink)] p-10 text-center">
            <p class="font-display text-5xl mb-3">12K</p>
            <p class="uppercase tracking-widest text-xs text-[var(--ink)]/70">Total Orders</p>
        </div>
    </section>
</main>
@endsection
