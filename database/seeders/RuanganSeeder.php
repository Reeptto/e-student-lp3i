<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ruangan::create([
                'nama_ruangan' => 'Lab. Bill Gates',
                'kapasitas' => 25,
                'deskripsi' => 'Laboratorium Komputer',
        ]);

        Ruangan::create([
                'nama_ruangan' => 'R. Crown',
                'kapasitas' => 30,
                'deskripsi' => 'Ruang Kelas',
        ]);

        Ruangan::create([
                'nama_ruangan' => 'R. Pullman',
                'kapasitas' => 25,
                'deskripsi' => 'Ruang Kelas',
        ]);

        Ruangan::create([
                'nama_ruangan' => 'R. Bj. Habibie',
                'kapasitas' => 40,
                'deskripsi' => 'Ruang Kelas/Aula',
        ]);

        Ruangan::create([
                'nama_ruangan' => 'Lab. Soekarno',
                'kapasitas' => 18,
                'deskripsi' => 'Laboratorium Komputer',
        ]);
    }
}
