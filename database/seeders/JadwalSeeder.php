<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\MataKuliah;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //  dd('JadwalSeeder JALAN');
        // Ambil data yang sudah ada
        $kelasAse = Kelas::where('kode_kelas', 'ASE-10')->firstOrFail();
        $kelasOaa = Kelas::where('kode_kelas', 'OAA-13')->firstOrFail();
        $kelasAis = Kelas::where('kode_kelas', 'AIS-12')->firstOrFail();

        $dosen1 = Dosen::where('nama_dsn', 'Budi Santoso')->firstOrFail();
        $dosen2 = Dosen::where('nama_dsn', 'Siti Aminah')->firstOrFail();
        $dosen3 = Dosen::where('nama_dsn', 'Ramdan Firmansyah')->firstOrFail();
        $dosen4 = Dosen::where('nama_dsn', 'Anas Fajar Pratama')->firstOrFail();
        $dosen5 = Dosen::where('nama_dsn', 'Eko Marmanto P.U.')->firstOrFail();

        $ruangan1 = Ruangan::where('nama_ruangan', 'Lab. Bill Gates')->firstOrFail();
        $ruangan2 = Ruangan::where('nama_ruangan', 'R. Crown')->firstOrFail();

        $mk1 = MataKuliah::where('kode_mk', 'ABP-01')->firstOrFail();
        $mk2 = MataKuliah::where('kode_mk', 'EGC-01')->firstOrFail();
        $mk3 = MataKuliah::where('kode_mk', 'WD-01')->firstOrFail();
        $mk4 = MataKuliah::where('kode_mk', 'CFO2-01')->firstOrFail();
        $mk5 = MataKuliah::where('kode_mk', 'CFO1-01')->firstOrFail();

        // Jadwal ASE-10
        Jadwal::create([
            'hari' => 'Senin',
            'mk_id' => $mk1->id,
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '11:30:00',
            'dsn_id' => $dosen1->id,
            'ruangan_id' => $ruangan1->id,
            'kelas_id' => $kelasAse->id,
            'semester' => 1,
        ]);

        Jadwal::create([
            'hari' => 'Senin',
            'mk_id' => $mk2->id,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '14:40:00',
            'dsn_id' => $dosen2->id,
            'ruangan_id' => $ruangan2->id,
            'kelas_id' => $kelasAse->id,
            'semester' => 1,
        ]);

        Jadwal::create([
            'hari' => 'Selasa',
            'mk_id' => $mk3->id,
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '11:30:00',
            'dsn_id' => $dosen3->id,
            'ruangan_id' => $ruangan1->id,
            'kelas_id' => $kelasAse->id,
            'semester' => 1,
        ]);

        Jadwal::create([
            'hari' => 'Selasa',
            'mk_id' => $mk4->id,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '14:40:00',
            'dsn_id' => $dosen4->id,
            'ruangan_id' => $ruangan2->id,
            'kelas_id' => $kelasAse->id,
            'semester' => 1,
        ]);

        // Jadwal OAA-13
        Jadwal::create([
            'hari' => 'Senin',
            'mk_id' => $mk5->id,
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '11:30:00',
            'dsn_id' => $dosen5->id,
            'ruangan_id' => $ruangan1->id,
            'kelas_id' => $kelasOaa->id,
            'semester' => 1,
        ]);

        Jadwal::create([
            'hari' => 'Senin',
            'mk_id' => $mk1->id,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '14:40:00',
            'dsn_id' => $dosen1->id,
            'ruangan_id' => $ruangan2->id,
            'kelas_id' => $kelasOaa->id,
            'semester' => 1,
        ]);

        // Jadwal AIS-12
        Jadwal::create([
            'hari' => 'Selasa',
            'mk_id' => $mk2->id,
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '11:30:00',
            'dsn_id' => $dosen2->id,
            'ruangan_id' => $ruangan1->id,
            'kelas_id' => $kelasAis->id,
            'semester' => 1,
        ]);

        Jadwal::create([
            'hari' => 'Selasa',
            'mk_id' => $mk3->id,
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '14:40:00',
            'dsn_id' => $dosen3->id,
            'ruangan_id' => $ruangan2->id,
            'kelas_id' => $kelasAis->id,
            'semester' => 1,
        ]);
    }
}
