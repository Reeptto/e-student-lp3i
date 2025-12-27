<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $guarded = [];

    // Relasi: 1 Matkul punya banyak Materi
    public function materi()
    {
       return $this->hasMany(Materi::class, 'kode_mk', 'kode_mk');
    }
}