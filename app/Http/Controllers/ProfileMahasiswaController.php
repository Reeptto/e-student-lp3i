<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileMahasiswaController extends Controller
{
public function edit()
{
    $user = auth()->user();
    $mahasiswa = $user->mahasiswa; // relasi 1–1

    return view('profile.mahasiswa', compact('user', 'mahasiswa'));
}

public function update(Request $request)
{
    $request->validate([
        'alamat' => 'required|string|max:255',
    ]);

    $mahasiswa = auth()->user()->mahasiswa;

    $mahasiswa->update([
        'Alamat' => $request->alamat,
    ]);

    return back()->with('success', 'Domisili berhasil diperbarui');
}

}
