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
            'nama_ruangan' => 'Bill Gates',
            'kapasitas' => '25',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Soekarno',
            'kapasitas' => '15',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Bj. Habibie',
            'kapasitas' => '40',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'R. Crown',
            'kapasitas' => '30',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'R. Pullman',
            'kapasitas' => '25',
        ]);
    }
}
