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
        $prodiId  = $user->prodi_id;

        if (!$semester) {
            return response()->json([]);
        }

        try {
            $matkul = MataKuliah::query()
                ->where('semester', $semester)
                ->where(function ($q) use ($prodiId) {
                    $q->where('prodi_id', $prodiId)
                      ->orWhereNull('prodi_id');
                })
                ->orderBy('nama_mk')
                ->get();

                return response()->json($matkul);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

