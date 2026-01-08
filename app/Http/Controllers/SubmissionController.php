<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Carbon\Carbon;
use App\Models\Tugas;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_tugas' => 'required|exists:tugas,id_tugas',
            'file_tugas' => 'required|file|mimes:pdf,docx,zip|max:5120',
        ]);

        $tugas = Tugas::where('id_tugas', $request->id_tugas)->firstOrFail();

        $existing = Submission::where('id_tugas', $tugas->id_tugas)
            ->where('id_mahasiswa', auth()->user()->id_user)
            ->first();

        if ($existing) {
            return back()->with('error', 'Tugas sudah dikumpulkan');
        }

        $file = $request->file('file_tugas');
        $path = $file->store('submission', 'public');

        Submission::create([
            'id_tugas' => $tugas->id_tugas,
            'id_mahasiswa' => auth()->user()->id_user,
            'file_tugas' => $path,
            'submitted_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan');
    }
}
