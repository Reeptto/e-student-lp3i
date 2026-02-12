<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materi';
    protected $primaryKey = 'id_materi';

    protected $fillable = [
        'id_mk',
        'id_kelas',
        'id_pendidik',
        'judul_materi',
        'deskripsi',
        'tipe_materi',
        'pertemuan',
        'tgl_upload',
    ];

    public function materiAjar()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');

    }
}
