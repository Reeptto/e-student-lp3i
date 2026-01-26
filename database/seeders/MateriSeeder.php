<?php

namespace Database\Seeders;

use App\Models\Dosen;
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

        // Ambil pendidik (contoh ambil yang pertama)
        $pendidik = Dosen::firstOrFail();

        // =========================
        // DATA MATERI
        // =========================
        $materi = [
            // ===== AIS
            [
                'id_mk'        => $mkAIS->id_mk,
                'id_kelas'     => $kelasAIS->id_kelas,
                'id_pendidik'  => $pendidik->id_pendidik,
                'judul_materi' => 'Pengantar Sistem Informasi',
                'deskripsi'    => 'Pengenalan konsep dasar sistem informasi',
                'tipe_materi'  => 'file',
                'pertemuan'    => 1,
                'tgl_upload'   => now()->toDateString(),
            ],
            [
                'id_mk'        => $mkAIS->id_mk,
                'id_kelas'     => $kelasAIS->id_kelas,
                'id_pendidik'  => $pendidik->id_pendidik,
                'judul_materi' => 'Komponen Sistem Informasi',
                'deskripsi'    => 'Hardware, software, brainware',
                'tipe_materi'  => 'file',
                'pertemuan'    => 2,
                'tgl_upload'   => now()->toDateString(),
            ],

            // ===== ASE
            [
                'id_mk'        => $mkASE->id_mk,
                'id_kelas'     => $kelasASE->id_kelas,
                'id_pendidik'  => $pendidik->id_pendidik,
                'judul_materi' => 'Dasar Pemrograman',
                'deskripsi'    => 'Logika dasar dan algoritma',
                'tipe_materi'  => 'file',
                'pertemuan'    => 1,
                'tgl_upload'   => now()->toDateString(),
            ],

            // ===== OAA
            [
                'id_mk'        => $mkOAA->id_mk,
                'id_kelas'     => $kelasOAA->id_kelas,
                'id_pendidik'  => $pendidik->id_pendidik,
                'judul_materi' => 'Administrasi Perkantoran',
                'deskripsi'    => 'Konsep dasar administrasi perkantoran',
                'tipe_materi'  => 'link',
                'pertemuan'    => 1,
                'tgl_upload'   => now()->toDateString(),
            ],
        ];

        foreach ($materi as $item) {
            Material::create($item);
        }
    }
}
