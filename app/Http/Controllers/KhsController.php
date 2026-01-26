<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use Illuminate\Http\Request;

class KhsController extends Controller
{

public function index()
{
    $mhs = auth()->user()->mahasiswa;

    $graphData = Khs::where('id_mahasiswa', $mhs->id)
        ->orderBy('semester')
        ->get()
        ->map(function ($row) {
            return [
                'label' => 'Sem ' . $row->semester,
                'value' => (float) $row->ip_semester
            ];
        });

    return view('dashboard', compact('graphData'));
}

} 