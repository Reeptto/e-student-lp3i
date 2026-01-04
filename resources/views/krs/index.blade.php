@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
    /* === GLOBAL VARIABLES === */
    :root {
        --c-blue: #004269;
        --c-teal: #009da5;
        --c-coral: #f15b67;
        --c-bg: #f0f0f0;
        --black: #1a1a1a;
    }

    body { font-family: 'Poppins', sans-serif; background-color: var(--c-bg); overflow-x: hidden; }

    /* === Z-INDEX FIX === */
    #detailModal { z-index: 99999 !important; }
    .modal-backdrop { z-index: 99998 !important; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(4px); }

    /* === DASHBOARD STYLE === */
    .comic-wrapper {
        min-height: 100vh;
        /* Background Utama: Titik Halus */
        background-image: radial-gradient(#ccc 1.5px, transparent 1.5px);
        background-size: 20px 20px;
        background-color: #f8f9fa;
        padding: 20px 15px;
        border-top: 5px solid var(--black);
    }
    @media (min-width: 768px) { .comic-wrapper { padding: 40px; } }

    .comic-header {
        background: #ffffff; border: 4px solid var(--black); padding: 1.5rem; margin-bottom: 3rem;
        box-shadow: 8px 8px 0px var(--black); /* Shadow lebih tebal */
        display: flex; flex-direction: column; gap: 20px; position: relative;
    }
    @media (min-width: 768px) { .comic-header { flex-direction: row; align-items: flex-end; justify-content: space-between; padding: 2.5rem; box-shadow: 12px 12px 0px var(--black); } }

    /* === CARD STYLE (UPDATED: NOT TOO PLAIN) === */
    .card-pop {
        position: relative; 
        background-color: white;
        /* TEKSTUR DOT (Biar tidak polos) */
        background-image: radial-gradient(#e5e7eb 1px, transparent 1px);
        background-size: 10px 10px;
        
        border: 3px solid var(--black); 
        border-radius: 12px; 
        min-height: 260px; 
        display: flex; flex-direction: column; justify-content: space-between; 
        padding: 1.5rem; 
        transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        box-shadow: 5px 5px 0px var(--black); 
        overflow: hidden;
    }
    
    /* Dekorasi Garis Atas (Ala Folder) */
    .card-pop::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 6px;
        background: var(--black);
        z-index: 1;
    }
    
    @media (min-width: 768px) { 
        .card-pop { border-width: 4px; box-shadow: 6px 6px 0px var(--black); height: 300px; padding: 1.8rem; } 
        .card-pop:hover { transform: translate(-4px, -4px); box-shadow: 12px 12px 0px var(--c-coral); border-color: var(--black); } 
    }
    
    .card-pop.active { background-color: white; }
    
    /* Locked state lebih gelap biar kontras */
    .card-pop.locked { 
        background-color: #f3f4f6; 
        background-image: repeating-linear-gradient(45deg, #e5e7eb 0, #e5e7eb 1px, transparent 0, transparent 50%);
        background-size: 10px 10px;
        opacity: 0.9; cursor: not-allowed; 
    }
    
    /* Angka Background Animasi */
    .bg-number { 
        position: absolute; bottom: -25px; right: -15px; font-size: 130px; font-weight: 900; line-height: 1; 
        color: var(--black); opacity: 0.03; pointer-events: none;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); transform-origin: bottom right;
    }
    @media (min-width: 768px) { .bg-number { font-size: 200px; } }
    .card-pop:hover .bg-number { transform: scale(1.1) rotate(-10deg); opacity: 0.1; color: var(--c-teal); }

    .pill-sks { 
        display: inline-block; background: var(--black); color: white; font-weight: 800; font-size: 0.85rem; 
        padding: 6px 16px; border-radius: 4px; /* Ganti jadi kotak rounded dikit biar lebih formal */
        box-shadow: 4px 4px 0px rgba(0,0,0,0.2);
    }

    .btn-card-action { 
        width: 100%; background: white; color: var(--black); font-weight: 800; text-transform: uppercase; 
        padding: 12px; border: 3px solid var(--black); border-radius: 8px; text-align: center; 
        box-shadow: 4px 4px 0px var(--black); font-size: 0.9rem; transition: 0.2s; position: relative; z-index: 10;
    }
    .card-pop:hover .btn-card-action { background: var(--c-teal); color: white; box-shadow: 2px 2px 0px var(--black); transform: translate(2px, 2px); }

    /* Decorative Circle */
    .decor-circle {
        width: 15px; height: 15px; background: var(--c-coral); border: 2px solid var(--black); border-radius: 50%;
    }

    /* === FORMAL SHEET STYLE === */
    .document-scroll-wrapper { width: 100%; overflow-x: auto; padding: 10px; background: #525659; border: 2px solid var(--black); }
    .formal-sheet { background: white; width: 100%; min-width: 700px; max-width: 800px; margin: 0 auto; padding: 30px 40px; font-family: 'Times New Roman', Times, serif; color: #000; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
    .kop-container { display: flex; align-items: center; border-bottom: 4px double #000; padding-bottom: 15px; margin-bottom: 20px; }
    .kop-logo { width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; margin-right: 20px; font-weight: bold; }
    .kop-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Gambar pas di dalam kotak tanpa terpotong */
    }
    .kop-text { flex: 1; text-align: center; }
    .kop-text h1 { font-size: 16pt; font-weight: bold; margin: 0; text-transform: uppercase; line-height: 1.2; }
    .table-formal { width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 10pt; }
    .table-formal th { border: 1px solid #000; padding: 8px; background-color: #eee; text-align: center; font-weight: bold; }
    .table-formal td { border: 1px solid #000; padding: 6px; }
</style>

<div class="comic-wrapper">
    <div class="max-w-7xl mx-auto">
        <header class="comic-header">
            <div class="absolute -top-3 -left-3 bg-[#ff0000] text-white border-2 border-black px-3 py-1 font-black transform -rotate-2 text-xs md:text-sm shadow-[3px_3px_0px_#000]">
                Antarmuka KRS
            </div>
            <div class="w-full">
                <h3 class="text-4xl md:text-7xl font-black uppercase italic tracking-tighter text-black" style="-webkit-text-stroke: 1px black;">
                    KARTU <span class="text-[#009da5]">RENCANA</span> STUDI
                </h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="bg-black text-white border-2 border-black px-3 py-1 text-xs md:text-sm font-bold uppercase">{{ $mahasiswa->nama_mhs }}</span>
                    <span class="bg-white text-black border-2 border-black px-3 py-1 text-xs md:text-sm font-bold uppercase">{{ $mahasiswa->program_studi }}</span>
                </div>
            </div>
            <div class="mt-4 md:mt-0 self-start md:self-end">
                <div class="bg-[#f15b67] border-4 border-black p-3 md:p-4 shadow-[4px_4px_0px_#000] text-white transform rotate-1 md:rotate-2">
                    <span class="block text-[10px] md:text-xs font-black uppercase text-black">Total:</span>
                    @php $grandTotalSks = 0; foreach($krsBySemester as $list) { $grandTotalSks += $list->sum('sks'); } @endphp
                    <span class="text-4xl md:text-6xl font-black italic leading-none" style="text-shadow: 2px 2px 0px #000;">{{ $grandTotalSks }}</span>
                    <span class="text-sm font-bold text-black">SKS</span>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 pb-10">
            @foreach([1,2,3,4,5,6] as $semester)
                @php
                    $hasData = isset($krsBySemester[$semester]) && count($krsBySemester[$semester]) > 0;
                    $totalSksSemester = $hasData ? $krsBySemester[$semester]->sum('sks') : 0;
                    // Logika warna garis atas beda-beda tiap semester biar fun
                    $borderColors = ['#009da5', '#f15b67', '#004269', '#ff9900', '#8b5cf6', '#10b981'];
                    $topColor = $borderColors[($semester - 1) % 6];
                @endphp

                @if($hasData)
                    <div onclick="openDetail({{ $semester }})" class="card-pop active group cursor-pointer hover:z-10">
                        <div class="absolute top-0 left-0 right-0 h-2 z-20" style="background: {{ $topColor }}; border-bottom: 2px solid #1a1a1a;"></div>
                        
                        <span class="bg-number">{{ $semester }}</span>
                        
                        <div class="relative z-10 flex flex-col h-full pt-4">
                            <div class="flex justify-between items-center">
                                <span class="pill-sks">SEMESTER {{ $semester }}</span>
                                <div class="decor-circle" style="background: {{ $topColor }}"></div>
                            </div>
                            
                            <div class="mt-8 mb-4">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Total Pengambilan</p>
                                <h2 class="text-5xl font-black text-black leading-none">
                                    {{ $totalSksSemester }}<span class="text-lg text-gray-400">sks</span>
                                </h2>
                                <div class="mt-3 inline-block bg-[#dcfce7] border-2 border-[#166534] px-2 py-1 rounded">
                                    <p class="text-[10px] font-black text-[#166534] uppercase tracking-wide">STATUS: AKTIF</p>
                                </div>
                            </div>
                            
                            <div class="mt-auto">
                                <button class="btn-card-action">LIHAT DETAIL</button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-pop locked flex flex-col items-center justify-center text-center">
                        <div class="absolute top-0 left-0 right-0 h-2 bg-gray-300 border-bottom: 2px solid #1a1a1a;"></div>
                        <span class="bg-number">{{ $semester }}</span>
                        <div class="relative z-10 opacity-50">
                            <div class="w-16 h-16 bg-white border-3 border-gray-400 rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <h3 class="text-xl font-black text-gray-500 uppercase">Semester {{ $semester }}</h3>
                            <p class="text-xs font-bold text-gray-400 uppercase mt-1">Belum Tersedia</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<div id="detailModal" class="hidden fixed inset-0 flex items-start justify-center pt-4 sm:pt-10 pb-4 px-2 sm:px-4">
    <div class="fixed inset-0 modal-backdrop" onclick="closeModal()"></div>
    <div class="relative w-full max-w-4xl bg-white border-4 border-black shadow-[8px_8px_0px_#f15b67] flex flex-col max-h-[90vh]" style="z-index: 100000;">
        <div class="flex justify-between items-center p-3 border-b-2 border-black bg-gray-50 z-20">
            <h3 class="font-bold text-sm md:text-lg uppercase flex items-center gap-2">
                <span class="bg-black text-white px-2 rounded">PREVIEW</span> DOKUMEN CETAK
            </h3>
            <button onclick="closeModal()" class="text-red-600 font-black hover:bg-red-100 px-3 py-1 rounded transition">CLOSE [X]</button>
        </div>

        <style>
            .formal-sheet {
                font-family: "Times New Roman", Times, serif;
                color: #000;
                
                width: 100%;
                max-width: 210mm; 
                margin: 0 auto;  
                padding: 10mm 20mm;
                box-sizing: border-box;
                background-color: white;
            }

            .kop-header {
                display: flex;
                align-items: center;
                justify-content: center;
                border-bottom: 4px double #000;
                padding-bottom: 15px;
                margin-bottom: 25px;
                position: relative;
            }

            .kop-logo {
                flex: 0 0 100px;
                text-align: left;
            }

            .kop-text {
                flex: 1;
                text-align: center;
                padding-right: 100px; /
            }

            @media (max-width: 640px) {
                .formal-sheet { padding: 10px; }
                .kop-text { padding-right: 0; }
                .kop-logo img { width: 60px !important; }
            }

            .kop-text h1 {
                font-size: 18pt;
                font-weight: 900;
                margin: 0;
                text-transform: uppercase;
                line-height: 1.2;
                letter-spacing: 1px;
            }

            .kop-text p {
                font-size: 10pt;
                margin: 2px 0;
                line-height: 1.3;
            }

            /* TABLE */
            .table-formal {
                width: 100%;
                border-collapse: collapse;
                margin-top: 15px;
                font-size: 10pt;
            }

            .table-formal th, .table-formal td {
                border: 1px solid #000;
                padding: 8px 10px; 
            }

            .table-formal th {
                background-color: #f0f0f0;
                font-weight: bold;
                text-align: center;
            }

           
            .signature-container {
                margin-top: 50px; 
                display: flex;
                justify-content: space-between;
                padding: 0 10px;
            }

          
            @media print {
                @page {
                    size: A4;
                    margin: 2cm;
                }
                body {
                    background: none;
                    -webkit-print-color-adjust: exact;
                }
                .formal-sheet {
                    padding: 0; 
                    max-width: none;
                    width: 100%;
                    margin: 0;
                }
                nav, header, footer, button {
                    display: none !important;
                }
            }
        </style>

        <div class="document-scroll-wrapper flex-1">
            <div id="printableArea" class="formal-sheet">
                
                <div class="kop-header">
                    <div class="kop-logo">
                        <img src="{{ asset('/img/lp3i-kotak.png') }}" style="width: 80px; height: auto; display: block;">
                    </div>
                    <div class="kop-text">
                        <h1>LP3I COLLEGE KARAWANG</h1>
                        <p>Jalan Tarumanegara Blok B No.4-6, Kelurahan Purwadana,<br>Kecamatan Teluk Jambe Timur, Kabupaten Karawang.</p>
                        <p>Email: education.karawang@lp3i.id</p>
                    </div>
                </div>

                <div class="text-center mb-6">
                    <h3 style="font-size: 14pt; font-weight: bold; text-decoration: underline; margin-bottom: 5px;">KARTU RENCANA STUDI (KRS)</h3>
                    <p style="font-size: 11pt;">Tahun Akademik {{ date('Y') }}/{{ date('Y')+1 }}</p>
                </div>

                <table style="width: 100%; font-size: 11pt; margin-bottom: 20px;">
                    <tr>
                        <td width="15%"><strong>Nama</strong></td>
                        <td width="2%">:</td>
                        <td width="33%">{{ $mahasiswa->nama_mhs }}</td>
                        
                        <td width="15%"><strong>Semester</strong></td>
                        <td width="2%">:</td>
                        <td id="formalSemester"></td>
                    </tr>
                    <tr>
                        <td><strong>NIPD</strong></td>
                        <td>:</td>
                        <td>{{ $mahasiswa->nipd }}</td>
                        
                        <td><strong>Bidang Keahlian</strong></td>
                        <td>:</td>
                        <td>{{ $mahasiswa->program_studi }}</td>
                    </tr>
                </table>

                <table class="table-formal">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th style="text-align: left;">MATA KULIAH</th>
                            <th style="text-align: left;">DOSEN</th>
                            <th width="10%">SKS</th>
                        </tr>
                    </thead>
                    <tbody id="courseTableBody">
                        </tbody>
                </table>

                <div class="signature-container">
                    <div class="text-center" style="width: 250px;">
                        <p style="font-size: 11pt;">Mahasiswa Ybs,</p>
                        <div style="height: 80px;"></div>
                        <p style="font-weight: bold; text-decoration: underline; font-size: 11pt; text-transform: uppercase;">{{ $mahasiswa->nama_mhs }}</p>
                        <p style="font-size: 11pt;">NIPD. {{ $mahasiswa->nipd }}</p>
                    </div>

                    <div class="text-center" style="width: 250px;">
                        <p style="font-size: 11pt;">Karawang, {{ date('d F Y') }}</p>
                        <p style="font-size: 11pt;">Bagian Akademik,</p>
                        <div style="height: 80px;"></div>
                        <p style="font-weight: bold; text-decoration: underline; font-size: 11pt;">( Administrator )</p>
                        <p style="font-size: 11pt;">NIDN. -</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 border-t-2 border-black bg-gray-50 flex justify-end">
            <button onclick="downloadPDF()" class="bg-[#009da5] text-white px-4 py-2 border-2 border-black font-bold text-sm hover:bg-[#004269] shadow-[3px_3px_0px_#000]">UNDUH PDF (RESMI)</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById('detailModal');
        // Pindahkan modal ke elemen body agar tidak tertutup sidebar/navbar
        if (modal) {
            document.body.appendChild(modal);
        }
    });

    const semesterData = {
        @foreach($krsBySemester as $semId => $krsList)
            {{ $semId }}: {
                courses: [
                    @foreach($krsList as $krs)
                    { name: "{{ $krs->mataKuliah->nama_mk }}", dosen: "{{ $krs->dosen->nama_dsn ?? '-' }}", sks: {{ $krs->sks }} },
                    @endforeach
                ]
            },
        @endforeach
    };
    function toRoman(num) { const r = {1:'I',2:'II',3:'III',4:'IV',5:'V',6:'VI'}; return r[num] || num; }
    function openDetail(semId) {
        const modal = document.getElementById('detailModal');
        const tableBody = document.getElementById('courseTableBody');
        const semText = document.getElementById('formalSemester');
        const data = semesterData[semId];
        if(data) {
            semText.innerText = toRoman(semId);
            tableBody.innerHTML = '';
            let totalSks = 0;
            data.courses.forEach((c, i) => {
                totalSks += c.sks;
                tableBody.innerHTML += `<tr><td align="center">${i+1}</td><td>${c.name}</td><td>${c.dosen}</td><td align="center">${c.sks}</td></tr>`;
            });
            tableBody.innerHTML += `<tr><td colspan="3" align="right" style="padding-right:10px;"><strong>TOTAL SKS</strong></td><td align="center"><strong>${totalSks}</strong></td></tr>`;
            modal.classList.remove('hidden');
        }
    }
    function closeModal() { document.getElementById('detailModal').classList.add('hidden'); }
   function downloadPDF() {
        // 1. Ambil elemen asli
        const element = document.getElementById('printableArea');

        // 2. Clone (duplikat) elemen tersebut
        const clone = element.cloneNode(true);

        // 3. Buat container sementara agar style clone tidak terpengaruh CSS modal
        const container = document.createElement('div');
        
        // Style container agar tersembunyi tapi tetap dianggap "renderable" oleh browser
        // Kita taruh di luar layar (off-screen)
        container.style.position = 'fixed';
        container.style.top = '-9999px';
        container.style.left = '0';
        container.style.zIndex = '-1';
        container.style.width = '100%'; // Biarkan lebar penuh atau sesuaikan (misal 800px)
        
        // Hapus class pembatas dari clone jika ada (opsional, tapi aman dilakukan)
        clone.style.margin = '0 auto';
        clone.style.width = '800px'; // Paksa lebar agar pas A4
        clone.style.maxWidth = 'none';
        
        // Masukkan clone ke container, dan container ke body
        container.appendChild(clone);
        document.body.appendChild(container);

        // 4. Konfigurasi html2pdf
        var opt = {
            margin:       [10, 10, 10, 10], // Atas, Kiri, Bawah, Kanan (mm)
            filename:     'KRS_{{ $mahasiswa->nipd }}.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { 
                scale: 2, 
                scrollY: 0, // Penting: Reset posisi scroll ke 0
                useCORS: true // Penting jika ada gambar dari url eksternal
            },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // 5. Generate PDF dari CLONE (bukan elemen asli di modal)
        html2pdf().set(opt).from(clone).save().then(function(){
            // 6. Hapus container setelah download selesai agar tidak memberatkan DOM
            document.body.removeChild(container);
        });
    }
</script>
@endsection