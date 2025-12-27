<?php

namespace App\Models;

use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materi';
    protected $fillable = [
        'mk_id',
        'nama_materi',
        'file_materi',
        'deskripsi',
        'pertemuan',
        'tgl_upload',
    ];

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class, 'mk_id');
    }


}
