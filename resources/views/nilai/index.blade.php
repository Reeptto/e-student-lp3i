@extends('layouts.app')

@section('content')
{{-- Font & Script PDF --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }

    :root {
        --navy: #004269;
        --teal: #009DA5;
        --red: #f15b67;
    }

    /* Style Original Mecha */
    .mecha-wrapper { position: relative; margin-bottom: 2rem; z-index: 1; --theme-color: #333; }
    .mecha-border { position: relative; border: 3px solid var(--theme-color); background: white; z-index: 10; border-radius: 12px; }
    .mecha-shadow { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: var(--theme-color); opacity: 0.25; z-index: 0; transform: translate(4px, 4px); border-radius: 12px; }
    .mecha-deco-tl { position: absolute; top: -6px; left: -6px; width: 24px; height: 24px; border-top: 4px solid var(--theme-color); border-left: 4px solid var(--theme-color); z-index: 20; border-radius: 4px 0 0 0; }
    .mecha-deco-br { position: absolute; bottom: -6px; right: -6px; width: 24px; height: 24px; border-bottom: 4px solid var(--theme-color); border-right: 4px solid var(--theme-color); z-index: 20; border-radius: 0 0 4px 0; }

    .tech-tabs-container { display: flex; gap: 0.5rem; border-bottom: 3px solid var(--navy); padding-left: 1rem; }
    .tech-tab { position: relative; padding: 12px 24px; font-weight: 800; font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em; border-radius: 12px 12px 0 0; border: 3px solid transparent; border-bottom: none; transition: all 0.3s; overflow: hidden; }
    .tech-tab.active { background: white; color: var(--navy); border-color: var(--navy); margin-bottom: -3px; padding-bottom: 15px; z-index: 10; box-shadow: 0 -5px 15px -5px rgba(0, 157, 165, 0.3); }
    .tech-tab.active::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--teal); }
    .tech-tab.inactive { background: #e5e7eb; color: #6b7280; top: 3px; }
    .tech-tab.inactive:hover { background: #d1d5db; color: var(--navy); top: 1px; }

    .card-item-border { border: 2px solid #e5e7eb; border-radius: 12px; transition: all 0.3s ease; background: linear-gradient(to bottom right, #ffffff, #f8fafc); }
    .card-item-border:hover { border-color: var(--teal); transform: translateY(-3px); box-shadow: 0 10px 20px -5px rgba(0, 157, 165, 0.15); }
    
    .sleek-filter { display: flex; align-items: center; gap: 1rem; background: white; padding: 0.75rem 1rem; border-radius: 50px; border: 2px solid #e5e7eb; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    .sleek-filter:hover { border-color: var(--navy); }
</style>

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8" x-data="{ activeTab: 'komponen' }">

    {{-- HEADER & FILTER --}}
    <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div class="flex-1">
            <h1 class="text-4xl font-black text-[#004269] uppercase italic tracking-wider flex items-center gap-2">
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
        <button @click="activeTab = 'khs'" :class="activeTab === 'khs' ? 'tech-tab active' : 'tech-tab inactive'">
            <i class="fas fa-file-invoice mr-2"></i> Kartu Hasil Studi (KHS)
        </button>
    </div>

    {{-- TAB 1: DETAIL KOMPONEN --}}
    <div x-show="activeTab === 'komponen'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="space-y-4 relative z-10">
        
        @forelse ($nilai as $item)
        <div class="card-item-border overflow-hidden" x-data="{ expanded: false }">
            {{-- Header Card --}}
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
                                $g = strtoupper($item->grade);
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

            {{-- Detail Expand --}}
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


<div x-show="activeTab === 'khs'" 
     style="display: none;"
     class="relative z-10">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <div class="bg-gray-100 p-4 md:p-8 rounded-xl flex justify-center">
        
        <div id="printable-khs" class="bg-white shadow-lg text-black relative" 
             style="width: 100%; max-width: 800px; padding: 40px; font-family: 'Poppins', sans-serif; margin: 0 auto; color: #000;">
            
            <table style="width: 100%; border-bottom: 3px solid black; margin-bottom: 2px;">
                <tr>
                    <td style="width: 15%; vertical-align: top;">
                        <img src="{{ asset('/img/lp3i-kotak.png') }}" style="width: 80px; height: auto;" alt="LP3I">
                    </td>
                    <td style="width: 70%; text-align: center; vertical-align: middle;">
                        <h1 style="font-size: 18pt; font-weight: 700; color: #004269; margin: 0; line-height: 1;">LP3I COLLEGE</h1>
                        <p style="font-size: 9pt; color: #333; margin: 5px 0 0 0; line-height: 1.3; font-weight: 400;">
                            Gedung Karawang Hijau, Jl. Tarumanegara No. 4-6, Desa Purwadana,<br>
                            Kecamatan Telukjambe Timur, Kabupaten Karawang, Jawa Barat 41361<br>
                            Telp (0267) 411286
                        </p>
                    </td>
                    <td style="width: 15%;"></td>
                </tr>
            </table>
            <div style="border-bottom: 1px solid black; margin-bottom: 25px;"></div>

            {{-- 2. JUDUL --}}
            <div style="text-align: center; margin-bottom: 25px;">
                <h2 style="font-size: 14pt; font-weight: 700; text-transform: uppercase; margin: 0;">KARTU HASIL STUDI</h2>
            </div>

            {{-- 3. BIODATA --}}
            <div style="margin-bottom: 20px;">
                <table style="width: 100%; font-size: 10pt; font-weight: 500;">
                    <tr><td style="width: 180px; padding: 3px 0;">Nama</td><td>: {{ strtoupper(auth()->user()->mahasiswa->nama) }}</td></tr>
                    <tr><td style="padding: 3px 0;">NIPD</td><td>: {{ auth()->user()->mahasiswa->nipd }}</td></tr>
                    <tr><td style="padding: 3px 0;">Tempat / Tanggal Lahir</td><td>: {{ auth()->user()->mahasiswa->tempat_lahir }} / {{ \Carbon\Carbon::parse(auth()->user()->mahasiswa->tgl_lahir)->translatedFormat('d F Y') }}</td></tr>
                    <tr><td style="padding: 3px 0;">Bidang Keahlian</td><td>: {{ strtoupper(auth()->user()->mahasiswa->bidangKeahlian->nama_bidang_keahlian) }}</td></tr>
                </table>
            </div>

            {{-- 4. TABEL NILAI --}}
            {{-- Fix: Menambahkan vertical-align: middle dan padding lebih besar agar teks tidak terpotong --}}
            <table style="width: 100%; border-collapse: collapse; font-size: 10pt; margin-bottom: 10px;">
                <thead>
                    <tr style="background-color: #e5e7eb; text-align: center;">
                        <th rowspan="2" style="border: 1px solid #333; padding: 12px 5px; vertical-align: middle;">NO</th>
                        <th rowspan="2" style="border: 1px solid #333; padding: 12px 5px; vertical-align: middle;">MATERI AJAR</th>
                        <th rowspan="2" style="border: 1px solid #333; padding: 12px 5px; vertical-align: middle;">BK</th>
                        <th colspan="2" style="border: 1px solid #333; padding: 8px 5px; vertical-align: middle;">NILAI</th>
                        <th rowspan="2" style="border: 1px solid #333; padding: 12px 5px; vertical-align: middle;">KUMULATIF</th>
                    </tr>
                    <tr style="background-color: #e5e7eb; text-align: center;">
                        <th style="border: 1px solid #333; padding: 8px 5px; vertical-align: middle;">Angka</th>
                        <th style="border: 1px solid #333; padding: 8px 5px; vertical-align: middle;">Huruf</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: #f9fafb;">
                        <td colspan="6" style="border: 1px solid #333; padding: 8px 10px; font-weight: 700; font-style: italic;">
                            Semester {{ request('semester', '1') }}
                        </td>
                    </tr>
                    @php $no = 1; $totalSks = 0; $totalKumulatif = 0; @endphp
                    @foreach ($nilai as $item)
                    @php
                        $sks = $item->materiAjar->sks;
                        $g = strtoupper($item->grade);
                        $angkaMutu = match($g) { 'A' => 4.0, 'A-' => 3.7, 'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7, 'C+' => 2.3, 'C' => 2.0, 'D' => 1.0, default => 0 };
                        $kumulatif = $sks * $angkaMutu;
                        $totalSks += $sks; $totalKumulatif += $kumulatif;
                    @endphp
                    <tr>
                        <td style="border: 1px solid #333; padding: 6px; text-align: center; vertical-align: middle;">{{ $no++ }}</td>
                        <td style="border: 1px solid #333; padding: 6px; vertical-align: middle;">{{ $item->materiAjar->nama_mk }}</td>
                        <td style="border: 1px solid #333; padding: 6px; text-align: center; vertical-align: middle;">{{ $sks }}</td>
                        <td style="border: 1px solid #333; padding: 6px; text-align: center; vertical-align: middle;">{{ number_format($angkaMutu, 1) }}</td>
                        <td style="border: 1px solid #333; padding: 6px; text-align: center; vertical-align: middle;">{{ $g }}</td>
                        <td style="border: 1px solid #333; padding: 6px; text-align: center; vertical-align: middle;">{{ number_format($kumulatif, 1) }}</td>
                    </tr>
                    @endforeach
                    <tr style="font-weight: 700; background-color: #e5e7eb;">
                        <td colspan="2" style="border: 1px solid #333; padding: 8px 10px;">JUMLAH</td>
                        <td style="border: 1px solid #333; padding: 8px; text-align: center;">{{ $totalSks }}</td>
                        <td style="border: 1px solid #333; background-color: #9ca3af;"></td>
                        <td style="border: 1px solid #333; background-color: #9ca3af;"></td>
                        <td style="border: 1px solid #333; padding: 8px; text-align: center;">{{ number_format($totalKumulatif, 1) }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- 5. FOOTER IPS --}}
            <div style="border: 1px solid #333; border-top: none; padding: 10px; font-weight: 700; font-size: 10pt; margin-bottom: 30px;">
                <table style="width: 100%;">
                    <tr>
                        <td>IPS : {{ $totalSks > 0 ? number_format($totalKumulatif / $totalSks, 2) : '0.00' }}</td>
                        <td style="text-align: right;">Predikat : Sangat Memuaskan</td>
                    </tr>
                </table>
            </div>

            {{-- 6. TANDA TANGAN --}}
            <table style="width: 100%; margin-top: 20px;">
                <tr>
                    <td style="width: 60%;"></td> {{-- Space Kiri --}}
                    <td style="width: 40%; text-align: center;">
                        <p style="font-size: 10pt; margin-bottom: 60px;">Karawang, {{ now()->translatedFormat('d F Y') }}</p>
                        <p style="font-weight: 700; text-decoration: underline; margin: 0; font-size: 10pt;">Eko Marmanto P.U, S.Kom.,M.Kom.,MOS. CDMP</p>
                        <p style="font-size: 9pt; color: #555; margin: 0;">Head of Education</p>
                    </td>
                </tr>
            </table>

        </div>
    </div>

    {{-- TOMBOL PRINT --}}
    <div class="text-center mt-6 pb-10">
        <button onclick="printKHS()" id="btn-print-khs" class="bg-[#004269] text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-[#003355] flex items-center gap-2 mx-auto transition transform hover:scale-105">
            <i class="fas fa-print"></i> Cetak KHS (A4)
        </button>
    </div>
</div>

<script>
    function printKHS() {
        const btn = document.getElementById('btn-print-khs');
        const originalText = btn.innerHTML;

        if (typeof html2pdf === 'undefined') { alert('Library PDF belum siap.'); return; }

        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
        btn.disabled = true;

        const element = document.getElementById('printable-khs');
        const clone = element.cloneNode(true);
        
        // --- LOGIKA CLONE ---
        const container = document.createElement('div');
        container.style.width = '800px'; // Paksa lebar 800px (mirip A4)
        container.style.position = 'absolute'; 
        container.style.left = '-9999px';
        container.style.top = '0';
        container.style.backgroundColor = 'white'; // Pastikan background putih
        
        // Pastikan font Poppins terbawa ke clone
        clone.style.fontFamily = "'Poppins', sans-serif";
        clone.style.margin = '0 auto';
        clone.style.maxWidth = 'none'; 
        clone.style.width = '100%';    
        
        container.appendChild(clone);
        document.body.appendChild(container);

        var opt = {
            margin: [10, 10, 10, 10], 
            filename: 'KHS_{{ auth()->user()->mahasiswa->nipd }}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true, scrollY: 0 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(clone).save()
            .then(() => {
                document.body.removeChild(container);
                btn.innerHTML = originalText;
                btn.disabled = false;
            })
            .catch(err => {
                console.error(err);
                if(document.body.contains(container)) document.body.removeChild(container);
                btn.innerHTML = originalText;
                btn.disabled = false;
                alert('Gagal mencetak.');
            });
    }
</script>

@endsection