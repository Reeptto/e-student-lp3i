<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    // ===============================
    // INDEX
    // ===============================
    public function index()
    {
        $user = auth()->user();
        if (!$user) abort(403, 'Belum login');

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        if (!$mahasiswa) abort(403, 'Akun ini bukan mahasiswa');

        // Ambil KRS dengan relasi lengkap
        $krsList = Krs::with(['mataKuliah', 'dosen', 'kelas', 'mahasiswa'])
            ->where('nipd', $mahasiswa->nipd)
            ->get()
            ->map(function ($item) {
                $item->semester = $item->mataKuliah->semester ?? null;
                return $item;
            });

        // Grouping per semester
        $semesters = $krsList
            ->groupBy('semester')
            ->map(function ($items, $semester) {
                return (object)[
                    'id' => $semester,
                    'nama' => $semester,
                    'periode' => "2025/2026 Ganjil", // contoh, bisa dinamis
                    'total_sks' => $items->sum('sks'),
                ];
            })
            ->values();

        // Amanin selectedSemester supaya tidak null
        $selectedSemester = $semesters->first() ?? (object)[
            'id' => null,
            'nama' => null,
            'periode' => null,
            'total_sks' => 0,
        ];

        return view('krs.index', [
            'semesters' => $semesters,
            'krsBySemester' => $krsList->groupBy('semester'),
            'mahasiswa' => $mahasiswa,
            'selectedSemester' => $selectedSemester,
        ]);
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user) abort(403);

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        if (!$mahasiswa) abort(403);

        $request->validate([
            'kode_mk' => 'required|exists:matakuliah,kode_mk',
            'dosen_id' => 'required|exists:dosen,id',
            'kelas_id' => 'required|exists:kelas,id',
            'sks' => 'required|integer|min:1',
        ]);

        Krs::create([
            'nipd' => $mahasiswa->nipd,
            'kode_mk' => $request->kode_mk,
            'dosen_id' => $request->dosen_id,
            'kelas_id' => $request->kelas_id,
            'jurusan' => $mahasiswa->jurusan,
            'sks' => $request->sks,
        ]);

        return redirect()->back()->with('success', 'KRS berhasil ditambahkan.');
    }

    // ===============================
    // SHOW
    // ===============================
    public function show($semester)
    {
        $user = auth()->user();
        if (!$user) abort(403);

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        if (!$mahasiswa) abort(403);

        $krsList = Krs::with(['mataKuliah', 'dosen', 'kelas', 'mahasiswa'])
            ->where('nipd', $mahasiswa->nipd)
            ->get()
            ->filter(function ($item) use ($semester) {
                return ($item->mataKuliah->semester ?? null) == $semester;
            });

        return view('krs.detail', [
            'krsList' => $krsList,
            'mahasiswa' => $mahasiswa,
            'semester' => $semester,
            'totalSks' => $krsList->sum('sks'),
        ]);
    }
}