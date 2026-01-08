<?php

namespace App\Models;

use App\Models\BidangKeahlian;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'id_bidang_keahlian'
    ];

    public function program_studi()
    {
        return $this->belongsTo(BidangKeahlian::class, 'bidang_keahlian_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
