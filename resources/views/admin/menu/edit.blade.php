@extends('layouts.admin')

@section('title', 'Edit Menu - FourYourCatering')
@section('page-title', 'Edit Menu')
@section('page-description', 'Update informasi menu yang sudah ada')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-[var(--line)] p-8">
        <h2 class="font-display uppercase text-2xl text-[var(--ink)] mb-6 pb-4 border-b border-[var(--line)]">Edit Menu</h2>

        <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <!-- Nama Menu -->
                <div>
                    <label for="name" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Nama Menu</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $menu->name) }}" required
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price', $menu->price) }}" min="0" step="1" required
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    @error('price')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Kategori</label>
                    <select id="category" name="category" required
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                        <option value="food" {{ old('category', $menu->category) == 'food' ? 'selected' : '' }}>Makanan</option>
                        <option value="drink" {{ old('category', $menu->category) == 'drink' ? 'selected' : '' }}>Minuman</option>
                    </select>
                    @error('category')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Gambar</label>
                    @if($menu->image)
                        <div class="mb-3 p-3 bg-[var(--cream-deep)] border border-[var(--line)]">
                            <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-28 h-28 object-cover border border-[var(--line)]">
                            <p class="text-[11px] text-[var(--muted)] mt-2 uppercase tracking-wider">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-white focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    @error('image')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Deskripsi (Opsional)</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">{{ old('description', $menu->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 pt-4 border-t border-[var(--line)]">
                    <a href="{{ route('admin.menu.index') }}" class="btn-outline flex-1 justify-center">
                        Batal
                    </a>
                    <button type="submit" class="btn-solid flex-1 justify-center">
                        Update Menu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
