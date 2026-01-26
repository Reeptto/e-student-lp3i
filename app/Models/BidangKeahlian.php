<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = 'program_studi';
    protected $fillable = [
        'nama_program_studi',
        'kode_program_studi'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
