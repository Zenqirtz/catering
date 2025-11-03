@extends('layouts.app')

@section('title', 'Checkout - FourYourCatering')

@section('content')
<main class="max-w-6xl mx-auto py-8 px-6">

    <h2 class="text-3xl font-bold mb-8 text-center">Scan QR untuk melakukan pembayaran</h2>
    <p class="text-center text-gray-600 mb-8">
        Pesanan akan diproses langsung jika sudah melakukan konfirmasi pembayaran
    </p>

    @if(empty($cart))
        <p class="text-center text-gray-500">Your cart is empty.</p>
        <div class="text-center mt-4">
            <a href="{{ route('menu') }}" class="text-[#036EA6] hover:underline">Kembali ke Menu</a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Order Details -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Pesanan Saya</h3>
                
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
                    <div class="flex justify-between items-center border-b pb-3">
                        <div>
                            <p class="font-semibold">{{ $item['name'] }}</p>
                            <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="font-semibold">Rp {{ number_format($itemTotal, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>

                <!-- Total -->
                <div class="flex justify-between items-center border-t pt-4 mb-6">
                    <p class="text-lg font-bold">Total</p>
                    <p class="text-lg font-bold">Rp {{ number_format($total, 0, ',', '.') }}</p>
                </div>

                <!-- Payment Method -->
                <div class="mb-6">
                    <h4 class="font-bold mb-2">Metode Pembayaran*</h4>
                    <p class="bg-gray-100 p-3 rounded">Dana/087758456674</p>
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
                   class="block w-full bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition duration-200 font-semibold text-center mb-4">
                    Konfirmasi Pembayaran via WhatsApp
                </a>

                <!-- Tombol Selesai -->
                <form action="{{ route('checkout.complete') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#036EA6] text-white py-3 rounded-lg hover:bg-[#025a87] transition duration-200 font-semibold">
                        Selesai (Saya Sudah Konfirmasi)
                    </button>
                </form>
            </div>

            <!-- Right Column - QR Code -->
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4 text-center">Scan QR Code</h3>
                <div class="flex justify-center mb-4">
                    <!-- Placeholder untuk QR Code -->
                    <div class="w-64 h-64 bg-gray-200  flex items-center justify-center rounded-lg">
                        <p class="text-gray-500 text-center">
                            QR Code akan muncul disini<br>
                            (Implementasi QR code)
                        </p>
                    </div>
                </div>
                <p class="text-center text-sm text-gray-600 mb-6">
                    Scan QR code di atas untuk melakukan pembayaran
                </p>
                
                <!-- QR code untuk WhatsApp -->
                <div class="text-center">
                    <p class="text-sm text-gray-600 mb-2">Atau scan untuk konfirmasi WhatsApp</p>
                    @php
                        $whatsappQR = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://wa.me/" . $whatsappNumber . "?text=" . $whatsappMessage;
                    @endphp
                    <img src="{{ $whatsappQR }}" alt="WhatsApp QR Code" class="mx-auto w-32 h-32">
                </div>
            </div>
        </div>

    @endif
</main>
@endsection