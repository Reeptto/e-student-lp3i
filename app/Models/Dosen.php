<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen'; // pastikan sama dengan tabel di migrasi
    protected $primaryKey = 'id'; // sesuai kolom id
    protected $fillable = [
        'nidn',
        'nama_dsn',
        'tempat_lahir',
        'tgl_lahir',
        'pendidikan',
        'bidang',
        'jenis_kelamin',
        'status',
    ];

    public $timestamps = true; // karena tabel dosen ada created_at dan updated_at
}
