<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas'; // ← SESUAIKAN DENGAN DB KAMU
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'id_mk',
        'id_kelas',
        'judul_tugas',
        'file_materi',
        'deskripsi',
        'jam_mulai',
        'jam_selesai',
        'status',
    ];

    public function materiAjar()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class, 'id_tugas', 'id_tugas');
    }

    public function submissionByAuth()
    {
        return $this->hasOne(Submission::class, 'id_tugas', 'id_tugas')->where('id_mahasiswa', auth()->user()->id_user);
    }

    public function notif()
    {
        return $this->hasMany(Notification::class, 'id_tugas', 'id_tugas');
    }


}
