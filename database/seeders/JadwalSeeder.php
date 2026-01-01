<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Jadwal;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
                'hari' => 'Senin',
                'mk_id' => 1,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:30:00',
                'dsn_id' => 5,
                'ruangan_id' => 1,
                'kelas_id' => 1,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Senin',
                'mk_id' => 5,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'dsn_id' => 4,
                'ruangan_id' => 1,
                'kelas_id' => 1,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Selasa',
                'mk_id' => 1,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:30:00',
                'dsn_id' => 5,
                'ruangan_id' => 1,
                'kelas_id' => 1,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Selasa',
                'mk_id' => 5,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'dsn_id' => 4,
                'ruangan_id' => 1,
                'kelas_id' => 1,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Senin',
                'mk_id' => 8,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:30:00',
                'dsn_id' => 6,
                'ruangan_id' => 1,
                'kelas_id' => 3,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Senin',
                'mk_id' => 5,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'dsn_id' => 4,
                'ruangan_id' => 1,
                'kelas_id' => 3,
                'semester' => 1,
        ]);

                Jadwal::create([
                'hari' => 'Selasa',
                'mk_id' => 1,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:30:00',
                'dsn_id' => 5,
                'ruangan_id' => 1,
                'kelas_id' => 3,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Selasa',
                'mk_id' => 5,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'dsn_id' => 4,
                'ruangan_id' => 1,
                'kelas_id' => 3,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Senin',
                'mk_id' => 11,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:30:00',
                'dsn_id' => 2,
                'ruangan_id' => 1,
                'kelas_id' => 2,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Senin',
                'mk_id' => 5,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'dsn_id' => 1,
                'ruangan_id' => 1,
                'kelas_id' => 2,
                'semester' => 1,
        ]);

                Jadwal::create([
                'hari' => 'Selasa',
                'mk_id' => 11,
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '11:30:00',
                'dsn_id' => 2,
                'ruangan_id' => 1,
                'kelas_id' => 2,
                'semester' => 1,
        ]);

        Jadwal::create([
                'hari' => 'Selasa',
                'mk_id' => 5,
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '14:40:00',
                'dsn_id' => 1,
                'ruangan_id' => 1,
                'kelas_id' => 2,
                'semester' => 1,
        ]);
    }
}
