<?php

use App\Http\Controllers\ProfileMahasiswaController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\NilaiController;
use \routes\auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/profile-mahasiswa', [ProfileMahasiswaController::class, 'edit'])->middleware('auth')->name('profile.mahasiswa');
Route::put('/profile-mahasiswa', [ProfileMahasiswaController::class, 'update'])->middleware('auth')->name('profile.mahasiswa');

Route::get('/pengumuman', [PengumumanController::class, 'index'])->middleware('auth')->name('pengumuman.index');


Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');

Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai');

require __DIR__.'/auth.php';
