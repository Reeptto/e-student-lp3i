<x-app-layout>
    {{-- ========================================== --}}
    {{-- 1. KONFIGURASI STYLE & ANIMASI --}}
    {{-- ========================================== --}}
    <style>
        :root {
            --primary-teal: #009da5;
            --dark-teal: #007f86;
            --light-teal: #d8f3f4;
        }
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #cbd5e0; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #a0aec0; }

        /* Animasi Fade In Up */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-entry {
            opacity: 0; 
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
    </style>

    <x-slot name="header">
    </x-slot>

    <div class="min-h-screen bg-slate-50 pb-20 font-sans">
        
        {{-- ========================================== --}}
        {{-- 2. HERO SECTION --}}
        {{-- ========================================== --}}
        <div class="bg-[#009da5] pb-32 pt-12 rounded-b-[3.5rem] shadow-2xl relative overflow-hidden">
            <div class="absolute inset-0 z-0 pointer-events-none opacity-20">
                <svg width="100%" height="100%" viewBox="0 0 1440 600" preserveAspectRatio="xMidYMid slice" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1440 100 H1300 C1280 100 1260 120 1260 140 V200 C1260 220 1240 240 1220 240 H1100" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="1100" cy="240" r="4" fill="white"/>
                    <path d="M0 500 H100 C120 500 140 480 140 460 V400 C140 380 160 360 180 360 H250" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="250" cy="360" r="4" fill="white"/>
                    <path d="M600 600 V500 C600 480 620 460 640 460 H700 C720 460 740 440 740 420 V350" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="10 10"/>
                </svg>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-entry">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="text-center md:text-left">
                        <span class="px-3 py-1 bg-white/20 rounded-full text-xs font-semibold text-white mb-4 inline-block backdrop-blur-sm border border-white/10">
                            Tahun Akademik {{ date('Y') }}/{{ date('Y')+1 }}
                        </span>
                        <h2 class="text-white text-4xl md:text-5xl font-extrabold mb-3 tracking-tight leading-tight">
                            Pustaka <span class="text-[#d8f3f4]">Materi</span>
                        </h2>
                        <p class="text-teal-50 text-lg font-light max-w-lg mx-auto md:mx-0 leading-relaxed">
                            Akses modul dan referensi kuliah dalam satu tempat terintegrasi.
                        </p>
                    </div>
                    
                    <div class="w-full md:w-auto min-w-[300px]">
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-teal-200 group-focus-within:text-white transition-colors"></i>
                            </div>
                            <input type="text" class="block w-full pl-11 pr-4 py-3.5 bg-white/10 border border-white/20 rounded-2xl leading-5 text-white placeholder-teal-100 focus:outline-none focus:bg-white/20 focus:border-white/40 focus:placeholder-white focus:ring-0 transition-all duration-300 shadow-lg backdrop-blur-sm" placeholder="Cari materi kuliah...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- 3. MAIN CONTENT --}}
        {{-- ========================================== --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-20">
            
            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10 animate-entry delay-100">
                <div class="bg-white rounded-2xl p-5 shadow-lg shadow-teal-900/5 flex items-center space-x-4 border-b-4 border-[#009da5]">
                    <div class="p-3 bg-teal-50 rounded-xl text-[#009da5]">
                        <i class="fas fa-layer-group text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">Total Subjek</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_subject'] }} Matkul</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-lg shadow-teal-900/5 flex items-center space-x-4 border-b-4 border-teal-400">
                    <div class="p-3 bg-teal-50 rounded-xl text-teal-500">
                        <i class="fas fa-file-alt text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">Total Materi</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_materi'] }} Dokumen</p>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-lg shadow-teal-900/5 flex items-center space-x-4 border-b-4 border-orange-400">
                    <div class="p-3 bg-orange-50 rounded-xl text-orange-500">
                        <i class="fas fa-history text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-bold uppercase tracking-wide">Update Terakhir</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $stats['last_update'] }}</p>
                    </div>
                </div>
            </div>

            {{-- Grid Mata Kuliah --}}
            <div class=" gap-8 animate-entry delay-200">
                
                @foreach ($subjects as $subject)
                    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                        
                        {{-- Header Kartu (Trigger) --}}
                        <div class="p-6 cursor-pointer relative" onclick="toggleBooks('{{ $subject->id }}')" id="folder-{{ $subject->id }}">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#d8f3f4] to-[#b2ebf2] flex items-center justify-center text-[#009da5] shadow-inner group-hover:from-[#009da5] group-hover:to-[#007f86] group-hover:text-white transition-all duration-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 group-hover:text-[#009da5] transition-colors leading-tight">
                                            {{ $subject->nama_mk }}
                                        </h3>
                                        <p class="text-sm text-gray-500 mt-1 line-clamp-1">
                                            <span class="font-semibold text-[#009da5]">{{ $subject->kode_mk }}</span> • {{ $subject->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                                <div class="w-10 h-10 rounded-full bg-gray-50 border border-gray-100 flex items-center justify-center toggle-icon-wrapper transition-all duration-300 group-hover:border-[#009da5]">
                                    <i class="fas fa-chevron-down text-gray-400 toggle-icon text-sm"></i>
                                </div>
                            </div>

                            @php
                                $materiCount = $subject->materi->count();
                                $progress = $materiCount > 0 ? 100 : 0; 
                            @endphp
                            <div class="mt-2">
                                <div class="flex justify-between text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">
                                    <span>Ketersediaan Materi</span>
                                    <span>{{ $materiCount }} File</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="bg-[#009da5] h-1.5 rounded-full transition-all duration-1000 ease-out" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Isi Materi (Hidden) --}}
                        {{-- FIX: Menggunakan ID Unik 'content-ID' agar tidak bentrok --}}
                        <div id="content-{{ $subject->id }}" class="hidden bg-slate-50 border-t border-gray-100">
                            <div class="p-2">
                                @forelse ($subject->materi as $material)
                                    @php
                                        $type = $material->file_type; 
                                        $iconType = 'fa-file-alt'; 
                                        $colorClass = 'text-gray-500 bg-gray-100';
                                        
                                        if($type == 'pdf') { $iconType = 'fa-file-pdf'; $colorClass = 'text-red-500 bg-red-50'; }
                                        elseif($type == 'video') { $iconType = 'fa-play-circle'; $colorClass = 'text-purple-500 bg-purple-50'; }
                                        elseif($type == 'doc') { $iconType = 'fa-file-word'; $colorClass = 'text-blue-500 bg-blue-50'; }
                                        elseif($type == 'ppt') { $iconType = 'fa-file-powerpoint'; $colorClass = 'text-orange-500 bg-orange-50'; }
                                        elseif($type == 'link') { $iconType = 'fa-link'; $colorClass = 'text-teal-500 bg-teal-50'; }
                                    @endphp

                                    <div class="p-3 m-2 rounded-xl bg-white border border-gray-100 hover:border-[#009da5]/30 hover:shadow-md transition-all duration-200 cursor-pointer group-item flex items-center justify-between"
                                         onclick="viewMaterial(this)" data-url="{{ $material->file_url }}">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-10 h-10 rounded-lg {{ $colorClass }} flex items-center justify-center shrink-0">
                                                {{-- Ini akan muncul jika Font Awesome sudah diload di app.blade.php --}}
                                                <i class="fas {{ $iconType }} text-lg"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-700 text-sm group-item-hover:text-[#009da5] transition-colors">
                                                    {{ $material->nama_materi }}
                                                </h4>
                                                <p class="text-[11px] text-gray-400 font-medium uppercase tracking-wide mt-0.5">
                                                   Pertemuan Ke {{ $material->pertemuan }} • {{ $material->created_at?->format('d M Y') ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="opacity-0 group-item-hover:opacity-100 -translate-x-2 group-item-hover:translate-x-0 transition-all duration-200">
                                            <i class="fas fa-arrow-right text-[#009da5]"></i>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-gray-100 mb-3">
                                            <i class="fas fa-folder-open text-gray-300 text-xl"></i>
                                        </div>
                                        <p class="text-gray-400 text-xs font-medium">Belum ada materi</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 4. JAVASCRIPT LOGIC --}}
    @push('scripts')
    <script>
        // Toggle Books dengan perbaikan ID Selector
        window.toggleBooks = function(id) {
            // Kita cari elemen dengan prefix 'content-' untuk menghindari bentrok
            const content = document.getElementById('content-' + id);
            const folderHeader = document.getElementById('folder-' + id);
            
            if (!content) return;

            const iconWrapper = folderHeader.querySelector('.toggle-icon-wrapper');
            const icon = folderHeader.querySelector('.toggle-icon');

            if (content.classList.contains('hidden')) {
                // BUKA
                content.classList.remove('hidden');
                
                content.animate([
                    { opacity: 0, height: '0px', transform: 'scale(0.98)' },
                    { opacity: 1, height: content.scrollHeight + 'px', transform: 'scale(1)' }
                ], { duration: 300, easing: 'cubic-bezier(0.16, 1, 0.3, 1)' });

                iconWrapper.classList.add('bg-[#009da5]', 'border-[#009da5]', 'rotate-180');
                iconWrapper.classList.remove('bg-gray-50', 'border-gray-100');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-white');
            } else {
                // TUTUP
                content.classList.add('hidden');
                
                iconWrapper.classList.remove('bg-[#009da5]', 'border-[#009da5]', 'rotate-180');
                iconWrapper.classList.add('bg-gray-50', 'border-gray-100');
                icon.classList.add('text-gray-400');
                icon.classList.remove('text-white');
            }
        }

        window.viewMaterial = function(element) {
            const url = element.getAttribute('data-url');
            if (url) {
                element.style.transform = "scale(0.98)";
                setTimeout(() => {
                    element.style.transform = "scale(1)";
                    if (url !== '#') {
                        window.location.href = url;
                    } else {
                        console.log('File URL kosong atau invalid');
                    }
                }, 150);
            }
        }
    </script>
    @endpush
</x-app-layout>