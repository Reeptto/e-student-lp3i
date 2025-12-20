<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            'nama_jurusan' => 'Application Software Engineering',
            'kode_jurusan' => '004',
            'deskripsi' => 'Jurusan yang cocok bagi mahasiswa yang memiliki minat di bidang IT'
        ]);

        Jurusan::create([
            'nama_jurusan' => 'Accounting Information System',
            'kode_jurusan' => '003',
            'deskripsi' => 'Jurusan yang cocok bagi mahasiswa yang memiliki minat di bidang Akuntansi'
        ]);

        Jurusan::create([
            'nama_jurusan' => 'Office Administration Automatization',
            'kode_jurusan' => '007',
            'deskripsi' => 'Jurusan yang cocok bagi mahasiswa yang memiliki minat di bidang Manajemen'
        ]);
    }
}
