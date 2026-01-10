@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(180deg, #f8fafc, #eef2f7);
    }

    /* ===== GLOBAL CARD ===== */
    .card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 8px 20px rgba(0,0,0,.04);
        overflow: hidden;
    }

    /* ===== HEADER ===== */
    .header-card {
        color: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(13,148,136,.35);
        position: relative;
        overflow: hidden;
    }
    
    .header-pattern {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        opacity: 0.1;
        background-image: radial-gradient(#ffffff 1px, transparent 1px);
        background-size: 20px 20px;
    }

    /* ===== JADWAL STYLES ===== */
    .jadwal-day {
        border-left: 5px solid #0d9488;
        background: linear-gradient(180deg, #ffffff, #f9fafb);
        transition: .25s ease;
        border: 1px solid #f1f5f9;
    }

    .jadwal-day:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,0,0,.06);
    }

    .jadwal-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        gap: 16px;
        align-items: center;
        transition: .2s;
        border: 1px solid #e5e7eb;
    }

    .jadwal-item:hover {
        background: #ecfeff;
        border-color: #5eead4;
    }

    .time-box {
        text-align: center;
        min-width: 64px;
        background: #0f766e;
        color: white;
        border-radius: 10px;
        padding: 6px 8px;
        font-weight: 700;
        box-shadow: inset 0 -3px 0 rgba(0,0,0,.15);
    }

    .time-box span {
        font-size: 11px;
        font-weight: 500;
        opacity: .85;
        display: block;
    }

    /* ===== ACCORDION / GORDEN ANIMATION ===== */
    .accordion-header {
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 24px;
        transition: background-color 0.2s;
    }
    
    .accordion-header:hover {
        background-color: #f8fafc;
    }

    .accordion-content {
        max-height: 2000px;
        opacity: 1;
        padding: 0 24px 24px 24px;
        transition: max-height 0.5s cubic-bezier(0.4, 0, 0.2, 1), 
                    opacity 0.4s ease, 
                    padding 0.4s ease;
        overflow: hidden;
    }

    .accordion-content.collapsed {
        max-height: 0;
        opacity: 0;
        padding-top: 0;
        padding-bottom: 0;
    }

    .chevron-icon {
        transition: transform 0.3s ease;
    }
    .chevron-icon.rotate {
        transform: rotate(180deg);
    }
</style>

<div class="max-w-6xl mx-auto space-y-8 py-10 px-6">

    {{-- ===== HEADER ===== --}}
    <div class="header-card bg-primary">
        <div class="header-pattern"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row justify-between gap-6 items-start">
            <div class="flex-1 max-w-2xl">
                <h1 class="text-3xl font-bold tracking-tight mb-3">
                    Halo, {{ auth()->user()->mahasiswa->nama }} 👋
                </h1>
                
                {{-- Paragraf Pengganti Detail --}}
                <p class="text-teal-50 text-sm leading-relaxed opacity-90">
                    Selamat datang di dashboard E-Student.</p>
            </div>

            <div class="hidden md:block text-right">
                <div class="bg-white/20 px-5 py-2 rounded-xl font-semibold text-sm inline-block backdrop-blur-md border border-white/20">
                    {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- ===== JADWAL KULIAH (ACCORDION) ===== --}}
    <div class="card">
        <div class="accordion-header" onclick="toggleSection('jadwalContent', 'jadwalIcon')">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Jadwal Kuliah
            </h2>
            <svg id="jadwalIcon" class="w-6 h-6 text-slate-400 chevron-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </div>

        <div id="jadwalContent" class="accordion-content">
            @if(count($jadwal) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    @foreach($jadwal as $hari => $items)
                        <div class="jadwal-day rounded-xl p-5">
                            <h3 class="font-bold text-teal-700 mb-4 uppercase tracking-wide text-sm border-b pb-2 border-slate-200">
                                {{ $hari }}
                            </h3>

                            <div class="space-y-3">
                                @foreach($items as $j)
                                    <div class="jadwal-item group">
                                        <div class="time-box group-hover:bg-teal-600 transition">
                                            {{ substr($j->jam_mulai, 0, 5) }}
                                            <span>s.d {{ substr($j->jam_selesai, 0, 5) }}</span>
                                        </div>

                                        <div class="flex-1 min-w-0"> 
                                            <div class="font-bold text-slate-800 text-sm leading-tight">
                                                {{ $j->matkul->nama_mk }}
                                            </div>
                                            <div class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                {{ $j->dosen->nama }}
                                            </div>
                                            <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                                {{ $j->ruangan->nama_ruangan }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-slate-50 rounded-lg border border-dashed border-slate-300">
                    <p class="text-slate-400 italic">Belum ada jadwal kuliah yang tersedia.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- ===== GRAFIK IPK (ACCORDION) ===== --}}
    <div class="card">
        <div class="accordion-header" onclick="toggleSection('grafikContent', 'grafikIcon')">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                Grafik Perkembangan Studi
            </h3>
            <svg id="grafikIcon" class="w-6 h-6 text-slate-400 chevron-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </div>

        <div id="grafikContent" class="accordion-content">
            <div class="h-64 w-full"> 
                <canvas id="ipkChart"></canvas>
            </div>
        </div>
    </div>
    
    <script>
        // Toggle Logic
        function toggleSection(contentId, iconId) {
            const content = document.getElementById(contentId);
            const icon = document.getElementById(iconId);
            content.classList.toggle('collapsed');
            if (content.classList.contains('collapsed')) {
                icon.classList.add('rotate');
            } else {
                icon.classList.remove('rotate');
            }
        }

        // Chart Logic
        const data = @json($graphData);
        const labels = data.map(d => d.label);
        const values = data.map(d => d.value);

        const ctx = document.getElementById('ipkChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(13, 148, 136, 0.5)'); 
        gradient.addColorStop(1, 'rgba(13, 148, 136, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Indeks Prestasi (IP)',
                    data: values,
                    borderWidth: 3,
                    borderColor: '#0d9488',
                    backgroundColor: gradient,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0f766e',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 0,
                        max: 4,
                        grid: { borderDash: [5, 5] }
                    },
                    x: {
                        grid: { display: false }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return 'IP: ' + context.parsed.y;
                            }
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection