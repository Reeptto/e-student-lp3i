<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table= 'jadwal';
    protected $fillabe = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'mk_id',
        'dsn_id',
        'ruangan_id'
    ];
        public function matkul()
        {
            return $this->belongsTo(Matakuliah::class,'mk_id');
        }
        public function dosen(){
            return $this->belongsTo(Dosen::class,'dsn_id');
        }
        public function ruangan(){
            return $this->belongsTo(Ruangan::class,'ruangan_id');
    }

}
