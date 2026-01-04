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
$user = auth()->user();
        if (!$user) abort(403);
        
        $kelas = Auth::user()->mahasiswa->kelas_id;

        $jadwal = Jadwal::with(['matkul', 'dosen', 'ruangan'])->where('kelas_id', $kelas)->
        orderBy('jam_mulai')
                ->get()->groupBy('hari');
        return view('dashboard', compact('jadwal'));
    }
}
