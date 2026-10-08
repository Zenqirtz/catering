<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - FourYourCatering</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: var(--cream); color: var(--ink); }
    .font-display { font-family: 'Archivo', sans-serif; }
    .card-shadow { box-shadow: 0 18px 40px rgba(25, 25, 25, 0.08); }
  </style>
</head>
<body class="min-h-screen bg-[var(--cream)] flex items-center justify-center p-4">
  <div class="w-full max-w-3xl min-h-[560px] bg-white border border-[var(--line)] card-shadow flex flex-col md:flex-row overflow-hidden">
    <!-- Left Side Image -->
    <div class="md:w-1/2 w-full bg-[var(--olive)] flex flex-col items-center justify-center p-8 text-white relative">
      <img src="{{ asset('img/about.png') }}" alt="Login Image" class="w-64 md:w-72 object-cover rounded-xl shadow-lg border-2 border-white/20 select-none">
      <p class="font-display uppercase tracking-widest text-xs mt-6 text-[#e8e2d2]">FourYourCatering</p>
    </div>

    <!-- Right Side Form -->
    <div class="md:w-1/2 w-full p-8 flex flex-col justify-center bg-[var(--cream)]">
      <div class="mb-6 text-center">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering" class="mx-auto h-12 mb-3">
        </a>
        <h2 class="font-display uppercase text-2xl text-[var(--ink)]">Selamat Datang</h2>
        <p class="text-[var(--muted)] text-sm mt-1">Masuk ke akun Anda</p>
      </div>
      
      <!-- Demo Accounts Info -->
      <div class="bg-[var(--cream-deep)] border border-[var(--line)] p-3 mb-4">
        <h3 class="text-xs font-bold text-[var(--ink)] uppercase tracking-wider mb-1">Akun Demo:</h3>
        <div class="text-xs text-[var(--muted)] space-y-1">
          <p><strong>Admin:</strong> admin@foryoucatering.com / admin123</p>
          <p><strong>User Biasa:</strong> Daftar melalui form register</p>
        </div>
      </div>
      
      <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"
                 class="w-full border border-[var(--line)] bg-white p-3 text-sm focus:ring-2 focus:ring-[var(--orange)] focus:outline-none transition"
                 required autocomplete="email">
        </div>
        
        <div>
          <input type="password" name="password" placeholder="Password"
                 class="w-full border border-[var(--line)] bg-white p-3 text-sm focus:ring-2 focus:ring-[var(--orange)] focus:outline-none transition"
                 required autocomplete="current-password">
        </div>
        
        <!-- Error Messages -->
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 p-3">
          <p class="text-xs text-red-600 text-center">{{ $errors->first() }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 border border-red-200 p-3">
          <p class="text-xs text-red-600 text-center">{{ session('error') }}</p>
        </div>
        @endif

        <div class="text-right">
          <a href="{{ route('password.request') }}" class="text-xs text-[var(--muted)] hover:text-[var(--orange)] transition">Lupa Password?</a>
        </div>
        
        <button type="submit" class="btn-solid w-full justify-center">
          Sign In
        </button>
      </form>
      
      <p class="text-xs text-center text-[var(--muted)] mt-6">
        Pengguna Baru?
        <a href="{{ route('register') }}" class="text-[var(--orange)] font-bold hover:underline transition">Buat Akun</a>
      </p>
    </div>
  </div>

  @if(session('success'))
  <div class="fixed top-4 right-4 bg-green-700 text-white px-6 py-3 shadow-lg z-50">
    <div class="flex items-center space-x-2">
      <i class="fas fa-check-circle"></i>
      <span>{{ session('success') }}</span>
    </div>
  </div>
  <script>
    setTimeout(() => {
      const toast = document.querySelector('.fixed.bg-green-700');
      if (toast) toast.remove();
    }, 5000);
  </script>
  @endif

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
