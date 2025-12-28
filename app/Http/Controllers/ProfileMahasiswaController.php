<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;

class ProfileMahasiswaController extends Controller
{
    public function edit()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        return view('profile.mahasiswa', compact('mahasiswa'));
    }

    public function update(Request $request)
    {
        $mahasiswa = auth()->user()->mahasiswa;

        $request->validate([
            'Domisili' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        $mahasiswa->Domisili = $request->Domisili;

        if($request->hasFile('foto')){
            // Hapus foto lama
            if($mahasiswa->foto && Storage::exists('public/image/'.$mahasiswa->foto)){
                Storage::delete('public/image/'.$mahasiswa->foto);
            }

            // Simpan foto baru
            $path = $request->file('foto')->store('image', 'public');
            $mahasiswa->foto = basename($path);
        }

        $mahasiswa->save();

      

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
