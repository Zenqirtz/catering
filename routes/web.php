<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Http\Request;

// ========================
// ✅ HALAMAN AUTH (UNTUK SEMUA USER)
// ========================

// Form Register (HANYA UNTUK USER BIASA)
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Proses Register (HANYA UNTUK USER BIASA)
Route::post('/register', function (Request $request) {
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    // Simpan ke database sebagai USER BIASA (is_admin = false)
    $user = \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'is_admin' => false, // Pastikan false untuk user biasa
    ]);

    // Login otomatis setelah register
    Auth::login($user);

    return redirect('/home');
})->name('register.post');

// Form Login (UNTUK SEMUA USER - ADMIN & USER BIASA)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses Login (UNTUK SEMUA USER)
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Redirect berdasarkan role
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect('/home');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
})->name('login.post');

// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ========================
// ✅ HALAMAN PUBLIK
// ========================

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Menu Public
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// ========================
// ✅ HALAMAN USER (BUTUH LOGIN - USER BIASA)
// ========================

Route::middleware('auth')->group(function() {
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Cart & Checkout
    Route::get('/cart-checkout', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart-checkout/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart-checkout/remove', [CartController::class, 'remove'])->name('cart.remove');   
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/complete', [CartController::class, 'complete'])->name('checkout.complete');
    
    // Orders
    Route::get('/my-order', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/my-order/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// Order Success (bisa diakses tanpa login setelah checkout)
Route::get('/order/success', function () {
    return view('order-success');
})->name('order.success');

// ========================
// ✅ HALAMAN ADMIN (BUTUH LOGIN & ADMIN ROLE)
// ========================

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function() {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Order Management
    Route::put('/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/update-order-totals', [AdminController::class, 'updateOrderTotals'])->name('updateOrderTotals');
    
    // Menu Management
    Route::prefix('menu')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('menu.index');
        Route::get('/create', [AdminController::class, 'create'])->name('menu.create');
        Route::post('/', [AdminController::class, 'store'])->name('menu.store');
        Route::get('/{id}/edit', [AdminController::class, 'edit'])->name('menu.edit');
        Route::put('/{id}', [AdminController::class, 'update'])->name('menu.update');
        Route::delete('/{id}', [AdminController::class, 'destroy'])->name('menu.destroy');
    });
    
    // Export Routes
    Route::prefix('export')->group(function() {
        Route::get('/orders', [ExportController::class, 'exportOrders'])->name('export.orders');
        Route::get('/menus', [ExportController::class, 'exportMenus'])->name('export.menus');
        Route::get('/customers', [ExportController::class, 'exportCustomers'])->name('export.customers');
    });
});

// Form Lupa Password (Input Email)
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Proses Kirim Email Link Reset
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Form Reset Password (Input Password Baru)
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');

// Proses Update Password Baru
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');