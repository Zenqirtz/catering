@extends('layouts.admin')

@section('title', 'Tambah Menu - FourYourCatering')
@section('page-title', 'Tambah Menu Baru')
@section('page-description', 'Tambahkan menu makanan atau minuman baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white border border-[var(--line)] p-8">
        <h2 class="font-display uppercase text-2xl text-[var(--ink)] mb-6 pb-4 border-b border-[var(--line)]">Tambah Menu Baru</h2>

        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-5">
                <!-- Nama Menu -->
                <div>
                    <label for="name" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Nama Menu</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" step="1" required
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
                        <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Makanan</option>
                        <option value="drink" {{ old('category') == 'drink' ? 'selected' : '' }}>Minuman</option>
                    </select>
                    @error('category')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Gambar</label>
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
                        class="w-full px-4 py-3 text-sm border border-[var(--line)] bg-[var(--cream)] focus:outline-none focus:ring-2 focus:ring-[var(--orange)]">{{ old('description') }}</textarea>
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
                        Simpan Menu
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
