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
                'nama_program_studi' => 'Accounting Information System',
                'kode_program_studi' => '002',
            ],
            [
                'nama_program_studi' => 'Application Software Engineering',
                'kode_program_studi' => '004',
            ],
            [
                'nama_program_studi' => 'Office Administration Automatization',
                'kode_program_studi' => '007',
            ],
        ];

        foreach ($data as $item) {
            BidangKeahlian::create($item);
        }
    }
}


