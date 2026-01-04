@extends('layouts.app')

@section('content')
<style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    
    /* --- MECHA WRAPPER (HEADER TETAP) --- */
    .mecha-wrapper { position: relative; margin-bottom: 2.5rem; z-index: 1; --dark-theme: #444; }
    .mecha-border { position: relative; border: 3px solid var(--dark-theme); background: white; z-index: 10; clip-path: polygon(0 10px, 10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%); }
    .mecha-shadow { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: var(--dark-theme); opacity: 0.3; z-index: 0; transform: translate(4px, 4px); clip-path: polygon(0 10px, 10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%); }
    .mecha-deco-tl { position: absolute; top: -6px; left: -6px; width: 30px; height: 30px; border-top: 4px solid var(--dark-theme); border-left: 4px solid var(--dark-theme); z-index: 20; }
    .mecha-deco-br { position: absolute; bottom: -6px; right: -6px; width: 30px; height: 30px; border-bottom: 4px solid var(--dark-theme); border-right: 4px solid var(--dark-theme); z-index: 20; }
    .mecha-dot { position: absolute; width: 8px; height: 8px; background: white; border: 2px solid var(--dark-theme); z-index: 21; }
    .dot-tl { top: -4px; left: -4px; } .dot-br { bottom: -4px; right: -4px; }
    .mecha-stripes { position: absolute; width: 6px; height: 50px; background: repeating-linear-gradient(-45deg, var(--dark-theme), var(--dark-theme) 2px, transparent 2px, transparent 4px); z-index: 15; }
    .stripes-right { top: 40px; right: -6px; border: 1px solid var(--dark-theme); background-color: white; }
    .stripes-left { bottom: 40px; left: -6px; border: 1px solid var(--dark-theme); background-color: white; }

    /* --- SCROLLBAR --- */
     .pink-scroll-area { 
        max-height: 600px;  /* Batas tinggi agar scroll muncul jika konten panjang */
        overflow-y: auto;   /* Scroll vertikal aktif */
        overflow-x: hidden; /* Sembunyikan scroll horizontal */
        padding: 2rem 1.5rem 2rem 1.5rem; /* Padding agar bayangan tidak terpotong */
    }
    
    /* Batang Scroll (Track) */
    .pink-scroll-area::-webkit-scrollbar { 
        width: 14px; /* Lebar scrollbar */
    }
    .pink-scroll-area::-webkit-scrollbar-track { 
        background: #fff0f5; 
        border-left: 1px solid #fce7f3; 
    }
    
    /* Tombol Scroll (Thumb) */
    .pink-scroll-area::-webkit-scrollbar-thumb { 
        background: linear-gradient(180deg, #ec4899, #f15b67); /* Gradasi Pink */
        border-radius: 8px; 
        border: 3px solid #fff0f5; /* Border putih agar terlihat melayang */
    }
    .pink-scroll-area::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #db2777, #e11d48); /* Warna lebih gelap saat hover */
    }
    /* --- FUTURISTIC CLEAN CARD (STYLE FRAME) --- */
    .futuristic-card {
        position: relative;
        margin-top: 2rem;
        transition: transform 0.2s ease;
    }
    .futuristic-card:hover { transform: translateY(-5px); }

    /* Frame Utama */
    .f-frame {
        position: relative;
        background: #fff;
        border: 2px solid #f15b67; /* Border Pink */
        /* Clip Path Sudut Terpotong (Chamfered) */
        clip-path: polygon(
            0 15px, 15px 0, 
            100% 0, 100% calc(100% - 15px), 
            calc(100% - 15px) 100%, 0 100%
        );
        z-index: 10;
        padding-top: 3rem; /* Space Header */
        padding-bottom: 1rem;
    }

    /* Shadow Belakang */
    .f-shadow {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-color: #f15b67; opacity: 0.2; z-index: 0;
        transform: translate(6px, 6px);
        clip-path: polygon(0 15px, 15px 0, 100% 0, 100% calc(100% - 15px), calc(100% - 15px) 100%, 0 100%);
    }

    /* Header Hari */
    .f-header {
        position: absolute; top: 0; left: 0; width: 100%; height: 45px;
        background: linear-gradient(90deg, #f15b67, #be185d);
        color: white; display: flex; align-items: center; justify-content: space-between;
        padding: 0 1.5rem;
        border-bottom: 4px solid #9d174d; /* Garis bawah gelap */
    }
    .f-day-title { font-weight: 900; text-transform: uppercase; letter-spacing: 2px; font-size: 1.25rem; font-style: italic; }

    /* Dekorasi Sudut */
    .f-deco-box { position: absolute; width: 12px; height: 12px; background: white; border: 2px solid #f15b67; z-index: 20; }
    .fd-tl { top: 0; left: 0; } 
    .fd-br { bottom: 0; right: 0; }

    /* --- ISI TABEL YANG LEBIH RAPI (CSS GRID) --- */
    .f-content { padding: 0 1.5rem; }

    /* Menggunakan GRID agar kolom lurus sempurna */
    .f-grid-row {
        display: grid;
        grid-template-columns: 85px 1fr; /* Kolom Kiri 85px, Kanan sisanya */
        gap: 20px;
        padding: 15px 0;
        border-bottom: 1px dashed #fbcfe8; /* Garis putus-putus pink muda */
        transition: background-color 0.2s;
    }
    .f-grid-row:last-child { border-bottom: none; }
    .f-grid-row:hover { background-color: #fff1f2; } /* Hover effect halus */

    /* Kolom Waktu (Kiri) */
    .f-col-time {
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: center;
        border-right: 3px solid #f15b67; /* Garis vertikal pembatas tegas */
        padding-right: 15px;
    }
    .ft-start { font-weight: 800; color: #1f2937; font-size: 1.2rem; line-height: 1; }
    .ft-end { font-size: 0.75rem; color: #f15b67; font-weight: 700; margin-top: 2px; }

    /* Kolom Info (Kanan) */
    .f-col-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 4px;
    }
    
    /* Judul Matkul */
    .fi-matkul { 
        font-weight: 800; 
        color: #1f2937; 
        font-size: 1rem;
        text-transform: uppercase; 
        line-height: 1.2; 
    }
    .group:hover .fi-matkul { color: #be185d; } /* Interaktif saat hover */

    /* Detail Dosen & Ruang */
    .fi-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.8rem;
        font-weight: 500;
        color: #4b5563;
        flex-wrap: wrap;
    }
    
    /* Badge Ruangan */
    .room-badge {
        background-color: #f15b67;
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.7rem;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

</style>

<div class="max-w-6xl mx-auto space-y-10 py-10 px-6">

    <div class="mecha-wrapper" style="--dark-theme: #b91c1c;">
        <div class="mecha-shadow"></div><div class="mecha-deco-tl"></div><div class="mecha-dot dot-tl"></div><div class="mecha-deco-br"></div><div class="mecha-dot dot-br"></div><div class="mecha-stripes stripes-right"></div>
        <div class="mecha-border" x-data="{ open: true }">
            <div @click="open = !open"
                 class="bg-gradient-to-r from-[#dc2626] to-[#7f1d1d] px-6 py-4 flex justify-between items-center text-white cursor-pointer select-none border-b-4 border-red-800">
                <h3 class="font-black text-xl italic uppercase tracking-wider flex items-center gap-3">
                    <i data-lucide="sparkles" class="w-6 h-6 text-yellow-300 fill-current"></i>
                    E-STUDENT INFO
                </h3>
                <div class="bg-white/20 rounded-full p-1 transition-transform duration-300" :class="open ? 'rotate-0' : 'rotate-180'">
                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                </div>
            </div>

            <div x-show="open" x-collapse>
                <div class="p-8 bg-red-50/30">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="w-20 h-20 bg-white border-4 border-red-700 shadow-lg flex items-center justify-center text-4xl flex-shrink-0 text-red-600">
                            📢
                        </div>
                        <div>
                            <h4 class="font-black text-2xl text-gray-800 uppercase mb-2">
                                SELAMAT DATANG KEMBALI, <span class="text-[#dc2626] border-b-4 border-red-200">{{ auth()->user()->mahasiswa->nama_mhs }}</span>!
                            </h4>
                            <p class="text-gray-600 font-bold border-l-4 border-red-700 pl-4">
                                Fasilitas khusus mahasiswa <span class="text-white bg-red-700 px-1 rounded">LP3I</span>. 
                                Cek terus updatemu agar tidak ketinggalan info akademik!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div x-show="open" x-collapse><div class="p-8 bg-red-50/30"><div class="flex flex-col md:flex-row items-center gap-6"><div class="w-20 h-20 bg-white border-4 border-red-700 shadow-lg flex items-center justify-center text-4xl flex-shrink-0 text-red-600">📢</div><div><h4 class="font-black text-2xl text-gray-800 uppercase mb-2">WELCOME BACK, <span class="text-[#dc2626] border-b-4 border-red-200">{{ auth()->user()->mahasiswa->nama_mhs }}</span>!</h4><p class="text-gray-600 font-bold border-l-4 border-red-700 pl-4">Fasilitas khusus mahasiswa <span class="text-white bg-red-700 px-1 rounded">LP3I</span>. Cek terus updatemu agar tidak ketinggalan info akademik!</p></div></div></div></div>
        </div>
    </div>

    <div class="mecha-wrapper" style="--dark-theme: #be185d;">
        <div class="mecha-shadow"></div><div class="mecha-deco-tl"></div><div class="mecha-dot dot-tl"></div><div class="mecha-deco-br"></div><div class="mecha-dot dot-br"></div><div class="mecha-stripes stripes-left"></div>

        <div class="mecha-border" x-data="{ open: true }">
            <div @click="open = !open"
                 class="bg-gradient-to-r from-pink-500 to-[#f15b67] px-6 py-4 flex justify-between items-center text-white cursor-pointer select-none border-b-4 border-pink-800">
                <h3 class="font-black text-xl italic uppercase tracking-wider flex items-center gap-3">
                    <i data-lucide="calendar" class="w-6 h-6"></i>
                    JADWAL KULIAH
                </h3>
                <div class="bg-white/20 rounded-full p-1 transition-transform duration-300" :class="open ? 'rotate-0' : 'rotate-180'">
                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                </div>
            </div>

            <div x-show="open" x-collapse>
                <div class="bg-white pink-scroll-area">
                    
                    @if(count($jadwal) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12">
                            @foreach($jadwal as $hari => $items)
                                
                                <div class="futuristic-card">
                                    <div class="f-shadow"></div>

                                    <div class="f-frame">
                                        <div class="f-deco-box fd-tl"></div>
                                        <div class="f-deco-box fd-br"></div>

                                        <div class="f-header">
                                            <span class="f-day-title">{{ $hari }}</span>
                                            <div class="flex gap-1.5">
                                                <div class="w-1.5 h-1.5 bg-white rounded-sm"></div>
                                                <div class="w-1.5 h-1.5 bg-white/50 rounded-sm"></div>
                                                <div class="w-1.5 h-1.5 bg-white/30 rounded-sm"></div>
                                            </div>
                                        </div>

                                        <div class="f-content">
                                            @foreach($items as $jadwalDaftar)
                                            <div class="f-grid-row group">
                                                
                                                <div class="f-col-time">
                                                    <div class="ft-start">{{ substr($jadwalDaftar->jam_mulai, 0, 5) }}</div>
                                                    <div class="ft-end">{{ substr($jadwalDaftar->jam_selesai, 0, 5) }}</div>
                                                </div>

                                                <div class="f-col-info">
                                                    <div class="fi-matkul">
                                                        {{ $jadwalDaftar->matkul->nama_mk }}
                                                    </div>
                                                    
                                                    <div class="fi-meta">
                                                        <span class="room-badge">
                                                            <i data-lucide="map-pin" class="w-3 h-3"></i>
                                                            {{ $jadwalDaftar->ruangan->nama_ruangan }}
                                                        </span>
                                                        <span class="flex items-center gap-1">
                                                            <i data-lucide="user" class="w-3 h-3 text-gray-400"></i>
                                                            {{ Str::limit($jadwalDaftar->dosen->nama_dsn, 20) }}
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-16 border-4 border-dashed border-gray-200 rounded-xl bg-gray-50">
                            <i data-lucide="calendar-off" class="w-12 h-12 text-gray-300 mb-3"></i>
                            <p class="text-gray-400 font-bold italic text-xl">TIDAK ADA JADWAL</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="mecha-wrapper" style="--dark-theme: #0f766e;">
        <div class="mecha-shadow"></div><div class="mecha-deco-tl"></div><div class="mecha-dot dot-tl"></div><div class="mecha-deco-br"></div><div class="mecha-dot dot-br"></div><div class="mecha-stripes stripes-right"></div>
        <div class="mecha-border" x-data="{ open: true }">
            <div @click="open = !open" class="bg-gradient-to-r from-[#009da5] to-[#006064] px-6 py-4 flex justify-between items-center text-white cursor-pointer select-none border-b-4 border-teal-800">
                <h3 class="font-black text-xl italic uppercase tracking-wider flex items-center gap-3"><i data-lucide="trending-up" class="w-6 h-6"></i> GRAFIK IPK</h3>
                <div class="bg-white/20 rounded-full p-1 transition-transform duration-300" :class="open ? 'rotate-0' : 'rotate-180'"><i data-lucide="chevron-down" class="w-5 h-5"></i></div>
            </div>
            <div x-show="open" x-collapse>
                <div class="p-8 overflow-x-auto bg-teal-50/20">
                    <div class="min-w-[600px] flex justify-center">
                        @php
                            $height = 250; $width = 700; $padding = 40; $maxGPA = 4.0;
                            $data = $graphData ?? [['semester' => 'Sem 1', 'gpa' => 3.42], ['semester' => 'Sem 2', 'gpa' => 3.55], ['semester' => 'Sem 3', 'gpa' => 2.30]];
                            $total = count($data); $divider = ($total > 1) ? ($total - 1) : 1; $pointsStr = "";
                            foreach($data as $i => $d) { $x = $padding + ($i * (($width - $padding * 2) / $divider)); $y = $height - $padding - ($d['gpa'] / $maxGPA) * ($height - $padding * 2); $pointsStr .= "$x,$y "; }
                            $areaPoints = "$padding," . ($height - $padding) . " " . $pointsStr . ($width - $padding) . "," . ($height - $padding);
                        @endphp
                        <svg width="{{ $width }}" height="{{ $height }}" viewBox="0 0 {{ $width }} {{ $height }}" class="overflow-visible font-sans">
                            @foreach([1.00, 2.00, 3.00, 4.00] as $val) @php $y = $height - $padding - ($val / $maxGPA) * ($height - $padding * 2); @endphp <line x1="{{ $padding }}" y1="{{ $y }}" x2="{{ $width - $padding }}" y2="{{ $y }}" stroke="#0f766e" stroke-width="1" stroke-dasharray="4 4" opacity="0.1" /> <text x="{{ $padding - 15 }}" y="{{ $y + 4 }}" text-anchor="end" font-size="11" fill="#0f766e" font-weight="800">{{ number_format($val, 1) }}</text> @endforeach
                            @foreach($data as $i => $d) @php $x = $padding + ($i * (($width - $padding * 2) / $divider)); @endphp <text x="{{ $x }}" y="{{ $height - 10 }}" text-anchor="middle" font-size="12" font-weight="900" fill="#0f766e" style="text-transform:uppercase">{{ $d['semester'] }}</text> @endforeach
                            <defs><linearGradient id="tealGradient" x1="0" x2="0" y1="0" y2="1"><stop offset="0%" stop-color="#009da5" stop-opacity="0.2"/><stop offset="100%" stop-color="#009da5" stop-opacity="0"/></linearGradient></defs>
                            <polygon points="{{ $areaPoints }}" fill="url(#tealGradient)" stroke="none" />
                            <polyline points="{{ $pointsStr }}" fill="none" stroke="#0f766e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            @foreach($data as $i => $d) @php $x = $padding + ($i * (($width - $padding * 2) / $divider)); $y = $height - $padding - ($d['gpa'] / $maxGPA) * ($height - $padding * 2); @endphp <circle cx="{{ $x }}" cy="{{ $y }}" r="6" fill="#fff" stroke="#0f766e" stroke-width="3" /> <circle cx="{{ $x }}" cy="{{ $y }}" r="3" fill="#009da5" /> <g transform="translate({{ $x }}, {{ $y - 35 }})"><rect x="-20" y="-12" width="40" height="24" fill="#0f766e" rx="4" /><text x="0" y="5" text-anchor="middle" font-size="12" font-bold fill="#fff">{{ $d['gpa'] }}</text><path d="M-5 12 L0 18 L5 12" fill="#0f766e" /></g> @endforeach
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection