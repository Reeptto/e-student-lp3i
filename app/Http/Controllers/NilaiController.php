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

    $nilai = Nilai::with('matkul')
        ->where('mhs_id', auth()->user()->mahasiswa->id)
        ->when($semester, function ($q) use ($semester) {
            $q->whereHas('matkul', function ($mq) use ($semester) {
                $mq->where('semester', $semester);
            });
        })
        ->get();

    return view('nilai.index', compact('nilai', 'semester'));
}
}