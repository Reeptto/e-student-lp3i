<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BidangKeahlian;

class BidangKeahlianSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_bidang_keahlian' => 'Accounting Information System',
                'kode_bidang_keahlian' => '002',
            ],
            [
                'nama_bidang_keahlian' => 'Application Software Engineering',
                'kode_bidang_keahlian' => '004',
            ],
            [
                'nama_bidang_keahlian' => 'Office Administration Automatization',
                'kode_bidang_keahlian' => '007',
            ],
        ];

        foreach ($data as $item) {
            BidangKeahlian::create($item);
        }
    }
}


