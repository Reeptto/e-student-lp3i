<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table= 'jadwal';
    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'mk_id',
        'dsn_id',
        'ruangan_id',
        'kelas_id',
        'semester'
    ];
        public function matkul()
        {
            return $this->belongsTo(Matakuliah::class,'mk_id');
        }

        public function dosen()
        {
            return $this->belongsTo(Dosen::class,'dsn_id');
        }

        public function ruangan()
        {
            return $this->belongsTo(Ruangan::class,'ruangan_id');
        }

        public function kelas()
        {
            return $this->belongsTo(Kelas::class, 'kelas_id');
        }

}
