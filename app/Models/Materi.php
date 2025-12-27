<?Php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $guarded = [];

    // Relasi balik ke Matkul
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_mk', 'kode_mk');
    }

    // --- FITUR TAMBAHAN UNTUK BLADE ---

    // 1. Biar gampang panggil URL file
    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_materi);
    }

    // 2. Biar icon berubah otomatis sesuai tipe file
    public function getFileTypeAttribute()
    {
        $extension = pathinfo($this->file_materi, PATHINFO_EXTENSION);
        return match(strtolower($extension)) {
            'pdf' => 'pdf',
            'doc', 'docx' => 'doc',
            'ppt', 'pptx' => 'ppt',
            'mp4', 'mkv', 'webm' => 'video',
            default => 'link',
        };
    }
}