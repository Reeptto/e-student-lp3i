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
        $mahasiswa = auth()->user()->mahasiswa;

        $jadwal = Jadwal::where('id_kelas', $mahasiswa->id_kelas)
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        $graphData = $mahasiswa->khs()
            ->orderBy('semester')
            ->get()
            ->map(fn ($k) => [
                'label' => 'Sem ' . $k->semester,
                'value' => (float) $k->ip_semester,
            ]);

        return view('dashboard', compact('jadwal', 'graphData'));
    }

}
