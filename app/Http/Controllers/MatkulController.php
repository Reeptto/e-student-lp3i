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
            return response()->json(['error' => 'user tidak terautentikasi'], 401);
        }

        $semester = $request->semester;
        $bidang_keahlianId  = $user->bidang_keahlian_id;

        if (!$semester) {
            return response()->json([]);
        }

        try {
            $matkul = MataKuliah::query()
                ->where('semester', $semester)
                ->where(function ($q) use ($bidang_keahlianId) {
                    $q->where('bidang_keahlian_id', $bidang_keahlianId)
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

