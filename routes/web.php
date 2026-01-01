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
    Route::get('/ajax/matkul', [MatkulController::class, 'bySemester'])->name('ajax.matkul');
});

Route::get('/profile/mahasiswa', [ProfileMahasiswaController::class, 'edit'])->middleware('auth')->name('profile.mahasiswa');
Route::patch('/profile/mahasiswa', [ProfileMahasiswaController::class, 'update'])->name('profile.updates');




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

// Menampilkan detail KHS per semester (dipanggil AJAX/modal)
Route::get('/krs/{semester}', [KrsController::class, 'show'])->name('krs.show');

Route::get('/material', [MaterialController::class, 'index'])->name('material.index');
Route::get('/materi/{materi}/download', [MaterialController::class, 'download'])->name('materi.download');

Route::post('/submission', [SubmissionController::class, 'store'])->name('submission.store');

Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');

require __DIR__.'/auth.php';
