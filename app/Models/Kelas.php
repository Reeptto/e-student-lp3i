<?php

namespace App\Models;

use App\Models\BidangKeahlian;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'nama_pa',
        'id_program_studi',
    ];

    public function program_studi()
    {
        return $this->belongsTo(BidangKeahlian::class, 'id_program_studi');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
