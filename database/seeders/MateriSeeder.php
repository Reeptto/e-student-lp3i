<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Material;
use App\Models\MataKuliah;
use App\Models\Kelas;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // AMBIL MASTER DATA
        // =========================
        $mkAIS = MataKuliah::where('kode_mk', 'AIS-101')->firstOrFail();
        $mkASE = MataKuliah::where('kode_mk', 'ASE-101')->firstOrFail();
        $mkOAA = MataKuliah::where('kode_mk', 'OAA-101')->firstOrFail();

        $kelasAIS = Kelas::where('nama_kelas', 'AIS-12')->firstOrFail();
        $kelasASE = Kelas::where('nama_kelas', 'ASE-10')->firstOrFail();
        $kelasOAA = Kelas::where('nama_kelas', 'OAA-13A')->firstOrFail();

        // =========================
        // DATA MATERI
        // =========================
        $materi = [
            // ===== AIS
            [
                'id_ma' => $mkAIS->id_ma,
                'id_kelas' => $kelasAIS->id_kelas,
                'judul_materi' => 'Pengantar Sistem Informasi',
                'deskripsi' => 'Pengenalan konsep dasar sistem informasi',
                'file_materi' => null,
                'pertemuan' => 'Pertemuan 1',
                'tgl_upload' => now()->toDateString(),
            ],
            [
                'id_ma' => $mkAIS->id_ma,
                'id_kelas' => $kelasAIS->id_kelas,
                'judul_materi' => 'Komponen Sistem Informasi',
                'deskripsi' => 'Hardware, software, brainware',
                'file_materi' => null,
                'pertemuan' => 'Pertemuan 2',
                'tgl_upload' => now()->toDateString(),
            ],

            // ===== ASE
            [
                'id_ma' => $mkASE->id_ma,
                'id_kelas' => $kelasASE->id_kelas,
                'judul_materi' => 'Dasar Pemrograman',
                'deskripsi' => 'Logika dasar dan algoritma',
                'file_materi' => null,
                'pertemuan' => 'Pertemuan 1',
                'tgl_upload' => now()->toDateString(),
            ],

            // ===== OAD
            [
                'id_ma' => $mkOAA->id_ma,
                'id_kelas' => $kelasOAA->id_kelas,
                'judul_materi' => 'Administrasi Perkantoran',
                'deskripsi' => 'Konsep dasar administrasi perkantoran',
                'file_materi' => null,
                'pertemuan' => 'Pertemuan 1',
                'tgl_upload' => now()->toDateString(),
            ],
        ];

        foreach ($materi as $item) {
            Material::create($item);
        }
    }
}
