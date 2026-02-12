<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // Agar halaman tidak reload saat ganti page
use App\Models\Material;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;

class MaterialFilter extends Component 
{
    use WithPagination;

    public $semester = '';
    public $id_mk = '';

    public function updatedSemester ()
    {
        $this->id_mk = '';
        $this->resetPage();
    }

    public function updatedIdMk()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = auth()->user()->mahasiswa->id_kelas;
        abort_if(!$user, 403);

        $kelas = auth()->user()->mahasiswa->id_kelas;
        $prodi = auth()->user()->mahasiswa->id_program_studi;
        
        $list_semester = Matakuliah::select('semester')->distinct()->orderBy('semester', 'asc')->pluck('semester');

        $list_matkul = collect([]);

        if (!empty($this->semester)) {
            $list_matkul = Matakuliah::where('id_program_studi', $prodi)->when($this->semester, function ($query) {
                    return $query->where('semester', $this->semester);
                })
                ->orderBy('nama_mk', 'asc')
                ->get();
        }


        $materi = Material::with(['kelas', 'materiAjar'])
            ->where('id_kelas', $kelas)->when($this->semester, function ($query) {
                return $query->whereHas('materiAjar', function ($q) {
                    $q->where('semester', $this->semester);
                });
            })->when($this->id_mk, function ($query) {
                return $query->where('id_mk', $this->id_mk);
            })->orderBy('tgl_upload', 'desc')->paginate(10);


    return view('livewire.material-filter', [
            'materi' => $materi,
            'list_semester' => $list_semester, 
            'list_matkul' => $list_matkul,        
        ]);
    }
}