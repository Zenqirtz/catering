<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Baru - FourYourCatering</title>
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
        <h2 class="font-display uppercase text-2xl text-[var(--ink)]">Buat Password Baru</h2>
      </div>
      
      <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div>
          <input type="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}"
                 class="w-full border border-[var(--line)] bg-[var(--cream-deep)] p-3 text-sm cursor-not-allowed text-[var(--muted)]"
                 required readonly>
        </div>

        <div>
          <input type="password" name="password" placeholder="Password Baru"
                 class="w-full border border-[var(--line)] bg-white p-3 text-sm focus:ring-2 focus:ring-[var(--orange)] focus:outline-none transition"
                 required autofocus>
        </div>

        <div>
          <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru"
                 class="w-full border border-[var(--line)] bg-white p-3 text-sm focus:ring-2 focus:ring-[var(--orange)] focus:outline-none transition"
                 required>
        </div>
        
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 p-3">
            <ul class="text-xs text-red-600 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <button type="submit" class="btn-solid w-full justify-center">
          Ubah Password
        </button>
      </form>
  </div>
</body>
</html>
