<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\User;
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
        return $this->kelas->jurusan();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
