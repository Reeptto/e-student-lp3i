<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        return view('tugas.index');
    }

    public function show(Tugas $tugas)
    {
        $tugas->load('materiAjar');

        $submission = $tugas->submissionByAuth()->first();
        $isExpired  = now()->isAfter($tugas->deadline);

        return view('tugas.show', compact('tugas', 'submission', 'isExpired'));
    }
}
