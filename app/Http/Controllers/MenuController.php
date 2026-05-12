<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    /**
     * Display menu page for frontend (public)
     */
    public function index()
    {
        try {
            // Untuk frontend, pisahkan makanan dan minuman
            $foods = Menu::where('category', 'food')
                        ->orderBy('created_at', 'desc')
                        ->get();
            
            $drinks = Menu::where('category', 'drink')
                         ->orderBy('created_at', 'desc')
                         ->get();
            
            // PERBAIKAN: Gunakan view 'menu' untuk frontend
            return view('menu', compact('foods', 'drinks'));
            
        } catch (\Exception $e) {
            Log::error('MenuController index error: ' . $e->getMessage());
            
            // Fallback jika error
            return view('menu', [
                'foods' => collect(),
                'drinks' => collect()
            ]);
        }
    }
}