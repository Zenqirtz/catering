@extends('layouts.admin')

@section('title', 'Manajemen Menu - FourYourCatering')
@section('page-title', 'Manajemen Menu')
@section('page-description', 'Kelola menu makanan dan minuman untuk katering')

@section('content')
<div class="space-y-6">
    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex space-x-2">
            <a href="{{ route('admin.export.menus') }}?{{ http_build_query(request()->all()) }}" 
               class="bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition-all font-semibold flex items-center space-x-2 shadow-md hover:shadow-lg">
                <i class="fas fa-file-export"></i>
                <span>Export CSV</span>
            </a>
            <a href="{{ route('admin.menu.create') }}" class="bg-[#036EA6] text-white px-6 py-3 rounded-lg hover:bg-[#025a87] transition-all font-semibold flex items-center space-x-2 shadow-md hover:shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Tambahkan Menu</span>
            </a>
        </div>
        
        <!-- Results Info -->
        @if(request()->hasAny(['search', 'category', 'sort']))
        <div class="text-sm text-gray-600 bg-blue-50 px-4 py-2 rounded-lg">
            Menampilkan hasil filter
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
    <div class="bg-white rounded-xl card-shadow p-6 mb-6">
        <form action="{{ route('admin.menu.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Menu</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari menu..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent transition-all">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>

            <!-- Category Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent transition-all">
                    <option value="">Semua Kategori</option>
                    <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>Makanan</option>
                    <option value="drink" {{ request('category') == 'drink' ? 'selected' : '' }}>Minuman</option>
                </select>
            </div>

            <!-- Sort -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                <select name="sort" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent transition-all">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end space-x-2">
                <button type="submit" class="bg-[#036EA6] text-white px-6 py-2 rounded-lg hover:bg-[#025a87] transition-colors font-semibold flex items-center space-x-2">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
                <a href="{{ route('admin.menu.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition-colors font-semibold flex items-center space-x-2">
                    <i class="fas fa-refresh"></i>
                    <span>Reset</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Menu Grid -->
    @if($menus->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($menus as $menu)
            <div class="bg-white rounded-xl card-shadow overflow-hidden transition-all hover:shadow-lg group">
                <!-- Image -->
                <div class="relative overflow-hidden">
                    @if($menu->image)
                        @if(str_contains($menu->image, 'img/'))
                            <!-- Gambar dari public/img/ -->
                            <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover transition-transform group-hover:scale-105">
                        @else
                            <!-- Gambar dari storage -->
                            <img src="{{ Storage::url('menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-48 object-cover transition-transform group-hover:scale-105">
                        @endif
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                            @if($menu->category == 'food') bg-orange-100 text-orange-800 
                            @else bg-blue-100 text-blue-800 @endif">
                            {{ $menu->category == 'food' ? 'Makanan' : 'Minuman' }}
                        </span>
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="bg-white text-[#036EA6] p-2 rounded-full hover:bg-[#036EA6] hover:text-white transition-all">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')" 
                                    class="bg-white text-red-500 p-2 rounded-full hover:bg-red-500 hover:text-white transition-all">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="p-4">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-900 text-lg truncate flex-1 mr-2">{{ $menu->name }}</h3>
                        <span class="text-[#036EA6] font-bold text-lg">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    </div>
                    @if($menu->description)
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $menu->description }}</p>
                    @endif
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            <i class="far fa-clock mr-1"></i>
                            {{ $menu->created_at->diffForHumans() }}
                        </span>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="bg-[#036EA6] text-white px-3 py-1 rounded-lg hover:bg-[#025a87] transition-all text-sm font-semibold flex items-center space-x-1">
                                <i class="fas fa-edit text-xs"></i>
                                <span>Edit</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($menus->hasPages())
        <div class="bg-white rounded-xl card-shadow p-4 flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
            <div class="text-sm text-gray-700">
                Menampilkan {{ $menus->firstItem() }} - {{ $menus->lastItem() }} dari {{ $menus->total() }} menu
            </div>
            <div class="flex space-x-2">
                @if($menus->onFirstPage())
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed font-semibold">
                        <i class="fas fa-chevron-left mr-2"></i>Previous
                    </span>
                @else
                    <a href="{{ $menus->previousPageUrl() }}" class="px-4 py-2 bg-[#036EA6] text-white rounded-lg hover:bg-[#025a87] transition-colors font-semibold flex items-center">
                        <i class="fas fa-chevron-left mr-2"></i>Previous
                    </a>
                @endif

                @if($menus->hasMorePages())
                    <a href="{{ $menus->nextPageUrl() }}" class="px-4 py-2 bg-[#036EA6] text-white rounded-lg hover:bg-[#025a87] transition-colors font-semibold flex items-center">
                        Next<i class="fas fa-chevron-right ml-2"></i>
                    </a>
                @else
                    <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed font-semibold">
                        Next<i class="fas fa-chevron-right ml-2"></i>
                    </span>
                @endif
            </div>
        </div>
        @endif
    @else
        <div class="col-span-full text-center py-12">
            <div class="bg-white rounded-xl card-shadow p-8 max-w-md mx-auto">
                <div class="fas fa-utensils text-4xl text-gray-300 mb-4"></div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                    @if(request()->hasAny(['search', 'category']))
                        Menu tidak ditemukan
                    @else
                        Belum ada menu
                    @endif
                </h3>
                <p class="text-gray-500 mb-6">
                    @if(request()->hasAny(['search', 'category']))
                        Coba ubah filter pencarian Anda.
                    @else
                        Silahkan tambahkan menu baru untuk memulai.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'category']))
                    <a href="{{ route('admin.menu.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg inline-flex items-center hover:bg-gray-600 transition-colors">
                        <i class="fas fa-refresh mr-2"></i>
                        <span>Reset Filter</span>
                    </a>
                @else
                    <a href="{{ route('admin.menu.create') }}" class="bg-[#036EA6] text-white px-6 py-3 rounded-lg inline-flex items-center hover:bg-[#025a87] transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Tambahkan Menu Pertama</span>
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection