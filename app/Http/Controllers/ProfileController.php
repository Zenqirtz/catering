<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil user dengan 1 riwayat pesanan terbaru.
     */
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil 1 riwayat pesanan paling terbaru
        $orders = Order::with('items')
            ->where('user_id', $user->id)
            ->latest()
            ->take(1)   // hanya ambil satu pesanan terbaru
            ->get();

        return view('profile', compact('user', 'orders'));
    }

    /**
     * Tampilkan form edit profil user.
     */
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return view('editprofile', compact('user'));
    }

    /**
     * Update data profil user.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Jika ada upload foto baru
        if ($request->hasFile('photo')) {

            if ($request->file('photo')->isValid()) {

                // Hapus foto lama jika ada
                if ($user->photo && Storage::exists('public/photos/' . $user->photo)) {
                    Storage::delete('public/photos/' . $user->photo);
                }

                // Simpan foto baru
                $photoName = time() . '_' . uniqid() . '.' .
                    $request->file('photo')->getClientOriginalExtension();

                $path = $request->file('photo')->storeAs('public/photos', $photoName);

                if ($path) {
                    $validated['photo'] = $photoName;
                } else {
                    return back()->withErrors(['photo' => 'Gagal mengupload foto.'])->withInput();
                }
            }

        } else {
            // Jangan ubah foto lama
            unset($validated['photo']);
        }

        // Update user
        $user->update($validated);

        // Refresh data user
        $user->refresh();

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
