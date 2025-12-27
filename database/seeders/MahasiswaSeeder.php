<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::where('email', 'ari@gmail.com')->firstOrFail();
        $user2 = User::where('email', 'esa@gmail.com')->firstOrFail();
        $user3 = User::where('email', 'novi@gmail.com')->firstOrFail();

        $kelas1 = Kelas::where('kode_kelas', 'ASE-10')->firstOrFail();
        $kelas2 = Kelas::where('kode_kelas', 'OAA-13')->firstOrFail();
        $kelas3 = Kelas::where('kode_kelas', 'AIS-12')->firstOrFail();

        Mahasiswa::create(
            [
                'user_id' => $user1->id,
                'kelas_id' => $kelas1->id,
                'nipd'  =>  '2407810040004',
                'nama_mhs' => 'Ari Aprianto',
                'Alamat' => 'Karawang Timur',
                'Domisili' => 'Johar',

                'tempat_lahir' => 'Pemalang',
                'tanggal_lahir' => '2006-04-02',
                'Agama' => 'Islam',
                'email' => $user1->email,
                'no_telp' => '085887375719',
                'jenis_kelamin' => 'Laki-laki',
                'status' => 'Aktif',
            ],
        );

        Mahasiswa::create(
            [
                'user_id' => $user2->id,
                'kelas_id' => $kelas2->id,
                'nipd'  =>  '2407810070044',
                'nama_mhs' => 'Esa Nabila Cahyani',
                'Alamat' => 'Telagasari',
                'Domisili' => 'Johar',
                'tempat_lahir' => 'Padang',
                'tanggal_lahir' => '2006-10-13',
                'Agama' => 'Islam',
                'email' => $user2->email,
                'no_telp' => '085887375719',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
            ],
        );

        Mahasiswa::create(
            [
                'user_id' => $user3->id,
                'kelas_id' => $kelas3->id,
                'nipd'  =>  '2407810030002',
                'nama_mhs' => 'Novi Irnawati',
                'Alamat' => 'Karawang Timur',
                'Domisili' => 'Johar',
                'tempat_lahir' => 'Karawang',
                'tanggal_lahir' => '2005-05-06',
                'agama' => 'Islam',
                'email' => $user3->email,
                'no_telp' => '085887375719',
                'jenis_kelamin' => 'Perempuan',
                'status' => 'Aktif',
            ],
        );
    }
}
