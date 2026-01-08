<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    $this->call([
        UserSeeder::class,
        BidangKeahlianSeeder::class,
        KelasSeeder::class,
        MahasiswaSeeder::class,
        PendidikSeeder::class,
        MateriAjarSeeder::class,
        RuanganSeeder::class,
        JadwalSeeder::class,
        MateriSeeder::class,
        TugasSeeder::class,
        KrsSeeder::class,
        NilaiSeeder::class,
        KhsSeeder::class,
    ]);
}

}
