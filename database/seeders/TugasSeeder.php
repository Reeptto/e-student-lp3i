<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tugas;
use App\Models\MataKuliah;
use App\Models\Kelas;
use Carbon\Carbon;

class TugasSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // AMBIL MASTER DATA
        // =========================
        $mkAIS = MataKuliah::where('kode_mk', 'AIS-101')->firstOrFail();
        $mkASE = MataKuliah::where('kode_mk', 'ASE-101')->firstOrFail();
        $mkOAA = MataKuliah::where('kode_mk', 'OAA-101')->firstOrFail(); // kode MK boleh tetap

        $kelasAIS = Kelas::where('nama_kelas', 'AIS-12')->firstOrFail();
        $kelasASE = Kelas::where('nama_kelas', 'ASE-10')->firstOrFail();
        $kelasOAA = Kelas::where('nama_kelas', 'OAA-13A')->firstOrFail();

        // =========================
        // DATA TUGAS (URUT)
        // =========================
        $tugas = [
            // ===== AIS-12
            [
                'judul_tugas' => 'Tugas 1 - Sistem Informasi',
                'deskripsi' => 'Buat ringkasan konsep sistem informasi',
                'file_materi' => null,
                'jam_mulai' => Carbon::now(),
                'jam_selesai' => Carbon::now()->addDays(7),
                'status' => 'Aktif',
                'id_ma' => $mkAIS->id_ma,
                'id_kelas' => $kelasAIS->id_kelas,
            ],

            // ===== ASE-10
            [
                'judul_tugas' => 'Tugas 1 - Pemrograman Dasar',
                'deskripsi' => 'Buat program CRUD sederhana menggunakan PHP',
                'file_materi' => null,
                'jam_mulai' => Carbon::now(),
                'jam_selesai' => Carbon::now()->addDays(5),
                'status' => 'Aktif',
                'id_ma' => $mkASE->id_ma,
                'id_kelas' => $kelasASE->id_kelas,
            ],

            // ===== OAA-13A
            [
                'judul_tugas' => 'Tugas 1 - Administrasi Perkantoran',
                'deskripsi' => 'Buat laporan administrasi perkantoran',
                'file_materi' => null,
                'jam_mulai' => Carbon::now(),
                'jam_selesai' => Carbon::now()->addDays(6),
                'status' => 'Aktif',
                'id_ma' => $mkOAA->id_ma,
                'id_kelas' => $kelasOAA->id_kelas,
            ],
        ];

        foreach ($tugas as $item) {
            Tugas::create($item);
        }
    }
}
