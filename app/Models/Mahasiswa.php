<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\User;
use App\Models\BidangKeahlian;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nipd',
        'user_id',
        'kelas_id',
        'bidang_keahlian_id', // jangan lupa ditambah kalau kolomnya ada
        'nama_mhs',
        'alamat',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'email',
        'Domisili',
        'no_telp',
        'semester_aktif',
        'foto',
        'jenis_kelamin',
        'status',
    ];

    // RELASI
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'id_program_studi', 'id_program_studi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }

    public function khs()
    {
        return $this->hasMany(Khs::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
