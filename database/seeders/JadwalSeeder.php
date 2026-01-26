<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Ruangan;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // AMBIL DATA MASTER
        // =========================
        $kelasAIS = Kelas::where('nama_kelas', 'AIS-12')->firstOrFail();
        $kelasASE = Kelas::where('nama_kelas', 'ASE-10')->firstOrFail();
        $kelasOAA = Kelas::where('nama_kelas', 'OAA-13A')->firstOrFail();

        $dosenAIS = Dosen::where('bidang', 'Accounting Information System')->firstOrFail();
        $dosenASE = Dosen::where('bidang', 'Application Software Engineering')->firstOrFail();
        $dosenOAA = Dosen::where('bidang', 'Office Administration Automatization')->firstOrFail();

        // MK inti per bidang
        $mkAIS = MataKuliah::where('kode_mk', 'AIS-101')->firstOrFail();
        $mkASE = MataKuliah::where('kode_mk', 'ASE-101')->firstOrFail();
        $mkOAA = MataKuliah::where('kode_mk', 'OAA-101')->firstOrFail();

        

      
        $jadwal = [
            // ===== AIS (PERTAMA)
            [
                'hari' => 'Senin',
                'jam_mulai' => '08:00',
                'jam_selesai' => '10:30',
                'semester' => 1,
                'id_mk' => $mkAIS->id_mk,
                'id_ruangan' => Ruangan::first()->id_ruangan,
                'id_pendidik' => $dosenAIS->id_pendidik,
                'id_kelas' => $kelasAIS->id_kelas,
            ],

            // // ===== ASE (KEDUA)
            [
                'hari' => 'Selasa',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:30',
                'semester' => 1,
                'id_mk' => $mkASE->id_mk,
                'id_ruangan' => Ruangan::first()->id_ruangan,
                'id_pendidik' => $dosenASE->id_pendidik,
                'id_kelas' => $kelasASE->id_kelas,
            ],

            // // ===== OAA (KETIGA)
            [
                'hari' => 'Rabu',
                'jam_mulai' => '13:00',
                'jam_selesai' => '15:30',
                'semester' => 1,
                'id_mk' => $mkOAA->id_mk,
                'id_ruangan' => Ruangan::first()->id_ruangan,
                'id_pendidik' => $dosenOAA->id_pendidik,
                'id_kelas' => $kelasOAA->id_kelas,
            ],

               [
                'hari' => 'Rabu',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:30',
                'semester' => 1,
                'id_mk' => $mkASE->id_mk,
                'id_ruangan' => Ruangan::first()->id_ruangan,
                'id_pendidik' => $dosenASE->id_pendidik,
                'id_kelas' => $kelasASE->id_kelas,
            ],

               [
                'hari' => 'Kamis',
                'jam_mulai' => '10:00',
                'jam_selesai' => '12:30',
                'semester' => 1,
                'id_mk' => $mkASE->id_mk,
                'id_ruangan' => Ruangan::first()->id_ruangan,
                'id_pendidik' => $dosenASE->id_pendidik,
                'id_kelas' => $kelasASE->id_kelas,
            ],
        ];

        foreach ($jadwal as $item) {
            Jadwal::create($item);
        }
    }
}
