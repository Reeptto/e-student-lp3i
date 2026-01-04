<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name' => 'Ari Aprianto',
                'email' => 'ari@gmail.com',
                'password' => '12345678',
                'bidang_keahlian_id' => 1           
        ]);
        User::create([
                'name' => 'Esa Nabila Cahyani',
                'email' => 'esa@gmail.com',
                'password' => '12345678',
                'bidang_keahlian_id'=> 2           
        ]);
        User::create([
                'name' => 'Novi Irnawati',
                'email' => 'novi@gmail.com',
                'password' => '12345678',
                'bidang_keahlian_id'=> 3          
        ]);
    }
}
