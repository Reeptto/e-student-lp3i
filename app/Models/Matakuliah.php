<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'materi_ajar';
    protected $fillable = [
        'nama_mk',
        'kode_mk',
        'deskripsi',
        'id_bidang_keahlian',
        'semester',
        'sks',
    ];

    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'id_ma');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_ma');
    }

    public function materi()
    {
        return $this->hasMany(Material::class, 'id_ma', 'id_ma');
    }
}
