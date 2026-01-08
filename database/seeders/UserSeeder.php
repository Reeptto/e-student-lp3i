<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ari Aprianto',
            'email' => 'ari@kampus.test',
            'password' => bcrypt('12345678'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Esa Nabila Cahyani',
            'email' => 'esa@kampus.test',
            'password' => bcrypt('12345678'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Novi Irnawati',
            'email' => 'novi@kampus.test',
            'password' => bcrypt('12345678'),
            'role' => 'mahasiswa',
        ]);
    }
}


