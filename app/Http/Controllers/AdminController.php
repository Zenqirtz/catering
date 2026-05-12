<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->is_admin) {
                abort(403, 'Unauthorized access.');
            }
            return $next($request);
        });
    }

   public function dashboard()
{
    try {
        // Total pesanan aktif (pending, process)
        $totalActiveOrders = Order::whereIn('status', ['pending', 'process'])->count();
        
        // Total pesanan selesai (done)
        $totalCompletedOrders = Order::where('status', 'done')->count();
        
        // Total pendapatan bulan ini
        $doneOrdersThisMonth = Order::where('status', 'done')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();

        $currentMonthRevenue = 0;
        foreach ($doneOrdersThisMonth as $order) {
            $currentMonthRevenue += $this->calculateOrderTotal($order);
        }
        
        // PERBAIKAN: Pelanggan baru bulan ini (users yang membuat order)
        $newCustomersThisMonth = User::whereHas('orders', function($query) {
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        })
        ->where('is_admin', false)
        ->count();

        // PERBAIKAN: Data pelanggan baru untuk ditampilkan
        $recentCustomers = User::withCount(['orders'])
            ->where('is_admin', false)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Customer terbaru dengan orders
        $recentOrders = Order::with(['user', 'items'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Cek apakah ada order dengan total 0
        $hasZeroTotals = Order::where(function($query) {
            $query->where('total_price', 0)
                  ->orWhereNull('total_price');
        })->exists();

        return view('admin.dashboard', compact(
            'totalActiveOrders', 
            'totalCompletedOrders',
            'currentMonthRevenue',
            'newCustomersThisMonth',
            'recentCustomers', // PASTIKAN INI ADA
            'recentOrders',
            'hasZeroTotals'
        ));

    } catch (\Exception $e) {
        Log::error('Dashboard error: ' . $e->getMessage());
        
        // Fallback values jika ada error
        return view('admin.dashboard', [
            'totalActiveOrders' => 0,
            'totalCompletedOrders' => 0,
            'currentMonthRevenue' => 0,
            'newCustomersThisMonth' => 0,
            'recentCustomers' => collect(), // PASTIKAN INI ADA
            'recentOrders' => collect(),
            'hasZeroTotals' => false
        ]);
    }
}

    // Helper method untuk menghitung total order
    private function calculateOrderTotal($order)
    {
        try {
            // Gunakan total_amount jika ada (dari struktur database)
            if (isset($order->total_amount) && $order->total_amount > 0) {
                return $order->total_amount;
            }
            
            // Jika tidak, gunakan total_price
            if (isset($order->total_price) && $order->total_price > 0) {
                return $order->total_price;
            }
            
            // Jika tidak, hitung dari items
            if ($order->relationLoaded('items') && $order->items->count() > 0) {
                $total = 0;
                foreach ($order->items as $item) {
                    // Dari struktur database: order_items memiliki 'price' dan 'quantity'
                    $price = $item->price ?? 0;
                    $quantity = $item->quantity ?? 1;
                    $total += $price * $quantity;
                }
                return $total;
            }
            
            return 0;
        } catch (\Exception $e) {
            Log::error('Calculate order total error: ' . $e->getMessage());
            return 0;
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,invalid,process,done'
            ]);

            $order = Order::findOrFail($id);
            
            // Jika status berubah menjadi done, update total_price jika masih 0
            if ($validated['status'] == 'done') {
                $total = $this->calculateOrderTotal($order);
                $order->update([
                    'status' => $validated['status'],
                    'total_price' => $total,
                    'total_amount' => $total // Update kedua kolom untuk konsistensi
                ]);
            } else {
                $order->update([
                    'status' => $validated['status']
                ]);
            }

            // Pesan sukses berdasarkan perubahan status
            $statusMessages = [
                'pending' => 'Pesanan dikembalikan ke status pending',
                'invalid' => 'Pesanan ditandai sebagai invalid',
                'process' => 'Pesanan sedang diproses',
                'done' => 'Pesanan telah selesai'
            ];

            $message = $statusMessages[$validated['status']] ?? 'Status pesanan berhasil diperbarui!';

            return redirect()->route('admin.dashboard')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Update status error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Gagal memperbarui status pesanan.');
        }
    }

    // Method untuk update total_price semua order yang masih 0 - SUDAH DIPERBAIKI
    public function updateOrderTotals()
    {
        try {
            $orders = Order::with('items')->get();
            $updatedCount = 0;

            /** @var Order $order */
            foreach ($orders as $order) {

                $calculatedTotal = $this->calculateOrderTotal($order);

                if (!$order->total_price || $order->total_price == 0) {
                    $order->update([
                        'total_price' => $calculatedTotal,
                        'total_amount' => $calculatedTotal
                    ]);
                    $updatedCount++;
                }
            }
            
            return redirect()->route('admin.dashboard')
                ->with('success', "Berhasil update {$updatedCount} order dengan total price!");
                
        } catch (\Exception $e) {
            Log::error('Update order totals error: ' . $e->getMessage());
            return redirect()->route('admin.dashboard')->with('error', 'Gagal update total harga.');
        }
    }

    // ================================
    // MENU MANAGEMENT METHODS
    // ================================

    /**
     * Display a listing of the menus.
     */
    public function index(Request $request)
    {
        try {
            // Debug: cek parameter request
            Log::info('Filter parameters:', $request->all());
            
            // Query dasar
            $query = Menu::query();
            
            // Filter pencarian
            if ($request->has('search') && !empty($request->search)) {
                $search = $request->search;
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            }
            
            // Filter kategori
            if ($request->has('category') && !empty($request->category)) {
                $query->where('category', $request->category);
            }
            
            // Filter urutan
            if ($request->has('sort')) {
                switch ($request->sort) {
                    case 'oldest':
                        $query->orderBy('created_at', 'asc');
                        break;
                    case 'name':
                        $query->orderBy('name', 'asc');
                        break;
                    case 'price_low':
                        $query->orderBy('price', 'asc');
                        break;
                    case 'price_high':
                        $query->orderBy('price', 'desc');
                        break;
                    case 'newest':
                    default:
                        $query->orderBy('created_at', 'desc');
                        break;
                }
            } else {
                // Default sorting
                $query->orderBy('created_at', 'desc');
            }
            
            // Pagination
            $menus = $query->paginate(12);
            
            // Tambahkan parameter filter ke pagination links
            $menus->appends($request->except('page'));
            
          
            
            return view('admin.menu.index', compact('menus'));
            
        } catch (\Exception $e) {
            Log::error('AdminController menu index error: ' . $e->getMessage());
            
            $menus = collect();
            return view('admin.menu.index', compact('menus'));
        }
    }


    /**
     * Show the form for creating a new menu.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created menu in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'category' => 'required|in:food,drink',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:500'
        ]);

        try {
            $menuData = [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'category' => $validated['category'],
                'description' => $validated['description'] ?? null,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                $imageName = time() . '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/menus', $imageName);
                $menuData['image'] = $imageName;
            }

            Menu::create($menuData);

            return redirect()->route('admin.menu.index')
                ->with('success', 'Menu berhasil ditambahkan!');

        } catch (\Exception $e) {
            Log::error('Menu store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan menu.')->withInput();
        }
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            return view('admin.menu.edit', compact('menu'));
            
        } catch (\Exception $e) {
            Log::error('Menu edit error: ' . $e->getMessage());
            return redirect()->route('admin.menu.index')->with('error', 'Menu tidak ditemukan.');
        }
    }

    /**
     * Update the specified menu in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'category' => 'required|in:food,drink',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:500'
        ]);

        try {
            $menu = Menu::findOrFail($id);

            $updateData = [
                'name' => $validated['name'],
                'price' => $validated['price'],
                'category' => $validated['category'],
                'description' => $validated['description'] ?? null,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($menu->image) {
                    Storage::delete('public/menus/' . $menu->image);
                }
                
                $imageName = time() . '_' . $request->image->getClientOriginalName();
                $request->image->storeAs('public/menus', $imageName);
                $updateData['image'] = $imageName;
            }

            $menu->update($updateData);

            return redirect()->route('admin.menu.index')
                ->with('success', 'Menu berhasil diperbarui!');

        } catch (\Exception $e) {
            Log::error('Menu update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui menu.')->withInput();
        }
    }

    /**
     * Remove the specified menu from storage.
     */
    public function destroy($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            
            // Delete image if exists
            if ($menu->image) {
                Storage::delete('public/menus/' . $menu->image);
            }
            
            $menu->delete();

            return redirect()->route('admin.menu.index')
                ->with('success', 'Menu berhasil dihapus!');

        } catch (\Exception $e) {
            Log::error('Menu destroy error: ' . $e->getMessage());
            return redirect()->route('admin.menu.index')->with('error', 'Gagal menghapus menu.');
        }
    }

    // Additional Dashboard Statistics
    public function getOrderStatistics()
    {
        $todayOrders = Order::whereDate('created_at', today())->count();
        $weekOrders = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $monthOrders = Order::whereMonth('created_at', now()->month)->count();

        return response()->json([
            'today' => $todayOrders,
            'week' => $weekOrders,
            'month' => $monthOrders
        ]);
    }
}