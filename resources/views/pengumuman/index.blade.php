@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    .font-poppins { font-family: 'Poppins', sans-serif; }

    /* Card Hover */
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

    {{-- === HEADER FORMAL CORPORATE STYLE === --}}
    <div class="relative w-full h-48 bg-[#004269] rounded-xl overflow-hidden mb-10 shadow-md group">
        
        {{-- 1. BACKGROUND SVG (POLA GEOMETRIS TEGAS) --}}
        <div class="absolute inset-0 z-0">
            <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 800 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                
                {{-- Aksen Garis Miring di Kanan (Tegas & Runcing) --}}
                <path d="M600 0L550 300H800V0H600Z" fill="white" fill-opacity="0.05"/>
                <path d="M650 0L600 300H800V0H650Z" fill="white" fill-opacity="0.05"/>
                
                {{-- Garis Diagonal Tipis (Aksen Tech/Formal) --}}
                <line x1="530" y1="0" x2="480" y2="300" stroke="white" stroke-opacity="0.1" stroke-width="1"/>
                <line x1="545" y1="0" x2="495" y2="300" stroke="white" stroke-opacity="0.05" stroke-width="1"/>

                {{-- Bingkai Kotak Dalam (Inner Border - Kesan Dokumen Resmi) --}}
                <rect x="25" y="25" width="750" height="250" rx="8" stroke="white" stroke-opacity="0.2" stroke-width="1.5"/>
            </svg>
        </div>

        {{-- 2. KONTEN HEADER --}}
        <div class="absolute inset-0 z-10 flex flex-col justify-center px-10 md:px-14">
            
            {{-- Label Kecil Atas --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="w-1 h-4 bg-blue-300 rounded-full"></span>
                <span class="text-[10px] font-bold text-blue-200 uppercase tracking-[0.2em]">Official Announcement</span>
            </div>
            
            {{-- Judul Utama --}}
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
                    <!-- <p class="text-xs text-blue-200 font-medium">Sistem Informasi Akademik</p> -->
                </div>
            </div>
            
            {{-- Deskripsi Singkat --}}
            <p class="text-blue-50/70 text-sm max-w-xl leading-relaxed ml-[4rem] border-l border-white/10 pl-4">
                Informasi resmi terbaru mengenai kegiatan akademik, jadwal, dan pemberitahuan kampus.
            </p>
        </div>
    </div>

    {{-- LIST PENGUMUMAN --}}
    <div class="space-y-4">
        @forelse ($pengumuman as $item)
        <div class="announcement-card bg-white rounded-lg p-6 relative overflow-hidden group">
            
            {{-- Indikator Kiri (Strip Biru) --}}
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

            <div class="flex justify-end border-t border-gray-50 pt-3">
                <button class="text-xs font-bold text-[#004269] flex items-center gap-1 hover:underline">
                    BACA DETAIL <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
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

</div>
@endsection