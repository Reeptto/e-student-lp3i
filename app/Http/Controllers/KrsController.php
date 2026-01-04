<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    // ===============================
    // INDEX (LIST SEMUA SEMESTER KRS)
    // ===============================
    public function index()
    {
        $user = auth()->user();
        if (!$user) abort(403);

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        $krsList = Krs::with(['mataKuliah', 'dosen', 'kelas'])
            ->where('nipd', $mahasiswa->nipd)
            ->orderBy('semester')
            ->get();

        // group KRS berdasarkan semester pengambilan
        $krsBySemester = $krsList->groupBy('semester');

        // data header semester
        $semesters = $krsBySemester->map(function ($items, $semester) {
            return (object) [
                'id' => $semester,
                'nama' => "Semester $semester",
                'total_sks' => $items->sum(fn ($i) => $i->mataKuliah->sks),
            ];
        })->values();

        return view('krs.index', compact(
            'mahasiswa',
            'krsBySemester',
            'semesters'
        ));
    }

   
    // GENERATE KRS (AUTO PAKET)
 
    public function generate()
    {
        $user = auth()->user();
        if (!$user) abort(403);

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        $semesterAktif = $mahasiswa->semester_aktif;
        if (!$semesterAktif) {
            return back()->with('error', 'Semester belum aktif');
        }

        // ambil MK paket semester aktif
        $matkulPaket = MataKuliah::where('semester', $semesterAktif)->get();

        foreach ($matkulPaket as $mk) {

            // CEK: MK sudah pernah diambil?
            $sudahAmbil = Krs::where('nipd', $mahasiswa->nipd)
                ->where('mk_id', $mk->id)
                ->exists();

            if ($sudahAmbil) {
                continue; // skip MK lama
            }

            Krs::create([
                'nipd'       => $mahasiswa->nipd,
                'mk_id'      => $mk->id,
                'kelas_id'   => $mahasiswa->kelas_id,
                'semester'   => $semesterAktif, 
                'status'     => 'normal',
            ]);
        }

        return back()->with('success', 'KRS semester ' . $semesterAktif . ' berhasil digenerate');
    }

    
    // DETAIL KRS PER SEMESTER
   
    public function show($semester)
    {
        $user = auth()->user();
        if (!$user) abort(403);

        $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

        $krsList = Krs::with(['mataKuliah', 'dosen', 'kelas'])
            ->where('nipd', $mahasiswa->nipd)
            ->where('semester', $semester)
            ->get();

        return view('krs.detail', [
            'krsList'   => $krsList,
            'semester'  => $semester,
            'totalSks'  => $krsList->sum(fn ($i) => $i->mataKuliah->sks),
        ]);
    }
}
