@extends('layouts.admin')

@section('title', 'Admin Dashboard - FourYourCatering')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview sistem dan statistik pesanan')

@section('content')
<div class="space-y-8">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pesanan Aktif -->
        <div class="bg-gradient-to-tr from-[#036EA6] to-[#00A3FF] rounded-2xl p-6 text-white shadow-[0_10px_20px_rgba(3,110,166,0.2)] flex items-center justify-between group hover:-translate-y-1 transition-transform">
            <div>
                <h3 class="text-sm font-medium opacity-90 mb-1 uppercase tracking-wider">Total Pesanan Aktif</h3>
                <p class="text-4xl font-extrabold">{{ $totalActiveOrders }}</p>
                <p class="text-xs opacity-75 mt-2">Sedang diproses</p>
            </div>
            <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                <i class="fas fa-shopping-cart text-2xl"></i>
            </div>
        </div>

        <!-- Total Pesanan Selesai -->
        <div class="bg-white rounded-2xl p-6 text-gray-800 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex items-center justify-between group hover:-translate-y-1 transition-transform">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1 uppercase tracking-wider">Total Pesanan Selesai</h3>
                <p class="text-4xl font-extrabold text-green-500">{{ $totalCompletedOrders }}</p>
                <p class="text-xs text-gray-400 mt-2">Telah selesai</p>
            </div>
            <div class="bg-green-50 p-4 rounded-xl group-hover:bg-green-100 transition-colors">
                <i class="fas fa-check-circle text-2xl text-green-500"></i>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white rounded-2xl p-6 text-gray-800 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex items-center justify-between group hover:-translate-y-1 transition-transform">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1 uppercase tracking-wider">Total Pendapatan</h3>
                <p class="text-3xl font-extrabold text-[#036EA6]">Rp {{ number_format($currentMonthRevenue, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-400 mt-2">Bulan ini</p>
            </div>
            <div class="bg-blue-50 p-4 rounded-xl group-hover:bg-blue-100 transition-colors">
                <i class="fas fa-wallet text-2xl text-[#036EA6]"></i>
            </div>
        </div>

        <!-- Pelanggan Baru -->
        <div class="bg-white rounded-2xl p-6 text-gray-800 border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] flex items-center justify-between group hover:-translate-y-1 transition-transform">
            <div>
                <h3 class="text-sm font-medium text-gray-500 mb-1 uppercase tracking-wider">Pelanggan Baru</h3>
                <p class="text-4xl font-extrabold text-purple-500">{{ $newCustomersThisMonth }}</p>
                <p class="text-xs text-gray-400 mt-2">Bulan ini</p>
            </div>
            <div class="bg-purple-50 p-4 rounded-xl group-hover:bg-purple-100 transition-colors">
                <i class="fas fa-users text-2xl text-purple-500"></i>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Customers Section -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">Pelanggan Baru</h3>
                <a href="{{ route('admin.export.customers') }}" class="bg-green-50 text-green-600 border border-green-100 px-4 py-2 rounded-full text-sm font-semibold hover:bg-green-500 hover:text-white transition-all">
                    <i class="fas fa-download mr-1"></i> Export
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentCustomers as $customer)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-[#036EA6] rounded-full flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $customer->name }}</p>
                            <p class="text-sm text-gray-600">{{ $customer->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">{{ $customer->created_at->diffForHumans() }}</p>
                        <p class="text-xs text-gray-500">{{ $customer->orders_count }} pesanan</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Belum ada pelanggan</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Stats Section -->
        <div class="bg-white rounded-xl card-shadow p-6">
            <h3 class="text-xl font-bold text-[#036EA6] mb-4">Statistik Cepat</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-shopping-bag text-blue-600"></i>
                        <span class="text-gray-700">Total Menu</span>
                    </div>
                    <span class="font-bold text-blue-600">{{ \App\Models\Menu::count() }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users text-green-600"></i>
                        <span class="text-gray-700">Total Pelanggan</span>
                    </div>
                    <span class="font-bold text-green-600">{{ \App\Models\User::where('is_admin', false)->count() }}</span>
                </div>
                <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-chart-line text-purple-600"></i>
                        <span class="text-gray-700">Pesanan Hari Ini</span>
                    </div>
                    <span class="font-bold text-purple-600">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Terbaru Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden" id="orders">
        <div class="p-6 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">Pesanan Terbaru</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar pesanan yang masuk ke sistem</p>
            </div>
            <a href="{{ route('admin.export.orders') }}" class="bg-green-50 text-green-600 border border-green-100 px-5 py-2.5 rounded-full hover:bg-green-500 hover:text-white transition-all text-sm font-semibold flex items-center">
                <i class="fas fa-download mr-2"></i> Export Data
            </a>
        </div>
        
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor HP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesanan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-[#036EA6] rounded-full flex items-center justify-center text-white font-semibold">
                                    {{ substr($order->user->name ?? 'N', 0, 1) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->user->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="font-medium">{{ $order->created_at->format('d M, Y') }}</div>
                            <div class="text-gray-400">{{ $order->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->user->phone_number ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                            <div class="truncate">
                                @foreach($order->items as $item)
                                    {{ $item->product_name ?? 'Product' }} ({{ $item->quantity ?? 0 }}){{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        @php
                            $orderTotal = $order->total_amount ?? $order->total_price ?? 0;
                        @endphp
                        @if($orderTotal > 0)
                            <span class="text-green-600">Rp {{ number_format($orderTotal, 0, ',', '.') }}</span>
                        @else
                            <span class="text-red-500">Rp 0</span>
                        @endif
                    </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                    class="px-3 py-2 text-xs font-semibold rounded-full border-0 focus:ring-2 focus:ring-[#036EA6] focus:outline-none cursor-pointer
                                    @if($order->status == 'pending') bg-gray-100 text-gray-800
                                    @elseif($order->status == 'invalid') bg-red-100 text-red-800
                                    @elseif($order->status == 'process') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'done') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="invalid" {{ $order->status == 'invalid' ? 'selected' : '' }}>Invalid</option>
                                    <option value="process" {{ $order->status == 'process' ? 'selected' : '' }}>Process</option>
                                    <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                            <p class="text-lg">Belum ada pesanan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($recentOrders->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
            <div class="text-sm text-gray-700">
                Menampilkan {{ $recentOrders->firstItem() }} - {{ $recentOrders->lastItem() }} dari {{ $recentOrders->total() }} pesanan
            </div>
            <div class="flex space-x-2">
                @if($recentOrders->onFirstPage())
                <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $recentOrders->previousPageUrl() }}" class="px-3 py-1 bg-white text-gray-700 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif
                
                @if($recentOrders->hasMorePages())
                <a href="{{ $recentOrders->nextPageUrl() }}" class="px-3 py-1 bg-white text-gray-700 rounded-lg hover:bg-gray-100 transition border border-gray-200">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @else
                <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection