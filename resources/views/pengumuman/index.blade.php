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
            <h1 class="text-3xl font-black text-white bg-[#ff0000] uppercase tracking-widest flex items-center gap-4 p-2 shadow-[4px_4px_0px_0px_black] transform -skew-x-6">
                    <span class="text-2xl bg-white text-black w-8 h-8 flex items-center justify-center border-2 border-black rounded-full shadow-[2px_2px_0px_0px_black] transform skew-x-6">📢</span>
                    <span class="transform skew-x-6">Pengumuman</span>
                </h1>
                <br>
        <p class="text-sm font-bold text-gray-600 bg-white border-2 border-black px-3 py-1 shadow-[4px_4px_0px_0px_#ccc] inline-block">
            Berita terbaru dan informasi penting.
        </p>
            <p class="text-sm font-bold text-gray-500 mt-2 uppercase tracking-widest pl-1">
                Inbox Masuk: <span class="text-[#ff0000]">{{ $pengumuman->count() }}</span> Pesan
            </p>
        </div>
        <div class="flex gap-2 mb-2 items-center bg-black text-white px-3 py-1 rounded-full">
            <div class="w-2 h-2 bg-[#ff0000] rounded-full animate-ping"></div>
            <span class="text-xs font-bold uppercase">Live Update</span>
        </div>
    </div>

    <div class="grid gap-6">
        @forelse ($pengumuman as $item)
            <article class="group relative bg-white border-2 border-black hover:border-[#ff0000] shadow-[8px_8px_0px_0px_black] hover:shadow-[8px_8px_0px_0px_#ff0000] transition-all duration-200 transform hover:-translate-y-1">
                
                <div class="flex justify-between items-center border-b-2 border-black p-4 pb-2 bg-gray-50 group-hover:bg-red-50 transition-colors">
                    <div class="flex items-center gap-2">
                        <span class="bell-icon text-lg">🔔</span> 
                        <span class="text-xs font-black text-gray-400 group-hover:text-[#ff0000] uppercase tracking-widest">
                            System Alert
                        </span>
                    </div>
                    <span class="text-xs font-bold text-white bg-black px-2 py-0.5 shadow-[2px_2px_0px_0px_#ff0000]">
                        {{ \Carbon\Carbon::parse($item->tanggal_terbit)->diffForHumans() }}
                    </span>
                </div>

                <div class="p-6 pt-4 flex gap-4">
                    <div class="hidden sm:flex flex-col items-center justify-center w-16 shrink-0 border-r-2 border-dashed border-gray-300 pr-4 group-hover:border-[#ff0000] transition-colors">
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
                    <button class="bg-black text-white text-xs font-bold px-4 py-2 hover:bg-[#ff0000] transition-colors shadow-[3px_3px_0px_0px_rgba(0,0,0,0.3)] hover:shadow-[3px_3px_0px_0px_black] border border-transparent hover:border-black">
                        MARK AS READ
                    </button>
                </div>

            </article>
        @empty
            <div class="bg-white border-2 border-black border-dashed p-10 text-center shadow-[4px_4px_0px_0px_#ccc]">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-gray-300">
                    <span class="text-3xl grayscale opacity-50">🔕</span>
                </div>
                <p class="text-gray-500 font-bold uppercase tracking-wide">No New Notifications</p>
                <p class="text-xs text-gray-400 mt-1">Check back later for updates.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12 text-center border-t-2 border-black pt-6 relative">
        <span class="absolute top-[-10px] left-1/2 transform -translate-x-1/2 bg-white px-2 text-xs font-black text-gray-300 uppercase tracking-widest">System Log End</span>
        <p class="text-xs font-bold text-gray-400 uppercase">End of Notification Stream</p>
    </div>
</div>
@endsection