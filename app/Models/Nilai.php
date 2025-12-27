<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = "nilai";
    protected $fillable = [
        'mk_id',
        'mhs_id',
        'nilai_tugas',
        'nilai_formative',
        'nilai_uts',
        'nilai_uas', 
        'grade', 
        'nilai_akhir', 
    ];

    public function matkul()
    {
        return $this->belongsTo(Matakuliah::class, 'mk_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }
}
