@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    .font-poppins { font-family: 'Poppins', sans-serif; }

    .announcement-card {
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease-in-out;
    }
    .announcement-card:hover {
        border-color: #004269;
        background-color: #f8fafc;
        transform: translateY(-2px);
    }
</style>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 font-poppins">

    <div class="relative w-full h-48 bg-[#004269] rounded-xl overflow-hidden mb-10 shadow-md group">
        
        <div class="absolute inset-0 z-0">
            <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 800 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                
                {{-- Aksen Garis Miring di Kanan (Tegas & Runcing) --}}
                <path d="M600 0L550 300H800V0H600Z" fill="white" fill-opacity="0.05"/>
                <path d="M650 0L600 300H800V0H650Z" fill="white" fill-opacity="0.05"/>
                
                <line x1="530" y1="0" x2="480" y2="300" stroke="white" stroke-opacity="0.1" stroke-width="1"/>
                <line x1="545" y1="0" x2="495" y2="300" stroke="white" stroke-opacity="0.05" stroke-width="1"/>

                <rect x="25" y="25" width="750" height="250" rx="8" stroke="white" stroke-opacity="0.2" stroke-width="1.5"/>
            </svg>
        </div>

        <div class="absolute inset-0 z-10 flex flex-col justify-center px-10 md:px-14">
            
            <div class="flex items-center gap-2 mb-3">
                <span class="w-1 h-4 bg-blue-300 rounded-full"></span>
                <span class="text-[10px] font-bold text-blue-200 uppercase tracking-[0.2em]">Official Announcement</span>
            </div>
            
            <div class="flex items-center gap-4 mb-2">
                <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center border border-white/20">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white tracking-tight">
                        Papan Pengumuman
                    </h1>
                </div>
            </div>
            
            <p class="text-blue-50/70 text-sm max-w-xl leading-relaxed ml-[4rem] border-l border-white/10 pl-4">
                Informasi resmi terbaru mengenai kegiatan akademik, jadwal, dan pemberitahuan kampus.
            </p>
        </div>
    </div>

    @livewire('daftar-pengumuman')
    

</div>
@endsection