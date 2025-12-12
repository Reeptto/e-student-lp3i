<?php

use App\Http\Controllers\MahasiswaProfileController;
use App\Http\Controllers\TugasController;
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

Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
Route::get('/profileMahasiswa', [MahasiswaProfileController::class, 'index'])->name('profil');

require __DIR__.'/auth.php';
