<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah; // Import Model Matakuliah
use App\Models\Krs;     // Import Model Materi

class KrsController extends Controller
{
    /**
     * Menampilkan halaman Pustaka Materi
     */
   public function index()
{
    $subjects = Matakuliah::with('krs')->get();



    return view('krs.index', compact('subjects'));
}


}
