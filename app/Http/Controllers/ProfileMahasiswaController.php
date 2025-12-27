<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class ProfileMahasiswaController extends Controller
{

     public function index()
    {
        $mahasiswa = Mahasiswa::all();

        return view('dashboard', compact('mhs'));
    }

    public function edit()
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;

        return view('profile.mahasiswa', compact('user', 'mahasiswa'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'Domisili' => 'required|string|max:255',
        ]);

        $mahasiswa = auth()->user()->mahasiswa;

        $mahasiswa->update([
            'Domisili' => $request->Domisili,
        ]);

        return back()->with('success', 'Domisili berhasil diperbarui');
    }

}
