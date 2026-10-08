@extends('layouts.app')

@section('title', 'Edit Profile - FourYourCatering')

@section('content')
<div class="min-h-screen bg-[var(--cream)] px-5 lg:px-8 py-14">
    <div class="max-w-5xl mx-auto bg-white border border-[var(--line)] p-8 sm:p-12 shadow-[0_18px_40px_rgba(25,25,25,0.06)]">
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
                <p class="eyebrow mb-1">Edit Account</p>
                <h2 class="font-display uppercase text-2xl sm:text-3xl text-[var(--ink)] leading-tight">{{ $user->name }}</h2>
                <p class="text-[var(--muted)] text-sm mt-1">{{ $user->email }}</p>
            </div>
        </div>

        <!-- Form Edit -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT') 

            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Foto Profil</label>
                <input type="file" name="photo" accept="image/*"
                    class="w-full p-3 bg-white border border-[var(--line)] text-sm text-[var(--ink)] focus:ring-2 focus:ring-[var(--orange)] outline-none">
                @error('photo')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full p-3 bg-white border border-[var(--line)] text-sm text-[var(--ink)] focus:ring-2 focus:ring-[var(--orange)] outline-none">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full p-3 bg-white border border-[var(--line)] text-sm text-[var(--ink)] focus:ring-2 focus:ring-[var(--orange)] outline-none">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest font-bold text-[var(--muted)] mb-2">Alamat</label>
                <input type="text" name="address" value="{{ old('address', $user->address ?? '') }}"
                    class="w-full p-3 bg-white border border-[var(--line)] text-sm text-[var(--ink)] focus:ring-2 focus:ring-[var(--orange)] outline-none">
                @error('address')
                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-6 border-t border-[var(--line)] flex justify-end gap-4">
                <a href="{{ route('profile') }}" class="btn-outline">
                    Batal
                </a>
                <button type="submit" class="btn-solid">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
