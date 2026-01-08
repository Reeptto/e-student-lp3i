<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        abort_if(!$user, 403);

        $semester = $request->semester;
        $id_ma    = $request->id_ma;

        $mataKuliah = MataKuliah::query()
            ->when($semester, fn ($q) =>
                $q->where('semester', $semester)
            )
            ->orderBy('nama_mk')
            ->get();

        $materi = Material::with('materiAjar')
            ->when($id_ma, fn ($q) =>
                $q->where('id_ma', $id_ma)
            )
            ->orderBy('tgl_upload', 'desc')
            ->get();

        return view('material.index', compact(
            'materi',
            'mataKuliah',
            'semester',
            'id_ma'
        ));
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