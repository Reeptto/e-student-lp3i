<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;



class NilaiController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
        if (!$user) abort(403);
        
    $semester = $request->semester;

    $nilai = Nilai::with('materiAjar')
        ->where('id_mahasiswa', auth()->user()->mahasiswa->id_mahasiswa)
        ->when($semester, function ($q) use ($semester) {
            $q->whereHas('materiAjar', function ($mq) use ($semester) {
                $mq->where('semester', $semester);
            });
        })
        ->get();

    return view('nilai.index', compact('nilai', 'semester'));
}
}