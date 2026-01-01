<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id';
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

    public $timestamps = true;
}
