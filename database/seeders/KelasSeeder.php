<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\BidangKeahlian;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil bidang keahlian
        $ase = BidangKeahlian::where('kode_bidang_keahlian', '002')->firstOrFail();
        $ais = BidangKeahlian::where('kode_bidang_keahlian', '004')->firstOrFail();
        $oaa = BidangKeahlian::where('kode_bidang_keahlian', '007')->firstOrFail();

        $data = [
            [
                'nama_kelas' => 'AIS-12',
                'id_bidang_keahlian' => $ais->id_bidang_keahlian,
            ],
            [
                'nama_kelas' => 'ASE-10',
                'id_bidang_keahlian' => $ase->id_bidang_keahlian,
            ],
            [
                'nama_kelas' => 'OAA-13A',
                'id_bidang_keahlian' => $oaa->id_bidang_keahlian,
            ],
        ];

        foreach ($data as $kelas) {
            Kelas::create($kelas);
        }
    }
}
