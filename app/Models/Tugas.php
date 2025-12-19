<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $fillable = [
        'mk_id',
        'judul_tugas',
        'file_materi',
        'deskripsi',
        'time_start',
        'time_end',
        'status',
    ];

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }


}
