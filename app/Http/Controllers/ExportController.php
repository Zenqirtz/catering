<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->check() || !auth()->user()->is_admin) {
                abort(403, 'Unauthorized access.');
            }
            return $next($request);
        });
    }

    /**
     * Export orders to CSV
     */
    public function exportOrders(Request $request)
    {
        $query = Order::with(['user', 'items']);

        // Apply filters
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'orders_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            
            // Header
            fputcsv($file, [
                'ID Pesanan',
                'Pelanggan',
                'Total Amount',
                'Status',
                'Tanggal Pesanan',
                'Metode Pembayaran',
                'Items'
            ]);

            // Data
            foreach ($orders as $order) {
                $items = '';
                foreach ($order->items as $item) {
                    $items .= $item->product_name . ' (Qty: ' . $item->quantity . ') - Rp ' . number_format($item->price * $item->quantity, 0, ',', '.') . '; ';
                }

                fputcsv($file, [
                    $order->id,
                    $order->user->name,
                    'Rp ' . number_format($this->calculateOrderTotal($order), 0, ',', '.'),
                    $this->getStatusText($order->status),
                    $order->created_at->format('d-m-Y H:i'),
                    $order->payment_method ?? 'Dana',
                    rtrim($items, '; ')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export menus to CSV
     */
    public function exportMenus(Request $request)
    {
        $query = Menu::query();

        // Apply filters
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $menus = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'menus_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($menus) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            
            // Header
            fputcsv($file, [
                'ID',
                'Nama Menu',
                'Harga',
                'Kategori',
                'Deskripsi',
                'Tanggal Dibuat'
            ]);

            // Data
            foreach ($menus as $menu) {
                fputcsv($file, [
                    $menu->id,
                    $menu->name,
                    'Rp ' . number_format($menu->price, 0, ',', '.'),
                    $menu->category == 'food' ? 'Makanan' : 'Minuman',
                    $menu->description ?? '-',
                    $menu->created_at->format('d-m-Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export customers to CSV
     */
    public function exportCustomers(Request $request)
    {
        $query = User::where('is_admin', false)->withCount(['orders']);

        if ($request->has('has_orders') && $request->has_orders == '1') {
            $query->has('orders');
        }

        $customers = $query->orderBy('created_at', 'desc')->get();

        $fileName = 'customers_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        $callback = function() use ($customers) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fputs($file, $bom = (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            
            // Header
            fputcsv($file, [
                'ID',
                'Nama',
                'Email',
                'Total Pesanan',
                'Tanggal Registrasi'
            ]);

            // Data
            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->id,
                    $customer->name,
                    $customer->email,
                    $customer->orders_count,
                    $customer->created_at->format('d-m-Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function calculateOrderTotal($order)
    {
        try {
            if (isset($order->total_amount) && $order->total_amount > 0) {
                return $order->total_amount;
            }
            
            if (isset($order->total_price) && $order->total_price > 0) {
                return $order->total_price;
            }
            
            if ($order->relationLoaded('items') && $order->items->count() > 0) {
                $total = 0;
                foreach ($order->items as $item) {
                    $price = $item->price ?? 0;
                    $quantity = $item->quantity ?? 1;
                    $total += $price * $quantity;
                }
                return $total;
            }
            
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getStatusText($status)
    {
        $statuses = [
            'pending' => 'Pending',
            'process' => 'Diproses',
            'done' => 'Selesai',
            'invalid' => 'Invalid'
        ];
        
        return $statuses[$status] ?? $status;
    }
}