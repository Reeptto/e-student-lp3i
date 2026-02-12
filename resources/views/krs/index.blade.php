@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    {{-- JUDUL HALAMAN (Tidak dicetak) --}}
    <h1 class="text-2xl font-bold mb-6 text-gray-800 no-print">Kartu Rencana Studi</h1>

    {{-- CARD SEMESTER --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 no-print">
        @foreach ($semesters as $s)
            <div onclick="openKrs({{ $s['semester'] }})" class="group cursor-pointer bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-lg hover:border-blue-400 hover:-translate-y-1 transition-all duration-300">
                
                <div class="flex justify-between items-start mb-2">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Semester</p>
                    <div class="bg-gray-50 text-gray-400 rounded-full p-1 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>

                <p class="text-4xl font-extrabold text-gray-800 mb-4 group-hover:text-blue-600 transition-colors">
                    {{ $s['semester'] }}
                </p>

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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
    
    .font-poppins { font-family: 'Poppins', sans-serif !important; }

    .paper-preview {
        width: 210mm;
        min-height: 297mm;
        background: white;
        margin: 0 auto;
        padding: 10mm 15mm; 
        position: relative;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15); 
    }

    @media print {
        @page { size: A4; margin: 0; }
        
        /* Reset Body */
        body, html { width: 100%; height: 100%; margin: 0; padding: 0; background: white !important; }
        
        .no-print, header, nav, footer, .sidebar, .print-toolbar { display: none !important; }
        
        #krsModal { 
            position: absolute !important; 
            inset: 0 !important; 
            background: white !important; 
            display: block !important; 
            z-index: 9999; 
            overflow: visible !important;
        }

        #printWrapper {
            display: block !important; 
            padding: 0 !important; 
            margin: 0 !important;
            height: auto !important;
            min-height: 0 !important;
        }
        
        #printArea { 
            width: 100% !important; 
            height: auto !important; 
            min-height: 0 !important;
            margin: 0 !important; 
            padding: 10mm 15mm !important;
            box-shadow: none !important; 
            border: none !important; 
        }

        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
    
    .border-double-bottom { border-bottom: 4px double #000; }
</style>

{{-- MODAL --}}
<div id="krsModal" class="fixed inset-0 bg-gray-900/80 hidden z-[9999] overflow-y-auto backdrop-blur-sm transition-opacity">
    
    {{-- TOOLBAR ERGONOMIS --}}
    <div class="print-toolbar fixed top-0 left-0 right-0 bg-white shadow-md z-[10000] px-4 py-3 flex justify-between items-center border-b border-gray-200">
        <div class="flex items-center gap-2">
            <span class="bg-blue-100 text-blue-700 p-1.5 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </span>
            <div>
                <h3 class="font-bold text-gray-800 text-sm leading-tight">Preview Dokumen</h3>
                <p class="text-xs text-gray-500" id="toolbarSemesterInfo">Memuat...</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900 px-4 py-2 text-sm font-medium hover:bg-gray-100 rounded-lg transition-colors">Tutup (Esc)</button>
            <button id="btnCetak" onclick="window.print()" class="hidden bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold shadow-sm items-center gap-2 transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak KRS
            </button>
        </div>
    </div>

    {{-- WRAPPER --}}
    <div id="printWrapper" class="min-h-screen flex justify-center py-24 px-4"> 
        {{-- KERTAS (Tambahkan relative & overflow-hidden) --}}
        <div id="printArea" class="paper-preview font-poppins text-black bg-white rounded-sm relative overflow-hidden">
            
            {{-- === GAMBAR BACKGROUND (WATERMARK) === --}}
            {{-- Posisi absolute agar di belakang, opacity agar transparan --}}
            <div class="absolute inset-0 flex items-center justify-center z-0 pointer-events-none">
                {{-- PERUBAHAN DISINI: w-[70%] diubah menjadi w-full dan ditambah p-4 --}}
                <img src="{{ asset('/img/lp3i-putih.png') }}" class="w-[70%] h-auto object-contain opacity-15  p-4">
            </div>

            {{-- === KONTEN SURAT (WRAPPER z-10) === --}}
            <div class="relative z-10">
                
                {{-- KOP SURAT --}}
                <div class="flex items-center gap-4 pb-2 mb-2 border-double-bottom">
                    <div class="w-[110px] flex-shrink-0">
                         <img src="{{ asset('/img/lp3i-putih.png') }}" class="w-full h-auto object-contain">
                    </div>
                    <div class="flex-1 text-center">
                        <h1 class="text-3xl font-extrabold text-[#004269] tracking-wide mb-1 leading-none">LP3I COLLEGE KARAWANG</h1>
                        <p class="text-[11px] text-black leading-tight font-medium">
                            Gedung Karawang Hijau, Jl. Tarumanegara No. 4-6, Desa Purwadana,<br>
                            Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361<br>
                            Telp (0267) 411286
                        </p>
                    </div>
                </div>

                {{-- JUDUL --}}
                <div class="text-center mb-6 mt-6">
                    <h2 class="text-lg font-bold underline underline-offset-4 uppercase">KARTU RENCANA STUDI (KRS)</h2>
                    <p class="text-[12px] font-bold mt-1 uppercase">TAHUN AKADEMIK 2024/2025</p>
                </div>

                {{-- BIODATA --}}
                <div class="mb-4 px-1">
                    <table class="w-full text-[13px] leading-snug font-medium">
                        <tr><td class="w-[160px] py-1">NIPD</td><td class="w-[10px] py-1">:</td><td class="py-1 font-semibold">{{ $mahasiswa->nipd }}</td></tr>
                        <tr><td class="py-1">Nama Lengkap</td><td class="py-1">:</td><td class="py-1 font-semibold">{{ ucfirst($mahasiswa->nama_mhs) }}</td></tr>
                        <tr><td class="py-1">Semester</td><td class="py-1">:</td><td><span id="semesterText"></span></td></tr>
                        <tr><td class="py-1">Bidang Keahlian</td><td class="py-1">:</td><td>{{ ucfirst($mahasiswa->bidangKeahlian->nama_program_studi ?? '-') }}</td></tr>
                    </table>
                </div>

                {{-- TABEL --}}
                <div class="w-full mb-2">
                    <table class="w-full border-collapse border border-black text-[12px] bg-transparent">
                        <thead>
                            <tr class="bg-gray-200/80 text-black">
                                <th class="border border-black py-2 w-12 text-center">NO</th>
                                <th class="border border-black py-2 w-32 text-center">Kode</th>
                                <th class="border border-black py-2 px-4 text-left">Materi Ajar</th>
                                <th class="border border-black py-2 w-16 text-center">SKS</th>
                            </tr>
                        </thead>
                        <tbody id="krsBody"></tbody>
                        <tfoot>
                            <tr class="font-bold bg-gray-100/80">
                                <td colspan="3" class="border border-black py-2 px-4 text-right uppercase text-[11px]">Total Kredit Semester</td>
                                <td class="border border-black py-2 text-center" id="totalSks">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-[11px] italic text-gray-600 mb-8 mt-2 px-1">
                    * Jadwal waktu dan tempat perkuliahan dapat dilihat pada Sistem Informasi Akademik (E-Student).
                </div>

                {{-- TANDA TANGAN --}}
                <div class="grid grid-cols-2 gap-10 text-[12px] mt-4 px-4">
                    <div class="text-left">
                        <p class="mb-1">Menyetujui,</p>
                        <p class="mb-20 font-medium">Pembimbing Akademik (PA)</p>
                        <p class="font-bold border-b border-black inline-block min-w-[200px]">Eko Marmanto P.U, M.Kom.,MOS.</p>
                    </div>
                    <div class="text-left ml-auto w-full max-w-[250px]">
                        <p class="mb-1">Karawang, {{ now()->translatedFormat('d F Y') }}</p>
                        <p class="mb-20 font-medium">Mahasiswa yang bersangkutan,</p>
                        <p class="font-bold border-b border-black inline-block min-w-[200px]"></p>
                        <p class="mt-1"><b>{{ ucfirst($mahasiswa->nama_mhs) }}</b></p>
                    </div>
                </div>

            </div> {{-- END RELATIVE Z-10 --}}
        </div>
    </div>
</div>

<script>
function openKrs(semester) {
    const krsBody = document.getElementById('krsBody');
    const btnCetak = document.getElementById('btnCetak');
    const toolbarInfo = document.getElementById('toolbarSemesterInfo');
    
    krsBody.innerHTML = '<tr><td colspan="4" class="text-center py-8 text-gray-500 italic">Sedang memuat data...</td></tr>';
    btnCetak.classList.add('hidden');
    btnCetak.classList.remove('flex');
    
    const modal = document.getElementById('krsModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';

    fetch(`/krs/${semester}`)
        .then(res => res.ok ? res.json() : Promise.reject(res))
        // ... kode fetch sebelumnya ...
.then(res => {
    const jenisSem = semester % 2 !== 0 ? 'GANJIL' : 'GENAP';
    const labelSemester = `${jenisSem} ( ${semester} )`;
    document.getElementById('semesterText').innerText = labelSemester; 
    toolbarInfo.innerText = `Semester ${labelSemester}`;

    let body = '';
    let totalSksDihitung = 0; // 1. Inisialisasi variabel penghitung

            if(res.data && res.data.length > 0) {
                res.data.forEach((item, i) => {
                    let kode = item.materi_ajar?.kode_mk ?? 'MK-00' + (i+1); 
                    let namaMk = item.materi_ajar?.nama_mk ?? 'MATA KULIAH TIDAK DITEMUKAN';
                    let sks = parseInt(item.materi_ajar?.sks ?? 0); // 2. Pastikan jadi angka
                    
                    totalSksDihitung += sks; // 3. Tambahkan ke total

                    body += `<tr class="border-b border-black last:border-0">
                                <td class="border-r border-black px-2 py-1.5 text-center align-middle">${i+1}</td>
                                <td class="border-r border-black px-2 py-1.5 text-center align-middle font-medium">${kode}</td>
                                <td class="border-r border-black px-3 py-1.5 align-middle uppercase">${namaMk}</td>
                                <td class="px-2 py-1.5 text-center font-bold align-middle">${sks}</td>
                            </tr>`;
                });

                krsBody.innerHTML = body;
                
                // 4. Masukkan hasil hitungan ke elemen HTML
                document.getElementById('totalSks').innerText = totalSksDihitung;

                btnCetak.classList.remove('hidden');
                btnCetak.classList.add('flex');
            } else {
                krsBody.innerHTML = `<tr><td colspan="4" class="text-center py-8 border border-black italic text-red-500">Data Mata Kuliah Belum Tersedia.</td></tr>`;
                document.getElementById('totalSks').innerText = '0'; // Reset jika kosong
                toolbarInfo.innerText = `Data Kosong`;
            }
        })
        .catch(err => { 
            console.error(err); 
            krsBody.innerHTML = `<tr><td colspan="4" class="text-center py-8 border border-black text-red-600 font-bold">Gagal mengambil data.</td></tr>`;
        });
}

function closeModal() {
    document.getElementById('krsModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(event) {
    if (event.key === "Escape") closeModal();
});
</script>
@endsection