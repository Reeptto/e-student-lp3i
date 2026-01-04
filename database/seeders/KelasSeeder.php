<?php

namespace Database\Seeders;

use App\Models\BidangKeahlian;
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
        $ase = BidangKeahlian::where('kode_bidang_keahlian', '004')->first();
        $oaa = BidangKeahlian::where('kode_bidang_keahlian', '007')->first();
        $ais = BidangKeahlian::where('kode_bidang_keahlian', '003')->first();

        Kelas::insert([
            [
                'bidang_keahlian_id' => $ase->id,
                'nama_kelas' => 'ASE',
                'kode_kelas' => 'ASE-10'
            ],
            [
                'bidang_keahlian_id' => $ais->id,
                'nama_kelas' => 'AIS',
                'kode_kelas' => 'AIS-12'
            ],
            [
                'bidang_keahlian_id' => $oaa->id,
                'nama_kelas' => 'OAA',
                'kode_kelas' => 'OAA-13'
            ]
        ]);
    }
}
