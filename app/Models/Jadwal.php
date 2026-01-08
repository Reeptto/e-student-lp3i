<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table= 'jadwal';
    protected $fillable = [
        'hari',
        'mk_id',
        'jam_mulai',
        'jam_selesai',
        'dsn_id',
        'ruangan_id',
        'kelas_id',
        'semester'
    ];
        public function matkul()
        {
            return $this->belongsTo(Matakuliah::class,'id_ma', 'id_ma');
        }

        public function dosen()
        {
            return $this->belongsTo(Dosen::class,'id_pendidik', 'id_pendidik');
        }

        public function ruangan()
        {
            return $this->belongsTo(Ruangan::class,'id_ruangan', 'id_ruangan');
        }

        public function kelas()
        {
            return $this->belongsTo(Kelas::class, 'id_kelas');
        }

}
