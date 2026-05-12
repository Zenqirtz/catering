@extends('layouts.app')

@section('title', 'My Order - FourYourCatering')

@section('content')
<main class="max-w-6xl mx-auto py-8 px-6">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    <h2 class="text-3xl font-bold mb-8 text-center">My Order</h2>

    @if($orders->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg">Anda belum memiliki pesanan.</p>
            <a href="{{ route('menu') }}" class="text-[#036EA6] hover:underline mt-4 inline-block">Pesan Sekarang</a>
        </div>
    @else
        <!-- Orders Table -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($orders as $order)
                        @foreach($order->items as $index => $item)
                        <tr class="{{ $loop->parent->index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $item->product_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                            @if($index === 0)
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" rowspan="{{ count($order->items) }}">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap" rowspan="{{ count($order->items) }}">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($order->status == 'pending') bg-gray-100 text-gray-800
                                    @elseif($order->status == 'invalid') bg-red-100 text-red-800
                                    @elseif($order->status == 'process') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'done') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
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
    @endif
</main>
@endsection