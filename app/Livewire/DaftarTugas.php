<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tugas;
use App\Models\MataKuliah;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DaftarTugas extends Component
{
    use WithPagination;

    public $semester = '';
    public $id_mk = '';

    // Data user di-cache di properti agar tidak query ulang tiap render
    public $id_kelas;
    public $id_prodi;

    // Data semester untuk filter (pre-loaded sekali saat mount)
    public $listSemester = [];

    public function mount()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        abort_if(!$mahasiswa, 403);

        $this->id_kelas = $mahasiswa->id_kelas;
        $this->id_prodi = $mahasiswa->id_program_studi;

        // Load semester sekali saat mount, difilter per prodi mahasiswa
        $this->listSemester = MataKuliah::where('id_program_studi', $this->id_prodi)
            ->distinct()
            ->orderBy('semester', 'asc')
            ->pluck('semester')
            ->toArray();
    }

    public function updatedSemester()
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
        // List matkul hanya dimuat saat semester dipilih, difilter per prodi
        $list_matkul = collect([]);
        if (!empty($this->semester)) {
            $list_matkul = MataKuliah::where('id_program_studi', $this->id_prodi)
                ->where('semester', $this->semester)
                ->orderBy('nama_mk', 'asc')
                ->get();
        }

        // Eager load materiAjar + submissionByAuth sekaligus — stop N+1 query
        $tugas = Tugas::with(['materiAjar', 'submissionByAuth'])
            ->where('id_kelas', $this->id_kelas)
            ->when($this->id_mk, function ($q) {
                $q->where('id_mk', $this->id_mk);
            })
            ->when($this->semester && empty($this->id_mk), function ($q) {
                $q->whereHas('materiAjar', function ($sub) {
                    $sub->where('semester', $this->semester);
                });
            })
            ->orderBy('deadline')
            ->latest()
            ->paginate(10);

        return view('livewire.daftar-tugas', [
            'semua_tugas'    => $tugas,
            'list_semester'  => $this->listSemester,
            'list_matkul'    => $list_matkul,
        ]);
    }
}