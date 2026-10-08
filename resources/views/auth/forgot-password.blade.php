<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password - FourYourCatering</title>
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
  <div class="w-full max-w-md bg-white border border-[var(--line)] card-shadow p-8">
      <div class="mb-6 text-center">
        <a href="{{ url('/') }}">
          <img src="{{ asset('img/logo.png') }}" alt="FourYourCatering" class="mx-auto h-12 mb-3">
        </a>
        <h2 class="font-display uppercase text-2xl text-[var(--ink)]">Reset Password</h2>
        <p class="text-[var(--muted)] text-sm mt-1">Masukkan email Anda untuk menerima link reset.</p>
      </div>
      
      <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
          <input type="email" name="email" placeholder="Email Terdaftar" value="{{ old('email') }}"
                 class="w-full border border-[var(--line)] bg-white p-3 text-sm focus:ring-2 focus:ring-[var(--orange)] focus:outline-none transition"
                 required>
        </div>
        
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 p-3">
          <p class="text-xs text-red-600 text-center">{{ $errors->first() }}</p>
        </div>
        @endif

        @if(session('success'))
        <div class="bg-green-50 border border-green-200 p-3">
          <p class="text-xs text-green-700 text-center">{{ session('success') }}</p>
        </div>
        @endif
        
        <button type="submit" class="btn-solid w-full justify-center">
          Kirim Link Reset
        </button>
      </form>
      
      <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-xs text-[var(--muted)] hover:text-[var(--orange)] transition">
          <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
        </a>
      </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
