<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    public function bySemester(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $semester = $request->semester;
        $bidangKeahlianId = $user->bidang_keahlian_id;

        if (!$semester) {
            return response()->json([]);
        }

        try {
            $matkul = MataKuliah::query()
                ->where('semester', $semester)
                // Isolasi: Hanya ambil matkul sesuai jurusan user atau matkul umum
                ->where(function ($q) use ($bidangKeahlianId) {
                    $q->where('bidang_keahlian_id', $bidangKeahlianId)
                      ->orWhereNull('bidang_keahlian_id');
                })
                ->orderBy('nama_mk')
                ->get();

            return response()->json($matkul);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}