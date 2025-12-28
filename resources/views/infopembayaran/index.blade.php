@extends('layouts.app')

@section('content')
    
 
    {{-- Custom Style untuk animasi collapsible --}}
    <x-slot name="head">
        <style>
            .collapsible-content {
                transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
                max-height: 0;
                opacity: 0;
                overflow: hidden;
            }
            .collapsible-content.open {
                opacity: 1;
            }
            /* Pattern Animation (Optional: membuat pattern sedikit bergerak saat hover) */
            .pattern-hover:hover .floating-shape {
                transform: rotate(45deg) scale(1.05);
            }
        </style>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8"> {{-- Diperlebar sedikit ke max-w-6xl --}}
            
            {{-- HEADER SECTION (Geometric Pattern Style) --}}
            <div class="relative transform translate-y-6 z-10 mx-4 sm:mx-0 group pattern-hover">
                <div class="bg-[#004269] rounded-2xl shadow-xl p-6 sm:p-8 flex items-center justify-between overflow-hidden relative min-h-[140px]">
                    
                    {{-- === BACKGROUND PATTERN LAYER === --}}
                    <div class="absolute inset-0 w-full h-full pointer-events-none overflow-hidden">
                        
                        {{-- 1. Diagonal Line Utama --}}
                        <div class="absolute right-[20%] -top-[50%] w-[30px] h-[200%] bg-[#009DA5] transform rotate-45 shadow-lg z-10 opacity-90 border-r border-[#004269]/20"></div>

                        {{-- 2. Bidang Miring Kanan --}}
                        <div class="absolute -right-[10%] -bottom-[80%] w-[60%] h-[200%] bg-white/5 transform rotate-45 z-0 backdrop-blur-[1px]"></div>

                        {{-- 3. Shape: Kotak Solid Teal --}}
                        <div class="floating-shape absolute right-[26%] top-[25%] w-10 h-10 bg-[#009DA5] rounded-lg transform rotate-45 shadow-lg z-20 border border-white/20 transition-transform duration-500 ease-out"></div>

                        {{-- 4. Shape: Kotak Besar Dark Blue --}}
                        <div class="floating-shape absolute right-[10%] top-[10%] w-24 h-24 bg-[#003655] rounded-xl transform rotate-45 border-2 border-[#009DA5] shadow-2xl z-20 flex items-center justify-center transition-transform duration-700 ease-out delay-75">
                            {{-- Inner Outline --}}
                            <div class="w-20 h-20 border border-white/10 rounded-lg"></div>
                        </div>

                        {{-- 5. Shape: Kotak Outline Transparan --}}
                        <div class="floating-shape absolute right-[18%] bottom-[10%] w-14 h-14 border-2 border-white/10 rounded-lg transform rotate-12 z-10 transition-transform duration-1000 ease-out delay-100"></div>
                        
                        {{-- 6. Floating Square Kecil --}}
                        <div class="absolute right-[5%] -top-[10%] w-6 h-6 bg-[#009DA5]/50 rounded transform rotate-45 z-0"></div>

                    </div>
                    
                    {{-- === KONTEN === --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 relative z-30">
                        {{-- Icon Box --}}
                        <div class="p-4 bg-white/10 rounded-2xl backdrop-blur-md border border-white/20 shadow-inner flex-shrink-0">
                            <i class="fas fa-wallet text-3xl text-white drop-shadow-md"></i>
                        </div>
                        
                        <div class="space-y-1">
                            <h1 class="text-3xl font-bold text-white tracking-wide drop-shadow-sm">
                                {{ __('Informasi Tagihan') }}
                            </h1>
                            <div class="flex items-center gap-2">
                                <span class="h-1 w-8 bg-[#009DA5] rounded-full inline-block"></span>
                                <p class="text-gray-200 text-sm font-medium tracking-wider uppercase opacity-90">
                                    Dasbor Keuangan
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- MAIN CONTENT CARD --}}
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden pt-16 pb-8 px-4 sm:px-8 border border-gray-100 mt-2 relative z-0">
                
                {{-- Section Header & Action --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-6 mb-6 border-b border-dashed border-gray-200 gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 tracking-tight">Realisasi Pembayaran</h2>
                        <p class="text-gray-500 text-sm mt-1">Kelola dan lihat riwayat pembayaran Anda di bawah ini.</p>
                    </div>
                    
                    <button class="group flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-xl font-medium hover:border-[#009DA5] hover:text-[#009DA5] hover:shadow-md transition-all duration-300 focus:ring-2 focus:ring-[#009DA5] focus:ring-offset-1">
                        <div class="bg-gray-100 p-1.5 rounded-md group-hover:bg-[#009DA5]/10 transition-colors">
                            <i class="fas fa-print text-sm group-hover:text-[#009DA5]"></i>
                        </div>
                        <span>{{ __('Cetak Laporan') }}</span>
                    </button>
                </div>
                
                {{-- Student Payment Plan Section --}}
                <div class="payment-section mb-6">
                    
                    {{-- Collapsible Trigger --}}
                    <div class="bg-gray-50 border border-gray-200 rounded-xl hover:border-[#004269]/30 transition-colors duration-300 cursor-pointer overflow-hidden group" 
                         id="plan-header" onclick="togglePlan()">
                        
                        <div class="p-5 flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-[#004269] flex items-center justify-center text-white shadow-md group-hover:scale-110 transition-transform duration-300">
                                    <i class="fas fa-calendar-alt text-sm"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-[#004269] group-hover:text-[#009DA5] transition-colors">
                                        Rencana Pembayaran Siswa
                                    </h3>
                                    <p class="text-xs text-gray-500 font-medium tracking-wide uppercase">Tahun Ajaran 2024/2025</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <span class="text-xs font-semibold px-3 py-1 bg-green-100 text-green-700 rounded-full border border-green-200 hidden sm:inline-block">
                                    Aktif
                                </span>
                                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-gray-200 shadow-sm text-gray-400 group-hover:text-[#004269] transition-all">
                                    <i class="fas fa-chevron-down transform transition-transform duration-500" id="chevron-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Collapsible Content --}}
                    <div id="plan-content" class="collapsible-content">
                        {{-- Spacer --}}
                        <div class="mt-4 border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                            
                            {{-- Table Wrapper --}}
                            <div class="overflow-x-auto">
                                <div class="min-w-[900px]"> {{-- Lebar min-w dinaikkan agar tabel tidak terlalu sempit --}}
                                    
                                    {{-- Table Header (GRID 6 KOLOM) --}}
                                    <div class="grid grid-cols-6 bg-[#009DA5] text-white text-xs font-bold uppercase tracking-wider py-4 px-4 text-center">
                                        <div class="flex flex-col gap-1 items-center justify-center border-r border-white/20">
                                            <span>Angsuran</span>
                                        </div>
                                        <div class="flex flex-col gap-1 items-center justify-center border-r border-white/20 col-span-1"> {{-- Kolom Baru --}}
                                            <span>Keterangan</span>
                                        </div>
                                        <div class="flex flex-col gap-1 items-center justify-center border-r border-white/20">
                                            <span>Tahun Ajaran</span>
                                        </div>
                                        <div class="flex flex-col gap-1 items-center justify-center border-r border-white/20">
                                            <span>Jatuh Tempo</span>
                                        </div>
                                        <div class="flex flex-col gap-1 items-center justify-center border-r border-white/20">
                                            <span>Jumlah Tagihan</span>
                                        </div>
                                        <div class="flex flex-col gap-1 items-center justify-center">
                                            <span>Status / Bayar</span>
                                        </div>
                                    </div>
                                    
                                    {{-- Table Body --}}
                                    <div class="bg-white divide-y divide-gray-100 text-sm">
                                        
                                        @php
                                            // Data dummy dengan keterangan
                                            $payments = [
                                                ['ins' => '1', 'desc' => 'Daftar Ulang & Gedung', 'year' => '2024/2025', 'plan' => '10/01/2024', 'bill' => '1.500.000', 'pay' => '1.500.000'],
                                                ['ins' => '2', 'desc' => 'SPP Bulan Januari', 'year' => '2024/2025', 'plan' => '10/02/2024', 'bill' => '500.000', 'pay' => '500.000'],
                                                ['ins' => '3', 'desc' => 'Seragam Olahraga', 'year' => '2024/2025', 'plan' => '10/03/2024', 'bill' => '700.000', 'pay' => '700.000'],
                                            ];
                                        @endphp

                                        @foreach ($payments as $payment)
                                        <div class="grid grid-cols-6 py-4 px-4 hover:bg-blue-50/50 transition duration-200 items-center text-center group">
                                            
                                            {{-- Installment --}}
                                            <div class="font-medium text-gray-500 group-hover:text-[#004269]">
                                                <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-md text-xs font-bold border border-gray-200">
                                                    Ke-{{ $payment['ins'] }}
                                                </span>
                                            </div>

                                            {{-- Keterangan (New Column) --}}
                                            <div class="font-semibold text-[#004269] text-left pl-4">
                                                {{ $payment['desc'] }}
                                            </div>

                                            {{-- Year --}}
                                            <div class="font-medium text-gray-600">
                                                {{ $payment['year'] }}
                                            </div>

                                            {{-- Due Date --}}
                                            <div class="text-gray-500 font-mono text-xs">
                                                {{ $payment['plan'] }}
                                            </div>
                                            
                                            {{-- Amount Bill --}}
                                            <div class="font-bold text-gray-800 text-base">
                                                Rp {{ $payment['bill'] }}
                                            </div>
                                            
                                            {{-- Status/Pay --}}
                                            <div class="flex flex-col items-center justify-center gap-1">
                                                <div class="text-green-600 font-bold bg-green-50 px-3 py-1 rounded-full border border-green-100 text-xs">
                                                    Lunas: {{ $payment['pay'] }}
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                    
                                    {{-- Table Footer --}}
                                    <div class="bg-gray-50 border-t border-gray-200 px-6 py-3 flex justify-end items-center gap-4 text-sm">
                                        <span class="text-gray-500 font-medium uppercase tracking-widest text-xs">Total Dibayar</span>
                                        <span class="text-[#004269] font-bold text-lg">Rp 2.700.000</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Collapsible Content --}}

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        window.togglePlan = function() {
            const content = document.getElementById('plan-content');
            const icon = document.getElementById('chevron-icon');
            const header = document.getElementById('plan-header');

            content.classList.toggle('open');
            
            if (content.classList.contains('open')) {
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = 'rotate(180deg)';
                header.classList.add('border-[#004269]');
            } else {
                content.style.maxHeight = "0px";
                icon.style.transform = 'rotate(0deg)';
                header.classList.remove('border-[#004269]');
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.getElementById('plan-content');
            const icon = document.getElementById('chevron-icon');
            const header = document.getElementById('plan-header');
            
            if (content) {
                content.classList.add('open');
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = 'rotate(180deg)';
                header.classList.add('border-[#004269]');
            }
        });
    </script>
    @endpush
<
@endsection