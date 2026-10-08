@extends('layouts.admin')

@section('title', 'Manajemen Menu - FourYourCatering')
@section('page-title', 'Manajemen Menu')
@section('page-description', 'Kelola menu makanan dan minuman untuk katering')

@section('content')
<div class="space-y-6">
    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex space-x-3">
            <a href="{{ route('admin.export.menus') }}?{{ http_build_query(request()->all()) }}" 
               class="btn-outline !py-2.5 !px-4 !text-xs">
                <i class="fas fa-file-export mr-1"></i>
                <span>Export CSV</span>
            </a>
            <a href="{{ route('admin.menu.create') }}" class="btn-solid !py-2.5 !px-4 !text-xs">
                <i class="fas fa-plus"></i>
                <span>Tambahkan Menu</span>
            </a>
        </div>
        
        @if(request()->hasAny(['search', 'category', 'sort']))
        <div class="text-xs text-[var(--ink)] bg-[var(--cream-deep)] border border-[var(--line)] px-4 py-2">
            Filter aktif
            @if(request('search'))
                • Pencarian: "{{ request('search') }}"
            @endif
            @if(request('category'))
                • Kategori: {{ request('category') == 'food' ? 'Makanan' : 'Minuman' }}
            @endif
        </div>
        @endif
    </div>

    <!-- Filters Section -->
    <div class="bg-white border border-[var(--line)] p-6">
        <form action="{{ route('admin.menu.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Cari Menu</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari menu..." 
                           class="w-full pl-9 pr-3 py-2 text-xs border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    <i class="fas fa-search absolute left-3 top-2.5 text-xs text-[var(--muted)]"></i>
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Kategori</label>
                <select name="category" class="w-full px-3 py-2 text-xs border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    <option value="">Semua Kategori</option>
                    <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>Makanan</option>
                    <option value="drink" {{ request('category') == 'drink' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Urutkan</label>
                <select name="sort" class="w-full px-3 py-2 text-xs border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end space-x-2">
                <button type="submit" class="btn-solid !py-2 !px-4 !text-xs flex-1 justify-center">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.menu.index') }}" class="btn-outline !py-2 !px-4 !text-xs justify-center">
                    <i class="fas fa-arrows-rotate"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Menu Grid -->
    @if($menus->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($menus as $menu)
            <div class="bg-white border border-[var(--line)] flex flex-col group transition-all duration-200 hover:border-[var(--ink)]">
                <!-- Image -->
                <div class="relative overflow-hidden aspect-[4/3] bg-[var(--cream-deep)]">
                    @if($menu->image)
                        @if(str_contains($menu->image, 'img/'))
                            <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <img src="{{ Storage::url('menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        @endif
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-utensils text-[var(--muted)] text-3xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-2 left-2">
                        <span class="px-2.5 py-1 text-[0.65rem] font-bold uppercase tracking-widest text-[var(--ink)] border border-[var(--line)] bg-white">
                            {{ $menu->category == 'food' ? 'Makanan' : 'Minuman' }}
                        </span>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="p-5 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-2 gap-2">
                        <h3 class="font-display uppercase text-base text-[var(--ink)] truncate flex-1">{{ $menu->name }}</h3>
                        <span class="font-display text-base text-[var(--orange)]">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </div>
                    @if($menu->description)
                    <p class="text-[var(--muted)] text-xs mb-4 line-clamp-2 flex-grow">{{ $menu->description }}</p>
                    @endif
                    
                    <div class="mt-auto pt-4 border-t border-[var(--line)] flex justify-between items-center">
                        <span class="text-[11px] text-[var(--muted)]">
                            {{ $menu->created_at->diffForHumans() }}
                        </span>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="p-2 border border-[var(--line)] hover:bg-[var(--ink)] hover:text-white text-[var(--ink)] transition-colors text-xs" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')" 
                                    class="p-2 border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition-colors text-xs" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($menus->hasPages())
        <div class="bg-white border border-[var(--line)] p-4 flex flex-col sm:flex-row items-center justify-between gap-4 mt-6 text-xs">
            <div class="text-[var(--muted)]">
                Menampilkan {{ $menus->firstItem() }} - {{ $menus->lastItem() }} dari {{ $menus->total() }} menu
            </div>
            <div class="flex space-x-2">
                @if($menus->onFirstPage())
                    <span class="px-3 py-1.5 bg-gray-200 text-gray-400 cursor-not-allowed">
                        <i class="fas fa-chevron-left mr-1"></i>Prev
                    </span>
                @else
                    <a href="{{ $menus->previousPageUrl() }}" class="px-3 py-1.5 bg-white text-[var(--ink)] border border-[var(--line)] hover:bg-[var(--cream-deep)]">
                        <i class="fas fa-chevron-left mr-1"></i>Prev
                    </a>
                @endif

                @if($menus->hasMorePages())
                    <a href="{{ $menus->nextPageUrl() }}" class="px-3 py-1.5 bg-white text-[var(--ink)] border border-[var(--line)] hover:bg-[var(--cream-deep)]">
                        Next<i class="fas fa-chevron-right ml-1"></i>
                    </a>
                @else
                    <span class="px-3 py-1.5 bg-gray-200 text-gray-400 cursor-not-allowed">
                        Next<i class="fas fa-chevron-right ml-1"></i>
                    </span>
                @endif
            </div>
        </div>
        @endif
    @else
        <div class="text-center py-12 bg-white border border-[var(--line)] p-8">
            <i class="fas fa-utensils text-3xl text-[var(--muted)] mb-3"></i>
            <h3 class="font-display uppercase text-lg text-[var(--ink)] mb-2">
                @if(request()->hasAny(['search', 'category']))
                    Menu tidak ditemukan
                @else
                    Belum ada menu
                @endif
            </h3>
            <p class="text-[var(--muted)] text-sm mb-6 max-w-sm mx-auto">
                @if(request()->hasAny(['search', 'category']))
                    Coba ubah filter pencarian Anda.
                @else
                    Silahkan tambahkan menu baru untuk memulai.
                @endif
            </p>
            @if(request()->hasAny(['search', 'category']))
                <a href="{{ route('admin.menu.index') }}" class="btn-outline">
                    Reset Filter
                </a>
            @else
                <a href="{{ route('admin.menu.create') }}" class="btn-solid">
                    <i class="fas fa-plus mr-1"></i> Tambahkan Menu Pertama
                </a>
            @endif
        </div>
    @endif
</div>
@endsection
