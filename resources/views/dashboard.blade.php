@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    
    /* === COLORFUL MECHA FRAME STYLE === */
    .mecha-wrapper {
        position: relative;
        margin-bottom: 2.5rem;
        z-index: 1;
        transition: transform 0.2s;
        /* Default Variables (akan ditimpa inline di HTML) */
        --dark-theme: #444; 
        --light-theme: #eee;
    }
    
    .mecha-wrapper:hover { transform: translate(-4px, -4px); }
    .mecha-wrapper:hover .mecha-shadow { transform: translate(8px, 8px); }

    /* 1. Border Utama (Sekarang berwarna, bukan hitam) */
    .mecha-border {
        position: relative;
        border: 3px solid var(--dark-theme); /* Pakai warna tema gelap */
        background: white;
        z-index: 10;
        clip-path: polygon(
            0 10px, 10px 0, 
            100% 0, 100% calc(100% - 10px), 
            calc(100% - 10px) 100%, 0 100%
        );
    }

    /* 2. Bayangan (Sekarang berwarna, bukan hitam) */
    .mecha-shadow {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: var(--dark-theme); /* Shadow mengikuti warna border */
        opacity: 0.3; /* Dibuat agak transparan biar ga terlalu gelap */
        z-index: 0;
        transform: translate(4px, 4px);
        transition: transform 0.2s;
        clip-path: polygon(
            0 10px, 10px 0, 
            100% 0, 100% calc(100% - 10px), 
            calc(100% - 10px) 100%, 0 100%
        );
    }

    /* 3. Dekorasi Siku */
    .mecha-deco-tl {
        position: absolute; top: -6px; left: -6px; width: 30px; height: 30px;
        border-top: 4px solid var(--dark-theme);
        border-left: 4px solid var(--dark-theme);
        z-index: 20;
    }
    .mecha-deco-br {
        position: absolute; bottom: -6px; right: -6px; width: 30px; height: 30px;
        border-bottom: 4px solid var(--dark-theme);
        border-right: 4px solid var(--dark-theme);
        z-index: 20;
    }

    /* 4. Titik Baut */
    .mecha-dot {
        position: absolute; width: 8px; height: 8px;
        background: white;
        border: 2px solid var(--dark-theme);
        z-index: 21;
    }
    .dot-tl { top: -4px; left: -4px; }
    .dot-br { bottom: -4px; right: -4px; }

    /* 5. Garis Arsir */
    .mecha-stripes {
        position: absolute; width: 6px; height: 50px;
        background: repeating-linear-gradient(
            -45deg,
            var(--dark-theme),
            var(--dark-theme) 2px,
            transparent 2px,
            transparent 4px
        );
        z-index: 15;
    }
    .stripes-right { top: 40px; right: -6px; border: 1px solid var(--dark-theme); background-color: white; }
    .stripes-left { bottom: 40px; left: -6px; border: 1px solid var(--dark-theme); background-color: white; }

    /* Scrollbar berwarna */
    .custom-scroll::-webkit-scrollbar { height: 8px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: #999; }
</style>

<div class="max-w-6xl mx-auto space-y-10 py-10 px-6">

    <div class="mecha-wrapper" style="--dark-theme: #b91c1c;">
        <div class="mecha-shadow"></div>
        <div class="mecha-deco-tl"></div><div class="mecha-dot dot-tl"></div>
        <div class="mecha-deco-br"></div><div class="mecha-dot dot-br"></div>
        <div class="mecha-stripes stripes-right"></div>
        
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
                                WELCOME BACK, <span class="text-[#dc2626] border-b-4 border-red-200">{{ auth()->user()->mahasiswa->nama_mhs }}</span>!
                            </h4>
                            <p class="text-gray-600 font-bold border-l-4 border-red-700 pl-4">
                                Fasilitas khusus mahasiswa <span class="text-white bg-red-700 px-1 rounded">LP3I</span>. 
                                Cek terus updatemu agar tidak ketinggalan info akademik!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mecha-wrapper" style="--dark-theme: #be185d;">
        <div class="mecha-shadow"></div>
        <div class="mecha-deco-tl"></div><div class="mecha-dot dot-tl"></div>
        <div class="mecha-deco-br"></div><div class="mecha-dot dot-br"></div>
        <div class="mecha-stripes stripes-left"></div>

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
                <div class="p-4 bg-white">
                    <div class="overflow-x-auto custom-scroll border-2 border-pink-800 rounded">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-pink-500 text-white uppercase font-black text-xs tracking-widest">
                                <tr>
                                    <th class="px-6 py-4 border-r border-pink-400/30">No</th>
                                    <th class="px-6 py-4 border-r border-pink-400/30">Hari</th>
                                    <th class="px-6 py-4 border-r border-pink-400/30">Jam</th>
                                    <th class="px-6 py-4 border-r border-pink-400/30">Mata Kuliah</th>
                                    <th class="px-6 py-4 border-r border-pink-400/30">Ruangan</th>
                                    <th class="px-6 py-4">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="font-bold text-gray-700">
                                @foreach($jadwal as $index => $jadwalDaftar)
                                <tr class="hover:bg-pink-50 transition-colors border-b border-pink-100">
                                    <td class="px-6 py-4 border-r border-pink-100 text-center bg-gray-50 text-pink-700">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 border-r border-pink-100 uppercase">{{ $jadwalDaftar->hari }}</td>
                                    <td class="px-6 py-4 border-r border-pink-100">
                                        <span class="inline-block px-2 py-1 bg-pink-100 text-pink-700 text-xs rounded border border-pink-200">
                                            {{ $jadwalDaftar->jam_mulai }} - {{$jadwalDaftar->jam_selesai}}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border-r border-pink-100 text-lg text-gray-800">{{ $jadwalDaftar->nama_mk }}</td>
                                    <td class="px-6 py-4 border-r border-pink-100">
                                        <span class="border border-gray-300 px-2 py-1 bg-gray-50 text-xs rounded text-gray-500">
                                            {{ $jadwalDaftar->nama_ruangan }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 bg-pink-600 rounded-full flex items-center justify-center text-white text-xs shadow-sm">
                                                {{ substr($jadwalDaftar->nama_dosen, 0, 1) }}
                                            </div>
                                            <span>{{ $jadwalDaftar->nama_dosen }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mecha-wrapper" style="--dark-theme: #0f766e;">
        <div class="mecha-shadow"></div>
        <div class="mecha-deco-tl"></div><div class="mecha-dot dot-tl"></div>
        <div class="mecha-deco-br"></div><div class="mecha-dot dot-br"></div>
        <div class="mecha-stripes stripes-right"></div>

        <div class="mecha-border" x-data="{ open: true }">
            <div @click="open = !open"
                 class="bg-gradient-to-r from-[#009da5] to-[#006064] px-6 py-4 flex justify-between items-center text-white cursor-pointer select-none border-b-4 border-teal-800">
                <h3 class="font-black text-xl italic uppercase tracking-wider flex items-center gap-3">
                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                    GRAFIK IPK
                </h3>
                <div class="bg-white/20 rounded-full p-1 transition-transform duration-300" :class="open ? 'rotate-0' : 'rotate-180'">
                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                </div>
            </div>

            <div x-show="open" x-collapse>
                <div class="p-8 overflow-x-auto bg-teal-50/20">
                    <div class="min-w-[600px] flex justify-center">
                        @php
                            $height = 250; $width = 700; $padding = 40; $maxGPA = 4.0;
                            $data = $graphData ?? [
                                ['semester' => 'Sem 1', 'gpa' => 3.42],
                                ['semester' => 'Sem 2', 'gpa' => 3.55],
                                ['semester' => 'Sem 3', 'gpa' => 2.30],
                            ];
                            $total = count($data);
                            $divider = ($total > 1) ? ($total - 1) : 1; 
                            
                            $pointsStr = "";
                            foreach($data as $i => $d) {
                                $x = $padding + ($i * (($width - $padding * 2) / $divider));
                                $y = $height - $padding - ($d['gpa'] / $maxGPA) * ($height - $padding * 2);
                                $pointsStr .= "$x,$y ";
                            }
                            $areaPoints = "$padding," . ($height - $padding) . " " . $pointsStr . ($width - $padding) . "," . ($height - $padding);
                        @endphp
                        
                        <svg width="{{ $width }}" height="{{ $height }}" viewBox="0 0 {{ $width }} {{ $height }}" class="overflow-visible font-sans">
                            @foreach([1.00, 2.00, 3.00, 4.00] as $val)
                                @php $y = $height - $padding - ($val / $maxGPA) * ($height - $padding * 2); @endphp
                                <line x1="{{ $padding }}" y1="{{ $y }}" x2="{{ $width - $padding }}" y2="{{ $y }}" stroke="#0f766e" stroke-width="1" stroke-dasharray="4 4" opacity="0.1" />
                                <text x="{{ $padding - 15 }}" y="{{ $y + 4 }}" text-anchor="end" font-size="11" fill="#0f766e" font-weight="800">{{ number_format($val, 1) }}</text>
                            @endforeach
                            
                            @foreach($data as $i => $d)
                                @php $x = $padding + ($i * (($width - $padding * 2) / $divider)); @endphp
                                <text x="{{ $x }}" y="{{ $height - 10 }}" text-anchor="middle" font-size="12" font-weight="900" fill="#0f766e" style="text-transform:uppercase">{{ $d['semester'] }}</text>
                            @endforeach

                            <defs>
                                <linearGradient id="tealGradient" x1="0" x2="0" y1="0" y2="1">
                                    <stop offset="0%" stop-color="#009da5" stop-opacity="0.2"/>
                                    <stop offset="100%" stop-color="#009da5" stop-opacity="0"/>
                                </linearGradient>
                            </defs>

                            <polygon points="{{ $areaPoints }}" fill="url(#tealGradient)" stroke="none" />
                            
                            <polyline points="{{ $pointsStr }}" fill="none" stroke="#0f766e" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />

                            @foreach($data as $i => $d)
                                @php 
                                    $x = $padding + ($i * (($width - $padding * 2) / $divider));
                                    $y = $height - $padding - ($d['gpa'] / $maxGPA) * ($height - $padding * 2);
                                @endphp
                                <circle cx="{{ $x }}" cy="{{ $y }}" r="6" fill="#fff" stroke="#0f766e" stroke-width="3" />
                                <circle cx="{{ $x }}" cy="{{ $y }}" r="3" fill="#009da5" />
                                
                                <g transform="translate({{ $x }}, {{ $y - 35 }})">
                                    <rect x="-20" y="-12" width="40" height="24" fill="#0f766e" rx="4" />
                                    <text x="0" y="5" text-anchor="middle" font-size="12" font-bold fill="#fff">{{ $d['gpa'] }}</text>
                                    <path d="M-5 12 L0 18 L5 12" fill="#0f766e" />
                                </g>
                            @endforeach
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection