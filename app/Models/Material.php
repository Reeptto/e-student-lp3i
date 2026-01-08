<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_ma',
        'judul_materi',
        'file_materi',
        'deskripsi',
        'pertemuan',
        'tgl_upload',
    ];

    public function materiAjar()
    {
        return $this->belongsTo(MataKuliah::class, 'id_ma', 'id_ma');
    }
}
