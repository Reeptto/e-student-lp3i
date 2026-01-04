<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TugasController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $kelasId = $user->kelas_id;
        $prodiId = $user->kelas->prodi_id;

        $semesters = MataKuliah::where('prodi_id', $prodiId)
        ->select('semester')
        ->distinct()
        ->orderBy('semester', 'asc')
        ->pluck('semester');

        $matkul = collect([]);

        if ($request->filled('semester')) {
                $matkul = MataKuliah::where(function($query) use ($prodiId) {
                $query->where('prodi_id', $prodiId)
                    ->orWhereNull('prodi_id');
            })
        ->where('semester', $request->semester)
        ->orderBy('nama_mk')
        ->get();
    }
        $tugas = Tugas::where('kelas_id', $kelasId)
            ->when($request->matkul, function ($q) use ($request) {
                $q->where('mk_id', $request->matkul);
            })
            ->orderBy('time_end')
            ->get();

        return view('tugas.index', compact('matkul', 'tugas', 'semesters'));
    }


    public function show(Tugas $tugas)
    {
        $tugas->load('matkul');

        $submission = $tugas->submissionByAuth()
            ->where('mhs_id', auth()->user()->id)
            ->first();

        $isExpired = now()->format('H:i:s') > $tugas->time_end;

        return view('tugas.show', compact('tugas', 'submission', 'isExpired'));
    }


}
