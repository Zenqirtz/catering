@extends('layouts.app')

@section('title', 'My Order - FourYourCatering')

@section('content')
<main class="max-w-[1280px] mx-auto py-16 px-5 lg:px-8">
    <div class="mb-12">
        <p class="eyebrow mb-3">Order Tracking</p>
        <h2 class="font-display uppercase text-[clamp(2rem,5vw,3.5rem)] leading-[0.95] text-[var(--ink)]">My Orders</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 p-4 mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 p-4 mb-6 text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="bg-white border border-[var(--line)] p-12 text-center">
            <p class="text-[var(--muted)] text-lg mb-6">Anda belum memiliki pesanan.</p>
            <a href="{{ route('menu') }}" class="btn-solid">Pesan Sekarang</a>
        </div>
    @else
        <div class="bg-white border border-[var(--line)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[var(--cream-deep)] border-b border-[var(--line)] text-xs font-bold uppercase tracking-widest text-[var(--ink)]">
                            <th class="p-4 sm:p-5">Description</th>
                            <th class="p-4 sm:p-5">Qty</th>
                            <th class="p-4 sm:p-5">Date</th>
                            <th class="p-4 sm:p-5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--line)] text-sm">
                        @foreach($orders as $order)
                            @foreach($order->items as $index => $item)
                            <tr class="hover:bg-[var(--cream)]/50 transition-colors">
                                <td class="p-4 sm:p-5 font-medium text-[var(--ink)]">
                                    {{ $item->product_name }}
                                </td>
                                <td class="p-4 sm:p-5 text-[var(--muted)] font-mono">{{ $item->quantity }}</td>
                                @if($index === 0)
                                <td class="p-4 sm:p-5 text-[var(--muted)] font-mono text-xs" rowspan="{{ count($order->items) }}">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="p-4 sm:p-5" rowspan="{{ count($order->items) }}">
                                    <span class="inline-block text-[0.7rem] uppercase font-bold tracking-widest px-3 py-1 border
                                        @if($order->status == 'pending') bg-gray-100 text-gray-800 border-gray-300
                                        @elseif($order->status == 'process') bg-[var(--mustard)]/20 text-[var(--ink)] border-[var(--mustard)]
                                        @elseif($order->status == 'invalid') bg-red-100 text-red-800 border-red-300
                                        @elseif($order->status == 'done') bg-[var(--olive)] text-white border-[var(--olive)]
                                        @else bg-gray-100 text-gray-700 border-gray-300 @endif">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</main>
@endsection
