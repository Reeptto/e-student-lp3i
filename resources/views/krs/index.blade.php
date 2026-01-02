@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
{{-- Menggunakan versi html2pdf yang lebih stabil --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
    /* === GLOBAL VARIABLES === */
    :root {
        --c-navy: #004269;
        --c-teal: #009DA5;
        --c-bg: #F0F4F8;
    }

    body { 
        font-family: 'Poppins', sans-serif !important; 
        background-color: var(--c-bg);
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
        overflow-x: hidden; /* Mencegah scroll horizontal body */
    }

    [x-cloak] { display: none !important; }

    /* === HEADER BACKGROUND === */
    .tech-header {
        position: fixed; top: 0; left: 0; right: 0; 
        height: 400px; 
        background-color: var(--c-navy);
        border-bottom: 6px solid var(--c-teal);
        border-radius: 0 0 60px 60px;
        z-index: -10; overflow: hidden;
        box-shadow: 0 10px 0 rgba(0, 157, 165, 0.2);
        transition: height 0.3s ease;
    }

    .pattern-tech-grid {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background-image: 
            linear-gradient(45deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px),
            linear-gradient(-45deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    /* Dekorasi dibuat responsif */
    .deco-diamond {
        position: absolute;
        width: 500px; height: 500px;
        border: 30px solid rgba(0, 157, 165, 0.15);
        top: -250px; left: -150px;
        transform: rotate(45deg);
    }

    .deco-block {
        position: absolute;
        width: 600px; height: 300px;
        background: linear-gradient(to right, rgba(0, 30, 50, 0.5), rgba(0, 66, 105, 0.8));
        bottom: -100px; right: -200px;
        transform: rotate(-20deg);
        border-top: 4px solid rgba(0, 157, 165, 0.3);
    }

    .deco-tech-lines {
        position: absolute; top: 120px; right: 5%;
        width: 250px; height: 40px;
        background: repeating-linear-gradient(-45deg, rgba(0, 157, 165, 0.2), rgba(0, 157, 165, 0.2) 10px, transparent 10px, transparent 20px);
    }

    /* === RESPONSIVE MEDIA QUERIES === */
    @media (max-width: 768px) {
        .tech-header {
            height: 280px; /* Header lebih pendek di HP */
            border-radius: 0 0 30px 30px;
        }
        
        /* Kecilkan elemen dekorasi agar tidak menutupi layar */
        .deco-diamond { width: 250px; height: 250px; top: -100px; left: -80px; border-width: 15px; }
        .deco-block { width: 300px; height: 150px; bottom: -50px; right: -100px; }
        .deco-tech-lines { display: none; } /* Hilangkan garis detail di HP */

        /* Judul responsive */
        h1 { font-size: 2rem !important; }
        
        /* Modal di HP */
        .formal-paper {
            padding: 20px 15px !important; /* Padding lebih tipis */
            width: 100% !important;
        }
        
        .kop-container {
            flex-direction: column;
            text-align: center;
        }
        .kop-logo { margin-right: 0 !important; margin-bottom: 10px; }
        
        /* Agar tabel bisa di-scroll horizontal di HP tanpa merusak layout kertas */
        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Tombol print floating disesuaikan */
        .modal-floating-actions {
            top: 10px; right: 10px;
            flex-direction: column; /* Stack tombol ke bawah biar rapi */
        }
        .btn-action span { display: none; } /* Sembunyikan teks di tombol jika perlu */
        .btn-action { padding: 8px 12px; }
    }

    /* === CARD STYLE === */
    .pop-card {
        background: #ffffff;
        border: 4px solid var(--c-navy);
        border-radius: 30px;
        box-shadow: 0px 10px 0px var(--c-navy);
        padding: 12px;
        position: relative;
        transition: transform 0.2s;
    }
    .pop-card.hoverable:hover { transform: translateY(-5px); box-shadow: 0px 15px 0px var(--c-navy); }

    .pop-inner {
        background: #F1F8FA;
        border: 3px dashed var(--c-teal);
        border-radius: 20px;
        height: 100%; position: relative; overflow: hidden;
        display: flex; flex-direction: column; padding: 1.5rem;
    }

    .pop-pill {
        display: inline-block; background: var(--c-teal); color: white;
        border: 3px solid var(--c-navy); padding: 6px 20px;
        border-radius: 50px; font-weight: 800; font-size: 0.9rem; text-transform: uppercase;
        box-shadow: 0 4px 0 rgba(0,0,0,0.2);
        white-space: nowrap; /* Mencegah teks turun */
    }

    .pop-btn {
        width: 100%; background: var(--c-navy); color: white;
        border: 3px solid var(--c-navy); border-radius: 12px; padding: 10px;
        font-weight: 800; text-transform: uppercase;
        box-shadow: 0 5px 0 #002840; cursor: pointer; transition: all 0.1s;
    }
    .pop-btn:hover { background-color: #005689; box-shadow: 0 7px 0 #002840; transform: translateY(-2px); }
    .pop-btn:active { top: 5px; box-shadow: 0 0 0 #002840; transform: translateY(0); }

    .card-locked .pop-inner { background: #e2e8f0; border-color: #94a3b8; opacity: 0.8; }
    .card-locked .pop-pill { background: #64748b; border-color: #334155; }


    /* === MODAL STYLE === */
    .formal-backdrop {
        background-color: rgba(26, 32, 44, 0.95);
        backdrop-filter: blur(5px);
        padding: 1rem; /* Tambah padding agar tidak mepet layar HP */
    }
    
    .formal-paper {
        background: white; 
        width: 100%; max-width: 800px; 
        margin: 0 auto; 
        padding: 40px 50px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7); 
        font-family: 'Poppins', sans-serif !important; 
        color: #000; position: relative;
        border-radius: 8px;
        /* Penting untuk responsif */
        box-sizing: border-box; 
    }

    .kop-container { display: flex; align-items: center; border-bottom: 4px double #000; padding-bottom: 15px; margin-bottom: 25px; }
    .kop-logo { width: 120px; height: 100px; display: flex; align-items: center; justify-content: center; margin-right: 20px; flex-shrink: 0; }
    .kop-logo img { width: 100%; height: 100%; object-fit: contain; }
    .kop-text { flex: 1; text-align: center; }
    .kop-text h1 { font-size: 18pt; font-weight: 800; margin: 0; text-transform: uppercase; line-height: 1.2; letter-spacing: 1px; }
    .kop-text p { margin: 2px 0; font-size: 10pt; font-weight: 500; }
    
    .doc-title { text-align: center; margin-bottom: 20px; }
    .doc-title h2 { font-size: 14pt; font-weight: 700; text-decoration: underline; margin: 0; text-transform: uppercase; }
    .doc-title p { font-size: 11pt; margin: 5px 0; font-weight: 500; }
    
    .formal-table { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 10pt; }
    .formal-table th { border: 1px solid #000; padding: 10px; background-color: #f0f0f0; text-align: center; font-weight: 700; }
    .formal-table td { border: 1px solid #000; padding: 8px; vertical-align: middle; }
    .formal-table tr:nth-child(even) { background-color: #fff; }
    
    .modal-floating-actions { 
        position: fixed; /* Ubah ke fixed agar selalu terlihat saat scroll */
        top: 20px; 
        right: 20px; 
        display: flex; 
        gap: 10px; 
        z-index: 100000;
    }
    
    .btn-action { 
        padding: 8px 20px; border-radius: 50px; font-weight: 600; font-size: 0.9rem;
        font-family: 'Poppins', sans-serif; box-shadow: 0 4px 6px rgba(0,0,0,0.3); 
        transition: transform 0.2s; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;
    }
    .btn-close { background: #e53e3e; color: white; }
    .btn-print { background: #004269; color: white; }
    .btn-action:hover { transform: translateY(-2px); filter: brightness(1.1); }
</style>

<div class="tech-header">
    <div class="pattern-tech-grid"></div> <div class="deco-diamond"></div> <div class="deco-block"></div> <div class="deco-tech-lines"></div> 
</div>

<div class="py-12 px-4 sm:px-6 lg:px-8 relative pt-24 md:pt-12"> {{-- Tambah padding top di HP agar tidak ketutup header --}}
    <div class="max-w-7xl mx-auto">
        
        {{-- Header Section: Stack Column di HP, Row di Desktop --}}
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6 mt-8 md:mt-0">
            <div class="text-white relative z-10 w-full md:w-auto">
                <div class="inline-block bg-white text-navy px-3 py-1 font-bold text-xs uppercase tracking-widest mb-2 border-2 border-teal rounded-md transform -rotate-2">
                    Academic Portal
                </div>
                <h1 class="text-3xl md:text-4xl lg:text-6xl font-black uppercase italic leading-none drop-shadow-md">
                    Kartu Rencana <br><span class="text-[#009DA5] text-stroke-white">Studi (KRS)</span>
                </h1>
                <div class="mt-4 flex flex-wrap gap-3">
                    <span class="bg-[#004269] border-2 border-[#009DA5] px-4 py-1 rounded-full font-bold text-xs md:text-sm">{{ $mahasiswa->nama_mhs }}</span>
                    <span class="bg-white text-[#004269] px-4 py-1 rounded-full font-bold text-xs md:text-sm border-2 border-white">{{ $mahasiswa->bidang_keahlian }}</span>
                </div>
            </div>

            <div class="pop-card bg-white relative z-10 transform rotate-2 hover:rotate-0 transition duration-300 w-full md:w-auto">
                <div class="pop-inner p-4 text-center min-w-[200px]">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest block mb-1">TOTAL KREDIT</span>
                    @php $grandTotalSks = 0; foreach($krsBySemester as $list) { $grandTotalSks += $list->sum('sks'); } @endphp
                    <span class="text-4xl md:text-5xl font-black text-[#004269] block leading-none">{{ $grandTotalSks }}</span>
                    <span class="text-sm font-bold text-[#009DA5] bg-white px-2 -mt-2 relative z-10">SKS DIAMBIL</span>
                </div>
            </div>
        </div>

        {{-- Grid System yang sudah Responsive --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-10">
            @foreach([1,2,3,4,5,6] as $semester)
                @php
                    $hasData = isset($krsBySemester[$semester]) && count($krsBySemester[$semester]) > 0;
                    $totalSksSemester = $hasData ? $krsBySemester[$semester]->sum('sks') : 0;
                @endphp

                @if($hasData)
                    <div onclick="openDetail({{ $semester }})" class="pop-card hoverable cursor-pointer group">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-20">
                            <span class="pop-pill">SEMESTER {{ $semester }}</span>
                        </div>
                        <div class="pop-inner bg-white">
                            <div class="mt-4 text-center">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Beban Studi</p>
                                <h2 class="text-5xl font-black text-[#004269] my-2 group-hover:scale-110 transition-transform duration-200">
                                    {{ $totalSksSemester }}
                                </h2>
                                <span class="text-sm font-bold text-[#009DA5]">SKS</span>
                            </div>
                            <div class="mt-auto pt-6 space-y-3">
                                <div class="flex justify-center">
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-black rounded border border-emerald-300 uppercase">
                                        Status: Aktif
                                    </span>
                                </div>
                                <button class="pop-btn">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="pop-card card-locked cursor-not-allowed">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-20">
                            <span class="pop-pill" style="background: #64748b; border-color: #334155;">SEMESTER {{ $semester }}</span>
                        </div>
                        <div class="pop-inner flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 bg-slate-300 rounded-full flex items-center justify-center text-slate-500 text-2xl mb-3 border-4 border-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <h3 class="text-xl font-black text-slate-500 uppercase">TERKUNCI</h3>
                            <p class="text-xs font-bold text-slate-400 mt-1">Belum ada data</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- MODAL AREA --}}
<div id="detailModal" class="hidden fixed inset-0 z-[99999] overflow-y-auto formal-backdrop">
    
    {{-- Container Modal --}}
    <div class="flex items-start md:items-center justify-center min-h-screen p-2 md:p-4">
        
        {{-- Tombol Action --}}
        <div class="modal-floating-actions">
            <button onclick="downloadPDF()" class="btn-action btn-print">
                <i class="fas fa-download mr-0 md:mr-2"></i> <span class="hidden md:inline">PDF</span>
            </button>
            <button onclick="closeModal()" class="btn-action btn-close">
                <i class="fas fa-times mr-0 md:mr-2"></i> <span class="hidden md:inline">Close</span>
            </button>
        </div>

        {{-- Kertas KRS --}}
        <div id="printableArea" class="formal-paper" onclick="event.stopPropagation()">
            <div class="kop-container">
                <div class="kop-logo">
                    <img src="{{ asset('/img/2.webp') }}" alt="LP3I Logo">
                </div>
                <div class="kop-text">
                    <h1 class="text-lg md:text-2xl">LP3I COLLEGE KARAWANG</h1>
                    <p class="text-xs md:text-sm">Jalan Tarumanegara Blok B No.4-6, Kelurahan Purwadana</p>
                    <p class="hidden md:block text-xs md:text-sm">Kecamatan Teluk Jambe Timur, Kabupaten Karawang</p>
                    <p class="text-xs md:text-sm">Email: education.karawang@lp3i.id | Telp: (0267) 8454541</p>
                </div>
            </div>

            <div class="doc-title">
                <h2>KARTU RENCANA STUDI (KRS)</h2>
                <p>Tahun Akademik {{ $mahasiswa->periode }}</p>
            </div>

            <div class="overflow-x-auto mb-4">
                <table style="width: 100%; font-size: 10pt; min-width: 500px; font-weight: 500;">
                    <tr>
                        <td width="130"><strong>Nama Mahasiswa</strong></td><td width="10">:</td><td>{{ $mahasiswa->nama_mhs }}</td>
                        <td width="80"><strong>Semester</strong></td><td width="10">:</td><td id="formalSemesterText"></td>
                    </tr>
                    <tr>
                        <td><strong>NIM / NIPD</strong></td><td>:</td><td>{{ $mahasiswa->nipd }}</td>
                        <td><strong>Kelas</strong></td><td>:</td><td>{{ $mahasiswa->kelas->kode_kelas }}</td>
                    </tr>
                    <tr>
                        <td><strong>Bidang Keahlian</strong></td><td>:</td><td colspan="4">{{ $mahasiswa->bidangKeahlian?->nama_bidang_keahlian ?? '-' }}</td>
                    </tr>
                </table>
            </div>

            {{-- Wrapper agar tabel bisa discroll di HP --}}
            <div class="table-responsive-wrapper">
                <table class="formal-table">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th style="text-align: left;">KODE MK</th>
                            <th style="text-align: left;">MATA KULIAH</th>
                            <th style="text-align: left;">DOSEN PENGAMPU</th>
                            <th width="10%">SKS</th>
                        </tr>
                    </thead>
                    <tbody id="formalTableBody"></tbody>
                </table>
            </div>

            <div class="flex flex-col md:flex-row justify-between mt-8 md:mt-12 px-2 md:px-5 gap-8">
                <div class="text-center w-full md:w-64">
                    <p style="font-size: 10pt;">Mahasiswa Ybs,</p>
                    <div style="height: 60px;"></div>
                    <p style="font-weight: bold; text-decoration: underline; font-size: 10pt; text-transform: uppercase;">{{ $mahasiswa->nama_mhs }}</p>
                    <p style="font-size: 10pt;">NIM. {{ $mahasiswa->nipd }}</p>
                </div>
                <div class="text-center w-full md:w-64">
                    <p style="font-size: 10pt;">Karawang, {{ date('d F Y') }}</p>
                    <p style="font-size: 10pt;">Bagian Administrasi Akademik,</p>
                    <div style="height: 60px;"></div>
                    <p style="font-weight: bold; text-decoration: underline; font-size: 10pt;">( .................................... )</p>
                    <p style="font-size: 10pt;">NIK. ....................</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const semesterData = {
        @foreach($krsBySemester as $semId => $krsList)
            {{ $semId }}: {
                courses: [
                    @foreach($krsList as $krs)
                    { 
                        code: "{{ $krs->mataKuliah->kode_mk ?? 'MK-00' }}",
                        name: "{{ $krs->mataKuliah->nama_mk }}", 
                        dosen: "{{ $krs->dosen->nama_dsn ?? '-' }}", 
                        sks: {{ $krs->sks }} 
                    },
                    @endforeach
                ]
            },
        @endforeach
    };

    function toRoman(num) { const r = {1:'I',2:'II',3:'III',4:'IV',5:'V',6:'VI'}; return r[num] || num; }

    function openDetail(semId) {
        const data = semesterData[semId];
        if(!data) return;
        document.getElementById('formalSemesterText').innerText = toRoman(semId);
        const tbody = document.getElementById('formalTableBody');
        tbody.innerHTML = '';
        let total = 0;
        data.courses.forEach((c, i) => {
            total += c.sks;
            tbody.innerHTML += `<tr><td align="center">${i+1}</td><td>${c.code}</td><td>${c.name}</td><td>${c.dosen}</td><td align="center">${c.sks}</td></tr>`;
        });
        tbody.innerHTML += `<tr style="background-color: #f9f9f9;"><td colspan="4" align="right" style="padding-right:15px;"><strong>TOTAL SKS DIAMBIL</strong></td><td align="center" style="font-weight: bold;">${total}</td></tr>`;
        
        const modal = document.getElementById('detailModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        // Cek jika yang diklik adalah backdrop (bukan kertas)
        if (e.target.id === 'detailModal' || e.target.classList.contains('flex')) {
            closeModal();
        }
    });

    function downloadPDF() {
        const element = document.getElementById('printableArea');
        var opt = {
            margin: [10, 10, 10, 10], // Margin diperkecil sedikit agar muat
            filename: 'KRS_Semester_{{ $mahasiswa->nipd }}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, scrollY: 0 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(element).save();
    }
</script>
@endsection