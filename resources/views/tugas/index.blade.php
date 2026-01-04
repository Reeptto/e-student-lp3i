@extends('layouts.app')

@section('content')
    <style>
        /* 1. IMPORT FONT POPPINS */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* 2. SETTING GLOBAL */
        body {
            font-family: 'Poppins', sans-serif !important;
            background-color: #f8f9fa;
            /* Pattern Dot Grid (Khas Buku Catatan) */
            background-image: radial-gradient(#d1d5db 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* 3. BINDER HOLES DECORATION (Lubang Kertas) */
        .binder-holes {
            display: flex;
            flex-direction: column;
            gap: 12px;
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }
        .hole {
            width: 12px;
            height: 12px;
            background-color: #333; /* Warna lubang gelap */
            border-radius: 50%;
            box-shadow: inset 1px 1px 2px rgba(0,0,0,0.5);
        }
    </style>

    <div class="min-h-screen py-10 px-4 md:px-8">
        <div class="max-w-4xl mx-auto">

            {{-- ========================================== --}}
            {{-- 1. HEADER: STYLE "STUDENT PLANNER"         --}}
            {{-- ========================================== --}}
            <div class="bg-white border-2 border-black p-6 md:p-8 mb-8 shadow-[8px_8px_0px_0px_#000] relative overflow-hidden rounded-lg">
                {{-- Dekorasi Selotip di atas --}}
                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 w-32 h-6 bg-yellow-200/80 rotate-1 border-l border-r border-white/50 shadow-sm"></div>

                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
                    <div>
                        <h4 class="text-sm font-bold text-gray-500 tracking-widest uppercase mb-1">E-Student</h4>
                        <h1 class="text-4xl md:text-5xl font-black text-black uppercase leading-none">
                            Daftar<span class="text-[#f15b67]"> Tugas</span>
                        </h1>
                        <p class="mt-3 font-medium text-gray-600 max-w-sm text-sm md:text-base">
                            Yuk, Mulai Tugasnya. <br>
                            <span class="bg-[#f15b67] text-white px-1">Selesaikan satu per satu.</span>
                        </p>
                    </div>

                    {{-- Summary Box Kecil --}}
                    <div class="flex gap-4">
                        <div class="text-center border-2 border-black p-2 min-w-[80px] bg-gray-50 rounded">
                            <span class="block text-2xl font-black text-black">{{ $tugas->count() }}</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">Total</span>
                        </div>
                        <div class="text-center border-2 border-black p-2 min-w-[80px] bg-[#f15b67] text-white rounded">
                            @php
                                $urgentCount = $tugas->filter(function($t) {
                                    return \Carbon\Carbon::parse($t->time_end)->diffInDays(now()) < 2;
                                })->count();
                            @endphp
                            <span class="block text-2xl font-black">{{ $urgentCount }}</span> 
                            <span class="text-[10px] font-bold text-white/80 uppercase">Urgent</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- 2. TOOLBAR FILTER (HANYA MATKUL)           --}}
            {{-- ========================================== --}}
            <div class="mb-8">
                <form method="GET" action="{{ route('tugas') }}" class="relative z-20">
                    
                    <div class="bg-white border-2 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex gap-3 items-center rounded-lg">
                        
                        <div class="hidden sm:flex items-center justify-center w-12 h-12 bg-gray-100 border-2 border-black rounded flex-shrink-0">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        </div>

                        <div class="flex-grow relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#f15b67]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M22 10v6M2 10l10-5 10 5-10 5-10-5z M6 10v6a8 8 0 0012 0v-6"></path>
                                </svg>
                            </div>
                            
                            <select name="semester" id="semester" onchange="this.form.submit()" class="appearance-none block w-full pl-10 pr-10 py-3 border-2 border-black rounded bg-gray-50 focus:bg-white focus:ring-0 focus:border-[#f15b67] focus:shadow-[2px_2px_0px_0px_#f15b67] transition-all font-bold text-sm cursor-pointer text-gray-800">
                                <option value="">Pilih Semester</option>
                                @foreach ($semesters as $s)
                                    <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>
                                        Semester {{ $s }}                                     
                                    </option>

                                @endforeach
                            </select>
                            
        

                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <div class="flex-grow relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#f15b67]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            
                            <select name="matkul" id="matkul" onchange="this.form.submit()" class="appearance-none block w-full pl-10 pr-10 py-3 border-2 border-black rounded bg-gray-50 focus:bg-white focus:ring-0 focus:border-[#f15b67] focus:shadow-[2px_2px_0px_0px_#f15b67] transition-all font-bold text-sm cursor-pointer text-gray-800">
                                <option value="">Pilih Materi Ajar</option>
                                @foreach($matkul as $mk)
                                    <option value="{{ $mk->id }}" {{ request('matkul') == $mk->id ? 'selected' : '' }}>
                                        {{ $mk->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            

                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        
                        @if(request('matkul'))
                            <a href="{{ route('tugas') }}" class="flex-shrink-0 px-4 py-3 bg-black text-white font-bold border-2 border-black rounded hover:bg-[#f15b67] hover:border-[#f15b67] transition-colors text-center text-sm" title="Hapus Filter">
                                Reset
                            </a>
                        @endif

                    </div>
                </form>
            </div>

            {{-- ========================================== --}}
            {{-- 3. LIST TUGAS (BINDER STYLE)               --}}
            {{-- ========================================== --}}
            <div class="flex flex-col gap-5" id="list-tugas">
                @forelse($tugas as $item)
                    @php
                        $deadline = \Carbon\Carbon::parse($item->time_end);
                        $submission = $item->submissionByAuth;
                        $isLate     = now()->isAfter($item->time_end);
                    @endphp

                    <div class="relative group">
                        <div class="absolute top-1 left-1 w-full h-full bg-black rounded-lg border-2 border-black transition-transform duration-200 group-hover:translate-x-1 group-hover:translate-y-1"></div>

                        <a href="{{ route('tugas.show', $item->id) }}"
                        class="relative block border-2 border-black rounded-lg p-0 overflow-hidden transition-transform duration-200
            
                        {{ $isLate ? 'bg-gray-200' : 'bg-white hover:-translate-y-1 hover:-translate-x-1' }}">
                            
                            <div class="flex h-full min-h-[110px]">
                                
                                {{-- KOLOM KIRI: BINDER HOLES & DATE --}}
                                <div class="w-24 bg-gray-50 border-r-2 border-black flex flex-col items-center justify-center relative flex-shrink-0">
                                    <div class="binder-holes">
                                        <div class="hole"></div>
                                        <div class="hole"></div>
                                        <div class="hole"></div>
                                    </div>
                                    
                                    <div class="pl-4 z-20 flex flex-col items-center justify-center pt-1">
                                        <span class="text-[20px] font-black uppercase tracking-widest {{ $isLate ? 'text-red-500' : 'text-gray-400' }}">
                                            {{ $deadline->translatedFormat('M') }}
                                        </span>
                                        <span class="text-[20px] font-black uppercase tracking-widest {{ $isLate ? 'text-red-500' : 'text-gray-400' }}">
                                            {{ $deadline->translatedFormat('d') }}
                                        </span>
                                        <div class="mt-1">
                                            @if($submission)
                                                <span class="px-1.5 py-0.5 bg-red-100 text-red-600 border border-red-200 rounded text-[9px] font-bold uppercase tracking-tighter">
                                                    HARI INI
                                                </span>
                                            @else
                                                <span class="text-[15px] font-bold {{ $isLate ? 'text-red-400 line-through' : 'text-gray-500' }}">
                                                    {{ $deadline->format('H:i') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- KOLOM TENGAH: INFO TUGAS --}}
                                <div class="flex-1 p-5 flex flex-col justify-center">
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        <span class="inline-block px-2 py-0.5 border border-black text-[10px] font-bold uppercase tracking-wider rounded bg-gray-100 text-gray-700">
                                            {{ $item->matkul->nama_mk }}
                                        </span>
                                        @if($submission)
                                            <span class="inline-block px-2 py-0.5 bg-green-500 text-white text-[10px] font-bold uppercase tracking-wider rounded border border-black animate-pulse">
                                                Terkirim
                                            </span>
                                        @elseif($isLate)
                                            <span class="inline-block px-2 py-0.5 bg-red-500 text-white text-[10px] font-bold uppercase tracking-wider rounded border border-black animate-pulse">
                                                Terlambat
                                            </span>
                                        @else
                                             <span class="inline-block px-2 py-0.5 bg-blue-500 text-white text-[10px] font-bold uppercase tracking-wider rounded border border-black animate-pulse">Belum Dikirim</span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold text-black leading-tight group-hover:underline decoration-[#f15b67] decoration-2 underline-offset-2 transition-all">
                                        {{ $item->judul_tugas }}
                                    </h3>
                                    
                                    <div class="mt-2 flex items-center gap-2 text-xs font-medium text-gray-500">
                                        
                                    </div>
                                </div>

                                {{-- KOLOM KANAN: CHECKBOX VISUAL --}}
                                <div class="w-16 flex items-center justify-center border-l-2 border-dashed border-gray-300 bg-white group-hover:bg-[#f15b67]/5 transition-colors flex-shrink-0">
                                    <div class="w-6 h-6 border-2 border-black rounded flex items-center justify-center group-hover:border-[#f15b67] transition-colors">
                                        <svg class="w-4 h-4 text-[#f15b67] opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- EMPTY STATE --}}
                    <div class="bg-white border-2 border-black border-dashed p-10 text-center rounded-lg">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-50 rounded-full mb-4 border-2 border-gray-200">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Tidak ada tugas</h3>
                        <p class="text-gray-500 font-medium text-sm mt-1">Belum ada tugas untuk mata kuliah ini.</p>
                        @if(request('matkul'))
                            <a href="{{ route('tugas') }}" class="inline-block mt-4 text-[#f15b67] font-bold text-sm hover:underline">
                                Tampilkan Semua
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{-- Pagination Links Here if needed --}}
            </div>

        </div>
    </div>



@endsection