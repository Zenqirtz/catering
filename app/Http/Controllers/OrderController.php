<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Ambil orders milik user yang login, beserta itemsnya
        $orders = Order::with('items')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('orders', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $validated = $request->validate([
            'status' => 'required|in:pending,invalid,process,done'
        ]);

        $order->update([
            'status' => $validated['status']
        ]);

        return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}