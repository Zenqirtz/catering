<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Baru - ForYourCatering</title>
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
        <h2 class="text-2xl font-bold text-[#036EA6]">Buat Password Baru</h2>
      </div>
      
      <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div>
          <input type="email" name="email" placeholder="Email" value="{{ $email ?? old('email') }}"
                 class="w-full border border-gray-300 rounded-lg p-3 bg-gray-100 cursor-not-allowed"
                 required readonly>
        </div>

        <div>
          <input type="password" name="password" placeholder="Password Baru"
                 class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:border-[#036EA6] focus:outline-none transition"
                 required autofocus>
        </div>

        <div>
          <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru"
                 class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:border-[#036EA6] focus:outline-none transition"
                 required>
        </div>
        
        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
            <ul class="text-sm text-red-600 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <button type="submit"
                class="w-full bg-[#036EA6] hover:bg-[#025a87] text-white py-3 rounded-lg font-semibold transition duration-300 transform hover:scale-[1.02] active:scale-[0.98]">
          Ubah Password
        </button>
      </form>
  </div>
</body>
</html>