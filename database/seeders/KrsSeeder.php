<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Kelas;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $ari  = Mahasiswa::where('nipd', '2407810040004')->firstOrFail();
        $esa  = Mahasiswa::where('nipd', '2407810070044')->firstOrFail();
        $novi = Mahasiswa::where('nipd', '2407810030002')->firstOrFail();

        $budi = Dosen::where('nama_dsn', 'Budi Santoso')->firstOrFail();
        $siti = Dosen::where('nama_dsn', 'Siti Aminah')->firstOrFail();

        $kelasAse = Kelas::where('kode_kelas', 'ASE-10')->firstOrFail();
        $kelasOaa = Kelas::where('kode_kelas', 'OAA-13')->firstOrFail();
        $kelasAis = Kelas::where('kode_kelas', 'AIS-12')->firstOrFail();

        $abp  = MataKuliah::where('kode_mk', 'ABP-01')->firstOrFail();
        $egc  = MataKuliah::where('kode_mk', 'EGC-01')->firstOrFail();
        $wd   = MataKuliah::where('kode_mk', 'WD-01')->firstOrFail();
        $cfo2 = MataKuliah::where('kode_mk', 'CFO2-01')->firstOrFail();
        $cfo1 = MataKuliah::where('kode_mk', 'CFO1-01')->firstOrFail();

        Krs::create([
            'nipd' => $ari->nipd,
            'kode_mk' => $abp->kode_mk,
            'dosen_id' => $budi->id,
            'kelas_id' => $kelasAse->id,
            'jurusan' => $ari->jurusan,
            'sks' => 3,
        ]);

        Krs::create([
            'nipd' => $ari->nipd,
            'kode_mk' => $egc->kode_mk,
            'dosen_id' => $siti->id,
            'kelas_id' => $kelasAse->id,
            'jurusan' => $ari->jurusan,
            'sks' => 2,
        ]);

        Krs::create([
            'nipd' => $esa->nipd,
            'kode_mk' => $wd->kode_mk,
            'dosen_id' => $budi->id,
            'kelas_id' => $kelasOaa->id,
            'jurusan' => $esa->jurusan,
            'sks' => 3,
        ]);

        Krs::create([
            'nipd' => $esa->nipd,
            'kode_mk' => $cfo2->kode_mk,
            'dosen_id' => $siti->id,
            'kelas_id' => $kelasOaa->id,
            'jurusan' => $esa->jurusan,
            'sks' => 2,
        ]);

        Krs::create([
            'nipd' => $novi->nipd,
            'kode_mk' => $cfo1->kode_mk,
            'dosen_id' => $budi->id,
            'kelas_id' => $kelasAis->id,
            'jurusan' => $novi->jurusan,
            'sks' => 3,
        ]);
    }
}