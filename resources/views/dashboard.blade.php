@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 font-sans">
            
    <!-- 1. E-STUDENT INFO BANNER -->
    <div x-data="{ open: true }"
         class="bg-white rounded-3xl shadow-xl shadow-pink-100 border border-pink-100 overflow-hidden relative group hover:-translate-y-1 transition-all duration-300">
        <!-- Dekorasi Background -->
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/20 rounded-full blur-xl"></div>
        
        <!-- Header Gradient Pink-Rose -->
        <div @click="open = !open"
             class="bg-gradient-to-r from-[#dc2626] to-[#7f1d1d] px-6 py-4 flex justify-between items-center text-white cursor-pointer">
            <h3 class="font-bold text-lg flex items-center gap-3">
                <span class="bg-white/20 p-1.5 rounded-lg backdrop-blur-sm">
                    <i data-lucide="sparkles" class="w-5 h-5 text-yellow-200"></i>
                </span>
                E-Student Info
            </h3>
            <div class="flex gap-2 opacity-90">
                <button class="hover:bg-white/20 p-1 rounded-full transition">
                    <i data-lucide="chevron-down"
                       :class="open ? '' : 'rotate-180'"
                       class="w-5 h-5 transition-transform duration-300"></i>
                </button>
            </div>
        </div>

        <!-- Content -->
        <div x-show="open" x-collapse>
            <div class="p-8">
                <div class="flex items-start gap-4">
                    <!-- SVG Bulet Kuning dihapus -->
                    <div>
                        <h4 class="font-extrabold text-gray-800 text-xl mb-2">
                            Welcome back, <span class="text-pink-600">{{ $student['name'] ?? 'Student' }}</span>!
                        </h4>
                        <p class="text-gray-600 leading-relaxed text-base">
                            Fasilitas ini khusus untuk mahasiswa <strong class="text-indigoDye px-1 rounded bg-indigo-50">LP3I</strong> yang super aktif! 🚀<br>
                            Jangan lupa cek jadwal dan nilai kamu, keep up the good work!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. COLLEGE SUBJECT SCHEDULE -->
    <div x-data="{ open: true }"
         class="bg-white rounded-3xl shadow-xl shadow-blue-100 border border-blue-100 overflow-hidden relative hover:shadow-2xl transition-shadow duration-300">
        <!-- Header Gradient Cyan-Blue -->
        <div @click="open = !open"
             class="bg-gradient-to-r from-pink-500 to-[#f15b67] px-6 py-4 flex justify-between items-center text-white cursor-pointer">
            <h3 class="font-bold text-lg flex items-center gap-3">
                <span class="bg-white/20 p-1.5 rounded-lg backdrop-blur-sm">
                    <i data-lucide="calendar-heart" class="w-5 h-5 text-cyan-100"></i>
                </span>
                Jadwal Kuliah
            </h3>
            <div class="flex gap-2 opacity-90">
                <button class="hover:bg-white/20 p-1 rounded-full transition">
                    <i data-lucide="chevron-down"
                       :class="open ? '' : 'rotate-180'"
                       class="w-5 h-5 transition-transform duration-300"></i>
                </button>
            </div>
        </div>
        
        <!-- Table -->
        <div x-show="open" x-collapse>
            <div class="overflow-x-auto p-2">
                <table class="w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 font-bold text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Hari</th>
                            <th class="px-6 py-4">Jam</th>
                            <th class="px-6 py-4">Mata Kuliah</th>
                            <th class="px-6 py-4">Ruangan</th>
                            <th class="px-6 py-4">Dosen Pengampu</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">

                        @foreach($jadwal as $jadwalDaftar)
                        <tr class="transition-colors duration-200 rounded-lg {{ isset($row['active']) ? 'bg-blue-50/80' : 'hover:bg-gray-50' }}">
                            <td class="px-6 py-4 font-bold text-blue-300">{{ $jadwalDaftar->id }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-700">{{ $jadwalDaftar->hari }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ isset($row['active']) ? 'bg-blue-500 text-white shadow-md shadow-blue-200' : 'bg-green-100 text-green-600' }}">
                                    {{ $jadwalDaftar->jam_mulai  }} - {{$jadwalDaftar->jam_selesai}}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-800">{{ $jadwalDaftar->nama_mk }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-500 border border-gray-200">
                                    {{ $jadwalDaftar->nama_ruangan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center text-[10px] text-white font-bold">
                                    {{ substr($jadwalDaftar->nama_dosen, 0, 1) }}
                                </div>
                                {{ $jadwalDaftar->nama_dosen }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 3. GPA GRAPH -->
    <div x-data="{ open: true }"
         class="bg-white rounded-3xl shadow-xl shadow-purple-100 border border-purple-100 overflow-hidden relative">
        <!-- Header Gradient Violet-Purple -->
        <div @click="open = !open"
             class="bg-gradient-to-r from-[#009da5] to-[#006064] px-6 py-4 flex justify-between items-center text-white cursor-pointer">
            <h3 class="font-bold text-lg flex items-center gap-3">
                <span class="bg-white/20 p-1.5 rounded-lg backdrop-blur-sm">
                    <i data-lucide="trending-up" class="w-5 h-5 text-purple-200"></i>
                </span>
                Grafik Prestasi (IPK)
            </h3>
            <div class="flex gap-2 opacity-90">
                <button class="hover:bg-white/20 p-1 rounded-full transition">
                    <i data-lucide="chevron-down"
                       :class="open ? '' : 'rotate-180'"
                       class="w-5 h-5 transition-transform duration-300"></i>
                </button>
            </div>
        </div>

        <div x-show="open" x-collapse>
            <div class="p-8 overflow-x-auto bg-gradient-to-b from-white to-purple-50/30">
                <div class="min-w-[500px] flex justify-center">
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
                        @foreach([0.00, 1.00, 2.00, 3.00, 4.00] as $val)
                            @php $y = $height - $padding - ($val / $maxGPA) * ($height - $padding * 2); @endphp
                            <g>
                                <line x1="{{ $padding }}" y1="{{ $y }}" x2="{{ $width - $padding }}" y2="{{ $y }}" stroke="#e9d5ff" stroke-width="1" stroke-dasharray="4 4" />
                                <text x="{{ $padding - 10 }}" y="{{ $y + 3 }}" text-anchor="end" font-size="10" fill="#009da5" font-weight="bold">{{ number_format($val, 1) }}</text>
                            </g>
                        @endforeach
                        
                        @foreach($data as $i => $d)
                            @php $x = $padding + ($i * (($width - $padding * 2) / $divider)); @endphp
                            <text x="{{ $x }}" y="{{ $height - 15 }}" text-anchor="middle" font-size="12" font-weight="600" fill="#006064">{{ $d['semester'] }}</text>
                        @endforeach

                        <defs>
                            <linearGradient id="purpleGradient" x1="0" x2="0" y1="0" y2="1">
                                <stop offset="0%" stop-color="#009da5" stop-opacity="0.2"/>
                                <stop offset="100%" stop-color="#009da5" stop-opacity="0"/>
                            </linearGradient>
                        </defs>

                        <polygon points="{{ $areaPoints }}" fill="url(#purpleGradient)" stroke="none" />
                        <polyline points="{{ $pointsStr }}" fill="none" stroke="#009da5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="drop-shadow-md" />

                        @foreach($data as $i => $d)
                            @php 
                                $x = $padding + ($i * (($width - $padding * 2) / $divider));
                                $y = $height - $padding - ($d['gpa'] / $maxGPA) * ($height - $padding * 2);
                            @endphp
                            <circle cx="{{ $x }}" cy="{{ $y }}" r="6" fill="#fff" stroke="#009da5" stroke-width="3" />
                            <text x="{{ $x }}" y="{{ $y - 12 }}" text-anchor="middle" font-size="10" font-weight="bold" fill="#009da5">{{ $d['gpa'] }}</text>
                        @endforeach
                    </svg>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
