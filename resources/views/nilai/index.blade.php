@extends('layouts.app')

@section('content')
{{-- Load Font --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* === STYLE TAMPILAN WEB (TIDAK DIUBAH) === */
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }
    :root { --navy: #004269; --teal: #009DA5; --red: #f15b67; }

    .tech-tabs-container { display: flex; gap: 0.5rem; border-bottom: 3px solid var(--navy); padding-left: 1rem; }
    .tech-tab { position: relative; padding: 12px 24px; font-weight: 800; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; border-radius: 12px 12px 0 0; border: 3px solid transparent; border-bottom: none; transition: all 0.3s; overflow: hidden; cursor: pointer; }
    .tech-tab.active { background: white; color: var(--navy); border-color: var(--navy); margin-bottom: -3px; padding-bottom: 15px; z-index: 10; box-shadow: 0 -5px 15px -5px rgba(0, 157, 165, 0.3); }
    .tech-tab.active::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--teal); }
    .tech-tab.inactive { background: #e5e7eb; color: #6b7280; top: 3px; }
    .tech-tab.inactive:hover { background: #d1d5db; color: var(--navy); top: 1px; }

    .card-item-border { border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s ease; background: linear-gradient(to bottom right, #ffffff, #f8fafc); }
    .card-item-border:hover { border-color: var(--teal); transform: translateY(-3px); box-shadow: 0 10px 20px -5px rgba(0, 157, 165, 0.15); }
    
    .sleek-filter { display: flex; align-items: center; gap: 1rem; background: white; padding: 0.75rem 1rem; border-radius: 50px; border: 2px solid #e5e7eb; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .sleek-filter:hover { border-color: var(--navy); }

    /* === STYLE KHUSUS PRINT & MODAL === */
    .paper-a4 {
        width: 210mm;
        min-height: 297mm;
        background: white;
        margin: 0 auto;
        padding: 10mm 15mm; 
        position: relative;
        box-shadow: 0 0 15px rgba(0,0,0,0.15);
        color: black;
        box-sizing: border-box;
    }

    /* 1. TABLE BIODATA (FIX JARAK) */
    .table-biodata { width: 100%; border-collapse: collapse; font-size: 10pt; margin-bottom: 20px; }
    .table-biodata td { 
        padding: 4px 0;       /* Jarak atas-bawah konsisten 4px */
        vertical-align: top;  /* Teks selalu mulai dari atas */
        line-height: 1.5;     /* Jarak antar baris teks rapi */
    }
    .col-label { width: 160px; font-weight: 500; }
    .col-separator { width: 15px; text-align: center; }
    .col-value { font-weight: 700; }

    /* 2. TABLE NILAI (RESMI) */
    .table-surat { width: 100%; border-collapse: collapse; font-size: 10pt; line-height: 1.3; margin-top: 10px; }
    .table-surat th { background-color: #f0f0f0 !important; font-weight: 700; text-align: center; vertical-align: middle; padding: 8px 5px; border: 1px solid #000; }
    .table-surat td { padding: 6px 8px; border: 1px solid #000; vertical-align: middle; }
    
    .garis-kop { border-bottom: 4px double #000; margin-bottom: 2px; }
    .garis-tipis { border-bottom: 1px solid #000; margin-bottom: 25px; }
    .tegak { font-style: normal !important; }

    @media print {
        @page { size: A4; margin: 0; }
        body, html { width: 100%; height: 100%; background: white !important; -webkit-print-color-adjust: exact; }
        
        .no-print, nav, header, footer, .tech-tabs-container, .sleek-filter, .web-header, .print-toolbar { display: none !important; }
        
        #khsModal { position: fixed !important; inset: 0 !important; background: white !important; z-index: 9999; display: block !important; }
        #printWrapper { padding: 0 !important; margin: 0 !important; }
        .paper-a4 { width: 100% !important; height: auto !important; margin: 0 !important; padding: 15mm !important; box-shadow: none !important; border: none !important; }
    }
</style>

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 no-print" x-data="{ activeTab: 'komponen' }">

    {{-- HEADER & FILTER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-6 web-header">
        <div class="flex-1">
            <h1 class="text-4xl font-black text-[#004269] uppercase tracking-wider flex items-center gap-2">
                <span class="text-[#009DA5]"><i class="fas fa-graduation-cap"></i></span>
                Nilai Akademik
            </h1>
            <p class="text-gray-500 font-medium mt-2 flex items-center gap-2">
                <span class="h-1 w-10 bg-[#009DA5] rounded-full"></span>
                Pantau performa studimu semester ini.
            </p>
        </div>

        <form method="GET" class="flex-shrink-0">
            <div class="sleek-filter">
                <div class="bg-[#004269] w-8 h-8 rounded-full flex items-center justify-center text-white shadow-sm"><i class="fas fa-filter text-sm"></i></div>
                <div class="flex flex-col">
                   <label class="text-[0.65rem] font-bold text-[#009DA5] uppercase tracking-wider">Filter Semester</label>
                   <select name="semester" onchange="this.form.submit()" class="font-bold text-gray-700 bg-transparent border-none p-0 pr-8 focus:ring-0 cursor-pointer text-sm outline-none -mt-0.5">
                        <option value="">-- Semua Semester --</option>
                        @for ($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                                Semester {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>
        </form>
    </div>

    {{-- TABS --}}
    <div class="mb-6 tech-tabs-container">
        <button @click="activeTab = 'komponen'" :class="activeTab === 'komponen' ? 'tech-tab active' : 'tech-tab inactive'">
            <i class="fas fa-list-ul mr-2"></i> Detail Komponen
        </button>
        <button onclick="openModal()" class="tech-tab inactive hover:bg-gray-200">
            <i class="fas fa-file-invoice mr-2"></i> Kartu Hasil Studi (KHS)
        </button>
    </div>

    {{-- TAB 1: DETAIL KOMPONEN (WEB VIEW) --}}
    <div x-show="activeTab === 'komponen'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="space-y-4 relative z-10">
        
        @forelse ($nilai as $item)
        <div class="card-item-border overflow-hidden" x-data="{ expanded: false }">
            <div @click="expanded = !expanded" class="p-5 cursor-pointer flex justify-between items-center group relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-[#009DA5]/0 to-[#009DA5]/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="flex items-center gap-5 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#004269] to-[#006064] flex items-center justify-center text-white font-black text-xl shadow-lg">
                        {{ substr($item->materiAjar->nama_mk, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#004269] group-hover:text-[#009DA5] transition-colors">{{ $item->materiAjar->nama_mk }}</h3>
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wide mt-1">
                            <span class="bg-gray-100 px-2 py-0.5 rounded border border-gray-200">SKS: {{ $item->materiAjar->sks }}</span>
                            <span>•</span>
                            <span>Semester {{ $item->materiAjar->semester }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-6 relative z-10">
                    <div class="text-right hidden sm:block bg-white/80 p-2 rounded-lg backdrop-blur-sm border border-gray-100">
                        <span class="block text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Nilai Akhir</span>
                        <div class="flex items-center gap-2 justify-end">
                            <span class="text-2xl font-black text-[#004269]">{{ $item->nilai_akhir }}</span>
                            @php 
                                $g = ucfirst($item->grade);
                                $gradeColor = str_starts_with($g, 'A') ? 'green' : (str_starts_with($g, 'B') ? 'blue' : (str_starts_with($g, 'C') ? 'orange' : 'red')); 
                            @endphp
                            <span class="px-2 py-0.5 rounded text-sm font-black bg-{{$gradeColor}}-100 text-{{$gradeColor}}-700 border border-{{$gradeColor}}-200 shadow-sm">
                                {{ $item->grade }}
                            </span>
                        </div>
                    </div>
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 bg-gray-50 border border-gray-200">
                        <svg :class="expanded ? 'rotate-180' : ''" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            <div x-show="expanded" x-collapse class="border-t-2 border-dashed border-gray-200 bg-gray-50/80 p-6 relative">
                <div class="relative z-10">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-blue-400 mb-1"><i class="fas fa-user-clock"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Kehadiran</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->nilai_kehadiran ?? '-' }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-purple-400 mb-1"><i class="fas fa-smile"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Attitude</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->nilai_sikap ?? '-' }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-orange-400 mb-1"><i class="fas fa-tasks"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Tugas</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->nilai_tugas ?? '-' }}</span>
                        </div>
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-pink-400 mb-1"><i class="fas fa-question-circle"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Formative</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->nilai_formative ?? '-' }}</span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gradient-to-r from-[#009DA5]/10 to-transparent p-4 rounded-xl border-l-4 border-[#009DA5] flex justify-between items-center">
                            <span class="text-sm font-bold text-[#009DA5] uppercase flex items-center gap-2"><i class="fas fa-file-alt"></i> UTS</span>
                            <span class="text-2xl font-black text-[#004269]">{{ $item->nilai_uts ?? '-' }}</span>
                        </div>
                        <div class="bg-gradient-to-r from-[#f15b67]/10 to-transparent p-4 rounded-xl border-l-4 border-[#f15b67] flex justify-between items-center">
                            <span class="text-sm font-bold text-[#f15b67] uppercase flex items-center gap-2"><i class="fas fa-file-signature"></i> UAS</span>
                            <span class="text-2xl font-black text-[#004269]">{{ $item->nilai_uas ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-12 rounded-xl border-2 border-dashed border-gray-300 text-center">
            <i class="fas fa-folder-open text-4xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 font-medium">Belum ada data nilai untuk semester yang dipilih.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ==================================================================== --}}
{{-- MODAL PREVIEW & PRINT --}}
{{-- ==================================================================== --}}
<div id="khsModal" class="fixed inset-0 bg-gray-900/90 hidden z-[9999] overflow-y-auto backdrop-blur-sm transition-opacity">
    
    {{-- TOOLBAR ATAS --}}
    <div class="print-toolbar fixed top-0 w-full bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center shadow-md z-[10000]">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 p-2 rounded-lg text-blue-700">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 text-sm">Pratinjau KHS</h3>
                <p class="text-xs text-gray-500">Siap dicetak di kertas A4</p>
            </div>
        </div>
        <div class="flex gap-3">
            <button onclick="closeModal()" class="px-4 py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                Tutup (Esc)
            </button>
            <button onclick="window.print()" class="px-5 py-2 text-sm font-bold text-white bg-[#004269] hover:bg-[#003355] rounded-lg shadow-lg flex items-center gap-2 transition-transform hover:scale-105">
                <i class="fas fa-print"></i> Cetak Dokumen
            </button>
        </div>
    </div>

    {{-- KERTAS A4 --}}
    <div id="printWrapper" class="flex justify-center py-24 px-4 min-h-screen">
        <div class="paper-a4 font-poppins text-black">
            
            {{-- KOP SURAT --}}
            <div style="display: flex; align-items: center; gap: 20px; padding-bottom: 10px;">
                <div style="width: 100px; flex-shrink: 0;">
                    <img src="{{ asset('/img/lp3i-kotak.png') }}" style="width: 100%; height: auto; object-fit: contain;">
                </div>
                <div style="flex-grow: 1; text-align: center;">
                    <h1 style="font-size: 20pt; font-weight: 800; color: #004269; margin: 0; line-height: 1;">LP3I COLLEGE KARAWANG</h1>
                    <p style="font-size: 9pt; margin: 6px 0 0 0; line-height: 1.4; font-weight: 400;">
                        Gedung Karawang Hijau, Jl. Tarumanegara No. 4-6, Desa Purwadana,<br>
                        Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361<br>
                        Telp (0267) 411286
                    </p>
                </div>
                <div style="width: 100px;"></div> 
            </div>
            
            <div class="garis-kop"></div>
            <div class="garis-tipis"></div>

            {{-- JUDUL --}}
            <div style="font-size: 14pt; font-weight: 700; text-decoration: underline; text-transform: uppercase; text-align: center; margin-bottom: 5px;" class="tegak">KARTU HASIL STUDI (KHS)</div>
            <div style="font-size: 11pt; font-weight: 600; text-align: center; margin-bottom: 20px; text-transform: uppercase;" class="tegak">TAHUN AKADEMIK 2025/2026</div>

            {{-- BIODATA (FIXED: CONSISTENT SPACING) --}}
            <table class="table-biodata">
                <tr>
                    <td class="col-label">NIPD</td>
                    <td class="col-separator">:</td>
                    <td class="col-value">{{ auth()->user()->mahasiswa->nipd }}</td>
                </tr>
                <tr>
                    <td class="col-label">NAMA LENGKAP</td>
                    <td class="col-separator">:</td>
                    <td class="col-value">{{ ucfirst(auth()->user()->mahasiswa->nama) }}</td>
                </tr>
                <tr>
                    <td class="col-label">TEMPAT/TGL LAHIR</td>
                    <td class="col-separator">:</td>
                    <td class="col-value">{{ auth()->user()->mahasiswa->tempat_lahir }} / {{ \Carbon\Carbon::parse(auth()->user()->mahasiswa->tgl_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="col-label">BIDANG KEAHLIAN</td>
                    <td class="col-separator">:</td>
                    <td class="col-value">{{ ucfirst(auth()->user()->mahasiswa->bidangKeahlian->nama_bidang_keahlian) }}</td>
                </tr>
            </table>

            {{-- TABEL NILAI --}}
            <table class="table-surat">
                <thead>
                    <tr>
                        <th style="width: 40px;">NO</th>
                        <th style="text-align: left; padding-left: 10px;">MATA KULIAH</th>
                        <th style="width: 50px;">SKS</th>
                        <th style="width: 60px;">ANGKA</th>
                        <th style="width: 60px;">HURUF</th>
                        <th style="width: 80px;">MUTU</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" style="padding: 6px 10px; font-weight: 700; background-color: #f9f9f9; text-transform: uppercase; font-size: 9pt;" class="tegak">
                            Semester {{ request('semester', '1') }}
                        </td>
                    </tr>

                    @php 
                        $no = 1; $totalSks = 0; $totalMutu = 0; 
                    @endphp
                    
                    @foreach ($nilai as $item)
                    @php
                        $sks = $item->materiAjar->sks;
                        $huruf = ucfirst($item->grade);
                        $angka = match($huruf) {
                            'A' => 4.0, 'A-' => 3.7, 'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7,
                            'C+' => 2.3, 'C' => 2.0, 'D' => 1.0, default => 0
                        };
                        $mutu = $sks * $angka;
                        $totalSks += $sks; $totalMutu += $mutu;
                    @endphp
                    <tr>
                        <td style="text-align: center;">{{ $no++ }}</td>
                        <td style="padding-left: 10px;">
                            <div style="font-weight: 600; font-size: 9pt;">{{ $item->materiAjar->nama_mk }}</div>
                        </td>
                        <td style="text-align: center;">{{ $sks }}</td>
                        <td style="text-align: center;">{{ number_format($angka, 1) }}</td>
                        <td style="text-align: center; font-weight: 700;">{{ $huruf }}</td>
                        <td style="text-align: center;">{{ number_format($mutu, 1) }}</td>
                    </tr>
                    @endforeach

                    <tr style="background-color: #f5f5f5; font-weight: 700;">
                        <td colspan="2" style="text-align: right; padding-right: 15px;">TOTAL</td>
                        <td style="text-align: center;">{{ $totalSks }}</td>
                        <td colspan="2" style="background-color: #e9ecef; border-bottom: 1px solid #000;"></td>
                        <td style="text-align: center;">{{ number_format($totalMutu, 1) }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- SUMMARY IPS --}}
            <div style="margin-top: 20px; border: 1px solid #000; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; background-color: #fff;">
                <div style="font-size: 10pt;">
                    <strong>IPS (Indeks Prestasi Semester) :</strong> 
                    <span style="font-size: 12pt; font-weight: 800; margin-left: 8px;">
                        {{ $totalSks > 0 ? number_format($totalMutu / $totalSks, 2) : '0.00' }}
                    </span>
                </div>
                <div style="font-size: 10pt;">
                    <strong>Predikat :</strong> 
                    <span style="font-weight: 600; margin-left: 5px;">
                        Sangat Memuaskan
                    </span>
                </div>
            </div>

            {{-- TANDA TANGAN --}}
            <div style="margin-top: 40px; display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
                <div style="text-align: center;">
                    <p style="margin-bottom: 60px;">Karawang, {{ now()->translatedFormat('d F Y') }}</p>
                    <p style="font-weight: 700; text-decoration: underline; font-size: 10pt;">Eko Marmanto P.U, S.Kom.,M.Kom.,MOS. CDMP</p>
                    <p style="font-size: 9pt;">Head of Education</p>
                </div>
                <div style="text-align: center;"></div> 
            </div>

        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('khsModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        document.getElementById('khsModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    document.addEventListener('keydown', function(e) { if(e.key === "Escape") closeModal(); });
</script>

@endsection