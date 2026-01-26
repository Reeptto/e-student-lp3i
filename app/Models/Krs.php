<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';

    protected $fillable = [
        'id_mahasiswa',
        'id_pendidik',
        'id_kelas',
        'id_mk',
        'sks',
        'semester', // semester pengambilan
    ];

    // =====================
    // RELATIONS
    // =====================

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function materiAjar()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public function pendidik()
    {
        return $this->belongsTo(Dosen::class, 'id_pendidik', 'id_pendidik');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // =====================
    // HELPERS (AMAN)
    // =====================

    // Semester kurikulum MK (beda dengan semester KRS)
    public function getSemesterMkAttribute()
    {
        return $this->mataKuliah->semester ?? null;
    }
}
