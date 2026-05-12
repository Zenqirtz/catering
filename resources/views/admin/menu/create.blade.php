@extends('layouts.admin')

@section('title', 'Tambah Menu - FourYourCatering')
@section('page-title', 'Tambah Menu Baru')
@section('page-description', 'Tambahkan menu makanan atau minuman baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-[#036EA6] mb-6">Tambah Menu Baru</h2>

        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <!-- Nama Menu -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Menu</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" step="1" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select id="category" name="category" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent">
                        <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Makanan</option>
                        <option value="drink" {{ old('category') == 'drink' ? 'selected' : '' }}>Minuman</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#036EA6] file:text-white hover:file:bg-[#025a87]">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi (Opsional)</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#036EA6] focus:border-transparent">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 pt-4">
                    <a href="{{ route('admin.menu.index') }}" class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition text-center font-semibold">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-[#036EA6] text-white px-6 py-3 rounded-lg hover:bg-[#025a87] transition font-semibold">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection