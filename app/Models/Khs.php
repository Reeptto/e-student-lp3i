<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Khs extends Model
{
    
    protected $table = 'khs';
    protected $fillable = [
        'mahasiswa_id',
        'semester',
        'ip_semester',
        'ipk'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
