<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - ForYourCatering</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Tailwind CSS sebagai fallback -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card-shadow {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-[#e3f2fd] to-[#036EA6]/30 flex items-center justify-center p-4">
  <div class="w-full max-w-3xl h-[600px] bg-white rounded-2xl card-shadow flex flex-col md:flex-row overflow-hidden">
    <!-- Left Side Image -->
    <div class="md:w-1/2 w-full bg-[#036EA6] flex items-center justify-center p-8">
      <img src="{{ asset('img/about.png') }}" alt="Login Image" class="w-72 md:w-80 drop-shadow-xl select-none rounded-xl">
    </div>
    <!-- Right Side Form -->
    <div class="md:w-1/2 w-full p-8 flex flex-col justify-center">
      <div class="mb-6 text-center">
        <img src="{{ asset('img/logo.png') }}" alt="ForYourCatering" class="mx-auto h-14 mb-4">
        <h2 class="text-2xl font-bold text-[#036EA6]">Selamat Datang</h2>
        <p class="text-gray-600 text-sm mt-2">Masuk ke akun Anda</p>
      </div>
      
      <!-- Demo Accounts Info -->
      <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
        <h3 class="text-xs font-semibold text-blue-800 mb-1">Akun Demo:</h3>
        <div class="text-xs text-blue-700 space-y-1">
          <p><strong>Admin:</strong> admin@foryoucatering.com / admin123</p>
          <p><strong>User Biasa:</strong> Daftar melalui form register</p>
        </div>
      </div>
      
      <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                 class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:border-[#036EA6] focus:outline-none transition"
                 required autocomplete="email">
        </div>
        
        <div>
          <input type="password" name="password" placeholder="Password"
                 class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:border-[#036EA6] focus:outline-none transition"
                 required autocomplete="current-password">
        </div>
        
        <!-- Error Messages -->
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
          <p class="text-sm text-red-600 text-center">{{ $errors->first() }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
          <p class="text-sm text-red-600 text-center">{{ session('error') }}</p>
        </div>
        @endif

        <div class="text-right">
  <!-- Mengarah ke route password.request -->
        <a href="{{ route('password.request') }}" class="text-sm text-[#036EA6] hover:underline transition">Lupa Password?</a>
      </div>
        
        <button type="submit"
                class="w-full bg-[#036EA6] hover:bg-[#025a87] text-white py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
          Sign In
        </button>
      </form>
      
      <p class="text-sm text-center text-gray-600 mt-6">
        Pengguna Baru?
        <a href="{{ route('register') }}" class="text-[#036EA6] hover:underline font-medium transition">Buat Akun</a>
      </p>
    </div>
  </div>

  <!-- Success Message (jika ada dari redirect) -->
  @if(session('success'))
  <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center space-x-2">
      <i class="fas fa-check-circle"></i>
      <span>{{ session('success') }}</span>
    </div>
  </div>
  <script>
    setTimeout(() => {
      const toast = document.querySelector('.fixed.bg-green-500');
      if (toast) toast.remove();
    }, 5000);
  </script>
  @endif

  <!-- Font Awesome untuk icons -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>