<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'information';

    protected $fillable = [
        'judul_informasi',
        'deskripsi',
        'tanggal_terbit',
    ];
}
