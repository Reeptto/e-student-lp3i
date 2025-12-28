@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@700;800&display=swap');

    body {
        font-family: 'Archivo', sans-serif; /* Font yang lebih tebal & tegas */
        background-color: #ffffff;
        color: #000000;
        min-height: 100vh;
        /* Pattern garis miring halus agar tidak plain dead white */
        background-image: repeating-linear-gradient(45deg, #f8f8f8 25%, transparent 25%, transparent 75%, #f8f8f8 75%, #f8f8f8), repeating-linear-gradient(45deg, #f8f8f8 25%, #ffffff 25%, #ffffff 75%, #f8f8f8 75%, #f8f8f8);
        background-position: 0 0, 10px 10px;
        background-size: 20px 20px;
    }

    /* --- GLOBAL COMPONENT STYLES --- */
    .border-hard {
        border: 3px solid #000000;
    }

    .shadow-hard-red {
        box-shadow: 8px 8px 0px 0px #f15b67;
    }
    
    .shadow-hard-black {
        box-shadow: 6px 6px 0px 0px #000000;
    }

    /* --- NAVBAR --- */
    .brutal-nav {
        background: #fff;
        border-bottom: 3px solid #000;
        padding: 1.5rem 0;
        position: relative;
        z-index: 50;
    }

    .btn-back-brutal {
        background: #fff;
        border: 2px solid #000;
        padding: 8px 16px;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.8rem;
        box-shadow: 4px 4px 0px 0px #000;
        transition: all 0.1s;
    }
    .btn-back-brutal:hover {
        transform: translate(2px, 2px);
        box-shadow: 2px 2px 0px 0px #000;
        background: #f15b67;
        color: white;
    }

    /* --- LAYOUT UTAMA --- */
    .paper-container {
        background: #ffffff;
        border: 3px solid #000000;
        max-width: 1200px;
        margin: 2rem auto;
        /* Layout Grid */
        display: grid;
        grid-template-columns: 1fr 400px;
    }

    @media (max-width: 1024px) {
        .paper-container { grid-template-columns: 1fr; }
    }

    /* --- HEADER SECTION (FULL WIDTH) --- */
    .task-header-bar {
        grid-column: 1 / -1;
        background: #004269;
        color: #fff;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px solid #000;
    }

    /* --- KOLOM KIRI (SOAL) --- */
    .left-panel {
        padding: 3rem;
        border-right: 3px solid #000;
    }

    .brutal-title {
        font-size: 3rem; /* JUDUL RAKSASA */
        font-weight: 900;
        line-height: 1;
        text-transform: uppercase;
        margin-bottom: 2rem;
        /* Efek teks seperti stempel/cetakan */
        -webkit-text-stroke: 1px black;
    }

    .meta-badge {
        display: inline-block;
        background: #f15b67;
        color: white;
        font-weight: 800;
        border: 2px solid #000;
        padding: 4px 10px;
        font-size: 0.75rem;
        text-transform: uppercase;
        margin-bottom: 1rem;
        box-shadow: 3px 3px 0px #000;
    }

    .materi-link {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 2px solid #000;
        padding: 1rem;
        margin-top: 2rem;
        background: #fff;
        transition: all 0.2s;
    }
    .materi-link:hover {
        background: #ff0000;
        color: #fff;
    }
    .materi-link:hover span { color: #ffffff; }

    /* --- KOLOM KANAN (DEADLINE & ACTION) --- */
    .right-panel {
        background: #fff;
        padding: 0; /* Padding diatur per child */
        display: flex;
        flex-direction: column;
    }

    /* Kotak Waktu */
    .deadline-zone {
        background: #f15b67; /* Merah Blok */
        padding: 2rem;
        text-align: center;
        border-bottom: 3px solid #000;
        color: #fff;
    }

    .time-big {
        font-family: 'JetBrains Mono', monospace;
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1;
        text-shadow: 4px 4px 0px #000; /* Shadow teks hitam keras */
    }

    .date-big {
        font-weight: 800;
        text-transform: uppercase;
        font-size: 1.2rem;
        margin-top: 0.5rem;
        background: #004269;
        color: #fff;
        display: inline-block;
        padding: 2px 8px;
        transform: rotate(-2deg); /* Miring dikit biar rebel */
    }

    /* Kotak Upload */
    .action-zone {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .upload-brutal {
        border: 3px dashed #000;
        padding: 2rem;
        text-align: center;
        background: #f0f0f0;
        cursor: pointer;
        transition: all 0.2s;
        margin-bottom: 1.5rem;
    }
    .upload-brutal:hover {
        background: #fff;
        border-color: #f15b67;
        box-shadow: inset 0 0 0 4px rgba(241, 91, 103, 0.1);
    }

    .btn-submit-brutal {
        background: #000;
        color: #fff;
        width: 100%;
        padding: 1.2rem;
        font-family: 'Archivo', sans-serif;
        font-weight: 900;
        font-size: 1.2rem;
        text-transform: uppercase;
        border: 3px solid #000;
        cursor: pointer;
        /* Shadow Merah Keras di Tombol */
        box-shadow: 6px 6px 0px #f15b67; 
        transition: all 0.1s;
    }
    
    .btn-submit-brutal:hover {
        transform: translate(2px, 2px);
        box-shadow: 4px 4px 0px #ff0000;
        background: #f15b67;
    }
    .btn-submit-brutal:active {
        transform: translate(6px, 6px);
        box-shadow: 0px 0px 0px #f15b67;
    }

    /* Stamp Style untuk Submitted */
    .stamp-box {
        border: 4px solid #000;
        padding: 2rem;
        text-align: center;
        background: #f15b67;
        color: white;
        transform: rotate(2deg);
        box-shadow: 8px 8px 0px #000;
    }
</style>

<nav class="brutal-nav">
    <div class="max-w-[1200px] mx-auto px-6 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-6 h-6 bg-black"></div>
            <span class="font-black text-xl tracking-tighter uppercase">Kumpulkan Tugas</span>
        </div>
        <a href="{{ route('tugas') }}" class="btn-back-brutal">
            &larr; Cancel
        </a>
    </div>
</nav>

<div class="paper-container shadow-hard-red ">
    
    <div class="task-header-bar">
        <div>
            <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest">Mata Kuliah</span>
            <span class="text-xl font-black uppercase text-[#fffffff]">{{ $tugas->matkul->nama_mk }}</span>
        </div>
        <div class="text-right">
            <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest">ID Tugas</span>
            <span class="text-xl font-mono font-bold">#{{ $tugas->id }}</span>
        </div>
    </div>

    <div class="left-panel">
        <span class="meta-badge">Tugas Anda</span>
        
        <h1 class="brutal-title">{{ $tugas->judul_tugas }}</h1>
        <br>
        <span class="meta-badge">Deskripsi Tugas</span>
        <div class="prose max-w-none font-medium text-lg leading-relaxed border-l-4 border-[#f15b67] pl-6 py-2">
            {!! nl2br(e($tugas->deskripsi)) !!}
        </div>

        @if($tugas->file_materi)
            <a href="{{ asset('storage/'.$tugas->file_materi) }}" class="materi-link group">
                <div>
                    <span class="block font-black text-sm uppercase">Lampiran File</span>
                    <span class="block text-xs font-mono group-hover:text-[#ffffff]">{{$tugas->file_materi}}
                    </span>
                </div>
                <div class="bg-black text-white p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                </div>
            </a>
        @endif
    </div>

    <div class="right-panel">
        
        <div class="deadline-zone">
            <p class="text-xs font-black text-black uppercase tracking-[0.2em] mb-2 bg-white inline-block px-2">Menuju Batas Waktu</p>
            <div class="time-big">
                {{ \Carbon\Carbon::parse($tugas->time_end)->format('H:i') }}
            </div>
            <div class="date-big">
                {{ \Carbon\Carbon::parse($tugas->time_end)->format('d M Y') }}
            </div>
        </div>

        <div class="action-zone">
            
            @if(!$submission && !$isExpired)
                <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">
                    
                    <label class="block font-black uppercase text-sm mb-2">Upload Tugas (PDF/DOC)</label>
                    <div class="relative">
                        <input type="file" name="file_tugas_mhs" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                        <div class="upload-brutal">
                            <svg class="w-10 h-10 mx-auto text-black mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <span class="font-bold underline decoration-2 decoration-[#f15b67]">KLIK UNTUK UPLOAD</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit-brutal">
                        KIRIM SEKARANG!
                    </button>
                    
                    <div class="mt-4 flex gap-2 items-start">
                        <span class="text-xl">⚠️</span>
                        <p class="text-xs font-bold leading-tight">
                            PERINGATAN: File tidak bisa diubah setelah tombol kirim ditekan. Pastikan file benar.
                        </p>
                    </div>
                </form>

            @elseif($submission)
                <div class="stamp-box">
                    <h3 class="text-3xl font-black uppercase">Terkirim</h3>
                    <p class="font-mono text-sm border-t-2 border-black pt-2 mt-2">
                        {{ \Carbon\Carbon::parse($submission->created_at)->format('d/m/Y - H:i') }}
                    </p>
                    @if($submission->nilai)
                        <div class="bg-white text-black font-black text-5xl mt-4 border-2 border-black p-2">
                            {{ $submission->nilai }}
                        </div>
                    @else
                        <div class="mt-4 bg-black text-white text-xs font-bold py-1 px-2 inline-block uppercase">
                            Menunggu Penilaian
                        </div>
                    @endif
                </div>

            @else
                <div class="border-4 border-black p-6 text-center opacity-50 grayscale bg-gray-200">
                    <h3 class="font-black text-2xl uppercase">EXPIRED</h3>
                    <p class="font-bold">WAKTU HABIS</p>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection