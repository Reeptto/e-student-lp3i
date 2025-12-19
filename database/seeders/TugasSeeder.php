<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
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

        Tugas::create([
            'mk_id' => $abp->id,
            'judul_tugas' => 'Membuat Flowchart Kue Coklat',
            'file_materi' => null,
            'deskripsi' => 'Buatlah alur untuk membuat kue coklat.',
            'time_start' => '08:00:00',
            'time_end' => '20:00:00',
            'status' => 'Belum Selesai',
        ]);

        Tugas::create([
            'mk_id' => $abp->id,
            'judul_tugas' => 'Membuat Program Kalkulator Sederhana ',
            'file_materi' => null,
            'deskripsi' => 'Buatlah program kallulator sederhana',
            'time_start' => '08:00:00',
            'time_end' => '20:00:00',
            'status' => 'Belum Selesai',
        ]);


        Tugas::create([
            'mk_id' => $egc->id,
            'judul_tugas' => 'Kosakata Bahasa Inggris',
            'file_materi' => null,
            'deskripsi' => 'kumpulkanlah 20 kosakata bahasa inggris',
            'time_start' => '08:00:00',
            'time_end' => '20:00:00',
            'status' => 'Belum Selesai',
        ]);

        Tugas::create([
            'mk_id' => $wd->id,
            'judul_tugas' => 'Membuat Navbar Sederhana',
            'file_materi' => null,
            'deskripsi' => 'Buatlah navbar sederhana.',
            'time_start' => '08:00:00',
            'time_end' => '20:00:00',
            'status' => 'Belum Selesai',
        ]);

        Tugas::create([
            'mk_id' => $wd->id,
            'judul_tugas' => 'Membuat Tombol Berwarna',
            'file_materi' => null,
            'deskripsi' => 'Buatlah tombol berwarna.',
            'time_start' => '08:00:00',
            'time_end' => '20:00:00',
            'status' => 'Belum Selesai',
        ]);
    }
}
