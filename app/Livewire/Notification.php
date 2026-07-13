<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tugas;

class Notification extends Component
{
    public $notifs = [];
    public $count = 0;

    // Listener untuk update notifikasi dari event Livewire
    protected $listeners = ['refreshNotification' => 'loadNotif'];

    public function loadNotif()
    {
        $mahasiswa = auth()->user()?->mahasiswa;
        if (!$mahasiswa) return;

        // Tampilkan tugas baru dalam 7 hari terakhir sebagai notifikasi "baru"
        $this->notifs = Tugas::where('id_kelas', $mahasiswa->id_kelas)
            ->where('created_at', '>=', now()->subDays(7))
            ->latest()
            ->take(5)
            ->get();

        $this->count = $this->notifs->count();
    }

    public function mount()
    {
        $this->loadNotif();
    }

    public function render()
    {
        return view('livewire.notif-tugas');
    }
}