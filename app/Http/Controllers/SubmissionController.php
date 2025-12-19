<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Tugas;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->method(), 'MASUK STORE');
        $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'file_tugas_mhs' => 'required|file|mimes:pdf,docx,zip|max:5120'
        ]);

        $tugas = Tugas::findOrFail($request->tugas_id);

        $existing = Submission::where('tugas_id', $tugas->id)->where('mhs_id', auth()->user()->id)->first();

        if ($existing) {
            return back()->with('error', 'Tugas Sudah dikumpulkan');
        }

        $path = $request->file('file_tugas_mhs')->store('submission', 'public');
        $isLate = now()->format('H:i:s') > $tugas->time_end;
        
        Submission::create([
            'file_tugas_mhs' => $path,
            'mhs_id'    => auth()->user()->id,
            'tugas_id'  => $tugas->id,
            'status'    => $isLate ? 'Late' : 'Submitted',
            'submitted_at' => now()
        ]);

        return redirect()->route('tugas.show', $tugas->id)->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
