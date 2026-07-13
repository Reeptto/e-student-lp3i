<x-app-layout>

@php
    $hour = now()->hour;
    if ($hour >= 0 && $hour < 11) {
        $greeting = 'SELAMAT PAGI';
    } elseif ($hour >= 11 && $hour < 15) {
        $greeting = 'SELAMAT SIANG';
    } elseif ($hour >= 15 && $hour < 18) {
        $greeting = 'SELAMAT SORE';
    } else {
        $greeting = 'SELAMAT MALAM';
    }
@endphp

{{-- Chart.js dimuat hanya di halaman dashboard ini --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="max-w-6xl mx-auto space-y-8 py-8 px-4 sm:px-6">

    <div class="header-wrapper">
        
        <div class="bg-shape-dark"></div>
        <div class="bg-shape-bar"></div>
        <div class="bg-shape-line"></div>
        <div class="bg-shape-dots"></div>

        <div class="header-inner">
            
            <div class="header-left">
                <div class="mb-3">
                    <svg class="w-10 h-10 text-[#004269]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
                    </svg>
                </div>
                <h2 class="text-sm font-bold text-slate-400 tracking-[0.2em] uppercase mb-1">
                    ACADEMIC DASHBOARD
                </h2>
                <h1 class="text-3xl font-black text-[#004269] uppercase tracking-tight">
                    <div class="text-xl font-bold tracking-tight drop-shadow-sm text-white">
                        <span class="text-primary">E |</span> <span class="text-primary">Student</span>
                    </div>
                </h1>
            </div>

            <div class="header-right">
                <div class="text-xl md:text-2xl font-black text-white opacity-20 mb-1 uppercase">
                    {{ $greeting }}
                </div>

                <h1 class="text-2xl font-bold uppercase leading-tight mb-2">
                    HALO, <br>
                    <span class="text-[#8ecae6]">{{ auth()->user()->mahasiswa->nama_mhs ?? 'MAHASISWA' }}</span>
                </h1>

                <p class="text-xs text-slate-300 font-medium uppercase tracking-wider mb-4">
                    Informasi akademik terkini tersedia di sini
                </p>

                <div class="border-t-2 border-white/20 pt-3 inline-block w-full text-right">
                    <span class="text-xs font-bold text-[#8ecae6] mr-2">DATE:</span>
                    <span class="text-sm font-semibold">{{ now()->translatedFormat('d F Y') }}</span>
                </div>
            </div>

        </div>
    </div>

    <div class="card" x-data="{ 
            currentPage: 0,
            totalItems: {{ isset($jadwal) ? count($jadwal) : 0 }},
            perPage: 2,
            get totalPages() { return Math.ceil(this.totalItems / this.perPage) - 1; },
            nextPage() { if (this.currentPage < this.totalPages) this.currentPage++; },
            prevPage() { if (this.currentPage > 0) this.currentPage--; }
        }">
        
        <div class="accordion-header flex justify-between items-center" onclick="toggleSection('jadwalContent', 'jadwalIcon')">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-[#004269]/5 flex items-center justify-center text-[#004269]">
                    <i class="far fa-clock text-lg"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Jadwal Kuliah</h2>
                    <p class="text-xs text-slate-500 font-medium">
                        Klik untuk melihat detail
                    </p>
                </div>
            </div>
            
            <svg id="jadwalIcon" class="w-5 h-5 text-slate-400 chevron-icon cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </div>

        <div id="jadwalContent" class="accordion-content">
            @if(isset($jadwal) && count($jadwal) > 0)
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-4 pb-4 min-h-[200px]">
                    @php $index = 0; @endphp
                    @foreach($jadwal as $hari => $items)
                        <div x-show="Math.floor({{ $index }} / perPage) === currentPage"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-x-2"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            class="jadwal-day rounded-xl p-5 bg-white group h-full shadow-sm hover:shadow-md border border-slate-100 flex flex-col">
                            
                            <div class="flex items-center justify-between mb-4 border-b border-gray-100 pb-3">
                                <h3 class="font-bold text-[#004269] text-sm uppercase tracking-wider flex items-center gap-2">
                                    <i class="far fa-calendar-check"></i> {{ $hari }}
                                </h3>
                                <span class="text-[10px] font-bold bg-[#004269]/10 text-[#004269] px-2 py-1 rounded">
                                    {{ count($items) }} Sesi
                                </span>
                            </div>

                            <div class="space-y-4 flex-1">
                                @foreach($items as $j)
                                    <div class="flex gap-4 items-stretch">
                                        <div class="time-badge">
                                            <span class="text-base font-extrabold leading-none">{{ substr($j->jam_mulai, 0, 5) }}</span>
                                            <div class="w-6 h-px bg-slate-200 my-1"></div>
                                            <span class="text-xs font-bold text-slate-500 leading-none">{{ substr($j->jam_selesai, 0, 5) }}</span>
                                        </div>

                                        <div class="flex-1 py-1">
                                            <h4 class="font-bold text-slate-800 text-sm mb-1.5 leading-snug">
                                                {{ $j->matkul->nama_mk }}
                                            </h4>
                                            <div class="space-y-1">
                                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                                    <i class="far fa-user text-slate-400 w-3.5 text-center"></i>
                                                    <span class="truncate">{{ $j->dosen->nama_pendidik }}</span>
                                                </div>
                                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                                    <i class="far fa-building text-slate-400 w-3.5 text-center"></i>
                                                    <span>{{ $j->ruangan->nama_ruangan }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @php $index++; @endphp
                    @endforeach
                </div>

                <div class="flex items-center justify-between border-t border-slate-100 pt-4 mt-2 pb-2">
                    <p class="text-xs text-slate-400 font-medium">
                        Menampilkan Halaman <span x-text="currentPage + 1" class="font-bold text-[#004269]"></span> dari <span x-text="totalPages + 1"></span>
                    </p>

                    <div class="flex items-center gap-2">
                        <button 
                            @click="prevPage()" 
                            :disabled="currentPage === 0"
                            :class="currentPage === 0 ? 'bg-slate-50 text-slate-300 cursor-not-allowed' : 'bg-white text-[#004269] hover:bg-slate-50 border-slate-200 shadow-sm'"
                            class="px-4 py-2 rounded-lg border text-xs font-bold flex items-center gap-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Prev
                        </button>

                        <button 
                            @click="nextPage()" 
                            :disabled="currentPage === totalPages"
                            :class="currentPage === totalPages ? 'bg-slate-50 text-slate-300 cursor-not-allowed' : 'bg-[#004269] text-white hover:bg-[#042d45] shadow-md shadow-blue-900/20'"
                            class="px-4 py-2 rounded-lg text-xs font-bold flex items-center gap-2 transition-all">
                            Next
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

            @else
                <div class="py-10 text-center">
                    <p class="text-slate-500 text-sm">Tidak ada jadwal kuliah hari ini.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- SECTION 2: GRAFIK --}}
    <div class="card">
        <div class="accordion-header flex justify-between items-center" onclick="toggleSection('grafikContent', 'grafikIcon')">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-[#004269]/10 flex items-center justify-center text-[#004269]">
                    <i class="fas fa-chart-line text-lg"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800">Perkembangan Studi</h3>
                    <p class="text-xs text-slate-500 font-medium">Grafik Indeks Prestasi (IP)</p>
                </div>
            </div>
            <svg id="grafikIcon" class="w-5 h-5 text-slate-400 chevron-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </div>

        <div id="grafikContent" class="accordion-content">
            <div class="h-72 w-full pt-4">
                <canvas id="ipkChart"></canvas>
            </div>
        </div>
    </div>

</div>

<script>
    function toggleSection(contentId, iconId) {
        const content = document.getElementById(contentId);
        const icon = document.getElementById(iconId);
        content.classList.toggle('collapsed');
        icon.classList.toggle('rotate');
    }

    const data = @json($graphData ?? []);
    const labels = data.length ? data.map(d => d.label) : ['Smt 1', 'Smt 2', 'Smt 3', 'Smt 4'];
    const values = data.length ? data.map(d => d.value) : [0, 0, 0, 0];

    const ctx = document.getElementById('ipkChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(0, 66, 105, 0.2)');
    gradient.addColorStop(1, 'rgba(0, 66, 105, 0.0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Indeks Prestasi',
                data: values,
                borderWidth: 2,
                borderColor: '#004269',
                backgroundColor: gradient,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#004269',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { min: 0, max: 4, grid: { borderDash: [4, 4], color: '#f1f5f9' }, ticks: { font: { family: 'Poppins', size: 11 } } },
                x: { grid: { display: false }, ticks: { font: { family: 'Poppins', size: 11 } } }
            },
            plugins: { legend: { display: false } }
        }
    });
</script>
</x-app-layout>