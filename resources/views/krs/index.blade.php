<x-app-layout>
    
    {{-- Slot Header Breeze --}}
    <x-slot name="header">
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- HEADER: Menggunakan warna Teal (#009da5) --}}
            <div class="flex items-center bg-[#009da5] p-4 sm:rounded shadow-md relative overflow-hidden">
                {{-- Dekorasi Header --}}
                <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 rounded-full bg-white opacity-10"></div>
                <div class="absolute bottom-0 left-10 w-16 h-1 bg-white opacity-20 rotate-45"></div>

                <h1 class="text-2xl font-extrabold text-white leading-tight relative z-10">
                    {{ __('Menu KRS (Kartu Rencana Studi)') }}
                </h1>
            </div>
            <br>            

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-10 fade-zoom">
                
                {{-- Grid Kartu Semester --}}
                {{-- Mengubah grid menjadi 3 kolom agar pas untuk 6 semester --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    
                    @php
                        // Menambahkan Semester 5 dan 6
                        // Pola warna: Teal -> Biru -> Teal -> Biru -> Teal -> Biru
                        $semesters = [
                            ['num' => 1, 'color_from' => 'from-[#009da5]', 'color_to' => 'to-[#004296]', 'link' => route('krs.menu', 1)],
                            ['num' => 2, 'color_from' => 'from-[#004296]', 'color_to' => 'to-[#009da5]', 'link' => route('krs.menu', 2)],
                            ['num' => 3, 'color_from' => 'from-[#009da5]', 'color_to' => 'to-[#004296]', 'link' => route('krs.menu', 3)],
                            ['num' => 4, 'color_from' => 'from-[#004296]', 'color_to' => 'to-[#009da5]', 'link' => route('krs.menu', 4)],
                            ['num' => 5, 'color_from' => 'from-[#009da5]', 'color_to' => 'to-[#004296]', 'link' => route('krs.menu', 5)],
                            ['num' => 6, 'color_from' => 'from-[#004296]', 'color_to' => 'to-[#009da5]', 'link' => route('krs.menu', 6)],
                        ];
                    @endphp
                    
                    @foreach ($semesters as $sem)
                        {{-- Kartu Semester --}}
                        <a href="{{ $sem['link'] }}" class="relative group rounded-2xl p-8 h-48 flex flex-col items-center justify-center text-center 
                                                            bg-gradient-to-br {{ $sem['color_from'] }} {{ $sem['color_to'] }} text-white shadow-xl overflow-hidden
                                                            transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl hover:scale-105 border border-white/10">
                            
                            {{-- === POLA/PATTERN DEKORATIF (Meniru gaya gambar) === --}}
                            
                            {{-- 1. Kotak Outline Miring (Kiri Bawah) --}}
                            <div class="absolute -bottom-6 -left-6 w-24 h-24 border-4 border-white opacity-10 transform rotate-12 rounded-lg group-hover:rotate-45 transition-transform duration-700"></div>
                            
                            {{-- 2. Lingkaran Glow (Kanan Atas) --}}
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl group-hover:opacity-10 transition duration-500"></div>

                            {{-- 3. Titik-titik Geometris (Kiri Atas) --}}
                            <div class="absolute top-5 left-5 grid grid-cols-3 gap-1 opacity-20">
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                                <div class="w-1 h-1 bg-white rounded-full"></div>
                            </div>

                            {{-- 4. Garis Diagonal (Tengah Background) --}}
                            <div class="absolute top-1/2 left-1/2 w-full h-32 border-t border-white opacity-5 transform -translate-x-1/2 -translate-y-1/2 -rotate-45"></div>

                            {{-- === KONTEN UTAMA === --}}

                            {{-- Ikon Bintang --}}
                            <div class="absolute top-4 right-4 bg-yellow-300 rounded-full w-8 h-8 flex items-center justify-center shadow-md group-hover:animate-bounce text-black z-10">
                                ⭐
                            </div>
                            
                            {{-- Nomor Semester --}}
                            <div class="relative z-10 text-6xl font-extrabold mb-1 drop-shadow-lg font-mono">{{ $sem['num'] }}</div>
                            <div class="relative z-10 text-lg tracking-[0.2em] font-bold uppercase">{{ __('Semester') }}</div>
                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    
    @push('styles')
    <style>
        /* Background body disesuaikan */
        body {
            background: linear-gradient(135deg, #f0f9fa, #e0f2fe) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .fade-zoom {
            opacity: 0;
            transform: scale(0.95);
            animation: fadeZoom 0.6s ease forwards;
        }
        @keyframes fadeZoom {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
    @endpush
    
    @push('scripts')
    {{-- Scripts --}}
    @endpush
</x-app-layout>