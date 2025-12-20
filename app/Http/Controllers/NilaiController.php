<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai; // Pastikan model Nilai sudah ada

class NilaiController extends Controller
{
    public function index()
    {
        // Contoh mengambil data (sesuaikan dengan logic auth kamu)
        // $nilai = Nilai::where('mhs_id', auth()->user()->id)->get();
        
        return view('nilai.index');
 
        // Jika disimpan di resources/views/mahasiswa/nilai.blade.php
        // Maka gunakan: return view('mahasiswa.nilai');
    }
}