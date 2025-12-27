<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Models\Nilai; // Pastikan model Nilai sudah ada

class NilaiController extends Controller
{
public function index(Request $request)
{
    $nilai = Nilai::with('matkul')
        ->when($request->semester, function ($q) use ($request) {
            $q->where('semester', $request->semester);
        })
        ->get();

    return view('nilai.index', compact('nilai'));
}
}