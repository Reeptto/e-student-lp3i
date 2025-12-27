<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah; // Import Model Matakuliah
use App\Models\Materi;     // Import Model Materi

class MateriController extends Controller
{
    /**
     * Menampilkan halaman Pustaka Materi
     */
   public function index()
{
    $subjects = Matakuliah::with('materi')->get();

   $lastMateri = Materi::orderBy('updated_at', 'desc')->first();

        $stats = [
            'total_subject' => $subjects->count(),
            'total_materi'  => Materi::count(),
            'last_update'   => $lastMateri?->updated_at?->format('d M Y') ?? '-',
        ];


    return view('materi.index', compact('subjects', 'stats'));
}


}