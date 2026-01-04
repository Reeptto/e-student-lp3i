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
                        {{ substr($item->matkul->nama_mk, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-[#004269] group-hover:text-[#009DA5] transition-colors">{{ $item->matkul->nama_mk }}</h3>
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wide mt-1">
                            <span class="bg-gray-100 px-2 py-0.5 rounded border border-gray-200">SKS: {{ $item->matkul->sks }}</span>
                            <span>•</span>
                            <span>Semester {{ $item->matkul->semester }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-6 relative z-10">
                    <div class="text-right hidden sm:block bg-white/80 p-2 rounded-lg backdrop-blur-sm border border-gray-100">
                        <span class="block text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Nilai Akhir</span>
                        <div class="flex items-center gap-2 justify-end">
                            <span class="text-2xl font-black text-[#004269]">{{ $item->nilai_akhir }}</span>
                            @php 
                                $g = strtoupper($item->huruf_mutu);
                                $gradeColor = str_starts_with($g, 'A') ? 'green' : (str_starts_with($g, 'B') ? 'blue' : (str_starts_with($g, 'C') ? 'orange' : 'red')); 
                            @endphp
                            <span class="px-2 py-0.5 rounded text-sm font-black bg-{{$gradeColor}}-100 text-{{$gradeColor}}-700 border border-{{$gradeColor}}-200 shadow-sm">
                                {{ $item->huruf_mutu }}
                            </span>
                        </div>
                    </div>
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 bg-gray-50 border border-gray-200">
                        <svg :class="expanded ? 'rotate-180' : ''" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </div>

            {{-- Detail Expand (Data sesuai Seeder) --}}
            <div x-show="expanded" x-collapse class="border-t-2 border-dashed border-gray-200 bg-gray-50/80 p-6 relative">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+CjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0iI2ZmZmZmZiI+PC9yZWN0Pgo8Y2lyY2xlIGN4PSIxIiBjeT0iMSIgcj0iMSIgZmlsbD0iI2UzZThlZiI+PC9jaXJjbGU+Cjwvc3ZnPg==')] opacity-50"></div>
                
                <div class="relative z-10">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        {{-- Kehadiran --}}
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-blue-400 mb-1"><i class="fas fa-user-clock"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Kehadiran</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->kehadiran ?? '-' }}</span>
                        </div>
                        {{-- Attitude --}}
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-purple-400 mb-1"><i class="fas fa-smile"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Attitude</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->attitude ?? '-' }}</span>
                        </div>
                        {{-- Tugas --}}
                        <div class="bg-white p-3 rounded-xl border border-gray-200 text-center shadow-sm flex flex-col items-center">
                            <div class="text-orange-400 mb-1"><i class="fas fa-tasks"></i></div>
                            <span class="text-[0.65rem] text-gray-400 font-bold uppercase tracking-wider block mb-1">Tugas</span>
                            <span class="text-lg font-black text-[#004269]">{{ $item->nilai_tugas ?? '-' }}</span>
                        </div>
                        {{-- Formative/Quiz --}}
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

    {{-- TAB 2: KHS (PRINTABLE) --}}
    <div x-show="activeTab === 'khs'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="display: none;"
         class="relative z-10">
        
        <div class="mecha-wrapper" style="--theme-color: #004269;">
            <div class="mecha-shadow"></div>
            <div class="mecha-deco-tl"></div><div class="mecha-deco-br"></div>
            <div class="mecha-border overflow-hidden bg-white">
                
                <div id="printable-khs">
                    <div class="bg-gray-50 p-6 border-b-2 border-[#004269] relative overflow-hidden">
                        <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDQwIDQwIj48cGF0aCBkPSJNMjAgMjBMMCAwSDQwTDIwIDIwWk0yMCAyMEw0MCA0MEgwTDIwIDIwWiIgZmlsbD0iIzAwNDI2OSIvPjwvc3ZnPg==')]"></div>

                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 relative z-10">
                            <div>
                                <h2 class="text-2xl font-black text-[#004269] uppercase mb-4 tracking-wider flex items-center gap-2">
                                    <i class="fas fa-file-invoice text-[#009DA5]"></i> Kartu Hasil Studi
                                </h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-sm text-[#004269]">
                                    <div class="flex gap-2"><span class="w-24 font-bold uppercase opacity-70">Nama</span>: <span class="font-bold">{{ auth()->user()->mahasiswa->nama_mhs }}</span></div>
                                    <div class="flex gap-2"><span class="w-24 font-bold uppercase opacity-70">NIM</span>: <span class="font-bold font-mono">{{ auth()->user()->mahasiswa->nipd }}</span></div>
                                    <div class="flex gap-2"><span class="w-24 font-bold uppercase opacity-70">Bidang Keahlian</span>: <span class="font-bold">{{ auth()->user()->mahasiswa->bidang_keahlian }}</span></div>
                                    <div class="flex gap-2 items-center"><span class="w-24 font-bold uppercase opacity-70">T.A</span>: <span class="font-bold bg-[#009DA5] text-white px-2 rounded-md text-xs py-0.5 shadow-sm">2024/2025 Ganjil</span></div>
                                </div>
                            </div>
                            
                            <button onclick="printKHS()" id="btn-print-khs" class="group bg-white border-2 border-[#004269] hover:bg-[#004269] hover:text-white text-[#004269] px-5 py-2.5 rounded-xl text-sm font-bold shadow-[3px_3px_0px_#004269] transition-all transform hover:-translate-y-1 active:translate-y-0 active:shadow-none flex items-center gap-2" data-html2canvas-ignore="true">
                                <i class="fas fa-print group-hover:animate-pulse"></i>
                                <span>Cetak KHS</span>
                            </button>
                        </div>
                    </div>

                    <div class="overflow-x-auto p-0">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-[#004269] text-white uppercase font-black text-xs tracking-widest">
                                <tr>
                                    <th class="px-6 py-4 border-r border-white/20 text-center w-16">No</th>
                                    <th class="px-6 py-4 border-r border-white/20">Kode MK</th>
                                    <th class="px-6 py-4 border-r border-white/20">Mata Kuliah</th>
                                    <th class="px-6 py-4 border-r border-white/20 text-center">SKS </th>
                                    <th class="px-6 py-4 border-r border-white/20 text-center">Nilai Numerik</th>
                                    <th class="px-6 py-4 border-r border-white/20 text-center">Huruf Mutu</th>
                                    <th class="px-6 py-4 text-center bg-[#003355]">Nilai Kumulatif</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 font-medium text-gray-700 bg-white">
                              @php
                                    $no = 1;
                                    $totalSks = 0;
                                    $totalBobot = 0;
                                @endphp

                                @foreach ($nilai as $item)
                                @php
                                $totalSks += $item->matkul->sks;
                                $totalBobot += $item->nilai_kumulatif; // bobot × sks (accessor)
                            @endphp

                              
                                <tr class="hover:bg-blue-50 transition group">
                                    <td class="px-6 py-3 text-center font-bold text-gray-400 group-hover:text-[#004269]">{{ $no++ }}</td>
                                    <td class="px-6 py-3 font-mono text-xs text-gray-500 group-hover:text-[#004269]">{{ $item->matkul->kode_mk ?? 'MK-??' }}</td>
                                    <td class="px-6 py-3 font-bold text-[#004269]">{{ $item->matkul->nama_mk }}</td>
                                    <td class="px-6 py-3 text-center">{{ $item->matkul->sks }}</td>
                                    <td class="px-6 py-3 text-center">
                                        <span class="inline-block w-8 h-8 leading-8 rounded-full bg-blue-100 text-blue-700 font-bold text-xs shadow-sm">{{ number_format($item->nilai_akhir, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-3 text-center text-gray-500">{{ $item->huruf_mutu}}</td>
                                    <td class="px-6 py-3 text-center font-bold text-[#004269] bg-blue-50/50 group-hover:bg-blue-100/50">{{ number_format($item->nilai_kumulatif, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 border-t-2 border-[#004269]">
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-right font-black text-[#004269] uppercase tracking-wide">Total Semester Ini</td>
                                    <td class="px-6 py-4 text-center font-bold text-white bg-[#009DA5] shadow-inner">{{ $totalSks }}</td>
                                    <td colspan="2" class="px-6 py-4 text-right font-black text-[#004269] uppercase tracking-wide">Total Bobot (KxB)</td>
                                    <td class="px-6 py-4 text-center font-bold text-white bg-[#004269] shadow-inner">{{ number_format($totalBobot, 1) }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-blue-50 to-white border-t border-blue-100 flex justify-end relative overflow-hidden">
                         <div class="absolute left-0 bottom-0 opacity-10"><i class="fas fa-chart-line text-8xl text-[#009DA5]"></i></div>
                        <div class="text-right relative z-10">
                            <span class="text-xs uppercase text-gray-500 font-bold tracking-wider block">Indeks Prestasi Semester (IPS)</span>
                            <div class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#004269] to-[#009DA5] mt-1">
                                {{ $totalSks > 0 ? number_format($totalBobot / $totalSks, 2) : '0.00' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function printKHS() {
        const btn = document.getElementById('btn-print-khs');
        const originalText = btn.innerHTML;

        if (typeof html2pdf === 'undefined') { alert('Library PDF sedang dimuat, coba sesaat lagi.'); return; }

        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Memproses...</span>';
        btn.disabled = true;

        const element = document.getElementById('printable-khs');
        const clone = element.cloneNode(true);
        
        const container = document.createElement('div');
        container.style.width = '800px'; 
        container.style.position = 'absolute'; 
        container.style.left = '-9999px';
        container.style.top = '0';
        
        clone.querySelector('.bg-white').style.borderRadius = '0';
        clone.querySelector('.bg-white').style.border = 'none';
        const table = clone.querySelector('table');
        if(table) table.style.width = '100%';

        container.appendChild(clone);
        document.body.appendChild(container);

        var opt = {
            margin: [10, 10, 15, 10],
            filename: 'KHS_{{ auth()->user()->mahasiswa->nipd }}_{{ date("Ymd") }}.pdf',
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
                alert('Gagal mencetak KHS.');
                document.body.removeChild(container);
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }
</script>

@endsection