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

    // Ambil data KRS beserta relasi materiAjar (sesuaikan nama relasi di Model)
    $krsBySemester = Krs::with('materiAjar') 
        ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
        ->orderBy('semester')
        ->get()
        ->groupBy('semester');

        $semesters = $krsBySemester->map(function ($items, $semester) {
        return [
            'semester' => $semester,
            'total_sks' => $items->sum(function($krs) {
                return $krs->materiAjar->sks ?? 0;
            })
        ];
    })->values();

    return view('krs.index', compact('mahasiswa', 'semesters'));
}

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
