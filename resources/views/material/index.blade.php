@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700;800&display=swap');
    
    .font-sans-formal { font-family: 'Inter', sans-serif; }
    .font-heading { font-family: 'Poppins', sans-serif; }

    /* Scrollbar */
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f1f5f9; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    /* Animasi */
    .dropdown-enter { animation: slideDown 0.2s ease-out forwards; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

    /* Card Compact */
    .card {
        background: #ffffff;
        border-radius: 12px; /* Radius sedikit dikurangi biar pas sama ukuran kecil */
        border: 1px solid #e2e8f0;
        transition: all .2s ease-in-out;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
        border-color: #004269;
    }
</style>

<div class="min-h-screen bg-slate-50 font-sans-formal pb-20">
    <div class="max-w-7xl mx-auto px-4 lg:px-6 pt-6">

        {{-- === HEADER COMPACT (UKURAN DIPERKECIL) === --}}
        {{-- Ubah h-64 menjadi h-40 md:h-48 --}}
        <div class="relative w-full h-40 md:h-48 bg-[#004269] rounded-2xl overflow-hidden mb-8 shadow-xl group">
            
            {{-- Background SVG --}}
            <div class="absolute inset-0 z-0">
                <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 800 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M550 0H800V300H450L550 0Z" fill="white"/>
                    <rect x="420" y="-50" width="20" height="500" transform="rotate(20 420 -50)" fill="white"/>
                    <rect x="380" y="-50" width="10" height="500" transform="rotate(20 380 -50)" fill="white"/>
                    <rect x="520" y="40" width="220" height="220" rx="4" stroke="#004269" stroke-width="3" fill="none" opacity="0.8"/>
                </svg>
            </div>

            {{-- Konten Center Compact --}}
            <div class="absolute inset-0 z-10 flex items-center justify-center px-4">
                <div class="bg-[#004269]/95 backdrop-blur-sm px-6 py-5 md:px-10 md:py-6 rounded-xl shadow-lg w-full max-w-xl border border-white/10 text-center relative">
                    
                    {{-- Hiasan Sudut Kecil --}}
                    <div class="absolute top-2 left-2 w-3 h-3 border-t border-l border-blue-300/30"></div>
                    <div class="absolute top-2 right-2 w-3 h-3 border-t border-r border-blue-300/30"></div>
                    <div class="absolute bottom-2 left-2 w-3 h-3 border-b border-l border-blue-300/30"></div>
                    <div class="absolute bottom-2 right-2 w-3 h-3 border-b border-r border-blue-300/30"></div>

                    {{-- Teks Header --}}
                    <h1 class="text-2xl md:text-3xl font-heading font-extrabold text-white leading-tight mb-1">
                        Pustaka <span class="text-blue-300">Materi</span>
                    </h1>
                    <p class="text-blue-100/90 text-xs md:text-sm font-light">
                        Kelas: <span class="font-bold text-white">{{ auth()->user()->mahasiswa->kelas->nama_kelas ?? 'Umum' }}</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- === FILTER COMPACT === --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 mb-8 relative z-30">
            <form method="GET" action="{{ route('material.index') }}">
                <div class="flex flex-col md:flex-row gap-3 items-center">
                    
                    {{-- Filter Semester --}}
                    <div class="w-full md:w-1/4 relative" x-data="{ open: false, label: '{{ request('semester') ? 'Semester '.request('semester') : 'Semester' }}' }">
                        <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-3 py-2.5 text-left flex items-center justify-between hover:border-[#004269]">
                            <span x-text="label" class="font-medium truncate"></span>
                            <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                        </button>
                        <div x-show="open" x-cloak class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-slate-100 z-50 dropdown-enter">
                            <div class="max-h-48 overflow-y-auto custom-scroll p-1">
                                <div @click="$el.closest('form').submit()" class="px-3 py-2 text-xs hover:bg-slate-50 cursor-pointer">Semua</div>
                                @for ($i = 1; $i <= 8; $i++)
                                    <input type="radio" name="semester" value="{{ $i }}" class="hidden" id="sem{{$i}}" @if(request('semester') == $i) checked @endif>
                                    <label for="sem{{$i}}" @click="$el.closest('form').submit()" class="block px-3 py-2 text-xs hover:bg-blue-50 cursor-pointer rounded {{ request('semester') == $i ? 'text-[#004269] font-bold bg-blue-50' : '' }}">Semester {{ $i }}</label>
                                @endfor
                            </div>
                        </div>
                    </div>

                    {{-- Filter Matkul --}}
                    <div class="w-full md:w-2/4 relative" x-data="{ open: false, label: '{{ request('id_mk') ? ($mataKuliah->firstWhere('id_mk', request('id_mk'))->nama_mk ?? 'Pilih Materi') : 'Mata Kuliah' }}' }">
                        <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-3 py-2.5 text-left flex items-center justify-between hover:border-[#004269]">
                            <span x-text="label" class="font-medium truncate"></span>
                            <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                        </button>
                        <div x-show="open" x-cloak class="absolute top-full left-0 right-0 mt-1 bg-white rounded-lg shadow-lg border border-slate-100 z-50 dropdown-enter">
                            <div class="max-h-48 overflow-y-auto custom-scroll p-1">
                                <div @click="$el.closest('form').submit()" class="px-3 py-2 text-xs hover:bg-slate-50 cursor-pointer">Semua</div>
                                @foreach ($mataKuliah as $mk)
                                    <input type="radio" name="id_mk" value="{{ $mk->id_mk }}" class="hidden" id="mk{{$mk->id_mk}}" @if(request('id_mk') == $mk->id_mk) checked @endif>
                                    <label for="mk{{$mk->id_mk}}" @click="$el.closest('form').submit()" class="block px-3 py-2 text-xs hover:bg-blue-50 cursor-pointer rounded {{ request('id_mk') == $mk->id_mk ? 'text-[#004269] font-bold bg-blue-50' : '' }}">{{ $mk->nama_mk }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Reset --}}
                    @if(request()->hasAny(['semester','id_mk']))
                        <a href="{{ route('material.index') }}" class="w-full md:w-auto px-4 py-2.5 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 text-sm font-bold text-center border border-red-100">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- === GRID CONTENT MATERI (COMPACT / PENDEK) === --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 relative z-0">
            @forelse ($materi as $item)
                {{-- Padding dikurangi jadi p-5 --}}
                <div class="card p-5 flex flex-col h-full bg-white group relative overflow-hidden">
                    
                    {{-- Dekorasi Samping Tipis --}}
                    <div class="absolute top-0 left-0 w-[3px] h-full bg-slate-100 group-hover:bg-[#004269] transition-colors duration-300"></div>

                    {{-- Badge MK --}}
                    <div class="mb-2 pl-3">
                         <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[#004269] uppercase tracking-wider border border-blue-100">
                            {{ Str::limit($item->materiAjar->nama_mk ?? 'Umum', 20) }}
                        </span>
                    </div>

                    {{-- Judul (Size dikurangi dikit) --}}
                    <h3 class="font-bold text-base md:text-lg text-slate-800 mb-2 line-clamp-1 pl-3 group-hover:text-[#004269] transition-colors" title="{{ $item->judul_materi }}">
                        {{ $item->judul_materi }}
                    </h3>

                    {{-- Deskripsi (Line clamp jadi 2 baris biar pendek) --}}
                    <p class="text-xs text-slate-500 flex-1 line-clamp-2 leading-relaxed pl-3 mb-3">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>

                    {{-- Footer Card --}}
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between pl-3 mt-auto">
                        <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                             <i class="far fa-calendar-alt"></i>
                            <span>{{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y') : '-' }}</span>
                        </div>

                        <a href="{{ route('materi.download', $item->id_materi) }}"
                           class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-[#004269] hover:bg-blue-800 px-3 py-1.5 rounded-lg transition-colors shadow-sm shadow-blue-900/10">
                            <span>Unduh</span>
                            <i class="fas fa-download text-[9px]"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-3 text-slate-300">
                        <i class="fas fa-folder-open text-2xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm">Data Kosong</p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection