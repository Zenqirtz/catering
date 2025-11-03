@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="min-h-screen flex flex-col justify-center items-center text-center bg-gradient-to-b from-white to-[#f7fbff] px-6 relative overflow-hidden">
  <div data-aos="fade-up" data-aos-duration="1000" class="z-10 max-w-7xl mx-auto">
    <h1 class="text-5xl md:text-6xl font-bold text-[#222] leading-tight mb-6" data-aos="fade-up" data-aos-delay="100">
      Your Favorite Student Meals<br>
      <span class="text-[#036EA6] underline decoration-4 decoration-[#036EA6]/40">
        Delivered Hot & Fresh
      </span>
    </h1>
    <p class="text-[#555] max-w-2xl mx-auto text-lg mb-10" data-aos="fade-up" data-aos-delay="250">
      Best student catering service in town. We're ready to fuel your busy campus life 
      with affordable, tasty, and healthy meals — perfect for every college day.
    </p>
    <a href="{{ url('/menu') }}" 
       class="bg-[#036EA6] text-white font-semibold px-10 py-4 rounded-lg hover:scale-110 hover:shadow-xl transition-all duration-300 inline-block"
       data-aos="zoom-in" data-aos-delay="400">
        See the menus 🍱
    </a>
  </div>

  <!-- Floating decorative circles -->
  <div class="absolute w-64 h-64 bg-[#036EA6]/10 rounded-full blur-3xl -top-10 -left-10 animate-pulse"></div>
  <div class="absolute w-80 h-80 bg-[#036EA6]/20 rounded-full blur-3xl -bottom-10 -right-10 animate-pulse"></div>

 <!-- Scrollable Menu Showcase -->
<div class="relative w-full mt-24 max-w-7xl mx-auto" data-aos="fade-up" data-aos-delay="600">
  <div id="menu-scroll" class="overflow-x-auto scroll-smooth scrollbar-hide px-8 pb-4">
    <div class="flex gap-8 w-max justify-center">
      @foreach (['menu1.png', 'menu2.png', 'menu3.png', 'menu4.png', 'menu5.png', 'menu6.png','menu7.png'] as $img)
        <div class="w-[260px] h-[320px] bg-white rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col items-center border border-gray-100"
             data-aos="zoom-in-up" data-aos-delay="{{ $loop->index * 150 }}">
          <div class="w-full h-[200px] overflow-hidden rounded-t-2xl flex justify-center items-center bg-gray-50">
            <img src="/img/{{ $img }}" 
                 alt="Menu" 
                 class="object-contain w-[220px] h-[180px] hover:scale-110 transition-transform duration-700">
          </div>
          <div class="p-4 text-center flex flex-col justify-center flex-1">
            <p class="text-gray-800 font-semibold text-lg mb-1">Delicious Meal</p>
            <p class="text-gray-500 text-sm">Fresh & affordable</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- gradient sides -->
  <div class="absolute top-0 left-0 w-24 h-full bg-gradient-to-r from-white to-transparent pointer-events-none"></div>
  <div class="absolute top-0 right-0 w-24 h-full bg-gradient-to-l from-white to-transparent pointer-events-none"></div>
</div>

<!-- Scroll Center Script -->
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const scrollContainer = document.getElementById("menu-scroll");
    // Hitung posisi tengah dan geser scroll ke sana
    scrollContainer.scrollLeft = (scrollContainer.scrollWidth - scrollContainer.clientWidth) / 2;
  });
</script>

</section>


<!-- How It Works -->
<section class="bg-white py-24 relative overflow-hidden">
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-[#036EA6]/10 rounded-full blur-3xl animate-pulse"></div>

  <div class="max-w-7xl mx-auto px-6 text-center relative z-10"> <!-- sama lebar dengan About -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-8" data-aos="fade-up">
      How It Works
    </h2>
    <p class="text-lg text-gray-600 mb-16 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="200">
This lesson provides a basic framework for conducting a recipe demonstration.    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
      @foreach ([
        ['Fresh & Nutritious', '01.', 'Offers fresh foods and calculates calories and portion size.'], 
        ['Pick Meals', '02.', 'Select your favorite dishes from our diverse menu options.'], 
        ['Place An Order', '03.', 'Order in just a few clicks — simple, quick, and convenient.'], 
        ['Fast Delivery', '04.', 'We deliver right to your campus doorstep — hot and fresh!']
      ] as [$title, $num, $desc])
        <div class="group bg-[#036EA6] text-white rounded-3xl p-10 text-left shadow-lg 
                    transform transition duration-500 hover:scale-105 
                    hover:-translate-y-3 hover:shadow-2xl hover:bg-[#025a87]
                    relative overflow-hidden" 
             data-aos="fade-up" data-aos-delay="{{ $loop->index * 200 }}">
          
          <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

          <p class="text-2xl font-bold mb-4 opacity-90 relative z-10">{{ $num }}</p>
          <h3 class="text-2xl font-extrabold mb-3 relative z-10">{{ $title }}</h3>
          <p class="text-base text-white/90 leading-relaxed relative z-10">{{ $desc }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>


<!-- About Section -->
<section class="py-24 bg-gradient-to-b from-white to-[#f4faff] relative overflow-hidden">
  <div class="absolute left-0 bottom-0 w-80 h-80 bg-[#036EA6]/10 rounded-full blur-3xl animate-pulse"></div>

  <div class="max-w-7xl mx-auto px-6"> <!-- Sama dengan yang lain -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-12 text-center" data-aos="fade-up">
      About Us
    </h2>

    <div class="flex flex-col lg:flex-row items-stretch gap-10">
      <!-- Left Text Box -->
      <div class="bg-[#036EA6] text-white rounded-2xl p-12 flex flex-col justify-between shadow-xl lg:flex-[1.3]" 
           data-aos="fade-right" data-aos-delay="150">
        <div>
          <h3 class="text-3xl font-bold mb-5">
            FourYourCatering: Catering Murah, Favorit Mahasiswa
          </h3>
          <p class="leading-relaxed mb-8 text-[#E8F7FF] text-base" data-aos="fade-up" data-aos-delay="300">
            Fo  rYourCatering adalah layanan catering yang dirancang khusus untuk memenuhi kebutuhan mahasiswa akan makanan yang lezat, bergizi, dan terjangkau. 
            Kami memahami bahwa kesibukan kuliah sering kali membuat sulit menjaga pola makan sehat—karena itu, FourYourCatering hadir memberikan solusi praktis dengan berbagai pilihan menu harian yang bisa disesuaikan dengan selera dan kebutuhan Anda. 
            Dengan sistem pemesanan yang mudah, pengantaran tepat waktu, dan bahan makanan berkualitas, kami berkomitmen membantu Anda menikmati hidangan bergizi tanpa ribet dan tanpa menguras kantong.
          </p>
        </div>

        <a href="{{ url('/menu') }}" 
           class="inline-block bg-white text-[#036EA6] font-semibold px-6 py-3 rounded-lg hover:scale-110 hover:bg-gray-100 transition shadow-md self-start"
           data-aos="zoom-in" data-aos-delay="450">
          Ayo Pesan Catering Disini!!
        </a>
      </div>

      <!-- Right Image Box -->
      <div class="bg-[#036EA6] rounded-2xl p-6 flex justify-center items-center shadow-lg lg:flex-[1]" 
           data-aos="fade-left" data-aos-delay="300">
        <img src="/img/about.png" alt="About" class="rounded-xl object-cover w-full h-full max-h-[500px] transform hover:scale-105 transition duration-500">
      </div>
    </div>
  </div>
</section>

@endsection
