<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Student | Transkrip Nilai</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js untuk interaksi klik -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-primary { background-color: #2563eb; }
        .text-primary { color: #2563eb; }
        .bg-secondary { background-color: #0d9488; }
        .text-secondary { color: #0d9488; }
        .border-secondary { border-color: #0d9488; }
        .accent-gradient { background: linear-gradient(135deg, #2563eb 0%, #0d9488 100%); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen p-4 md:p-8">

    <div class="max-w-6xl mx-auto" x-data="{ openSemester: null }">
        <!-- Header Section -->
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-bold text-gray-800">Transkrip Nilai Mahasiswa</h1>
            <p class="text-gray-500 mt-1">Pilih semester untuk melihat rincian nilai akademik kamu.</p>
        </div>

        <!-- Semester Folders List -->
        <div class="space-y-4">
            @foreach(range(1, 6) as $semester)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all">
                
                <!-- Semester Header (Folder Label) -->
                <button 
                    @click="openSemester = (openSemester === {{ $semester }} ? null : {{ $semester }})"
                    class="w-full flex items-center justify-between p-5 md:p-6 hover:bg-gray-50 transition-colors group"
                >
                    <div class="flex items-center gap-4">
                        <!-- Folder Icon / Badge -->
                        <div 
                            class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-xl shadow-md transition-all group-hover:scale-110"
                            :class="openSemester === {{ $semester }} ? 'accent-gradient text-white' : 'bg-gray-100 text-gray-500'"
                        >
                            {{ $semester }}
                        </div>
                        <div class="text-left">
                            <h2 class="text-lg font-bold text-gray-800">Semester {{ $semester }}</h2>
                            <p class="text-xs text-gray-400 font-medium">Tahun Akademik {{ 2021 + floor(($semester-1)/2) }}/{{ 2022 + floor(($semester-1)/2) }}</p>
                        </div>
                    </div>

                    <!-- Status & Arrow -->
                    <div class="flex items-center gap-3">
                        <span 
                            class="hidden md:inline-block text-xs font-semibold px-3 py-1 rounded-full border"
                            :class="openSemester === {{ $semester }} ? 'border-secondary text-secondary' : 'border-gray-200 text-gray-400'"
                        >
                            <span x-text="openSemester === {{ $semester }} ? 'Tutup' : 'Lihat Nilai'"></span>
                        </span>
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            class="h-5 w-5 text-gray-400 transition-transform duration-300" 
                            :class="openSemester === {{ $semester }} ? 'rotate-180 text-secondary' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </button>

                <!-- Nilai Component (Collapsible Content) -->
                <div 
                    x-show="openSemester === {{ $semester }}" 
                    x-collapse
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform -translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="border-t border-gray-100"
                >
                    <div class="p-6">
                        <div class="overflow-x-auto rounded-xl border border-gray-100">
                            <table class="w-full text-left border-collapse">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Mata Kuliah</th>
                                        <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase text-center">Tugas</th>
                                        <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase text-center">Formative</th>
                                        <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase text-center">UTS</th>
                                        <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase text-center">UAS</th>
                                        <th class="px-4 py-4 text-xs font-bold text-gray-500 uppercase text-center">Kumulatif</th>
                                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Mutu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @php
                                        // Contoh data statis. Nanti ganti dengan data dari controller.
                                        $sampleData = [
                                            ['mk' => 'Dasar Pemrograman', 't' => 85, 'f' => 80, 'uts' => 78, 'uas' => 90, 'k' => 83.5, 'm' => 'A'],
                                            ['mk' => 'Algoritma & Struktur Data', 't' => 88, 'f' => 82, 'uts' => 80, 'uas' => 85, 'k' => 83.8, 'm' => 'A-'],
                                            ['mk' => 'Matematika Diskrit', 't' => 75, 'f' => 70, 'uts' => 85, 'uas' => 80, 'k' => 77.5, 'm' => 'B+'],
                                        ];
                                    @endphp

                                    @foreach($sampleData as $item)
                                    <tr class="hover:bg-blue-50/20 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-800">{{ $item['mk'] }}</div>
                                            <div class="text-xs text-gray-400">MK-00{{ $loop->iteration }}</div>
                                        </td>
                                        <td class="px-4 py-4 text-center text-gray-600 font-medium">{{ $item['t'] }}</td>
                                        <td class="px-4 py-4 text-center text-gray-600 font-medium">{{ $item['f'] }}</td>
                                        <td class="px-4 py-4 text-center text-gray-600 font-medium">{{ $item['uts'] }}</td>
                                        <td class="px-4 py-4 text-center text-gray-600 font-medium">{{ $item['uas'] }}</td>
                                        <td class="px-4 py-4 text-center">
                                            <span class="inline-block bg-blue-100 text-primary px-3 py-1 rounded-full text-sm font-bold">
                                                {{ $item['k'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="text-xl font-black {{ in_array($item['m'], ['A', 'A-']) ? 'text-green-600' : 'text-secondary' }}">
                                                {{ $item['m'] }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Semester Stats Summary -->
                        <div class="mt-4 flex flex-wrap justify-end gap-4 text-sm bg-gray-50 p-4 rounded-xl">
                            <div class="flex items-center gap-2">
                                <span class="text-gray-400">IP Semester:</span>
                                <span class="font-bold text-gray-800">3.50</span>
                            </div>
                            <div class="flex items-center gap-2 border-l pl-4 border-gray-200">
                                <span class="text-gray-400">Total SKS:</span>
                                <span class="font-bold text-gray-800">20 SKS</span>
                            </div>
                            <button class="ml-4 flex items-center gap-1 text-secondary font-bold hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak KHS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Final Footer Information -->
        <div class="mt-16 pt-8 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-6 pb-12">
            <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <div class="p-3 bg-primary/10 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800">Data Terverifikasi</p>
                    <p class="text-xs text-gray-400">Terakhir diperbarui: {{ date('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <button class="group bg-primary hover:bg-blue-700 text-white px-8 py-4 rounded-2xl font-bold transition shadow-lg flex items-center gap-3">
                <span>Cetak Transkrip Lengkap</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </div>

</body>
</html>