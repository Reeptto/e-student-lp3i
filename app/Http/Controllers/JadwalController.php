<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Khs;

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

         $graphData = Khs::where('id_mahasiswa', $mahasiswa->id)
        ->orderBy('semester')
        ->get()
        ->map(function ($row) {
            return [
                'label' => 'Semester ' . $row->semester,
                'value' => (float) $row->ip_semester
            ];
        });
        return view('dashboard', compact('jadwal', 'graphData'));
    }

}
