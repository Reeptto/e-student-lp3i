<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nipd' => ['required'],
            'password' => ['required'],
        ]);

        // 1. Cari mahasiswa berdasarkan NIPD
        $mahasiswa = Mahasiswa::where('nipd', $request->nipd)->first();

        if (!$mahasiswa) {
            return back()->withErrors([
                'nipd' => 'NIPD tidak terdaftar',
            ]);
        }

        // 2. Ambil user dari relasi
        $user = $mahasiswa->user;

        // 3. Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password salah',
            ]);
        }

        // 4. Login
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
