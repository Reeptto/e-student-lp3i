@extends('layouts.app')

@section('content')
{{-- Font & Script PDF --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
    body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; }

    /* === MECHA STYLES === */
    .mecha-wrapper { position: relative; margin-bottom: 2rem; z-index: 1; --theme-color: #333; }
    .mecha-border { position: relative; border: 3px solid var(--theme-color); background: white; z-index: 10; border-radius: 12px; }
    .mecha-shadow { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: var(--theme-color); opacity: 0.25; z-index: 0; transform: translate(4px, 4px); border-radius: 12px; }
    
    /* Dekorasi Sudut */
    .mecha-deco-tl { position: absolute; top: -6px; left: -6px; width: 24px; height: 24px; border-top: 4px solid var(--theme-color); border-left: 4px solid var(--theme-color); z-index: 20; border-radius: 4px 0 0 0; }
    .mecha-deco-br { position: absolute; bottom: -6px; right: -6px; width: 24px; height: 24px; border-bottom: 4px solid var(--theme-color); border-right: 4px solid var(--theme-color); z-index: 20; border-radius: 0 0 4px 0; }
    .mecha-stripes { position: absolute; width: 6px; height: 40px; background: repeating-linear-gradient(-45deg, var(--theme-color), var(--theme-color) 2px, transparent 2px, transparent 4px); z-index: 15; }
    .stripes-right { top: 30px; right: -6px; background-color: white; border: 1px solid var(--theme-color); }

    /* Collapsible */
    .collapsible-content { transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out; overflow: hidden; opacity: 1; max-height: 2000px; }
    .collapsible-content.closed { opacity: 0; max-height: 0; }

    /* Button */
    .btn-mecha { background: white; border: 2px solid var(--theme-color); color: var(--theme-color); font-weight: 700; border-radius: 8px; box-shadow: 3px 3px 0px var(--theme-color); transition: all 0.2s; cursor: pointer; }
    .btn-mecha:hover { transform: translate(-2px, -2px); box-shadow: 5px 5px 0px var(--theme-color); background: var(--theme-color); color: white; }
    .btn-mecha:disabled { opacity: 0.5; cursor: wait; }

    /* Scrollbar (Hanya untuk tampilan web) */
    .custom-scroll::-webkit-scrollbar { height: 8px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f0f0f0; border-radius: 4px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
</style>

<div class="py-10 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        
        {{-- HEADER (Navy) --}}
        <div class="mecha-wrapper" style="--theme-color: #004269;">
            <div class="mecha-shadow"></div>
            <div class="mecha-deco-tl"></div><div class="mecha-deco-br"></div><div class="mecha-stripes stripes-right"></div>
            <div class="mecha-border overflow-hidden">
                <div class="bg-[#004269] p-6 sm:p-8 flex items-center justify-between relative overflow-hidden">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 relative z-10">
                        <div class="p-3 bg-white border-2 border-[#009DA5] rounded-xl shadow-[4px_4px_0px_#009DA5] flex-shrink-0 text-[#004269]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        </div>
                        <div class="space-y-1">
                            <h1 class="text-3xl font-black text-white tracking-wide uppercase italic">{{ __('Informasi Tagihan') }}</h1>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 bg-[#009DA5] text-white text-xs font-bold uppercase rounded border border-white/20">Dashboard</span>
                                <p class="text-gray-200 text-sm font-medium tracking-wide">Keuangan Mahasiswa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT (Teal) --}}
        <div class="mecha-wrapper" style="--theme-color: #009DA5;">
            <div class="mecha-shadow"></div>
            <div class="mecha-deco-tl"></div><div class="mecha-deco-br"></div>
            <div class="mecha-border px-6 py-8">
                
                {{-- Toolbar --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-6 mb-6 border-b-2 border-dashed border-[#009DA5]/30 gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-[#004269] uppercase">Realisasi Pembayaran</h2>
                        <p class="text-gray-500 text-sm font-medium border-l-4 border-[#009DA5] pl-3 mt-1">Kelola dan lihat riwayat pembayaran Anda.</p>
                    </div>
                    {{-- TOMBOL CETAK --}}
                    <button id="btn-print" onclick="downloadReport()" class="btn-mecha px-5 py-2.5 flex items-center gap-2 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                        <span>{{ __('Cetak Laporan') }}</span>
                    </button>
                </div>
                
                {{-- Payment List --}}
                <div class="payment-section mb-6">
                    <div class="bg-white border-2 border-[#004269] rounded-xl cursor-pointer overflow-hidden group shadow-[4px_4px_0px_#004269]/20 hover:shadow-[4px_4px_0px_#004269] transition-all" id="plan-header" onclick="togglePlan()">
                        <div class="p-5 flex justify-between items-center bg-gray-50 group-hover:bg-blue-50/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-lg bg-[#004269] flex items-center justify-center text-white border-2 border-black shadow-sm group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-[#004269] uppercase tracking-tight">Rencana Pembayaran</h3>
                                    <p class="text-xs text-[#009DA5] font-bold tracking-wide uppercase bg-[#009DA5]/10 px-2 py-0.5 rounded inline-block">2024/2025</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-bold px-3 py-1 bg-green-100 text-green-700 border-2 border-green-600 rounded shadow-[2px_2px_0px_#15803d] hidden sm:inline-block transform -rotate-2">AKTIF</span>
                                <div class="w-8 h-8 flex items-center justify-center rounded bg-white border-2 border-[#004269] text-[#004269]">
                                    <svg id="chevron-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-500 rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="plan-content" class="collapsible-content">
                        {{-- ID 'printable-area' untuk target PDF --}}
                        <div id="printable-area" class="mt-4 border-2 border-[#009DA5] rounded-xl overflow-hidden shadow-sm bg-white">
                            
                            {{-- Header Khusus Print --}}
                            <div class="hidden print-header p-5 bg-[#009DA5] text-white text-center border-b-2 border-[#004269]">
                                <h2 class="text-2xl font-black uppercase">Laporan Keuangan mahasiswa</h2>
                                <p class="text-sm"> LP3I COLLEGE KARAWANG - Tahun Ajaran 2024/2025</p>
                                <p class="text-sm">Atas Nama : {{ auth()->user()->mahasiswa->nama_mhs }}</p>
                                <p class="text-sm">Nipd : {{ auth()->user()->mahasiswa->nipd }}</p>

                            </div>

                            <div class="overflow-x-auto custom-scroll">
                                <div class="min-w-[900px]">
                                    <div class="grid grid-cols-6 bg-[#009DA5] text-white text-xs font-black uppercase tracking-widest py-4 px-4 text-center border-b-2 border-[#004269]">
                                        <div class="border-r border-white/30">Angsuran</div>
                                        <div class="border-r border-white/30">Keterangan</div>
                                        <div class="border-r border-white/30">TA</div>
                                        <div class="border-r border-white/30">Jatuh Tempo</div>
                                        <div class="border-r border-white/30">Tagihan</div>
                                        <div>Status</div>
                                    </div>
                                    
                                    <div class="bg-white text-sm font-bold text-gray-700">
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
                                        <div class="grid grid-cols-6 py-4 px-4 border-b border-[#009DA5]/20 hover:bg-teal-50 transition duration-200 items-center text-center">
                                            <div class="text-[#004269]"><span class="bg-white border-2 border-[#004269] py-1 px-3 rounded shadow-sm text-xs">Ke-{{ is_array($payment) ? $payment['ins'] : $payment->ins }}</span></div>
                                            <div class="text-[#004269] text-left pl-4 font-black">{{ is_array($payment) ? $payment['desc'] : $payment->desc }}</div>
                                            <div class="text-gray-500">{{ is_array($payment) ? $payment['year'] : $payment->year }}</div>
                                            <div class="text-[#f15b67] font-mono text-xs bg-red-50 px-2 py-1 rounded border border-red-100">{{ is_array($payment) ? $payment['plan'] : $payment->plan }}</div>
                                            <div class="font-black text-gray-800">Rp {{ is_array($payment) ? $payment['bill'] : $payment->bill }}</div>
                                            <div class="flex justify-center"><div class="text-green-700 bg-green-100 px-3 py-1 rounded border border-green-500 text-xs">LUNAS</div></div>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                    <div class="bg-gray-50 border-t-2 border-[#009DA5] px-6 py-4 flex justify-end items-center gap-4 text-sm">
                                        <span class="text-gray-500 font-bold uppercase tracking-widest text-xs">Total</span>
                                        <span class="text-white bg-[#004269] px-4 py-2 rounded font-black text-lg border-2 border-[#009DA5]">Rp 3.700.000</span>
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
        if (content.classList.contains('closed')) {
            content.classList.remove('closed'); content.style.maxHeight = content.scrollHeight + "px"; icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('closed'); content.style.maxHeight = "0px"; icon.style.transform = 'rotate(0deg)';
        }
    }

    function downloadReport() {
        const btn = document.getElementById('btn-print');
        const originalText = btn.innerHTML;
        
        if (typeof html2pdf === 'undefined') {
            alert('Sedang memuat sistem PDF...'); return;
        }

        btn.innerHTML = '<span>⏳ Memproses...</span>';
        btn.disabled = true;

        const element = document.getElementById('printable-area');
        
        // 1. CLONE elemen agar tampilan asli tidak rusak
        const clone = element.cloneNode(true);
        
        // 2. MODIFIKASI CLONE: Hapus scroll & paksa lebar agar tercetak semua
        const scrollDiv = clone.querySelector('.overflow-x-auto');
        if(scrollDiv) {
            scrollDiv.classList.remove('overflow-x-auto', 'custom-scroll'); // Hapus class scroll
            scrollDiv.style.overflow = 'visible'; // Paksa visible
            scrollDiv.style.height = 'auto'; // Tinggi otomatis
        }
        
        const minWidth = clone.querySelector('.min-w-\\[900px\\]');
        if(minWidth) {
            minWidth.style.minWidth = 'auto'; // Reset min-width
            minWidth.style.width = '100%'; // Full width
            minWidth.classList.remove('min-w-[900px]');
        }

        // Tampilkan header print
        const header = clone.querySelector('.print-header');
        if(header) header.classList.remove('hidden');

        // Hilangkan border radius saat print agar rapi di kertas
        clone.style.borderRadius = '0';
        clone.style.border = 'none';

        // 3. Opsi PDF
        var opt = {
            margin:       10,
            filename:     'Laporan_Keuangan_Siswa.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, scrollY: 0 },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' } // Landscape biar muat
        };

        // 4. Proses Cetak dari Clone
        html2pdf().set(opt).from(clone).save()
            .then(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            })
            .catch((err) => {
                console.error(err);
                alert("Gagal mencetak.");
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    }
</script>
@endsection