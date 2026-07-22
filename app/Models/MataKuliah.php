<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $fillable = [
        'nama_mk',
        'kode_mk',
        'deskripsi',
        'tipe_matakuliah',
        'id_program_studi',
        'semester',
        'sks',
    ];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_mk');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_mk');
    }

    public function materi()
    {
        return $this->hasMany(Material::class, 'id_mk', 'id_mk');
    }
}
