<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::create([
            'nidn' => '0012345678',
            'nama_dsn' => 'Budi Santoso',
            'tempat_lahir' => 'Jakarta',
            'tgl_lahir' => '1980-05-12',
            'pendidikan' => 'S2 Teknik Informatika',
            'bidang' => 'Pemrograman Web',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
        ]);

        Dosen::create([
            'nidn' => '0098765432',
            'nama_dsn' => 'Siti Aminah',
            'tempat_lahir' => 'Bandung',
            'tgl_lahir' => '1985-09-21',
            'pendidikan' => 'S2 Sistem Informasi',
            'bidang' => 'Basis Data',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
        ]);
    }
}
