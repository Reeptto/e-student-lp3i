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
        abort_if(!$user || !$user->mahasiswa || !$user->mahasiswa->kelas, 403);

        $kelasId = $user->mahasiswa->id_kelas;

        // Ambil semester dari matkul yang BENAR-BENAR punya tugas di kelas ini
        $semesters = MataKuliah::whereIn('id_mk', function ($q) use ($kelasId) {
                $q->select('id_mk')
                  ->from('tugas')
                  ->where('id_kelas', $kelasId);
            })
            ->whereNotNull('semester')
            ->select('semester')
            ->distinct()
            ->orderBy('semester')
            ->pluck('semester');

        // Ambil matkul berdasarkan tugas di kelas ini (AMAN antar kelas)
        $matkul = MataKuliah::whereIn('id_mk', function ($q) use ($kelasId) {
                $q->select('id_mk')
                  ->from('tugas')
                  ->where('id_kelas', $kelasId);
            })
            ->when($request->filled('semester'), function ($q) use ($request) {
                $q->where('semester', $request->semester);
            })
            ->orderBy('nama_mk')
            ->get();

        // Ambil tugas
        $tugas = Tugas::with('materiAjar')
            ->where('id_kelas', $kelasId)
            ->when($request->filled('matkul'), function ($q) use ($request) {
                $q->where('id_mk', $request->matkul);
            })
            ->orderBy('deadline')
            ->get();

        return view('tugas.index', compact('semesters', 'matkul', 'tugas'));
    }

    public function show(Tugas $tugas)
    {
        $tugas->load('materiAjar');

        $submission = $tugas->submissionByAuth()->first();
        $isExpired  = now()->isAfter($tugas->deadline);

        return view('tugas.show', compact('tugas', 'submission', 'isExpired'));
    }
}
