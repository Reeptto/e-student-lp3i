@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- JUDUL HALAMAN (Tidak dicetak) --}}
    <h1 class="text-2xl font-bold mb-6 text-gray-800 no-print">Kartu Rencana Studi</h1>

    {{-- CARD SEMESTER (Tampilan Simple & Modern) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 no-print">
        @foreach ($semesters as $s)
            <div onclick="openKrs({{ $s['semester'] }})"
                 class="group cursor-pointer bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-lg hover:border-blue-400 hover:-translate-y-1 transition-all duration-300">
                
                {{-- Header Card --}}
                <div class="flex justify-between items-start mb-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Semester</p>
                    {{-- Icon Panah Kecil --}}
                    <div class="bg-gray-50 text-gray-400 rounded-full p-1 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                {{-- Angka Semester --}}
                <p class="text-4xl font-extrabold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">
                    {{ $s['semester'] }}
                </p>

                {{-- Footer Card (SKS) --}}
                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-sm text-gray-500 font-medium">Total SKS Diambil</span>
                    <span class="text-lg font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded-md group-hover:bg-blue-50 group-hover:text-blue-700 transition-colors">
                        {{ $s['total_sks'] }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    .font-poppins { font-family: 'Poppins', sans-serif; }

    .paper-preview {
        width: 210mm;
        min-height: 297mm;
        background: white;
        margin: 0 auto;
        padding: 15mm;
        box-shadow: 0 0 15px rgba(0,0,0,0.1); 
    }

    @media print {
        @page { 
            size: A4; 
            margin: 10mm 15mm; 
        }
        
        body { 
            visibility: hidden; 
            background: white !important;
            -webkit-print-color-adjust: exact;
        }
        
        .no-print { display: none !important; }
        
        #krsModal {
            position: static;
            background: none !important;
            display: block !important;
            width: 100%;
            height: auto;
            overflow: visible;
            z-index: auto;
        }

        #printArea {
            visibility: visible;
            position: absolute;
            left: 0; top: 0;
            width: 100%;
            margin: 0; padding: 0;
            box-shadow: none !important;
            border: none !important;
        }

        * { color: black !important; }
    }
</style>

{{-- MODAL WRAPPER (Tampilan Dokumen) --}}
<div id="krsModal" class="fixed inset-0 bg-black/70 hidden justify-center overflow-y-auto z-[9999] py-10 backdrop-blur-sm">
    
    {{-- KONTEN DOKUMEN --}}
    <div id="printArea" class="paper-preview font-poppins text-black relative">
        
        {{-- 1. KOP SURAT --}}
        <div class="flex items-start mb-8 gap-4">
            <img src="{{ asset('/img/lp3i-kotak.png') }}" class="w-20 h-auto object-contain">
            <div class="flex-1 pt-1">
                <h1 class="text-xl font-bold tracking-wide leading-none mb-1">LP3I COLLEGE</h1>
                <p class="text-[11px] leading-snug text-gray-800 w-3/4">
                    Cabang Karawang : Jl. Tarumanegara, Komplek Karawang Hijau Blok B. 4-6, Kab. Karawang
                </p>
                <p class="text-[11px] font-bold mt-1">TAHUN AKADEMIK 2025/2026</p>
            </div>
        </div>


        {{-- 3. BIODATA --}}
        <div class="mb-6 pl-1">
            <table class="w-full text-[12px] leading-tight font-medium">
                <tr><td class="w-40 py-0.5">NIPD</td><td class="py-0.5">: {{ $mahasiswa->nipd }}</td></tr>
                <tr><td class="py-0.5">NAMA LENGKAP</td><td class="py-0.5">: {{ strtoupper($mahasiswa->nama) }}</td></tr>
                <tr><td class="py-0.5">SEMESTER</td><td class="py-0.5">: <span id="semesterText"></span></td></tr>
                <tr><td class="py-0.5">BIDANG KEAHLIAN</td><td class="py-0.5">: {{ strtoupper($mahasiswa->bidangKeahlian->nama_bidang_keahlian ?? '-') }}</td></tr>
            </table>
        </div>

        {{-- 4. TABEL --}}
        <table class="w-full border border-black text-[11px] mb-2 border-collapse">
            <thead class="bg-gray-300 font-bold text-center">
                <tr>
                    <th class="border border-black py-1.5 w-10">NO</th>
                    <th class="border border-black py-1.5 w-24">KODE</th>
                    <th class="border border-black py-1.5  px-3">MATERI AJAR</th>
                    <th class="border border-black py-1.5 w-14">BK</th>
                </tr>
            </thead>
            <tbody id="krsBody"></tbody>
            <tfoot class="font-bold bg-gray-100">
                <tr>
                    <td colspan="3" class="border border-black text-right py-1.5 px-3 uppercase text-[10px]">Total Jumlah BK</td>
                    <td class="border border-black text-center py-1.5" id="totalSks"></td>
                </tr>
            </tfoot>
        </table>

        {{-- Note --}}
        <div class="text-[10px] font-bold mt-1 mb-12">
            Note : Waktu dan Tempat lihat jadual di Sistem Informasi Akademik (e-student)
        </div>

        {{-- 5. TTD --}}
        <div class="flex justify-between text-[11px] px-2">
            <div class="text-left w-1/3">
                <p class="mb-16">Pembimbing Akademik (PA)</p>
                <p class="font-bold underline underline-offset-2">Eko Marmanto P.U, M.Kom.,MOS.</p>
            </div>
            <div class="text-left w-1/3 ml-auto pl-6">
                <p class="mb-2">Karawang, {{ now()->translatedFormat('d-F-Y') }}</p>
                <p class="mb-14">PD yang bersangkutan,</p>
                <div class="h-4"></div> 
                <p class="font-bold">{{ $mahasiswa->nama }}</p>
            </div>
        </div>
    </div>

    {{-- TOMBOL AKSI --}}
    <div class="fixed bottom-6 left-1/2 transform -translate-x-1/2 flex gap-4 no-print z-[10000]">
        <button onclick="closeModal()" class="bg-white text-gray-700 border border-gray-300 px-6 py-2 rounded-full shadow-lg text-sm font-semibold hover:bg-gray-50 transition-all">
            Tutup
        </button>
        <button onclick="window.print()" class="bg-gray-900 text-white px-6 py-2 rounded-full shadow-lg text-sm font-semibold hover:bg-black flex items-center gap-2 transition-all hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak KRS
        </button>
    </div>
</div>

<script>
function openKrs(semester) {
    document.getElementById('krsBody').innerHTML = '<tr><td colspan="4" class="text-center py-4">Memuat...</td></tr>';
    const modal = document.getElementById('krsModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    fetch(`/krs/${semester}`)
        .then(res => res.json())
        .then(res => {
            // Logic Text Semester (Ganjil/Genap)
            const jenisSem = semester % 2 !== 0 ? 'Ganjil' : 'Genap';
            document.getElementById('semesterText').innerText = `${jenisSem} ( ${semester} )`; 
            
            document.getElementById('totalSks').innerText = res.total_sks;

            let body = '';
            if(res.data && res.data.length > 0) {
                res.data.forEach((item, i) => {
                    let kode = item.materi_ajar?.kode_mk ?? '23IC030' + (i+1); 
                    body += `
                        <tr>
                            <td class="border border-black px-2 py-1 text-center align-middle">${i+1}</td>
                            <td class="border border-black px-2 py-1 align-middle">${kode}</td>
                            <td class="border border-black px-3 py-1 align-middle">${item.materi_ajar?.nama_mk ?? '-'}</td>
                            <td class="border border-black px-2 py-1 text-center font-bold align-middle">${item.sks}</td>
                        </tr>`;
                });
            } else {
                body = `<tr><td colspan="4" class="text-center py-4 border border-black italic">Data belum tersedia.</td></tr>`;
            }
            document.getElementById('krsBody').innerHTML = body;
        })
        .catch(err => { console.error(err); alert('Gagal mengambil data.'); });
}

function closeModal() {
    const modal = document.getElementById('krsModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>
@endsection