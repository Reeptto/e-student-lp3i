<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliah::create([
            'kode_mk' => 'ABP-01',
            'nama_mk' => 'Algorithm and Basic Programming',
            'semester' => '2',
            'sks' => '4',
            'deskripsi' => 'Mata Kuliah yang mempelajari tentang pemrograman web.'
        ]);

        MataKuliah::create([
            'kode_mk' => 'EGC-01',
            'nama_mk' => 'English General Communication 1',
            'semester' => '2',
            'sks' => '2',
            'deskripsi' => 'Mata Kuliah yang mempelajari grammar, vocab, bahasa inggris.'
        ]);

        MataKuliah::create([
            'kode_mk' => 'WD-01',
            'nama_mk' => 'Web Design',
            'semester' => '2',
            'sks' => '4',
            'deskripsi' => 'Mata Kuliah yang mempelajari tentang desain web.'
        ]);

        MataKuliah::create([
             'kode_mk' => 'CFO2-01',
             'nama_mk' => 'Computer for Office 2',
             'semester' => '1',
            'sks' => '4',
             'deskripsi' => 'Mata Kuliah yang mempelajari tentang desain web.'
        ]);

        MataKuliah::create([
             'kode_mk' => 'CFO1-01',
             'nama_mk' => 'Computer fot Office 1',
             'semester' => '1',
            'sks' => '2',
             'deskripsi' => 'Mata Kuliah yang mempelajari tentang desain web.'
        ]);
    }
}
