<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Nilai;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = Mahasiswa::whereIn('nama_mhs', [
            'Ari Aprianto',
            'Esa Nabila Cahyani',
            'Novi Irnawati'
        ])->get();

        if ($mahasiswas->isEmpty()) {
            $this->command->info('Mahasiswa belum ada');
            return;
        }

        $matkuls = MataKuliah::all();

        if ($matkuls->isEmpty()) {
            $this->command->info('Mata kuliah belum ada');
            return;
        }

        foreach ($mahasiswas as $mhs) {
            foreach ($matkuls as $mk) {

                Nilai::updateOrCreate(
                    [
                        'mhs_id' => $mhs->id,
                        'mk_id'  => $mk->id,
                    ],
                    [
                        // ⬇️ NILAI MENTAH SAJA
                        'kehadiran'  => rand(70, 100),
                        'attitude'       => rand(70, 100),
                        'nilai_tugas'    => rand(70, 95),
                        'nilai_formative' => rand(70, 95),
                        'nilai_uts'      => rand(65, 90),
                        'nilai_uas'      => rand(65, 95),
                        // ⛔ nilai_akhir & huruf_mutu JANGAN DIISI
                    ]
                );
            }
        }

        $this->command->info('Seeder Nilai berhasil dijalankan');
    }
}
