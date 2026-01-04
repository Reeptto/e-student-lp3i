<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use App\Models\User;
use App\Models\BidangKeahlian;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

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
        return $this->belongsTo(Kelas::class);
    }

    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class, 'bidang_keahlian_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nilai()
    {
        return $this->belongsTo(Nilai::class);
    }
}
