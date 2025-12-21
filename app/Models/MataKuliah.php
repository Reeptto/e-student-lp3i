<?php

namespace App\Models;

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
}
