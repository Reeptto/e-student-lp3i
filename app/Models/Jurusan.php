<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'program_studi';
    protected $fillable = [
        'nama_jurusan',
        'kode_jurusan'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
