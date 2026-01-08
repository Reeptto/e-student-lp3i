<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class PendidikSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Dr. Andi Pratama, M.Kom',
                'pendidikan' => 'S2 Teknik Informatika',
                'bidang' => 'Application Software Engineering',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '1985-03-12',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'andi.dosen@test.ac.id',
                'no_tlp' => '081234567801',
                'rate_gaji' => 7500000,
                'status' => 'Tetap',
                'foto' => null,
            ],
            [
                'nama' => 'Siti Rahmawati, S.E., M.Ak',
                'pendidikan' => 'S2 Akuntansi',
                'bidang' => 'Accounting Information System',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '1987-07-20',
                'jenis_kelamin' => 'perempuan',
                'agama' => 'Islam',
                'email' => 'siti.dosen@test.ac.id',
                'no_tlp' => '081234567802',
                'rate_gaji' => 6800000,
                'status' => 'Kontrak',
                'foto' => null,
            ],
            [
                'nama' => 'Budi Santoso, S.AP., M.AP',
                'pendidikan' => 'S2 Administrasi Publik',
                'bidang' => 'Office Administration Automatization',
                'tempat_lahir' => 'Surabaya',
                'tgl_lahir' => '1984-11-05',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'email' => 'budi.dosen@test.ac.id',
                'no_tlp' => '081234567803',
                'rate_gaji' => 7000000,
                'status' => 'Honorer',
                'foto' => null,
            ],
        ];

        foreach ($data as $dosen) {
            Dosen::create($dosen);
        }
    }
}
