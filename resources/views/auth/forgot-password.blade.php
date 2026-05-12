<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password - ForYourCatering</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card-shadow { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#e3f2fd] to-[#036EA6]/30 flex items-center justify-center p-4">
  <div class="w-full max-w-md bg-white rounded-2xl card-shadow p-8">
      <div class="mb-6 text-center">
        <img src="{{ asset('img/logo.png') }}" alt="ForYourCatering" class="mx-auto h-12 mb-4">
        <h2 class="text-2xl font-bold text-[#036EA6]">Reset Password</h2>
        <p class="text-gray-600 text-sm mt-2">Masukkan email Anda untuk menerima link reset.</p>
      </div>
      
      <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
          <input type="email" name="email" placeholder="Email Terdaftar" value="{{ old('email') }}"
                 class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:border-[#036EA6] focus:outline-none transition"
                 required>
        </div>
        
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
          <p class="text-sm text-red-600 text-center">{{ $errors->first() }}</p>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-3">
          <p class="text-sm text-green-600 text-center">{{ session('success') }}</p>
        </div>
        @endif
        
        <button type="submit"
                class="w-full bg-[#036EA6] hover:bg-[#025a87] text-white py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
          Kirim Link Reset
        </button>
      </form>
      
      <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-[#036EA6] transition">
          <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
        </a>
      </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>