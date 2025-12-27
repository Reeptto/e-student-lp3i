<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $mk = Matakuliah::where('nama_mk', 'Algorithm and Basic Programming')->firstOrFail();

        Material::insert([
            [
                'mk_id' => $mk->id,
                'nama_materi' => 'Pengenalan Algoritma',
                'file_materi' => 'materi/contoh.pdf',
                'pertemuan' => '1',
                'deskripsi' => 'Materi dasar pengertian algoritma, karakteristik, dan contoh sederhana.',
                'tgl_upload' => now()
            ],
            [
                'mk_id' => $mk->id,
                'nama_materi' => 'Flowchart dan Pseudocode',
                'file_materi' => 'materi/contoh.pdf',
                'pertemuan' => '2',
                'deskripsi' => 'Pembahasan flowchart, simbol-simbol, dan penulisan pseudocode.',
                'tgl_upload' => now()
            ],
            [
                'mk_id' => $mk->id,
                'nama_materi' => 'Struktur Kontrol Percabangan',
                'file_materi' => 'materi/contoh.pdf',
                'pertemuan' => '3',
                'deskripsi' => 'If, if-else, dan switch case dalam algoritma.',
                'tgl_upload' => now()
            ],

        ]);
    }
}
