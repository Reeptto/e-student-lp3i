<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'matakuliah';
    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'deskripsi',
    ];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'mk_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mk_id');
    }

    public function materi()
    {
        return $this->hasMany(Material::class, 'mk_id');
    }
}
