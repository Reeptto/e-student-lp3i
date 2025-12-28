<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
        public function index()
    {
        $jadwal = Jadwal::with(['matakuliah','dosen','ruangan'])->orderBy('hari', 'desc')->get();
        return view('dashboard', compact('jadwal'));
    }
}
