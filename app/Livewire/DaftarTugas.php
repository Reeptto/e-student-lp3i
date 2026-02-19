<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tugas;
use App\Models\MataKuliah;
use Livewire\WithPagination;    

class DaftarTugas extends Component
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

        $tugas = Tugas::with('materiAjar')
            ->where('id_kelas', $kelas)
            ->when($this->id_mk, function ($q)  {
                $q->where('id_mk', $this->id_mk);
            })
            ->orderBy('deadline')
            ->latest()->paginate(10);

        return view('livewire.daftar-tugas', [
            'semua_tugas' => $tugas,
            'list_semester' => $list_semester,
            'list_matkul' => $list_matkul
            ]);
    }
}