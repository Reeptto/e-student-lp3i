<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;

class BidangKeahlian extends Model
{
    protected $table = 'bidang_keahlian';
    protected $fillable = [
        'nama_bidang_keahlian',
        'kode_bidang_keahlian'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
