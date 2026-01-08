<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;

class KrsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        abort_if(!$user, 403);

        $mahasiswa = Mahasiswa::where('id_user', $user->id_user)->firstOrFail();

        $krs = Krs::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->orderBy('semester')
            ->get()
            ->groupBy('semester');

        $semesters = $krs->map(function ($items, $semester) {
            return [
                'semester' => $semester,
                'total_sks' => $items->sum('sks'),
            ];
        })->values();

        return view('krs.index', compact('mahasiswa', 'semesters'));
    }

    // AJAX MODAL
    public function show($semester)
    {
        $user = auth()->user();
        abort_if(!$user, 403);

        $mahasiswa = Mahasiswa::where('id_user', $user->id_user)->firstOrFail();

        $krs = Krs::with('materiAjar')
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('semester', $semester)
            ->get();

        return response()->json([
            'data' => $krs,
            'total_sks' => $krs->sum('sks'),
        ]);
    }

    // CETAK
    public function print($semester)
    {
        $user = auth()->user();
        abort_if(!$user, 403);

        $mahasiswa = Mahasiswa::where('id_user', $user->id_user)->firstOrFail();

        $krsList = Krs::with('materiAjar')
            ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
            ->where('semester', $semester)
            ->get();

        $totalSks = $krsList->sum('sks');

        return view('krs.print', compact(
            'mahasiswa',
            'krsList',
            'semester',
            'totalSks'
        ));
    }
}
