<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\Krs;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        $krsList = Krs::with(['mahasiswa', 'dosen', 'mataKuliah'])->get();

        foreach ($krsList as $krs) {

            // Nilai random tapi masuk akal
            $kehadiran = rand(80, 100);
            $sikap     = rand(80, 100);
            $formatif  = rand(70, 95);
            $tugas     = rand(70, 95);
            $uts       = rand(65, 90);
            $uas       = rand(65, 90);

            // Hitung nilai akhir (contoh bobot)
            $nilaiAkhir =
                ($kehadiran * 0.10) +
                ($sikap * 0.10) +
                ($formatif * 0.20) +
                ($tugas * 0.20) +
                ($uts * 0.20) +
                ($uas * 0.20);

            // Tentukan grade & bobot IP
            if ($nilaiAkhir >= 85) {
                $grade = 'A';
                $bobot = 4.0;
            } elseif ($nilaiAkhir >= 75) {
                $grade = 'B';
                $bobot = 3.0;
            } elseif ($nilaiAkhir >= 65) {
                $grade = 'C';
                $bobot = 2.0;
            } elseif ($nilaiAkhir >= 50) {
                $grade = 'D';
                $bobot = 1.0;
            } else {
                $grade = 'E';
                $bobot = 0.0;
            }

            Nilai::create([
                'id_pendidik'     => $krs->id_pendidik,
                'id_mahasiswa'    => $krs->id_mahasiswa,
                'id_ma'           => $krs->id_ma,
                'semester'        => $krs->semester,
                'periode'         => 'Ganjil',
                'tahun_ajaran'    => '2024/2025',
                'nilai_kehadiran' => $kehadiran,
                'nilai_sikap'     => $sikap,
                'nilai_formative' => $formatif,
                'nilai_tugas'     => $tugas,
                'nilai_uts'       => $uts,
                'nilai_uas'       => $uas,
                'nilai_akhir'     => round($nilaiAkhir, 2),
                'grade'           => $grade,
                'bobot_ip'        => $bobot,
            ]);
        }
    }
}
