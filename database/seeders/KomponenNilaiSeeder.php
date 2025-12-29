<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Nilai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomponenNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mhsList = Mahasiswa::all();
        $mkList  = MataKuliah::all();

        foreach ($mhsList as $mhs) {
            $randomMk = $mkList->random(5); // ambil 5 MK

            foreach ($randomMk as $mk) {
                Nilai::create([
                    'mhs_id' => $mhs->id,
                    'mk_id' => $mk->id,
                    'nilai_tugas' => rand(70, 95),
                    'nilai_formative' => rand(70, 95),
                    'nilai_uts' => rand(70, 95),
                    'nilai_uas' => rand(70, 95),
                    'nilai_akhir' => rand(75, 90),
                    'grade' => 'A',
                    'semester' => rand(1,3),
                ]);
            }
        }

    }
}
