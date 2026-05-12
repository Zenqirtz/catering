<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Cek apakah user adalah admin
        if (!Auth::user()->is_admin) {
            // Jika user biasa mencoba akses admin area
            if ($request->is('admin/*')) {
                return redirect()->route('home')->with('error', 'Akses ditolak. Hanya administrator yang dapat mengakses halaman ini.');
            }
            
            return redirect()->route('home')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}