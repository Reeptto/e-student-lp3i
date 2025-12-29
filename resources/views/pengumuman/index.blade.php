@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');
    
    /* Animasi Lonceng Getar */
    @keyframes ring {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(15deg); }
        75% { transform: rotate(-15deg); }
    }
    .group:hover .bell-icon {
        animation: ring 0.5s ease-in-out infinite;
    }
</style>

<div class="max-w-4xl mx-auto p-6" style="font-family: 'Poppins', sans-serif;">
    
    <div class="mb-10 border-b-4 border-black pb-4 flex items-end justify-between">
        <div>
            <h1 class="text-3xl font-black text-white bg-[#ff0000] uppercase tracking-widest flex items-center gap-4 p-2">
                    <span class="text-2xl bg-white text-black w-8 h-8 flex items-center justify-center border-2 border-black rounded-full shadow-[2px_2px_0px_0px_black]">📢</span>
                    Pengumuman
                </h1>
                <br>
        <p class="text-sm font-bold text-gray-600 bg-white border-2 border-black px-3 py-1 shadow-[4px_4px_0px_0px_#ccc]">
            Berita terbaru dan informasi penting.
        </p>
            <p class="text-sm font-bold text-gray-500 mt-1 uppercase tracking-widest">
                Inbox Masuk: {{ $pengumuman->count() }} Pesan
            </p>
        </div>
        <div class="flex gap-1 mb-2">
            <div class="w-2 h-2 bg-[#ff0000] rounded-full animate-ping"></div>
            <span class="text-xs font-bold text-[#ff0000]">Lihat</span>
        </div>
    </div>

    <div class="grid gap-6">
        @forelse ($pengumuman as $item)
            <article class="group relative bg-white border-2 border-l-[12px] border-black hover:border-l-[#ff0000] shadow-[6px_6px_0px_0px_rgba(0,0,0,0.15)] hover:shadow-[6px_6px_0px_0px_#ff0000] transition-all duration-300">
                
                <div class="flex justify-between items-center border-b-2 border-gray-100 p-4 pb-2 bg-gray-50 group-hover:bg-red-50 transition-colors">
                    <div class="flex items-center gap-2">
                        <span class="bell-icon text-lg">🔔</span> 
                        <span class="text-xs font-black text-gray-400 group-hover:text-[#ff0000] uppercase tracking-widest">
                            System Alert
                        </span>
                    </div>
                    <span class="text-xs font-bold text-black bg-white border border-black px-2 py-0.5 shadow-[2px_2px_0px_0px_#ccc]">
                        {{ \Carbon\Carbon::parse($item->tanggal_terbit)->diffForHumans() }}
                    </span>
                </div>

                <div class="p-6 pt-4 flex gap-4">
                    <div class="hidden sm:flex flex-col items-center justify-center w-16 shrink-0 border-r-2 border-dashed border-gray-300 pr-4">
                        <span class="text-4xl font-black text-gray-200 group-hover:text-[#ff0000] transition-colors">!</span>
                    </div>

                    <div class="flex-grow">
                        <h2 class="text-xl font-black text-black mb-2 uppercase leading-tight group-hover:text-[#ff0000] transition-colors">
                            {{ $item->judul_informasi }}
                        </h2>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed">
                            {{ $item->deskripsi }}
                        </p>
                    </div>
                </div>

                <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-2 group-hover:translate-x-0 duration-200">
                    <button class="bg-[#004269] text-white text-xs font-bold px-3 py-1 hover:bg-[#ff0000] transition-colors">
                        MARK AS READ
                    </button>
                </div>

            </article>
        @empty
            <div class="bg-white border-2 border-black border-dashed p-8 text-center">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <span class="text-2xl">🔕</span>
                </div>
                <p class="text-gray-500 font-bold uppercase">No New Notifications</p>
            </div>
        @endforelse
    </div>

    <div class="mt-10 text-center border-t border-black pt-4">
        <p class="text-xs font-bold text-gray-400 uppercase">End of Notification Stream</p>
    </div>
</div>
@endsection