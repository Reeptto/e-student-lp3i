<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'pendidik';
    protected $primaryKey = 'id_pendidik';
    protected $fillable = [
        'nama',
        'pendidikan',
        'bidang',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'no_tlp',
        'rate_gaji',
        'status',
        'foto',
    ];

    public $timestamps = true;
}
