<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';

    protected $fillable = [
        'nipd',
        'kode_mk',
        'dosen_id',
        'kelas_id',
        'bidang_keahlian',
        'sks',
        'semester', // semester pengambilan
        'status',   // normal | ngulang | cuti
    ];

    // =====================
    // RELATIONS
    // =====================

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nipd', 'nipd');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'kode_mk', 'kode_mk');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
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
