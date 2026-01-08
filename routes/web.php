<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatkulController;
use App\Models\MataKuliah;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KhsController;

use App\Http\Controllers\SubmissionController;
use \routes\auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/dashboard', [JadwalController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/ajax/matkul', function (Request $request) {

        $user = auth()->user();

        // VALIDASI
        if (!$request->filled('semester')) {
            return response()->json([], 200);
        }

        $matkul = MataKuliah::query()
            ->where('id_kelas', $user->id_kelas) // 🔒 KUNCI ANTI BOCOR
            ->where('semester', $request->semester)
            ->orderBy('nama_mk')
            ->get([
                'id_ma as id',
                'nama_mk'
            ]);

        return response()->json($matkul, 200);
});
});

Route::get('/profile/mahasiswa', [ProfileMahasiswaController::class, 'edit'])->middleware('auth')->name('profile.mahasiswa');
Route::patch('/profile/mahasiswa', [ProfileMahasiswaController::class, 'update'])->name('profile.updates');


Route::get('/dashboard', [JadwalController::class, 'index'])->name('dashboard');


Route::get('/pengumuman', [PengumumanController::class, 'index'])->middleware('auth')->name('pengumuman.index');


Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
Route::get('/tugas/{tugas}', [TugasController::class, 'show'])->name('tugas.show');

Route::get('/materi', function () {
    return view('materi.index');
});

Route::get('/jadwal_guru', function () {
    return view('jadwal_guru.index');
});

Route::get('/infopembayaran', function () {
    return view('infopembayaran.index');
})->name('infopembayaran.index');


Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
Route::get('/krs/{semester}', [KrsController::class, 'show'])->name('krs.show');
Route::get('/krs/{semester}/print', [KrsController::class, 'print'])->name('krs.print');


Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
Route::get('/materi/{id}/download', [MaterialController::class, 'download'])->name('materi.download');




Route::post('/submission', [SubmissionController::class, 'store'])->name('submission.store');
Route::get('/submission', function () {
    abort(404);
});

Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');

require __DIR__.'/auth.php';
