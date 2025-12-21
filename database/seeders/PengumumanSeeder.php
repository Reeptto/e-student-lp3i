<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengumuman;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengumuman::create([
            'judul_informasi' => 'Libur Nasional',
            'deskripsi' => 'Kegiatan perkuliahan diliburkan.',
            'tanggal_terbit' => now(),
        ]);

        Pengumuman::create([
            'judul_informasi' => 'UTS Semester Ganjil',
            'deskripsi' => 'UTS dimulai minggu depan.',
            'tanggal_terbit' => now(),
        ]);
    }
}
 