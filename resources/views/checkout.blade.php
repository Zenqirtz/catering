@extends('layouts.app')

@section('title', 'Checkout - FourYourCatering')

@section('content')
<main class="max-w-6xl mx-auto py-16 px-6">
    <div class="text-center mb-12">
        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-[#036EA6] font-bold text-sm tracking-widest uppercase mb-4 border border-blue-100">Payment</span>
        <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">Complete Your Order</h2>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto">Scan the QR code to process your payment immediately.</p>
    </div>

    <div class="bg-blue-50/50 backdrop-blur-sm border border-blue-100/50 rounded-2xl p-4 mb-10 max-w-2xl mx-auto flex items-center justify-center gap-3 shadow-sm">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-[#036EA6] shrink-0">
            <i class="fas fa-info-circle text-lg"></i>
        </div>
        <p class="text-blue-800 font-medium">
            Minimum order is 50 pcs per item. Orders will be processed right after payment confirmation.
        </p>
    </div>

    @if(empty($cart))
    <p class="text-center text-gray-500">Your cart is empty.</p>
    <div class="text-center mt-4">
        <a href="{{ route('menu') }}" class="text-[#036EA6] hover:underline">Kembali ke Menu</a>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Left Column - Order Details -->
        <div class="bg-white border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] rounded-[2rem] p-8">
            <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b border-gray-100 pb-4">Order Summary</h3>

            <div class="space-y-4 mb-6">
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
                <div class="flex justify-between items-center border-b border-gray-50 pb-4">
                    <div>
                        <p class="font-bold text-gray-800 text-lg">{{ $item['name'] }}</p>
                        <p class="text-sm font-medium text-gray-500 bg-gray-50 inline-block px-2 py-1 rounded mt-1">Qty: {{ $item['quantity'] }}</p>
                    </div>
                    <p class="font-extrabold text-gray-900">Rp {{ number_format($itemTotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="bg-gray-50 rounded-2xl p-6 mb-8 flex justify-between items-center border border-gray-100">
                <p class="text-xl font-bold text-gray-600">Total Amount</p>
                <p class="text-3xl font-extrabold text-[#036EA6]">Rp {{ number_format($total, 0, ',', '.') }}</p>
            </div>

            <!-- Payment Method -->
            <div class="mb-8 bg-blue-50/50 p-6 rounded-2xl border border-blue-100/50">
                <h4 class="font-bold text-gray-800 mb-3 text-lg flex items-center gap-2">
                    <i class="fas fa-wallet text-[#036EA6]"></i> Payment Method
                </h4>
                <div class="flex items-center gap-4 bg-white p-4 rounded-xl border border-blue-100">
                    <div class="w-12 h-12 bg-[#036EA6] rounded-full flex items-center justify-center text-white font-bold shrink-0">D</div>
                    <div>
                        <p class="font-bold text-gray-900">Dana / E-Wallet</p>
                        <p class="text-gray-500 text-sm font-medium">087758456674</p>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Confirm Button -->
            @php
            // Format pesan WhatsApp
            $whatsappMessage = "Halo, saya ingin konfirmasi pembayaran untuk pesanan:%0A%0A" .
            $orderDetails .
            "%0ATotal: Rp " . number_format($total, 0, ',', '.') .
            "%0AMetode Pembayaran: Dana/087758456674" .
            "%0A%0ASaya sudah melakukan pembayaran. Terima kasih!";
            $whatsappNumber = "6287758456674"; // Format internasional dari 087758456674
            @endphp

            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ $whatsappMessage }}"
                target="_blank"
                class="flex items-center justify-center gap-2 w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-4 rounded-full hover:-translate-y-1 transition-all duration-300 font-bold text-lg shadow-[0_8px_20px_rgba(34,197,94,0.3)] mb-4">
                <i class="fab fa-whatsapp text-2xl"></i> Confirm via WhatsApp
            </a>

            <!-- Tombol Selesai -->
            <form action="{{ route('checkout.complete') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-white border-2 border-gray-200 text-gray-700 py-4 rounded-full hover:bg-gray-50 hover:border-gray-300 transition duration-300 font-bold text-lg flex items-center justify-center gap-2">
                    <i class="fas fa-check-circle"></i> I Have Confirmed Payment
                </button>
            </form>
        </div>

        <!-- Right Column - QR Code -->
        <div class="bg-white border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] rounded-[2rem] p-8 flex flex-col items-center justify-center text-center">
            <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center text-[#036EA6] mb-6">
                <i class="fas fa-qrcode text-2xl"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2 text-gray-800">Scan to Pay</h3>

            <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 mb-8 w-full max-w-sm flex items-center justify-center shadow-inner">
                <img src="{{ asset('img/qr.jpg') }}"
                    alt="QR Code Pembayaran"
                    class="w-64 h-64 object-contain rounded-xl mix-blend-multiply" />
            </div>

            <div class="w-full h-px bg-gray-100 mb-8 relative">
                <span class="absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-4 text-sm font-bold text-gray-400 uppercase tracking-wider">OR</span>
            </div>

            <!-- QR code untuk WhatsApp -->
            <div class="text-center w-full">
                <p class="font-bold text-gray-800 mb-4">Scan for WhatsApp Confirmation</p>
                <div class="bg-green-50 p-4 rounded-2xl border border-green-100 inline-block shadow-sm">
                    @php
                    $whatsappQR = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://wa.me/" . $whatsappNumber . "?text=" . $whatsappMessage;
                    @endphp
                    <img src="{{ $whatsappQR }}" alt="WhatsApp QR Code" class="w-32 h-32 mix-blend-multiply">
                </div>
            </div>
        </div>
    </div>

    @endif
</main>
@endsection