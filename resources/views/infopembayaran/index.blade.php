@extends('layouts.app')

@section('content')
{{-- Hanya Import Poppins --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
    /* === GLOBAL FONT SETTING === */
    body, html {
        font-family: 'Poppins', sans-serif !important;
        background-color: #e6eefa;
        color: #2d3748;
    }

    /* === HYBRID STYLE VARIABLES === */
    :root {
        --teal-main: #009DA5;
        --navy-main: #004269;
        --metal-light: #f1f5f9;
        --clay-out-shadow: 8px 8px 16px rgba(0, 66, 105, 0.2), -8px -8px 16px rgba(255, 255, 255, 0.8);
        --clay-in-shadow: inset 6px 6px 12px rgba(0, 0, 0, 0.3), inset -6px -6px 12px rgba(255, 255, 255, 0.2);
    }

    /* === EFEK TEKS TERTANAM (NANCEP) === */
    .text-engraved {
        color: var(--navy-main);
        /* Trik: Bayangan putih di bawah, bayangan hitam di atas */
        text-shadow: 
            1px 1px 0px rgba(255, 255, 255, 0.9),  /* Highlight bibir bawah */
            -1px -1px 2px rgba(0, 0, 0, 0.2);      /* Bayangan bibir atas */
    }

    /* Versi Light (Untuk teks di background gelap) */
    .text-engraved-light {
        color: rgba(255,255,255,0.9);
        text-shadow: 
            -1px -1px 2px rgba(255, 255, 255, 0.1), 
            1px 1px 2px rgba(0, 0, 0, 0.5); /* Masuk ke dalam gelap */
    }

    /* Container Utama */
    .hybrid-card {
        background: var(--metal-light);
        border-radius: 24px;
        border: 6px solid var(--teal-main); 
        box-shadow: var(--clay-out-shadow);
        margin-bottom: 3rem;
        overflow: hidden;
        position: relative;
    }

    /* Header Block */
    .hybrid-header-panel {
        background: var(--navy-main);
        color: white;
        padding: 2.5rem;
        position: relative;
        box-shadow: var(--clay-in-shadow);
        border-bottom: 6px solid var(--teal-main);
        font-family: 'Poppins', sans-serif;
    }

    /* Dekorasi "Sekrup/Rivet" */
    .rivet {
        position: absolute;
        width: 16px; height: 16px;
        background: var(--teal-main);
        border-radius: 50%;
        box-shadow: inset 2px 2px 4px rgba(0,0,0,0.4);
        border: 2px solid #003354;
    }
    .rivet-tl { top: 12px; left: 12px; }
    .rivet-tr { top: 12px; right: 12px; }
    .rivet-bl { bottom: 12px; left: 12px; }
    .rivet-br { bottom: 12px; right: 12px; }

    /* Tombol Hybrid */
    .btn-hybrid {
        background: var(--teal-main);
        color: white;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 3px solid var(--navy-main);
        border-radius: 16px;
        padding: 12px 28px;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 4px 4px 8px rgba(0,0,0,0.3), inset 2px 2px 4px rgba(255,255,255,0.4);
    }
    .btn-hybrid:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 12px rgba(0,0,0,0.3), inset 2px 2px 4px rgba(255,255,255,0.5);
    }
    .btn-hybrid:active {
        transform: translate(2px, 2px);
        box-shadow: inset 4px 4px 8px rgba(0,0,0,0.5), inset -4px -4px 8px rgba(0,0,0,0.1);
        background: var(--navy-main);
    }

    /* Accordion */
    .hybrid-accordion {
        background: white;
        border: 4px solid var(--navy-main);
        border-radius: 20px;
        box-shadow: 6px 6px 0px var(--teal-main);
        transition: all 0.3s;
        margin-top: 1rem;
    }
    .hybrid-accordion-header {
        padding: 20px;
        cursor: pointer;
        border-bottom: 4px solid var(--navy-main);
        background: #f8fafc;
        border-radius: 16px 16px 0 0;
        font-family: 'Poppins', sans-serif;
    }

    /* Table Container */
    .data-console-container {
        background: #edf2f7;
        border-radius: 16px;
        border: 4px solid var(--navy-main);
        padding: 8px;
        box-shadow: inset 4px 4px 10px rgba(0,0,0,0.1);
    }
    
    /* Styling Tabel */
    .hybrid-table { width: 100%; border-collapse: separate; border-spacing: 0 4px; }
    .hybrid-table thead th {
        background: var(--navy-main);
        color: var(--teal-main);
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 12px;
        border: 2px solid var(--navy-main);
    }
    .hybrid-table tbody tr td {
        background: white;
        padding: 16px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        border-top: 2px solid var(--navy-main);
        border-bottom: 2px solid var(--navy-main);
    }
    .hybrid-table tbody tr td:first-child { border-left: 2px solid var(--navy-main); border-radius: 8px 0 0 8px; }
    .hybrid-table tbody tr td:last-child { border-right: 2px solid var(--navy-main); border-radius: 0 8px 8px 0; }

    /* Status Lunas */
    .status-stamp {
        background: var(--teal-main);
        color: white;
        padding: 4px 12px;
        border-radius: 8px;
        font-weight: 800;
        font-family: 'Poppins', sans-serif;
        border: 2px solid var(--navy-main);
        box-shadow: 3px 3px 0px var(--navy-main);
        transform: rotate(-2deg);
        display: inline-block;
    }

    /* Scrollbar */
    .custom-scroll::-webkit-scrollbar { height: 12px; }
    .custom-scroll::-webkit-scrollbar-track { background: var(--navy-main); border-radius: 6px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: var(--teal-main); border: 3px solid var(--navy-main); border-radius: 6px; }
</style>

<div class="py-10 min-h-screen font-['Poppins']">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">

        {{-- === CARD 1: HEADER HYBRID === --}}
        <div class="hybrid-card">
            <div class="hybrid-header-panel">
                <div class="rivet rivet-tl"></div><div class="rivet rivet-tr"></div>
                <div class="rivet rivet-bl"></div><div class="rivet rivet-br"></div>

                <div class="flex flex-col sm:flex-row items-center gap-6 relative z-10">
                    {{-- Icon Timbul (Inset container) --}}
                    <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-[#004269] border-4 border-[#009DA5] shadow-[inset_0_0_10px_rgba(0,0,0,0.2)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                    </div>
                    
                    <div class="text-center sm:text-left">
                        {{-- APPLIED: text-engraved-light --}}
                        <h1 class="text-engraved-light text-3xl sm:text-4xl font-black tracking-widest uppercase">{{ __('Informasi Tagihan') }}</h1>
                        <div class="flex items-center justify-center sm:justify-start gap-3 mt-3">
                            <span class="px-3 py-1 bg-[#009DA5] text-white text-xs font-bold uppercase border-2 border-white rounded-md shadow-sm">SYSTEM: DASHBOARD</span>
                            <p class="font-bold text-teal-200 tracking-wider">/// Keuangan Mahasiswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- === CARD 2: CONTENT HYBRID === --}}
        <div class="hybrid-card" style="border-top: none;">
            <div class="p-8 bg-white rounded-b-[18px]">
                
                {{-- Toolbar --}}
                <div class="flex flex-col sm:flex-row justify-between items-end mb-10 gap-6 pb-6 border-b-4 border-dashed border-gray-300">
                    <div>
                        {{-- APPLIED: text-engraved --}}
                        <h2 class="text-engraved text-2xl font-black uppercase">Data Realisasi</h2>
                        <p class="text-gray-500 font-bold bg-gray-100 px-2 inline-block border-l-4 border-[#009DA5]">Status pembayaran terkini.</p>
                    </div>
                    <button id="btn-print" onclick="downloadReport()" class="btn-hybrid flex items-center gap-3 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                        <span>CETAK DATA</span>
                    </button>
                </div>

                {{-- Accordion --}}
                <div class="hybrid-accordion">
                    <div class="hybrid-accordion-header flex justify-between items-center" onclick="togglePlan()">
                        <div class="flex items-center gap-5">
                            {{-- Text di dalam kotak ini diberi efek engraved juga --}}
                            <div class="w-14 h-14 rounded-xl bg-[#004269] text-white flex items-center justify-center border-4 border-[#009DA5] shadow-sm font-black text-xl text-engraved-light">
                                RP
                            </div>
                            <div>
                                {{-- APPLIED: text-engraved --}}
                                <h3 class="text-engraved font-black text-xl uppercase">Rencana Pembayaran</h3>
                                <p class="text-sm font-bold text-[#009DA5] bg-[#004269] px-2 py-0.5 text-white inline-block rounded-sm mt-1">T.A 2024/2025</p>
                            </div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center text-[#004269] border-4 border-gray-300 shadow-[inset_2px_2px_5px_rgba(0,0,0,0.1)]">
                            <svg id="chevron-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform transition-transform duration-300 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>

                    <div id="plan-content" class="overflow-hidden transition-[max-height] duration-500 ease-in-out" style="max-height: 2000px;">
                        <div class="p-6">
                            <div id="printable-area" class="data-console-container bg-white">
                                
                                <div class="hidden print-header p-6 text-center border-b-4 border-black mb-6">
                                    <h1 class="text-2xl font-black uppercase text-black">LAPORAN KEUANGAN</h1>
                                    <p class="text-black font-bold">LP3I COLLEGE KARAWANG // SYSTEM REPORT</p>
                                </div>

                                <div class="overflow-x-auto custom-scroll p-1">
                                    <table class="hybrid-table min-w-[800px]">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Deskripsi Tagihan</th>
                                                <th>Tahun Ajar</th>
                                                <th>Jatuh Tempo</th>
                                                <th class="text-right">Nominal</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $payments = $payments ?? [
                                                    ['ins' => '1', 'desc' => 'Daftar Ulang', 'year' => '24/25', 'plan' => '10/01/24', 'bill' => '1.500.000', 'pay' => '1.500.000'],
                                                    ['ins' => '2', 'desc' => 'SPP Januari', 'year' => '24/25', 'plan' => '10/02/24', 'bill' => '500.000', 'pay' => '500.000'],
                                                    ['ins' => '3', 'desc' => 'Seragam', 'year' => '24/25', 'plan' => '10/03/24', 'bill' => '700.000', 'pay' => '700.000'],
                                                    ['ins' => '4', 'desc' => 'SPP Februari', 'year' => '24/25', 'plan' => '10/04/24', 'bill' => '500.000', 'pay' => '500.000'],
                                                    ['ins' => '5', 'desc' => 'SPP Maret', 'year' => '24/25', 'plan' => '10/05/24', 'bill' => '500.000', 'pay' => '500.000'],
                                                ];
                                            @endphp
                                            @foreach ($payments as $payment)
                                            <tr class="hover:brightness-95 transition-all">
                                                <td class="font-black text-[#004269] text-center bg-gray-50">{{ is_array($payment) ? $payment['ins'] : $payment->ins }}</td>
                                                <td class="font-bold text-[#004269] text-lg">{{ is_array($payment) ? $payment['desc'] : $payment->desc }}</td>
                                                <td class="text-gray-600 font-['Poppins']">{{ is_array($payment) ? $payment['year'] : $payment->year }}</td>
                                                <td>
                                                    <span class="px-2 py-1 bg-gray-200 border-2 border-gray-400 rounded text-xs font-bold text-gray-700">{{ is_array($payment) ? $payment['plan'] : $payment->plan }}</span>
                                                </td>
                                                <td class="text-right font-black text-[#009DA5] text-lg">Rp {{ is_array($payment) ? $payment['bill'] : $payment->bill }}</td>
                                                <td class="text-center">
                                                    <span class="status-stamp">LUNAS</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-6 flex justify-end p-4 bg-[#004269] text-white rounded-lg border-4 border-[#009DA5] shadow-[inset_0_0_10px_rgba(0,0,0,0.3)]">
                                    <div class="flex items-center gap-4">
                                        <span class="text-sm font-bold opacity-80 uppercase tracking-wider">Total Akumulasi:</span>
                                        {{-- APPLIED: text-engraved-light --}}
                                        <span class="text-engraved-light text-3xl font-black tracking-wide">Rp 3.700.000</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    function togglePlan() {
        const content = document.getElementById('plan-content');
        const icon = document.getElementById('chevron-icon');
        if (content.style.maxHeight === "0px") {
            content.style.maxHeight = content.scrollHeight + "px"; icon.style.transform = 'rotate(180deg)';
        } else {
            content.style.maxHeight = "0px"; icon.style.transform = 'rotate(0deg)';
        }
    }

    function downloadReport() {
        const btn = document.getElementById('btn-print');
        const originalText = btn.innerHTML;
        
        if (typeof html2pdf === 'undefined') { alert('Library PDF belum siap.'); return; }

        btn.innerHTML = '<span>⚠️ GENERATING...</span>';
        btn.disabled = true;

        const element = document.getElementById('printable-area');
        const clone = element.cloneNode(true);
        
        // --- BERSIHKAN STYLE UNTUK PDF ---
        clone.style.boxShadow = 'none';
        clone.style.border = 'none';
        clone.style.padding = '0';
        clone.style.background = 'white';
        
        // Hapus class engraved di PDF agar tidak pecah resolusinya saat print
        const engraved = clone.querySelectorAll('.text-engraved, .text-engraved-light');
        engraved.forEach(el => {
            el.style.textShadow = 'none';
            el.style.color = 'black';
        });

        const scrollDiv = clone.querySelector('.overflow-x-auto');
        if(scrollDiv) {
            scrollDiv.classList.remove('overflow-x-auto', 'custom-scroll');
            scrollDiv.style.overflow = 'visible';
        }
        
        const table = clone.querySelector('table');
        if(table) {
            table.style.borderCollapse = 'collapse';
            table.style.borderSpacing = '0';
        }
        const cells = clone.querySelectorAll('th, td');
        cells.forEach(cell => {
            cell.style.border = '2px solid black';
            cell.style.borderRadius = '0';
            cell.style.background = 'white';
            cell.style.color = 'black';
            cell.style.fontFamily = 'Poppins, sans-serif'; 
        });
        
        const stamps = clone.querySelectorAll('.status-stamp');
        stamps.forEach(s => {
             s.style.boxShadow = 'none'; s.style.transform = 'none'; s.style.border = '1px solid black'; s.style.color = 'black'; s.style.background = 'white';
        });

        const header = clone.querySelector('.print-header');
        if(header) header.classList.remove('hidden');

        var opt = {
            margin: 10,
            filename: 'Laporan_Keuangan_Industrial.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        html2pdf().set(opt).from(clone).save().then(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    }
</script>
@endsection