<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submission';
    protected $fillable = [
        'file_tugas_mhs',
        'mhs_id',
        'tugas_id',
        'nilai',   
        'status',   
        'submitted_at',   
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
