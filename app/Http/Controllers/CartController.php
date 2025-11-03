<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->id;
        $name = $request->name;
        $price = $request->price;
        $img = $request->img;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $name,
                "price" => $price,
                "img" => $img,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
    }

    /**
     * Update the quantity of an item in the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $action = $request->input('action'); // 'increase' atau 'decrease' dari tombol
        $quantityInput = (int) $request->input('quantity'); // Kuantitas dari input number

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if ($action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($action === 'decrease') {
                if ($cart[$id]['quantity'] > 1) { // Pastikan tidak kurang dari 1
                    $cart[$id]['quantity']--;
                } else {
                    // Jika kuantitas menjadi 0 atau kurang, hapus item dari keranjang
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Produk dihapus dari keranjang!');
                }
            } else {
                // Ini akan dijalankan jika form disubmit karena 'onchange' pada input number
                // atau jika ada cara lain form disubmit tanpa action 'increase'/'decrease'
                $cart[$id]['quantity'] = max(1, $quantityInput); // Pastikan minimal 1
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong!');
        }
        
        return view('checkout', compact('cart'));
    }

    public function complete(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        // Hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Buat order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => 'dana'
        ]);

        // Simpan items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }

        // Kosongkan cart
        session()->forget('cart');

        // Redirect langsung ke My Order
        return redirect()->route('orders.index')->with('success', 'Terima kasih! Pesanan Anda telah berhasil dibuat dan sedang diproses.');
    }
}