<div wire:poll.30s="loadNotif" class="relative inline-block">
    <button onclick="toggleNotif()" class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
        <i class="fas fa-bell text-xl"></i>
        @if($count > 0)
        <span class="absolute top-0 right-0 bg-red-500 text-white text-[10px] font-bold min-w-[18px] h-[18px] flex items-center justify-center px-1 rounded-full">
            {{ $count }}
        </span>
        @endif
    </button>
    <div id="modalNotif"
        class="absolute right-0 mt-2 w-80 bg-white shadow-xl rounded-xl border border-slate-200 hidden z-[9999] overflow-hidden">
        <div class="px-4 py-3 border-b border-slate-100 bg-slate-50 flex items-center justify-between">
            <span class="font-bold text-sm text-slate-700">Notifikasi Tugas Baru</span>
            @if($count > 0)
            <span class="text-[10px] font-bold bg-red-100 text-red-600 px-2 py-0.5 rounded-full">{{ $count }} baru</span>
            @endif
        </div>
        <div class="max-h-72 overflow-y-auto divide-y divide-slate-50">
            @forelse($notifs as $notif)
            <a href="{{ route('tugas.show', $notif->id_tugas) }}" wire:navigate
               class="flex items-start gap-3 p-3 hover:bg-slate-50 transition-colors group">
                <div class="w-8 h-8 flex-shrink-0 bg-cyan-50 border border-cyan-100 rounded-lg flex items-center justify-center text-[#009da5] mt-0.5">
                    <i class="fas fa-clipboard-list text-xs"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-slate-700 group-hover:text-[#009da5] transition-colors line-clamp-1">
                        {{ $notif->judul_tugas }}
                    </p>
                    <p class="text-[10px] text-slate-400 mt-0.5">
                        {{ $notif->created_at->diffForHumans() }}
                    </p>
                </div>
            </a>
            @empty
            <div class="p-6 text-center">
                <i class="fas fa-bell-slash text-slate-300 text-2xl mb-2"></i>
                <p class="text-xs text-slate-400 font-medium">Tidak ada tugas baru</p>
            </div>
            @endforelse
        </div>
        @if($count > 0)
        <div class="border-t border-slate-100 p-2">
            <a href="{{ route('tugas') }}" wire:navigate
               class="block text-center text-xs font-bold text-[#009da5] hover:text-[#007a82] py-1.5 transition-colors">
                Lihat Semua Tugas →
            </a>
        </div>
        @endif
    </div>

    <script>
        function toggleNotif() {
            document.getElementById("modalNotif").classList.toggle("hidden");
        }
        // Tutup modal notif jika klik di luar
        document.addEventListener('click', function(e) {
            const modal = document.getElementById('modalNotif');
            if (modal && !modal.classList.contains('hidden')) {
                if (!e.target.closest('#modalNotif') && !e.target.closest('[onclick="toggleNotif()"]')) {
                    modal.classList.add('hidden');
                }
            }
        });
    </script>
</div>