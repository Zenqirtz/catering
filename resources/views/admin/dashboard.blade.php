@extends('layouts.admin')

@section('title', 'Admin Dashboard - FourYourCatering')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview sistem dan statistik pesanan')

@section('content')
<div class="space-y-8">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pesanan Aktif -->
        <div class="bg-[var(--olive)] p-6 text-white border border-[var(--olive-dark)] flex items-center justify-between group">
            <div>
                <h3 class="text-xs font-bold opacity-80 mb-1 uppercase tracking-widest text-[#c4bfa6]">Total Pesanan Aktif</h3>
                <p class="font-display text-4xl text-white">{{ $totalActiveOrders }}</p>
                <p class="text-[11px] opacity-75 mt-2">Sedang diproses</p>
            </div>
            <div class="w-12 h-12 bg-white/10 flex items-center justify-center text-white text-xl">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>

        <!-- Total Pesanan Selesai -->
        <div class="bg-white p-6 border border-[var(--line)] flex items-center justify-between">
            <div>
                <h3 class="text-xs font-bold text-[var(--muted)] mb-1 uppercase tracking-widest">Total Pesanan Selesai</h3>
                <p class="font-display text-4xl text-emerald-700">{{ $totalCompletedOrders }}</p>
                <p class="text-[11px] text-[var(--muted)] mt-2">Telah selesai</p>
            </div>
            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center justify-center text-xl">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-[var(--mustard)] p-6 text-[var(--ink)] border border-[var(--line)] flex items-center justify-between">
            <div>
                <h3 class="text-xs font-bold text-[var(--ink)]/70 mb-1 uppercase tracking-widest">Total Pendapatan</h3>
                <p class="font-display text-2xl sm:text-3xl text-[var(--ink)]">Rp {{ number_format($currentMonthRevenue, 0, ',', '.') }}</p>
                <p class="text-[11px] text-[var(--ink)]/70 mt-2">Bulan ini</p>
            </div>
            <div class="w-12 h-12 bg-[var(--ink)] text-[var(--cream)] flex items-center justify-center text-xl">
                <i class="fas fa-wallet"></i>
            </div>
        </div>

        <!-- Pelanggan Baru -->
        <div class="bg-white p-6 border border-[var(--line)] flex items-center justify-between">
            <div>
                <h3 class="text-xs font-bold text-[var(--muted)] mb-1 uppercase tracking-widest">Pelanggan Baru</h3>
                <p class="font-display text-4xl text-[var(--orange)]">{{ $newCustomersThisMonth }}</p>
                <p class="text-[11px] text-[var(--muted)] mt-2">Bulan ini</p>
            </div>
            <div class="w-12 h-12 bg-orange-50 text-[var(--orange)] border border-orange-200 flex items-center justify-center text-xl">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Customers Section -->
        <div class="bg-white border border-[var(--line)] p-6">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-[var(--line)]">
                <h3 class="font-display uppercase text-lg text-[var(--ink)]">Pelanggan Baru</h3>
                <a href="{{ route('admin.export.customers') }}" class="btn-outline !py-1.5 !px-3 !text-[0.68rem]">
                    <i class="fas fa-download mr-1"></i> Export
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentCustomers as $customer)
                <div class="flex items-center justify-between p-3 bg-[var(--cream)] border border-[var(--line)]">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 bg-[var(--ink)] text-[var(--cream)] font-bold flex items-center justify-center text-xs">
                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm text-[var(--ink)] uppercase tracking-wide">{{ $customer->name }}</p>
                            <p class="text-xs text-[var(--muted)]">{{ $customer->email }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-[var(--muted)]">{{ $customer->created_at->diffForHumans() }}</p>
                        <p class="text-[11px] text-[var(--ink)] font-semibold">{{ $customer->orders_count }} pesanan</p>
                    </div>
                </div>
                @empty
                <p class="text-[var(--muted)] text-center py-4 text-sm">Belum ada pelanggan</p>
                @endforelse
            </div>
        </div>

        <!-- Quick Stats Section -->
        <div class="bg-white border border-[var(--line)] p-6">
            <h3 class="font-display uppercase text-lg text-[var(--ink)] mb-6 pb-4 border-b border-[var(--line)]">Statistik Cepat</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center p-3.5 bg-[var(--cream)] border border-[var(--line)]">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-shopping-bag text-[var(--orange)]"></i>
                        <span class="text-xs uppercase tracking-widest font-bold text-[var(--ink)]">Total Menu</span>
                    </div>
                    <span class="font-display text-xl text-[var(--ink)]">{{ \App\Models\Menu::count() }}</span>
                </div>
                <div class="flex justify-between items-center p-3.5 bg-[var(--cream)] border border-[var(--line)]">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users text-[var(--olive)]"></i>
                        <span class="text-xs uppercase tracking-widest font-bold text-[var(--ink)]">Total Pelanggan</span>
                    </div>
                    <span class="font-display text-xl text-[var(--ink)]">{{ \App\Models\User::where('is_admin', false)->count() }}</span>
                </div>
                <div class="flex justify-between items-center p-3.5 bg-[var(--cream)] border border-[var(--line)]">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-chart-line text-[var(--mustard)]"></i>
                        <span class="text-xs uppercase tracking-widest font-bold text-[var(--ink)]">Pesanan Hari Ini</span>
                    </div>
                    <span class="font-display text-xl text-[var(--ink)]">{{ \App\Models\Order::whereDate('created_at', today())->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Pesanan Terbaru Table -->
    <div class="bg-white border border-[var(--line)] overflow-hidden" id="orders">
        <div class="p-6 border-b border-[var(--line)] flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-display uppercase text-xl text-[var(--ink)]">Pesanan Terbaru</h2>
                <p class="text-xs text-[var(--muted)] mt-0.5">Daftar pesanan yang masuk ke sistem</p>
            </div>
            <a href="{{ route('admin.export.orders') }}" class="btn-solid !py-2 !px-4 !text-[0.7rem]">
                <i class="fas fa-download mr-1"></i> Export Data
            </a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[var(--cream-deep)] border-b border-[var(--line)] text-xs font-bold uppercase tracking-widest text-[var(--ink)]">
                        <th class="p-4">Nama</th>
                        <th class="p-4">Tanggal Order</th>
                        <th class="p-4">Nomor HP</th>
                        <th class="p-4">Pesanan</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--line)] text-sm">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-[var(--cream)]/60 transition-colors">
                        <td class="p-4 whitespace-nowrap">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-[var(--ink)] text-[var(--cream)] font-bold flex items-center justify-center text-xs shrink-0">
                                    {{ substr($order->user->name ?? 'N', 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-xs uppercase tracking-wide text-[var(--ink)]">{{ $order->user->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-[var(--muted)]">{{ $order->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap text-xs text-[var(--muted)] font-mono">
                            <div class="font-bold text-[var(--ink)]">{{ $order->created_at->format('d M, Y') }}</div>
                            <div>{{ $order->created_at->format('H:i') }}</div>
                        </td>
                        <td class="p-4 whitespace-nowrap text-xs text-[var(--muted)] font-mono">
                            {{ $order->user->phone_number ?? '-' }}
                        </td>
                        <td class="p-4 text-xs text-[var(--ink)] max-w-xs">
                            <div class="truncate">
                                @foreach($order->items as $item)
                                    {{ $item->product_name ?? 'Product' }} ({{ $item->quantity ?? 0 }}){{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>
                        </td>
                        <td class="p-4 whitespace-nowrap font-display text-sm">
                        @php
                            $orderTotal = $order->total_amount ?? $order->total_price ?? 0;
                        @endphp
                        @if($orderTotal > 0)
                            <span class="text-[var(--ink)] font-bold">Rp {{ number_format($orderTotal, 0, ',', '.') }}</span>
                        @else
                            <span class="text-red-600">Rp 0</span>
                        @endif
                    </td>
                        <td class="p-4 whitespace-nowrap">
                            <form action="{{ route('admin.updateStatus', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                    class="text-[0.68rem] font-bold uppercase tracking-wider px-2.5 py-1 border border-[var(--line)] focus:outline-none cursor-pointer
                                    @if($order->status == 'pending') bg-gray-100 text-gray-800
                                    @elseif($order->status == 'invalid') bg-red-100 text-red-800
                                    @elseif($order->status == 'process') bg-[var(--mustard)]/20 text-[var(--ink)]
                                    @elseif($order->status == 'done') bg-[var(--olive)] text-white
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
                        <td colspan="6" class="p-8 text-center text-[var(--muted)]">
                            <i class="fas fa-inbox text-3xl text-[var(--muted)] mb-2"></i>
                            <p class="text-sm">Belum ada pesanan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($recentOrders->hasPages())
        <div class="p-4 bg-[var(--cream)] border-t border-[var(--line)] flex items-center justify-between text-xs">
            <div class="text-[var(--muted)]">
                Menampilkan {{ $recentOrders->firstItem() }} - {{ $recentOrders->lastItem() }} dari {{ $recentOrders->total() }} pesanan
            </div>
            <div class="flex space-x-2">
                @if($recentOrders->onFirstPage())
                <span class="px-3 py-1 bg-gray-200 text-gray-400 cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $recentOrders->previousPageUrl() }}" class="px-3 py-1 bg-white text-[var(--ink)] border border-[var(--line)] hover:bg-[var(--cream-deep)]">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif
                
                @if($recentOrders->hasMorePages())
                <a href="{{ $recentOrders->nextPageUrl() }}" class="px-3 py-1 bg-white text-[var(--ink)] border border-[var(--line)] hover:bg-[var(--cream-deep)]">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @else
                <span class="px-3 py-1 bg-gray-200 text-gray-400 cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
