<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';

    protected $fillable = [
        'mk_id',
        'mhs_id',
        'kehadiran',
        'attitude',
        'nilai_tugas',
        'nilai_formative',
        'nilai_uts',
        'nilai_uas'
    ];

    protected $appends = [
        'nilai_akhir',
        'huruf_mutu',
        'nilai_kumulatif'
    ];

    public function matkul()
    {
        return $this->belongsTo(Matakuliah::class, 'mk_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mhs_id');
    }

    /* ================= NILAI AKHIR ================= */

    public function getNilaiAkhirAttribute()
    {
        return round(
            ($this->kehadiran * 0.05) +
            ($this->attitude * 0.05) +
            ($this->nilai_tugas * 0.15) +
            ($this->nilai_formative * 0.20) +
            ($this->nilai_uts * 0.25) +
            ($this->nilai_uas * 0.30),
            2
        );
    }

    /* ================= HURUF MUTU ================= */

    public function getHurufMutuAttribute()
    {
        $n = $this->nilai_akhir;

        return match (true) {
            $n >= 4.00 => 'A',
            $n >= 3.60 => 'A-',
            $n >= 3.30 => 'B+',
            $n >= 3.00 => 'B',
            $n >= 2.60 => 'B-',
            $n >= 2.30 => 'C+',
            $n >= 2.00 => 'C',
            $n >= 1.30 => 'D',
            default => 'E',
        };
    }

    /* ================= BOBOT ================= */

    public function getBobotAttribute()
    {
        return match ($this->huruf_mutu) {
            'A'  => 4.0,
            'A-' => 3.7,
            'B+' => 3.3,
            'B'  => 3.0,
            'B-' => 2.7,
            'C+' => 2.3,
            'C'  => 2.0,
            'D'  => 1.0,
            default => 0
        };
    }

    /* ================= NILAI KUMULATIF ================= */

    public function getNilaiKumulatifAttribute()
    {
        return $this->matkul
            ? $this->bobot * $this->matkul->sks
            : 0;
    }
}
