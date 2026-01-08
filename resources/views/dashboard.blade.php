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
    }

    /* ===== HEADER ===== */
    .header-card {
        background: linear-gradient(135deg, #0f766e, #0d9488);
        color: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(13,148,136,.35);
    }

    /* ===== SECTION TITLE ===== */
    .section-title {
        font-weight: 800;
        color: #0f172a;
        letter-spacing: .3px;
        border-left: 6px solid #0d9488;
        padding-left: 12px;
    }

    /* ===== JADWAL CARD ===== */
    .jadwal-day {
        border-left: 5px solid #0d9488;
        background: linear-gradient(180deg, #ffffff, #f9fafb);
        transition: .25s ease;
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
    }

    .matkul-title {
        font-weight: 800;
        color: #0f172a;
    }

    .meta {
        font-size: 12px;
        color: #475569;
        margin-top: 2px;
    }

    /* ===== EMPTY STATE ===== */
    .empty-state {
        text-align: center;
        padding: 60px;
        color: #94a3b8;
        font-style: italic;
    }
</style>

<div class="max-w-6xl mx-auto space-y-10 py-10 px-6">

    {{-- ===== HEADER ===== --}}
    <div class="header-card flex flex-col md:flex-row justify-between gap-6 items-start md:items-center">
        <div>
            <h1 class="text-2xl font-semibold tracking-wide">
                Selamat Datang, {{ auth()->user()->mahasiswa->nama }}
            </h1>
            <p class="text-sm opacity-90 mt-1">
                Ringkasan jadwal dan progres akademik kamu
            </p>
        </div>

        <div class="bg-white/20 px-4 py-2 rounded-xl font-semibold text-sm">
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- ===== JADWAL ===== --}}
    <div class="card p-6">
        <h2 class="text-lg font-semibold mb-6">
            Jadwal Kuliah
        </h2>

        @if(count($jadwal) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($jadwal as $hari => $items)
                    <div class="jadwal-day rounded-xl p-5">
                        <h3 class="font-bold text-slate-700 mb-4 uppercase tracking-wide">
                            {{ $hari }}
                        </h3>

                        <div class="space-y-3">
                            @foreach($items as $j)
                                <div class="jadwal-item">
                                    <div class="time-box">
                                        {{ substr($j->jam_mulai, 0, 5) }}
                                        <span>{{ substr($j->jam_selesai, 0, 5) }}</span>
                                    </div>

                                    <div class="flex-1">
                                        <div class="matkul-title">
                                            {{ $j->matkul->nama_mk }}
                                        </div>
                                        <div class="meta">
                                            {{ $j->dosen->nama }} • {{ $j->ruangan->nama_ruangan }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                Tidak ada jadwal kuliah
            </div>
        @endif
    </div>

    {{-- ===== IPK GRAPH (PAKAI PUNYAMU, UDAH KEREN) ===== --}}
    <div class="bg-white border border-slate-200 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-slate-800 mb-4">
            Grafik IP Semester
        </h3>

        <canvas id="ipkChart" height="120"></canvas>
    </div>
    
    <script>
        const data = @json($graphData);

        const labels = data.map(d => d.label);
        const values = data.map(d => d.value);

        new Chart(document.getElementById('ipkChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'IP Semester',
                    data: values,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                scales: {
                    y: {
                        min: 0,
                        max: 4
                    }
                }
            }
        });
    </script>
</div>
@endsection
