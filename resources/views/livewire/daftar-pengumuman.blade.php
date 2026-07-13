<div>
    <div class="space-y-4">
        @forelse ($pengumuman as $item)
        <div class="announcement-card bg-white rounded-lg p-6 relative overflow-hidden group">
            
            <div class="absolute left-0 top-0 bottom-0 w-[4px] bg-[#004269] opacity-0 group-hover:opacity-100 transition-opacity"></div>

            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3 mb-2">
                <h2 class="text-base font-bold text-gray-800 group-hover:text-[#004269] transition-colors">
                    {{ $item->judul_pengumuman }}
                </h2>

                <span class="text-[11px] font-medium text-gray-400 bg-gray-50 px-2 py-1 rounded border border-gray-100 whitespace-nowrap">
                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}
                </span>
            </div>

            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-2">
                {{ $item->isi }}
            </p>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center py-16 bg-white rounded-lg border border-dashed border-gray-300 text-gray-400">
            <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
            </div>
            <p class="text-xs font-semibold uppercase tracking-wider">Tidak ada pengumuman</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $pengumuman->links() }}
    </div>
</div>