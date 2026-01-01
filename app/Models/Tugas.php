<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $fillable = [
        'mk_id',
        'dsn_id',
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

    public function submissionByAuth()
    {
        return $this->hasOne(Submission::class)->where('mhs_id', auth()->id());
    }


}
