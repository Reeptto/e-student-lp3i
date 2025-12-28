<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $ari  = User::where('email', 'ari@gmail.com')->firstOrFail();
        $esa  = User::where('email', 'esa@gmail.com')->firstOrFail();
        $novi = User::where('email', 'novi@gmail.com')->firstOrFail();

        $kelasAse = Kelas::where('kode_kelas', 'ASE-10')->firstOrFail();
        $kelasOaa = Kelas::where('kode_kelas', 'OAA-13')->firstOrFail();
        $kelasAis = Kelas::where('kode_kelas', 'AIS-12')->firstOrFail();

        Mahasiswa::create([
            'user_id' => $ari->id,
            'kelas_id' => $kelasAse->id,
            'nipd' => '2407810040004',
            'nama_mhs' => 'Ari Aprianto',
            'alamat' => 'Karawang Timur',
            'Domisili' => 'Johar',
            'tempat_lahir' => 'Pemalang',
            'tanggal_lahir' => '2006-04-02',
            'jurusan' => 1,
            'angkatan' => 2024,
            'periode' => '2024/2025',
            'agama' => 'Islam',
            'email' => $ari->email,
            'no_telp' => '085887375719',
            'foto' => 'ari.jpg',
            'jenis_kelamin' => 'Laki-laki',
            'status' => 'Aktif',
        ]);

        Mahasiswa::create([
            'user_id' => $esa->id,
            'kelas_id' => $kelasOaa->id,
            'nipd' => '2407810070044',
            'nama_mhs' => 'Esa Nabila Cahyani',
            'alamat' => 'Telagasari',
            'Domisili' => 'Johar',
            'tempat_lahir' => 'Padang',
            'tanggal_lahir' => '2006-10-13',
            'jurusan' => 2,
            'angkatan' => 2024,
            'periode' => '2024/2025',
            'agama' => 'Islam',
            'email' => $esa->email,
            'no_telp' => '085887375719',
            'foto' => 'esa.jpg',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
        ]);

        Mahasiswa::create([
            'user_id' => $novi->id,
            'kelas_id' => $kelasAis->id,
            'nipd' => '2407810030002',
            'nama_mhs' => 'Novi Irnawati',
            'alamat' => 'Karawang Timur',
            'Domisili' => 'Johar',
            'tempat_lahir' => 'Karawang',
            'tanggal_lahir' => '2005-05-06',
            'jurusan' => 3,
            'angkatan' => 2023,
            'periode' => '2023/2024',
            'agama' => 'Islam',
            'email' => $novi->email,
            'no_telp' => '085887375719',
            'foto' => 'novi.jpg',
            'jenis_kelamin' => 'Perempuan',
            'status' => 'Aktif',
        ]);
    }
}
