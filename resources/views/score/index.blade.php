<x-app-layout>
    
    {{-- Slot Header Breeze untuk Judul Halaman --}}
    <x-slot name="header">
       
    </x-slot>

    {{-- Main Content Container --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center bg-[#4b2aad] p-4 sm:rounded ">
             {{-- INI TOMBOL TOGGLE-nya --}}
             <button 
    @click="isSidebarOpen = !isSidebarOpen" 
    class="text-white hover:text-gray-900 focus:outline-none p-2 mr-4"
>

    <!-- ICON KETIKA SIDEBAR TERTUTUP (MENU ICON) -->
    <template x-if="!isSidebarOpen">
        <svg 
            xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 21 21" 
            fill="none" 
            stroke="white"
            stroke-linecap="round" 
            stroke-linejoin="round"
            class="w-10 h-10"
        >
            <!-- garis menu -->
            <path d="M7.5 6 H15.5" />
            <path d="M7.5 10 H12.5" />
            <path d="M7.5 14 H15.5" />

            <!-- bullet -->
            <circle cx="4.5" cy="6" r="1" fill="white" />
            <circle cx="4.5" cy="10" r="1" fill="white" />
            <circle cx="4.5" cy="14" r="1" fill="white" />
        </svg>
    </template>

    <!-- ICON KETIKA SIDEBAR TERBUKA (ARROW LEFT) -->
    <template x-if="isSidebarOpen">
        <svg 
            xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="white"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="w-10 h-10"
        >
            <path d="M15 6 L9 12 L15 18" />
        </svg>
    </template>

</button>


              <h1 class="text-2xl font-bold text-indigo-600 leading-tight">
            {{ __('Scores') }}
        </h1></div><br>            

            <div class="scores-container bg-white rounded-xl shadow-xl p-4 sm:p-6">
                
                <h1 class="text-3xl font-bold text-indigo-600 border-b-2 border-gray-200 pb-3 mb-6">Scores</h1>

                {{-- Data Semester Mockup --}}
                @php
                    $semesters = ['1 SEMESTER', '2 SEMESTER', '3 SEMESTER'];
                    
                    $reports = [
                        [
                            'id' => 'component',
                            'title' => 'Component Scores',
                            'bg_color' => 'bg-purple-700', // Dibuat custom untuk mendekati #8A2BE2
                            'button_class' => 'detail-button bg-yellow-300 text-gray-800 border-yellow-300 hover:bg-transparent hover:text-gray-800',
                            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#fde047" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 14.66v1.626a2 2 0 0 1-.976 1.696A5 5 0 0 0 7 21.978"/><path d="M14 14.66v1.626a2 2 0 0 0 .976 1.696A5 5 0 0 1 17 21.978"/><path d="M18 9h1.5a1 1 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M6 9a6 6 0 0 0 12 0V3a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1z"/><path d="M6 9H4.5a1 1 0 0 1 0-5H6"/></svg>',
                            'detail_route' => 'scores.detail',
                        ],
                        [
                            'id' => 'khs',
                            'title' => 'Study Result Card (KHS)',
                            'bg_color' => 'bg-red-600',
                            'button_class' => 'detail2-button bg-pink-500 text-white border-pink-500 hover:bg-transparent hover:text-red-700',
                            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
                            'detail_route' => 'khs.detail',
                        ],
                        [
                            'id' => 'summary',
                            'title' => 'Summary Of Academic Profile Data',
                            'bg_color' => 'bg-blue-500',
                            'button_class' => 'detail3-button bg-indigo-500 text-white border-indigo-500 hover:bg-transparent hover:text-indigo-500',
                            'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white"><path d="M21.42 10.922a1 1 1 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/></svg>',
                            'detail_route' => 'summary.detail',
                        ],
                    ];
                @endphp

                {{-- Looping untuk menampilkan setiap kartu laporan nilai --}}
                @foreach ($reports as $report)
                    <div class="header-box {{ $report['bg_color'] }} text-white px-5 py-3 flex flex-wrap justify-between items-center rounded-t-lg font-bold mt-6 cursor-pointer" onclick="toggleCollapse('{{ $report['id'] }}', this)">
                        <div class="header-title flex items-center gap-3">
                            {!! $report['icon_svg'] !!} {{-- Menggunakan {!! !!} untuk SVG HTML --}}
                            {{ $report['title'] }}
                        </div>
                        <button class="collapse-btn" data-target="{{ $report['id'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </div>

                    <div class="semester-list-container transition-all duration-500 ease-in-out" id="{{ $report['id'] }}">
                        @if ($report['id'] == 'summary')
                            <div class="semester-row flex justify-between items-center py-4 border-b border-gray-100 last:border-b-0">
                                <span>Academic Scores Profile Data</span>
                                <a href="{{ route('score.index'], ['type' => 'academic-profile']) }}" class="{{ $report['button_class'] }} text-sm">Detail</a>
                            </div>
                        @else
                            @foreach ($semesters as $semester)
                                <div class="semester-row flex justify-between items-center py-4 border-b border-gray-100 last:border-b-0">
                                    <span>{{ $semester }}</span>
                                    {{-- Mengarahkan ke route detail dengan parameter semester --}}
                                    <a href="{{ route('score.index'], ['semester' => explode(' ', $semester)[0]]) }}" class="{{ $report['button_class'] }} text-sm">Detail</a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{-- Memasukkan CSS Kustom dan JavaScript --}}
    @push('styles')
    <style>
        /* CSS Tambahan untuk transition collapse */
        .semester-list-container {
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-height: 0;
            /* Kita gunakan cubic-bezier dari kode asli untuk smooth collapse */
            transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), padding 0.3s ease; 
        }

        .semester-list-container.open {
            max-height: 600px; /* Nilai besar agar konten pasti termuat */
            padding-bottom: 15px;
        }
        
        /* Rotasi Ikon */
        .collapse-btn.open svg {
             transform: rotate(180deg);
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // FUNGSI JAVASCRIPT UNTUK COLLAPSE
        window.toggleCollapse = function(targetId, buttonElement) {
            const target = document.getElementById(targetId);
            const btn = buttonElement.querySelector('.collapse-btn') || buttonElement;
            
            // Toggle kelas 'open' pada tombol dan target konten
            btn.classList.toggle("open");
            target.classList.toggle("open");

            // Logika untuk mengatur max-height (agar transisi CSS berjalan halus)
            if (target.classList.contains("open")) {
                // Buka: Atur max-height ke scrollHeight agar transisi terlihat penuh
                target.style.maxHeight = target.scrollHeight + "px";
            } else {
                // Tutup: Kembalikan max-height ke 0
                target.style.maxHeight = '0';
            }
        };

        // PENTING: Inisialisasi status awal saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            // Tutup semua container secara default
            document.querySelectorAll(".semester-list-container").forEach(container => {
                container.style.maxHeight = '0';
                container.classList.remove('open');
            });
            // Hapus rotasi ikon awal
            document.querySelectorAll(".collapse-btn").forEach(btn => {
                btn.classList.remove('open');
            });
        });

        // Hubungkan kembali event listener ke tombol (jika ada tombol terpisah)
        document.querySelectorAll(".collapse-btn").forEach(btn => {
             // Pastikan klik pada tombol juga memicu toggle (untuk kompatibilitas)
             btn.addEventListener("click", () => {
                 const target = document.getElementById(btn.dataset.target);
                 window.toggleCollapse(btn.dataset.target, btn.closest('.header-box'));
             });
        });
    </script>
    @endpush
</x-app-layout>