<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ase = Jurusan::where('kode_jurusan', '004')->first();
        $oaa = Jurusan::where('kode_jurusan', '007')->first();
        $ais = Jurusan::where('kode_jurusan', '003')->first();

        Kelas::insert([
            [
                'prodi_id' => $ase->id,
                'nama_kelas' => 'ASE',
                'kode_kelas' => 'ASE-10'
            ],
            [
                'prodi_id' => $ais->id,
                'nama_kelas' => 'AIS',
                'kode_kelas' => 'AIS-12'
            ],
            [
                'prodi_id' => $oaa->id,
                'nama_kelas' => 'OAA',
                'kode_kelas' => 'OAA-13'
            ]
        ]);
    }
}
