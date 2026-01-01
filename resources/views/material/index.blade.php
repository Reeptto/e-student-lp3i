@extends('layouts.app')

@section('content')

    <style>
        .neo-card-wrapper {
            position: relative;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .neo-card-bg {
            position: absolute;
            top: 12px;
            left: 12px;
            width: 100%;
            height: 100%;
            background-color: #009da5; 
            border: 2px solid #1e293b;
            border-radius: 12px;
            z-index: 1;
        }

        .neo-card-main {
            position: relative;
            background: white;
            border: 2px solid #1e293b;
            border-radius: 12px;
            padding: 2.5rem 1.5rem 1.5rem 1.5rem;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .neo-card-wrapper:hover .neo-card-main {
            transform: translate(-4px, -4px);
        }

        .neo-number-box {
            position: absolute;
            top: -20px;
            left: -10px;
            background-color: #009da5;
            color: white;
            padding: 8px 18px;
            border: 2px solid #1e293b;
            border-radius: 8px;
            font-weight: 800;
            font-size: 1.2rem;
            z-index: 20;
            box-shadow: 4px 4px 0px #1e293b;
        }

        .neo-dots {
            position: absolute;
            bottom: -15px;
            right: -15px;
            width: 60px;
            height: 60px;
            background-image: radial-gradient(#1e293b 2px, transparent 2px);
            background-size: 10px 10px;
            opacity: 0.3;
            z-index: 0;
        }

        .neo-zigzag {
            position: absolute;
            top: -25px;
            right: 20px;
            width: 80px;
            height: 15px;
            background: linear-gradient(135deg, transparent 25%, #009da5 25%, #009da5 50%, transparent 50%, transparent 75%, #009da5 75%, #009da5 100%);
            background-size: 15px 15px;
            opacity: 0.4;
        }
    </style>

    <div class="min-h-screen pb-20">

        <div class="bg-[#009da5] pt-12 pb-24 px-4 sm:px-6 lg:px-8 border-b-4 border-slate-800 shadow-lg mb-10">
            <div class="max-w-7xl mx-auto text-center md:text-left relative z-10">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2 tracking-tight">PUSTAKA MATERI</h1>
                <p class="text-white/80 text-sm md:text-base font-medium">Arsip bahan ajar digital terstruktur.</p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            
            <div class="bg-white rounded-xl border-2 border-slate-800 p-3 mb-12 flex flex-col md:flex-row items-center justify-between gap-4 shadow-[6px_6px_0px_#1e293b]">
                <div class="px-4 font-black text-slate-800 text-sm uppercase tracking-widest flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    PILIH MATAKULIAH
                </div>
                
                <form method="GET" action="{{ url()->current() }}"
                    class="w-full flex gap-3 items-center md:max-w-xl">

                    <select name="semester" id="semester" 
                        class="flex-1 border-2 border-slate-800 bg-slate-50 rounded-lg 
                            text-sm font-bold text-slate-700 focus:ring-0
                            focus:border-[#009da5] cursor-pointer py-2 px-4">
                        <option value="">🎓 Pilih Semester</option>
                        @for ($i = 1; $i <= 4; $i++)
                            <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>

                    <select name="mk_id" onchange="this.form.submit()" id="mk_id"
                        class="flex-1 border-2 border-slate-800 bg-slate-50 rounded-lg
                            text-sm font-bold text-slate-700 focus:ring-0
                            focus:border-[#009da5] cursor-pointer py-2 px-4">
                        <option value="">📂 Pilih Mata Kuliah</option>
                        @if(isset($mataKuliah))
                            @foreach ($mataKuliah as $mk)
                                <option value="{{ $mk->id }}" {{ request('mk_id') == $mk->id ? 'selected' : '' }}>
                                    {{ $mk->nama_mk }}
                                </option>
                            @endforeach
                        @endif
                    </select>

                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-16 gap-x-10">
                @if(isset($materi) && count($materi) > 0)
                    @foreach ($materi as $index => $item)
                        
                        <div class="neo-card-wrapper h-full">
                            <div class="neo-dots"></div>
                            <div class="neo-zigzag"></div>
                            
                            <div class="neo-card-bg"></div>

                            <div class="neo-number-box">
                                {{ str_pad($item->pertemuan, 2, '0', STR_PAD_LEFT) }}
                            </div>

                            {{-- KARTU UTAMA --}}
                            <div class="neo-card-main flex flex-col h-full">
                                {{-- KONTEN --}}
                                <div class="flex-1">
                                    <h4 class="text-[10px] font-black text-[#009da5] tracking-[0.2em] uppercase mb-2">
                                        {{ $item->matkul->nama_mk ?? 'MATERI UMUM' }}
                                    </h4>

                                    <h3 class="text-lg font-extrabold text-slate-800 leading-tight mb-4 line-clamp-2">
                                        {{ $item->nama_materi }}
                                    </h3>

                                    <p class="text-xs text-slate-500 font-medium leading-relaxed mb-6">
                                        {{ $item->deskripsi ?? 'Tidak ada deskripsi tambahan untuk materi ini.' }}
                                    </p>
                                </div>


                                {{-- FOOTER & DOWNLOAD --}}
                                <div class="mt-4 pt-4 border-t-2 border-slate-100 flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Diunggah pada</span>
                                        <span class="text-xs font-black text-slate-700">
                                            {{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d/m/Y') : '-' }}
                                        </span>
                                    </div>

                                    <a href="{{ route('materi.download', $item->id) }}" 
                                       class="bg-[#009da5] border-2 border-slate-800 text-white p-2 px-4 rounded-lg font-black text-xs shadow-[3px_3px_0px_#1e293b] hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all flex items-center gap-2">
                                        UNDUH
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="col-span-full py-20 text-center border-4 border-dashed border-slate-300 rounded-3xl bg-white">
                        <p class="text-slate-400 font-black text-xl uppercase tracking-widest opacity-50">Belum Ada Data Materi</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const semesterSelect = document.getElementById('semester')
    const matkulSelect   = document.getElementById('mk_id')

    function loadMatkul(semester = null, selectedMatkul = null) {
        matkulSelect.innerHTML = '<option>Loading...</option>'

        let url = '/ajax/matkul'
        if (semester) {
            url += `?semester=${semester}`
        }

        fetch(url, { credentials: 'same-origin' })
            .then(res => res.json())
            .then(data => {
                matkulSelect.innerHTML = '<option value="">📂 Pilih Mata Kuliah</option>'

                if (data.length === 0) {
                    matkulSelect.innerHTML += '<option disabled>Tidak ada matkul</option>'
                    return
                }

                data.forEach(mk => {
                    const selected = selectedMatkul == mk.id ? 'selected' : ''
                    matkulSelect.innerHTML +=
                        `<option value="${mk.id}" ${selected}>${mk.nama_mk}</option>`
                })
            })
            .catch(() => {
                matkulSelect.innerHTML = '<option>Gagal load</option>'
            })
    }


    semesterSelect.addEventListener('change', function () {
        loadMatkul(this.value)
    })

    const selectedSemester = semesterSelect.value
    const selectedMatkul   = "{{ request('mk_id') }}"

    loadMatkul(selectedSemester, selectedMatkul)
})
</script>

@endsection