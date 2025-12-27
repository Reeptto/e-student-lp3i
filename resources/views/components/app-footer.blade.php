@php
    // Warna yang diinspirasi dari gambar Lower Third (Biru Tua & Biru Muda/Cyan)
    $darkBlue = '#004269'; // Biru Tua (Primary Color)
    $lightBlue = '#009DA5'; // Teal/Cyan (Accent Color)
    $white = '#FFFFFF'; 
@endphp

{{-- 
Wrapper Utama: Menggunakan Flex untuk menampung Logo (kiri) dan Info (kanan).
Shadow yang kuat untuk meniru tampilan "mengambang".
--}}
<footer class="mt-6 w-full max-w-6xl mx-auto shadow-2xl relative">
    <div class="flex items-stretch h-20">

        {{-- 1. BAGIAN LOGO (Wadah KIRI - Putih) --}}
        <div class="relative w-48 flex-shrink-0 z-20">
            {{-- SVG Background untuk Shape Logo Putih --}}
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <polygon points="0 0, 95 0, 100 50, 95 100, 0 100" fill="{{ $white }}"/>
                <polyline points="0 0, 95 0, 100 50, 95 100, 0 100" stroke="#E0E0E0" stroke-width="0.5" fill="none"/>
            </svg>
            
            {{-- Konten Logo (E-Student) --}}
            <div class="absolute inset-0 p-4 flex items-center justify-center">
                <h2 class="text-xl font-extrabold text-{{ $darkBlue }} tracking-tighter">
                    <span class="text-3xl">E</span>-Student
                </h2>
            </div>
        </div>

        {{-- 2. BAGIAN INFO (Wadah KANAN - Biru Tua) --}}
        <div class="relative flex-grow min-w-0 z-10 -ml-1">
            
            {{-- SVG Background untuk Shape Info Biru Tua (Bentuk Poligon Utama) --}}
            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                {{-- Area Biru Tua Utama --}}
                <polygon points="0 0, 100 0, 100 100, 0 100" fill="{{ $darkBlue }}"/>

                {{-- Bentuk Tajam Biru Muda di Atas --}}
                <polygon points="0 0, 100 0, 90 20, 10 20" fill="{{ $lightBlue }}"/>
                
                {{-- Bentuk Tajam Biru Tua di Bawah --}}
                <polygon points="0 100, 100 100, 90 80, 10 80" fill="{{ $darkBlue }}" style="filter: brightness(80%);"/>
            </svg>
            
            {{-- Konten Info --}}
            <div class="absolute inset-0 p-3 pl-8 flex flex-col justify-center text-white">
                <p class="text-xs font-semibold uppercase text-gray-200">
                    Developed by 
                    <span class="text-{{ $lightBlue }} font-bold">LP3I College Karawang</span>
                </p>
                <p class="text-sm font-light text-gray-400 mt-0">
                    Copyright © 2025 | Version 4.0
                </p>
            </div>
        </div>
    </div>
</footer>