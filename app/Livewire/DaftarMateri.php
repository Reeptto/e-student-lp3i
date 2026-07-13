<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Matakuliah;
use App\Models\Material;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DaftarMateri extends Component
{
    use WithPagination;

    public $semester = '';
    public $id_mk = '';

    // Data user di-cache di properti agar tidak query ulang tiap render
    public $id_kelas;
    public $id_prodi;

    // Data semester untuk filter (pre-loaded sekali saat mount, difilter per prodi)
    public $listSemester = [];

    public function mount()
    {
        $mahasiswa = auth()->user()->mahasiswa;
        abort_if(!$mahasiswa, 403);

        $this->id_kelas = $mahasiswa->id_kelas;
        $this->id_prodi = $mahasiswa->id_program_studi;

        // Load semester sekali saat mount, hanya semester dari matakuliah prodi mahasiswa
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

        $materi = Material::with(['kelas', 'materiAjar'])
            ->where('id_kelas', $this->id_kelas)
            ->when($this->semester, function ($query) {
                return $query->whereHas('materiAjar', function ($q) {
                    $q->where('semester', $this->semester);
                });
            })
            ->when($this->id_mk, function ($query) {
                return $query->where('id_mk', $this->id_mk);
            })
            ->orderBy('tgl_upload', 'desc')
            ->latest()
            ->paginate(10);

        return view('livewire.daftar-materi', [
            'materi'        => $materi,
            'list_semester' => $this->listSemester,
            'list_matkul'   => $list_matkul,
        ]);
    }
}
