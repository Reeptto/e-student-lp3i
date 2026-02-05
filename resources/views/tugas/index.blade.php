@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700&display=swap');
    
    .font-sans-formal { font-family: 'Inter', sans-serif; }
    .font-heading { font-family: 'Poppins', sans-serif; }

    /* Animasi Dropdown */
    .dropdown-enter { animation: slideDown 0.2s ease-out forwards; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

    /* Scrollbar */
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    /* Card Effect */
    .clean-card {
        background: white;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        transition: all 0.2s ease-in-out;
    }
    .clean-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px -3px rgba(0,0,0,0.05);
        border-color: #cbd5e1;
    }
</style>

<div class="min-h-screen bg-[#F8FAFC] font-sans-formal py-8">
    <div class="max-w-5xl mx-auto px-4 lg:px-0">

        {{-- === HEADER GEOMETRIS COMPACT (GOLD LINE ACCENT) === --}}
        {{-- Tinggi dikurangi (h-40) agar compact --}}
        <div class="relative w-full h-40 md:h-48 bg-gradient-to-r from-[#009da5] to-[#007f86] rounded-2xl overflow-hidden mb-8 shadow-lg">
            
            {{-- 1. DEKORASI SVG (LINE GOLD SIMPEL DI SUDUT) --}}
            <div class="absolute inset-0 z-0 pointer-events-none">
                <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 800 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                    {{-- Garis Emas Diagonal Kanan Atas --}}
                    <rect x="700" y="-50" width="10" height="200" transform="rotate(45 700 -50)" fill="#FCD34D" fill-opacity="0.8"/>
                    
                    {{-- Garis Emas Diagonal Kiri Bawah --}}
                    <rect x="50" y="250" width="10" height="200" transform="rotate(45 50 250)" fill="#FCD34D" fill-opacity="0.8"/>
                    
                    {{-- Frame Tipis (Outline) --}}
                    <rect x="30" y="30" width="740" height="240" rx="10" stroke="#FCD34D" stroke-opacity="0.3" stroke-width="2" fill="none"/>
                </svg>
            </div>

            {{-- 2. KONTEN TENGAH --}}
            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center text-center px-4">
                
                <div class="inline-flex items-center gap-2 mb-2">
                    <span class="w-8 h-[1px] bg-yellow-300/50"></span>
                    <span class="text-[10px] font-bold tracking-[0.2em] text-yellow-100 uppercase">Academic Portal</span>
                    <span class="w-8 h-[1px] bg-yellow-300/50"></span>
                </div>

                <h1 class="text-3xl md:text-4xl font-heading font-bold text-white mb-2 tracking-tight">
                    Daftar Tugas
                </h1>
                
                <p class="text-teal-50 text-xs md:text-sm max-w-lg leading-relaxed font-light opacity-90">
                    Kelola jadwal pengumpulan tugas akademik Anda agar tetap disiplin dan tepat waktu.
                </p>
            </div>
        </div>

        {{-- === FILTER SECTION (CUSTOM ALPINE) === --}}
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm mb-6 relative z-30">
            <form id="filterForm" method="GET" action="{{ route('tugas') }}">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    
                    {{-- Filter Semester --}}
                    <div class="md:col-span-4 relative" x-data="{ open: false, label: '{{ request('semester') ? 'Semester '.request('semester') : 'Semua Semester' }}' }">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5 ml-1">Periode</label>
                        <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full bg-slate-50 border border-slate-200 hover:border-teal-400 text-slate-700 text-sm rounded-lg px-3 py-2.5 text-left flex items-center justify-between transition-all">
                            <span x-text="label" class="font-medium"></span>
                            <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                        </button>
                        {{-- Dropdown Content --}}
                        <div x-show="open" x-cloak class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-slate-100 overflow-hidden z-50 dropdown-enter">
                            <div class="max-h-48 overflow-y-auto custom-scroll p-1">
                                <div @click="$el.closest('form').submit()" class="px-3 py-2 text-xs hover:bg-slate-50 cursor-pointer text-slate-500">Reset</div>
                                @foreach($semesters as $s)
                                    <input type="radio" name="semester" value="{{ $s }}" class="hidden" id="sem{{$s}}" @if(request('semester') == $s) checked @endif>
                                    <label for="sem{{$s}}" @click="$el.closest('form').submit()" class="block px-3 py-2 text-sm hover:bg-teal-50 cursor-pointer rounded text-slate-600 hover:text-teal-700 font-medium">Semester {{ $s }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Filter Matkul --}}
                    <div class="md:col-span-6 relative" x-data="{ open: false, label: '{{ request('matkul') ? ($matkul->where('id_mk', request('matkul'))->first()->nama_mk ?? 'Terpilih') : 'Semua Mata Kuliah' }}' }">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5 ml-1">Mata Kuliah</label>
                        <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full bg-slate-50 border border-slate-200 hover:border-teal-400 text-slate-700 text-sm rounded-lg px-3 py-2.5 text-left flex items-center justify-between transition-all">
                            <span x-text="label" class="font-medium truncate pr-2"></span>
                            <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                        </button>
                        <div x-show="open" x-cloak class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-slate-100 overflow-hidden z-50 dropdown-enter">
                            <div class="max-h-48 overflow-y-auto custom-scroll p-1">
                                <div @click="$el.closest('form').submit()" class="px-3 py-2 text-xs hover:bg-slate-50 cursor-pointer text-slate-500">Reset</div>
                                @foreach($matkul as $mk)
                                    <input type="radio" name="matkul" value="{{ $mk->id_mk }}" class="hidden" id="mk{{$mk->id_mk}}" @if(request('matkul') == $mk->id_mk) checked @endif>
                                    <label for="mk{{$mk->id_mk}}" @click="$el.closest('form').submit()" class="block px-3 py-2 text-sm hover:bg-teal-50 cursor-pointer rounded text-slate-600 hover:text-teal-700 truncate">{{ $mk->nama_mk }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Reset Button --}}
                    <div class="md:col-span-2">
                        @if(request()->hasAny(['semester','matkul']))
                            <a href="{{ route('tugas') }}" class="w-full py-2.5 rounded-lg flex items-center justify-center gap-2 text-sm font-bold text-red-500 bg-red-50 hover:bg-red-100 transition-colors border border-red-100">
                                Reset
                            </a>
                        @else
                            <div class="w-full py-2.5 rounded-lg border border-slate-100 bg-slate-50 text-slate-300 text-sm font-bold text-center cursor-not-allowed">Filter</div>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- === LIST TUGAS === --}}
        <div class="space-y-4 relative z-0">
            @forelse($tugas as $item)
                @php
                    $deadline   = \Carbon\Carbon::parse($item->deadline);
                    $submission = $item->submissionByAuth;
                    $isLate     = now()->isAfter($deadline);
                    $isDisabled = $isLate && !$submission; 
                @endphp

                <div class="clean-card rounded-xl p-5 md:p-6 flex flex-col md:flex-row gap-5 relative overflow-hidden group 
                     {{ $isDisabled ? 'opacity-60 bg-slate-50 grayscale-[0.8]' : '' }}">
                    
                    {{-- Garis Indikator Kiri --}}
                    <div class="absolute left-0 top-0 bottom-0 w-[4px] 
                        {{ $submission ? 'bg-emerald-500' : ($isLate ? 'bg-red-500' : 'bg-[#009da5]') }}">
                    </div>

                    {{-- Tanggal --}}
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 rounded-xl flex flex-col items-center justify-center border 
                            {{ $submission ? 'bg-emerald-50 border-emerald-100 text-emerald-600' : ($isDisabled ? 'bg-slate-100 border-slate-200 text-slate-400' : 'bg-cyan-50 border-cyan-100 text-[#009da5]') }}">
                            <span class="text-[9px] font-bold uppercase tracking-wider opacity-70">{{ $deadline->format('M') }}</span>
                            <span class="text-xl font-heading font-bold">{{ $deadline->format('d') }}</span>
                        </div>
                    </div>

                    {{-- Info Tugas --}}
                    <div class="flex-1 min-w-0 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-bold tracking-widest text-slate-400 uppercase truncate">
                                {{ Str::limit($item->materiAjar->nama_mk ?? 'General', 30) }}
                            </span>
                            @if($isLate && !$submission)
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-red-100 text-red-600 uppercase border border-red-200">Terlewat</span>
                            @endif
                        </div>
                        
                        <h3 class="text-base md:text-lg font-bold text-slate-800 mb-1 truncate pr-4 group-hover:text-[#009da5] transition-colors">
                            {{ $item->judul_tugas }}
                        </h3>

                        <div class="flex items-center gap-2 text-xs md:text-sm text-slate-500">
                            <i class="far fa-clock text-slate-400"></i>
                            <span class="font-medium">{{ $deadline->format('H:i') }} WIB</span>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-start md:justify-end pt-3 md:pt-0 border-t md:border-t-0 border-slate-100 mt-2 md:mt-0">
                        @if($submission)
                            <a href="{{ route('tugas.show', $item->id_tugas) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-50 text-emerald-700 text-sm font-medium hover:bg-emerald-100 transition-colors border border-emerald-100">
                                <i class="fas fa-check-circle"></i> <span>Terkirim</span>
                            </a>
                        @elseif($isDisabled)
                            <button disabled class="flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-100 text-slate-400 text-sm font-medium cursor-not-allowed border border-slate-200">
                                <i class="fas fa-lock"></i> <span>Terkunci</span>
                            </button>
                        @else
                            <a href="{{ route('tugas.show', $item->id_tugas) }}" class="flex items-center gap-2 px-5 py-2 rounded-lg bg-[#009da5] text-white text-sm font-medium shadow-md shadow-cyan-700/10 hover:shadow-cyan-700/20 hover:bg-[#008a91] transition-all transform hover:-translate-y-0.5">
                                <span>Kerjakan</span> <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white border border-dashed border-slate-300 rounded-xl p-10 text-center">
                    <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <h3 class="text-slate-800 font-bold text-sm">Tidak ada tugas</h3>
                    <a href="{{ route('tugas') }}" class="inline-block mt-2 text-[#009da5] text-xs font-bold hover:underline">Reset Filter</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection