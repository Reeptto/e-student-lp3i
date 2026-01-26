<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table= 'jadwal';
    protected $fillable = [
        'hari',
        'id_mk',
        'jam_mulai',
        'jam_selesai',
        'semester',
        'id_pendidik',
        'id_kelas',
        'id_ruangan'
    ];
        public function matkul()
        {
            return $this->belongsTo(Matakuliah::class,'id_mk', 'id_mk');
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
            return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
        }

}
