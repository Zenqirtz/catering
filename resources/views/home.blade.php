@extends('layouts.app')

@section('title', 'FourYourCatering — Epicurean Buffet Experience')

@section('content')

@php
    // Gambar-gambar yang tersedia untuk kolase (memakai path yang benar-benar ada)
    $heroMain = 'storage/menus/1763303727_Gemini_Generated_Image_3pkxo93pkxo93pkx 1 (2).png';
    $heroSecondary = 'storage/menus/1763303808_Chicken Fillet (2).png';
    $heroTertiary = 'storage/menus/1763303827_Chicken Katsu (4).png';
    $collage1 = 'storage/menus/1763303931_10f94ad1cc39544.1629705002 1 (1).png';
    $collage2 = 'storage/menus/1763303950_19252bf850c4d1c04d60c30459e26f4d 1 (1).png';
    $collage3 = 'storage/menus/1763303876_Gemini_Generated_Image_j4x5c7j4x5c7j4x5 1 (2).png';
@endphp

<!-- ================= HERO ================= -->
<section class="relative bg-[var(--cream)] pt-12 lg:pt-20 pb-16">
    <div class="max-w-[1280px] mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">

            <!-- Left: Headline -->
            <div class="lg:col-span-5 lg:pt-6">
                <p class="eyebrow mb-6">Wedding &amp; Event Catering</p>
                <h1 class="font-display uppercase leading-[0.92] text-[clamp(2.75rem,7vw,5.25rem)] text-[var(--ink)]">
                    Epicurean<br>
                    Buffet<br>
                    <span class="font-serif-accent normal-case text-[var(--olive)] text-[1.08em] tracking-normal">Experience</span>
                </h1>

                <div class="mt-9 flex flex-wrap items-center gap-4">
                    <a href="{{ url('/menu') }}" class="btn-solid">
                        Explore Our Offerings <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                    <a href="#packages" class="btn-outline">Our Packages</a>
                </div>

                <p class="mt-10 text-[var(--muted)] leading-relaxed max-w-md">
                    Embark on a culinary journey with FourYourCatering — an exquisite fusion of art and flavor.
                    Our Epicurean Buffet Experience promises not just a meal, but a symphony of taste, where
                    passion meets precision, creating memories beyond the plate.
                </p>

                <!-- Small trust line (text, not floating glass badges) -->
                <div class="mt-9 flex items-center gap-8 border-t border-[var(--line)] pt-6">
                    <div>
                        <p class="font-display text-2xl text-[var(--ink)]">120+</p>
                        <p class="text-xs uppercase tracking-widest text-[var(--muted)] mt-1">Events Served</p>
                    </div>
                    <div class="w-px h-10 bg-[var(--line)]"></div>
                    <div>
                        <p class="font-display text-2xl text-[var(--ink)]">4.9<span class="text-sm align-top text-[var(--muted)]">/5</span></p>
                        <p class="text-xs uppercase tracking-widest text-[var(--muted)] mt-1">Client Rating</p>
                    </div>
                    <div class="w-px h-10 bg-[var(--line)]"></div>
                    <div>
                        <p class="font-display text-2xl text-[var(--ink)]">100%</p>
                        <p class="text-xs uppercase tracking-widest text-[var(--muted)] mt-1">Fresh Daily</p>
                    </div>
                </div>
            </div>

            <!-- Right: Image collage -->
            <div class="lg:col-span-7 relative">
                <div class="relative">
                    <!-- Main tall image -->
                    <div class="relative overflow-hidden aspect-[4/3] lg:aspect-[16/12]">
                        <img src="{{ asset($heroMain) }}"
                             onerror="this.onerror=null;this.src='{{ asset('img/menu1.png') }}'"
                             alt="Epicurean buffet spread"
                             class="w-full h-full object-cover">
                        <!-- Orange label tag -->
                        <span class="absolute top-0 right-0 bg-[var(--orange)] text-white text-[0.7rem] font-bold uppercase tracking-widest px-5 py-3">
                            Explore Our Offerings
                        </span>
                    </div>

                    <!-- Bottom strip: two images + circular stamp -->
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div class="overflow-hidden aspect-[16/10]">
                            <img src="{{ asset($collage3) }}"
                                 onerror="this.onerror=null;this.src='{{ asset('img/menu3.png') }}'"
                                 alt="Plated dish"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="overflow-hidden aspect-[16/10]">
                            <img src="{{ asset($heroSecondary) }}"
                                 onerror="this.onerror=null;this.src='{{ asset('img/menu2.png') }}'"
                                 alt="Buffet detail"
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Circular rotating stamp (Wedding & Event Catering) -->
                    <div class="hidden sm:flex absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-28 h-28 lg:w-32 lg:h-32 rounded-full bg-[var(--olive)] items-center justify-center shadow-[0_12px_30px_rgba(25,25,25,0.25)] ring-4 ring-[var(--cream)]">
                        <svg viewBox="0 0 100 100" class="w-full h-full animate-spin-slow">
                            <defs>
                                <path id="circlePath" d="M 50, 50 m -36, 0 a 36,36 0 1,1 72,0 a 36,36 0 1,1 -72,0"/>
                            </defs>
                            <text class="fill-[#e8e2d2]" style="font-size:7.4px; letter-spacing:1.6px; font-family:'Archivo',sans-serif; font-weight:700; text-transform:uppercase;">
                                <textPath href="#circlePath" startOffset="0%">Wedding &amp; Event Catering • FourYourCatering • </textPath>
                            </text>
                        </svg>
                        <span class="absolute text-[var(--mustard)]"><i class="fas fa-utensils text-lg"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= PACKAGES ================= -->
<section id="packages" class="bg-white border-y border-[var(--line)] py-20 lg:py-24">
    <div class="max-w-[1280px] mx-auto px-5 lg:px-8">

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-12">
            <div>
                <p class="eyebrow mb-4">Curated For Every Occasion</p>
                <h2 class="font-display uppercase text-[clamp(2rem,4.5vw,3.25rem)] leading-[0.95] text-[var(--ink)]">
                    Our Packages
                </h2>
            </div>
            <a href="{{ url('/menu') }}" class="btn-solid shrink-0">
                View More <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        @php
            $packages = [
                [
                    'name' => 'Signature Feast',
                    'img'  => 'img/menu4.png',
                    'fallback' => 'img/menu1.png',
                    'price' => '39.99',
                    'pax' => '20–50 guests',
                    'details' => '3 appetizers, 3 main courses, 3 condiments, 3 desserts',
                    'tag' => 'Most Popular',
                ],
                [
                    'name' => 'Gourmet Vaganza',
                    'img'  => 'img/menu5.png',
                    'fallback' => 'img/menu2.png',
                    'price' => '49.99',
                    'pax' => '30–80 guests',
                    'details' => '3 appetizers, 4 main courses, 3 condiments, 3 desserts',
                    'tag' => null,
                ],
                [
                    'name' => 'Premium Culinary',
                    'img'  => 'img/menu6.png',
                    'fallback' => 'img/menu3.png',
                    'price' => '69.99',
                    'pax' => '50–100 guests',
                    'details' => '3 appetizers, 5 main courses, 4 condiments, 3 desserts',
                    'tag' => null,
                ],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
            @foreach ($packages as $pkg)
            <article class="group flex flex-col border border-[var(--line)] bg-[var(--cream)] overflow-hidden">
                <!-- Image -->
                <div class="relative aspect-[4/3] overflow-hidden">
                    <img src="{{ asset($pkg['img']) }}"
                         onerror="this.onerror=null;this.src='{{ asset($pkg['fallback']) }}'"
                         alt="{{ $pkg['name'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @if($pkg['tag'])
                    <span class="absolute top-0 left-0 bg-[var(--mustard)] text-[var(--ink)] text-[0.65rem] font-bold uppercase tracking-widest px-4 py-2">
                        {{ $pkg['tag'] }}
                    </span>
                    @endif
                </div>

                <!-- Orange title bar -->
                <div class="bg-[var(--orange)] px-6 py-4">
                    <h3 class="font-display text-xl text-white uppercase tracking-tight">{{ $pkg['name'] }}</h3>
                </div>

                <!-- Olive info block -->
                <div class="bg-[var(--olive)] text-[#eae6d5] px-6 py-6 flex flex-col flex-grow">
                    <dl class="space-y-3 text-sm">
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="uppercase tracking-widest text-[0.68rem] text-[#c4bfa6]">Price</dt>
                            <dd class="font-bold text-white text-base">${{ $pkg['price'] }} <span class="font-normal text-[0.7rem] text-[#c4bfa6]">/ person</span></dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="uppercase tracking-widest text-[0.68rem] text-[#c4bfa6]">Pax Range</dt>
                            <dd class="font-semibold text-white">{{ $pkg['pax'] }}</dd>
                        </div>
                        <div class="pt-3 border-t border-white/15">
                            <dt class="uppercase tracking-widest text-[0.68rem] text-[#c4bfa6] mb-2">Details</dt>
                            <dd class="leading-relaxed text-[#e0dcc8]">{{ $pkg['details'] }}</dd>
                        </div>
                    </dl>

                    <a href="{{ url('/menu') }}" class="btn-yellow justify-center mt-7 w-full">
                        Book This Package
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= GALLERY STRIP ================= -->
<section class="bg-[var(--cream)] py-20 lg:py-24">
    <div class="max-w-[1280px] mx-auto px-5 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 mb-10">
            <div>
                <p class="eyebrow mb-4">A Taste Of Our Work</p>
                <h2 class="font-display uppercase text-[clamp(1.75rem,3.5vw,2.5rem)] leading-[0.95] text-[var(--ink)]">
                    From The Kitchen
                </h2>
            </div>
            <a href="{{ url('/menu') }}" class="text-[var(--ink)] font-bold uppercase tracking-widest text-xs border-b-2 border-[var(--orange)] pb-1 hover:text-[var(--orange)] transition-colors shrink-0">
                Explore More Photos
            </a>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4">
            @foreach ([$collage1, $collage2, $heroTertiary, 'img/menu7.png'] as $i => $img)
            <div class="relative overflow-hidden {{ $i === 0 ? 'aspect-[3/4] lg:aspect-auto lg:row-span-2 lg:h-full' : 'aspect-square' }}">
                <img src="{{ asset($img) }}"
                     onerror="this.onerror=null;this.src='{{ asset('img/menu' . (($i % 4) + 1) . '.png') }}'"
                     alt="Catering dish {{ $i + 1 }}"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================= YELLOW CTA ================= -->
<section class="bg-[var(--mustard)]">
    <div class="max-w-[1280px] mx-auto px-5 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-8">
                <h2 class="font-display uppercase text-[clamp(2rem,5vw,3.75rem)] leading-[0.95] text-[var(--ink)]">
                    Explore Packages<br>
                    And Reserve<br>
                    <span class="font-serif-accent normal-case text-[var(--olive)] text-[1.05em] tracking-normal">Your Feast.</span>
                </h2>
            </div>
            <div class="lg:col-span-4 lg:text-right">
                <a href="{{ url('/menu') }}" class="btn-solid">
                    Book Now <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <p class="mt-5 text-[var(--ink)]/70 text-sm max-w-xs lg:ml-auto">
                    Tell us your date, guest count and preferences — we'll craft the rest.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin-slow {
        animation: spin-slow 22s linear infinite;
    }
</style>

@endsection
