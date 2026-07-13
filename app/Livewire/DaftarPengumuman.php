<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengumuman;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DaftarPengumuman extends Component
{
    use WithPagination;

    public function render()
    {
        $user = auth()->user();
        if (!$user) abort(403);

        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.daftar-pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
