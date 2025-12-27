<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    protected $table = 'krs';
    
    // Sesuaikan fillable dengan nama kolom baru
    protected $fillable = ['nipd', 'kode_mk', 'semester', 'tahun_ajaran'];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        // Parameter: (ModelTujuan, Foreign Key di tabel ini, Primary Key di tabel tujuan)
        return $this->belongsTo(Mahasiswa::class, 'nipd');
    }

    // Relasi ke Matakuliah
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }
}