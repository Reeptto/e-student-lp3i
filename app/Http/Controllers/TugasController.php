<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request)
    {

        $user = auth()->user();
        if (!$user) abort(403);

        
        $matkul = Matakuliah::orderBy('nama_mk')->get();

        $tugas = Tugas::with('matkul')
            ->when($request->matkul, function ($q) use ($request) {
                $q->where('mk_id', $request->matkul);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tugas.index', compact('tugas', 'matkul'));
    }

    public function show(Tugas $tugas)
    {
        $tugas->load('matkul');

        // contoh: ambil submission mahasiswa login
        $submission = $tugas->submissionByAuth()
            ->where('mhs_id', auth()->user()->id)
            ->first();

        $isExpired = now()->format('H:i:s') > $tugas->time_end;

        return view('tugas.show', compact('tugas', 'submission', 'isExpired'));
    }


}
