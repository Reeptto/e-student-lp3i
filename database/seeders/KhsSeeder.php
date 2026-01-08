<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Khs;

class KhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Khs::insert([
            ['id_mahasiswa' => 1, 'semester' => 1, 'ip_semester' => 3.25],
            ['id_mahasiswa' => 1, 'semester' => 2, 'ip_semester' => 3.45],
            ['id_mahasiswa' => 1, 'semester' => 3, 'ip_semester' => 3.60],
        ]);

        Khs::insert([
            ['id_mahasiswa' => 2, 'semester' => 1, 'ip_semester' => 3.25],
            ['id_mahasiswa' => 2, 'semester' => 2, 'ip_semester' => 3.45],
            ['id_mahasiswa' => 2, 'semester' => 3, 'ip_semester' => 3.60],
        ]);

        Khs::insert([
            ['id_mahasiswa' => 3, 'semester' => 1, 'ip_semester' => 3.25],
            ['id_mahasiswa' => 3, 'semester' => 2, 'ip_semester' => 3.45],
            ['id_mahasiswa' => 3, 'semester' => 3, 'ip_semester' => 3.60],
        ]);
    }
}
