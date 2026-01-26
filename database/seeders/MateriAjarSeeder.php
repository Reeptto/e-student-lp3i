<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\BidangKeahlian;

class MateriAjarSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil bidang keahlian
        $ais = BidangKeahlian::where('kode_program_studi', '002')->firstOrFail();
        $ase = BidangKeahlian::where('kode_program_studi', '004')->firstOrFail();
        $oaa = BidangKeahlian::where('kode_program_studi', '007')->firstOrFail();

        // =========================
        // MATA KULIAH UMUM
        // =========================
        $mkUmum = [
            [
                'kode_mk' => 'MKU-001',
                'nama_mk' => 'Pendidikan Pancasila',
                'deskripsi' => 'Mata kuliah wajib nasional',
                'id_program_studi' => null,
                'semester' => 1,
                'sks' => 2,
            ],
            [
                'kode_mk' => 'MKU-002',
                'nama_mk' => 'Kewarganegaraan',
                'deskripsi' => 'Mata kuliah kewarganegaraan',
                'id_program_studi' => null,
                'semester' => 1,
                'sks' => 2,
            ],
            [
                'kode_mk' => 'MKU-003',
                'nama_mk' => 'Bahasa Inggris',
                'deskripsi' => 'Bahasa Inggris dasar',
                'id_program_studi' => null,
                'semester' => 1,
                'sks' => 2,
            ],
        ];

        // =========================
        // MATA KULIAH INTI ASE
        // =========================
        $mkAse = [
            [
                'kode_mk' => 'ASE-101',
                'nama_mk' => 'Pemrograman Dasar',
                'deskripsi' => 'Dasar pemrograman aplikasi',
                'id_program_studi' => $ase->id_program_studi,
                'semester' => 1,
                'sks' => 3,
            ],
            [
                'kode_mk' => 'ASE-201',
                'nama_mk' => 'Framework Web',
                'deskripsi' => 'Pengembangan aplikasi web modern',
                'id_program_studi' => $ase->id_program_studi,
                'semester' => 2,
                'sks' => 3,
            ],
        ];

        // =========================
        // MATA KULIAH INTI AIS
        // =========================
        $mkAis = [
            [
                'kode_mk' => 'AIS-101',
                'nama_mk' => 'Pengantar Sistem Informasi',
                'deskripsi' => 'Konsep dasar sistem informasi',
                'id_program_studi' => $ais->id_program_studi,
                'semester' => 1,
                'sks' => 3,
            ],
        ];

        // =========================
        // MATA KULIAH INTI OAA
        // =========================
        $mkOaa = [
            [
                'kode_mk' => 'OAA-101',
                'nama_mk' => 'Administrasi Perkantoran',
                'deskripsi' => 'Dasar administrasi perkantoran',
                'id_program_studi' => $oaa->id_program_studi,
                'semester' => 1,
                'sks' => 3,
            ],
        ];

        foreach (array_merge($mkUmum, $mkAis, $mkAse, $mkOaa) as $mk) {
            MataKuliah::create($mk);
        }
    }
}
