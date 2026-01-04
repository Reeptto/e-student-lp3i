<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\Kelas;

use App\Models\Tugas;


class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abp = MataKuliah::where('kode_mk', 'ABP-01')->first();
        $egc = MataKuliah::where('kode_mk', 'EGC-01')->first();
        $wd = MataKuliah::where('kode_mk', 'WD-01')->first();

        // $mk = MataKuliah::firstOrFail();
        $dosen = Dosen::firstOrFail();
        $kelas = Kelas::firstOrFail();

        Tugas::create([
            'mk_id' => $abp->id,
            'dsn_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'judul_tugas' => 'buatlah mainan seru',
            'file_materi' => 'file.pdf',
            'deskripsi' => 'Buatlah program kalkulator sederhana',
            'time_start' => '2026-01-02 08:00:00',
            'time_end' => '2026-01-02 12:00:00',
            'status' => 'Belum Selesai',
        ]);

        Tugas::create([
            'mk_id' => $abp->id,
            'dsn_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'judul_tugas' => 'Membuat Program Kalkulator Sederhana',
            'file_materi' => 'file.pdf',
            'deskripsi' => 'Buatlah program kalkulator sederhana',
            'time_start' => '2026-01-02 08:00:00',
            'time_end' => '2026-01-03 08:00:00',
            'status' => 'Belum Selesai',
        ]);



            Tugas::create([
            'mk_id' => $egc->id,
            'dsn_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'judul_tugas' => 'Membuat kepalamu berpikir',
            'file_materi' => 'file.pdf',
            'deskripsi' => 'Buatlah semacam analisa barang ga boleh tanya gpt',
            'time_start' => '2026-01-02 08:00:00',
            'time_end' => '2026-01-04 20:00:00',
            'status' => 'Belum Selesai',
        ]);



            Tugas::create([
            'mk_id' => $egc->id,
            'dsn_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'judul_tugas' => 'Membuat puisi',
            'file_materi' => 'ichi.html',
            'deskripsi' => 'Buatlah sebuah puisi untuk dirimu sendiri, kenapa bisa dirimu jadi begitu',
            'time_start' => '2026-01-02 08:00:00',
            'time_end' => '2026-01-04 20:00:00',
            'status' => 'Belum Selesai',
        ]);


            Tugas::create([
            'mk_id' => $wd->id,
            'dsn_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'judul_tugas' => 'Membuat Indonesia bebas dari korupsi',
            'file_materi' => 'file.doc',
            'deskripsi' => 'Buatlah sebuah cerita dimana indonesia bisa bebas dari korupsi',
            'time_start' => '2026-01-02 08:00:00',
            'time_end' => '2026-01-04 20:00:00',
            'status' => 'Belum Selesai',
        ]);


                Tugas::create([
            'mk_id' => $wd->id,
            'dsn_id' => $dosen->id,
            'kelas_id' => $kelas->id,
            'judul_tugas' => 'Membuat Program Vr',
            'file_materi' => 'file.pdf',
            'deskripsi' => 'Buatlah program VR seperti the Spirealm',
            'time_start' => '2026-01-02 08:00:00',
            'time_end' => '2026-01-03 20:00:00',
            'status' => 'Belum Selesai',
        ]);

            }
}
