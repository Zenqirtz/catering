<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;

// ========================
// ✅ HALAMAN AUTH
// ========================

// Form Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Register
Route::post('/register', function (Request $request) {
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // Simpan ke database
    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
    ]);

    // Login otomatis setelah register
    Auth::login($user);

    return redirect('/home');
})->name('register.post');

// Form Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses Login
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/home');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
})->name('login.post');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/menu', function () {
    return view('menu');
});

// Profile
Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Cart
Route::get('/cart-checkout', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart-checkout/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart-checkout/remove', [CartController::class, 'remove'])->name('cart.remove');   
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/order/success', function () {
    return view('order-success');
})->name('order.success');
// Checkout complete
Route::post('/checkout/complete', [CartController::class, 'complete'])->name('checkout.complete')->middleware('auth');
// My Order
Route::get('/my-order', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');

Route::get('/menu', function () {
    return view('menu');
})->name('menu'); // Tambahkan ini