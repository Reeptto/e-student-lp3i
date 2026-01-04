<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\User;
// use Carbon\Carbon;
class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nipd',
        'user_id',
        'kelas_id',
        'nama_mhs',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'email',
        'Domisili',
        'no_telp',
        'foto',
        'jenis_kelamin',
        'status',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);  
    }

    public function jurusan()
    {
        return $this->kelas->program_studi();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
// <<<<<<< HEAD
//     public function getNamaAttribute()
// {
//     return $this->nama_mhs;
// }

// =======

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }

//     public function getSemesterAktifAttribute()
//     {
//         $tahunMasuk = $this->angkatan;
//         $now = Carbon::now();

//         // selisih tahun
//         $tahunBerjalan = $now->year - $tahunMasuk;

//         // aturan semester:
//         // Agustus–Desember = Ganjil
//         // Januari–Juli = Genap
//         $semester = ($tahunBerjalan * 2) + ($now->month >= 8 ? 1 : 2);

//         return max(1, $semester);
//     }
// }
}
