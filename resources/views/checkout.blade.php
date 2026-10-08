@extends('layouts.app')

@section('title', 'Checkout - FourYourCatering')

@section('content')
<main class="max-w-[1280px] mx-auto py-16 px-5 lg:px-8">
    <div class="mb-12">
        <p class="eyebrow mb-3">Payment &amp; Confirmation</p>
        <h2 class="font-display uppercase text-[clamp(2rem,5vw,3.5rem)] leading-[0.95] text-[var(--ink)] mb-4">Complete Your Order</h2>
        <p class="text-[var(--muted)] text-base max-w-xl">Scan the QR code to process your payment immediately. Min order 50 pcs/item.</p>
    </div>

    @if(empty($cart))
    <div class="bg-white border border-[var(--line)] p-12 text-center">
        <p class="text-[var(--muted)] text-lg mb-6">Your cart is empty.</p>
        <a href="{{ route('menu') }}" class="btn-solid">Kembali ke Menu</a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Left Column - Order Summary -->
        <div class="lg:col-span-7 bg-white border border-[var(--line)] p-6 sm:p-8">
            <h3 class="font-display uppercase text-xl text-[var(--ink)] border-b border-[var(--line)] pb-4 mb-6">Order Summary</h3>

            <div class="space-y-4 mb-8">
                @php
                $total = 0;
                $orderDetails = "";
                @endphp
                @foreach($cart as $id => $item)
                @php
                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
                $orderDetails .= "• " . $item['name'] . " (Qty: " . $item['quantity'] . ") - Rp " . number_format($itemTotal, 0, ',', '.') . "%0A";
                @endphp
                <div class="flex justify-between items-center border-b border-[var(--line)] pb-4">
                    <div>
                        <p class="font-display text-base uppercase text-[var(--ink)]">{{ $item['name'] }}</p>
                        <p class="text-xs text-[var(--muted)] mt-1">Qty: {{ $item['quantity'] }} pcs</p>
                    </div>
                    <p class="font-display text-lg text-[var(--ink)]">Rp {{ number_format($itemTotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            <!-- Total Block -->
            <div class="bg-[var(--olive)] text-[var(--cream)] p-6 mb-8 flex justify-between items-center">
                <p class="uppercase tracking-widest text-xs text-[#c4bfa6]">Total Amount</p>
                <p class="font-display text-3xl text-white">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>

            <!-- Payment Method -->
            <div class="mb-8 bg-[var(--cream-deep)] p-6 border border-[var(--line)]">
                <h4 class="font-display uppercase text-sm text-[var(--ink)] mb-3 flex items-center gap-2">
                    <i class="fas fa-wallet text-[var(--orange)]"></i> Payment Method
                </h4>
                <div class="flex items-center gap-4 bg-white p-4 border border-[var(--line)]">
                    <div class="w-10 h-10 bg-[var(--ink)] text-[var(--cream)] flex items-center justify-center font-bold text-sm shrink-0">D</div>
                    <div>
                        <p class="font-bold text-[var(--ink)] text-sm">Dana / E-Wallet</p>
                        <p class="text-[var(--muted)] text-xs font-mono">087758456674</p>
                    </div>
                </div>
            </div>

            @php
            $whatsappMessage = "Halo, saya ingin konfirmasi pembayaran untuk pesanan:%0A%0A" .
            $orderDetails .
            "%0ATotal: Rp " . number_format($total, 0, ',', '.') .
            "%0AMetode Pembayaran: Dana/087758456674" .
            "%0A%0ASaya sudah melakukan pembayaran. Terima kasih!";
            $whatsappNumber = "6287758456674";
            @endphp

            <div class="space-y-3">
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMessage }}"
                    target="_blank"
                    class="btn-solid w-full justify-center text-sm !bg-emerald-700 !border-emerald-700 hover:!bg-emerald-800">
                    <i class="fab fa-whatsapp text-base"></i> Confirm via WhatsApp
                </a>

                <form action="{{ route('checkout.complete') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-outline w-full justify-center text-sm">
                        <i class="fas fa-check-circle"></i> I Have Confirmed Payment
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column - QR Code -->
        <div class="lg:col-span-5 bg-[var(--mustard)] border border-[var(--line)] p-8 text-center flex flex-col items-center">
            <div class="w-12 h-12 bg-[var(--ink)] text-[var(--cream)] flex items-center justify-center mb-4">
                <i class="fas fa-qrcode text-xl"></i>
            </div>
            <h3 class="font-display uppercase text-2xl text-[var(--ink)] mb-2">Scan to Pay</h3>
            <p class="text-[var(--ink)]/80 text-xs mb-6 max-w-xs">Gunakan aplikasi e-wallet / banking favorit Anda untuk memindai QR code.</p>

            <div class="bg-white p-6 border-2 border-[var(--ink)] mb-8 w-full max-w-xs flex items-center justify-center shadow-md">
                <img src="{{ asset('img/qr.jpg') }}"
                    alt="QR Code Pembayaran"
                    class="w-56 h-56 object-contain" />
            </div>

            <div class="w-full border-t border-[var(--ink)]/20 pt-6">
                <p class="font-display uppercase text-xs text-[var(--ink)] tracking-widest mb-3">WhatsApp Confirmation QR</p>
                <div class="bg-white p-3 border border-[var(--ink)] inline-block">
                    @php
                    $whatsappQR = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://wa.me/" . $whatsappNumber . "?text=" . $whatsappMessage;
                    @endphp
                    <img src="{{ $whatsappQR }}" alt="WhatsApp QR Code" class="w-28 h-28">
                </div>
            </div>
        </div>
    </div>
    @endif
</main>
@endsection
