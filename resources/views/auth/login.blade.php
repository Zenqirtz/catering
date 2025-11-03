<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - ForYourCatering</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#e3f2fd] to-[#036EA6]/30 flex items-center justify-center">
  <div class="w-full max-w-3xl h-[600px] bg-white rounded-2xl shadow-xl flex flex-col md:flex-row overflow-hidden">
    <!-- Left Side Image -->
    <div class="md:w-1/2 w-full bg-[#036EA6] flex items-center justify-center p-8">
      <img src="{{ asset('img/about.png') }}" alt="Login Image" class="w-72 md:w-80 drop-shadow-xl select-none rounded-xl">
    </div>
    <!-- Right Side Form -->
    <div class="md:w-1/2 w-full p-8 flex flex-col justify-center">
      <div class="mb-6 text-center">
        <img src="{{ asset('img/logo.png') }}" alt="ForYourCatering" class="mx-auto h-14 mb-4">
        <h2 class="text-2xl font-bold text-[#036EA6]">Selamat Datang</h2>
      </div>
      
      <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <input type="email" name="email" placeholder="Email"
               class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:outline-none">
        <input type="password" name="password" placeholder="Password"
               class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-[#036EA6] focus:outline-none">
        <div class="text-right">
          <a href="#" class="text-sm text-[#036EA6] hover:underline">Lupa Password?</a>
        </div>
        <button type="submit"
                class="w-full bg-[#036EA6] hover:bg-[#025a87] text-white py-3 rounded-lg font-semibold transition duration-300">
          Sign In
        </button>
      </form>
      <p class="text-sm text-center text-gray-600 mt-6">
        Pengguna Baru?
        <a href="{{ route('register') }}" class="text-[#036EA6] hover:underline font-medium">Buat Akun</a>
      </p>
    </div>
  </div>
</body>
</html>
