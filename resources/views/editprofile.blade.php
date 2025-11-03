@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-white px-6 py-16">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-3xl p-12 border border-gray-200">
        <!-- Header Profile -->
        <div class="flex items-center space-x-8 mb-10">
            <div class="relative">
                <div class="w-28 h-28 rounded-full bg-gray-200 flex items-center justify-center text-gray-400 text-5xl overflow-hidden">
                    @if($user->photo)
                        <img src="{{ asset('storage/photos/' . $user->photo) }}" alt="Profile Photo" class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Form Edit -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
            @csrf
            <div class="md:col-span-2">
                <label class="block text-base font-medium text-gray-600 mb-2">Foto Profil</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full px-5 py-3 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-400 outline-none">
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-base font-medium text-gray-600 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full px-5 py-3 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-400 outline-none">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-base font-medium text-gray-600 mb-2">Alamat</label>
                <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}"
                    class="w-full px-5 py-3 rounded-lg border border-gray-300 text-gray-700 focus:ring-2 focus:ring-blue-400 outline-none">
                @error('address')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 flex justify-end space-x-4">
                <a href="{{ route('profile') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 ease-in-out">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-700 hover:bg-blue-800 text-white font-semibold px-8 py-3 rounded-lg transition duration-300 ease-in-out">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection