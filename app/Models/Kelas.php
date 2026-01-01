<?php

namespace App\Models;

use App\Models\Jurusan;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'prodi_id'
    ];

    public function program_studi()
    {
        return $this->belongsTo(Jurusan::class, 'prodi_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
