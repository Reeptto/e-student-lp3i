<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {

        $kelas = Auth::user()->kelas_id;

        $jadwal = Jadwal::with(['matkul', 'dosen', 'ruangan'])->where('kelas_id', $kelas)
                ->get();
        return view('dashboard', compact('jadwal'));
    }
}
