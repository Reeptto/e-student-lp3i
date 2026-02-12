<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        return view('material.index');
    }



    public function download($id)
    {
        $materi = Material::findOrFail($id);

        // Validasi tambahan: Pastikan user yang download satu kelas dengan materi
        if(auth()->user()->id_kelas != $materi->id_kelas) {
            abort(403, 'Akses ditolak. Materi ini bukan untuk kelas Anda.');
        }

        if (!$materi->file_materi || !Storage::disk('public')->exists($materi->file_materi)) {
            abort(404, 'File materi tidak ditemukan');
        }

        return Storage::disk('public')->download($materi->file_materi);
    }
}