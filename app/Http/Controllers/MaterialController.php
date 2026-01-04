<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MataKuliah;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class MaterialController extends Controller
{
 public function index(Request $request)
{

    $user = auth()->user();
        if (!$user) abort(403);
        
    $mataKuliah = MataKuliah::orderBy('nama_mk')->get();

    $materi = Material::with('matkul')
        ->when($request->mk_id, function ($query) use ($request) {
            $query->where('mk_id', $request->mk_id);
        })
        ->orderBy('tgl_upload', 'desc')
        ->get();

    return view('material.index', compact('materi', 'mataKuliah'));
}

    public function download(Material $materi)
    {
        if (!$materi->file_materi) {
            abort(404, 'Maaf file materi tidak ditemukan di database');
        }

        if (!Storage::disk('public')->exists($materi->file_materi)) {
           abort(404, 'File materi tidak ditemukan di storage');
        }
        return Storage::disk('public')->download($materi->file_materi);
    }
}
