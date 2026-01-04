<?php

namespace Database\Seeders;

use App\Models\BidangKeahlian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangKeahlianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BidangKeahlian::create([
            'nama_bidang_keahlian' => 'Application Software Engineering',
            'kode_bidang_keahlian' => '004',
            'deskripsi' => 'bidang_keahlian yang cocok bagi mahasiswa yang memiliki minat di bidang IT'
        ]);

        BidangKeahlian::create([
            'nama_bidang_keahlian' => 'Accounting Information System',
            'kode_bidang_keahlian' => '003',
            'deskripsi' => 'bidang_keahlian yang cocok bagi mahasiswa yang memiliki minat di bidang Akuntansi'
        ]);

        BidangKeahlian::create([
            'nama_bidang_keahlian' => 'Office Administration Automatization',
            'kode_bidang_keahlian' => '007',
            'deskripsi' => 'bidang_keahlian yang cocok bagi mahasiswa yang memiliki minat di bidang Manajemen'
        ]);
    }
}
