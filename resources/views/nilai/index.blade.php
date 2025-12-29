@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ activeTab: 'komponen' }">

   <form method="GET" class="mb-4">
     <label class="text-sm font-semibold text-gray-600">Semester</label>
        <select name="mk_id"
            onchange="this.form.submit()"
            class="px-4 block py-2 border rounded-lg">
            <option value="">Pilih Semester</option>
        </select>
    </form>

    <!-- HEADER PAGE -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>   
            <h1 class="text-2xl font-bold text-gray-900">Nilai Akademik</h1>
        </div>
        
        <div class="mt-4 md:mt-0 bg-gray-100 p-1 rounded-lg inline-flex">
            <button 
                @click="activeTab = 'komponen'"
                :class="activeTab === 'komponen' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 focus:outline-none">
                Detail Komponen
            </button>
            <button 
                @click="activeTab = 'khs'"
                :class="activeTab === 'khs' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-500 hover:text-gray-700'"
                class="px-6 py-2 rounded-md text-sm font-medium transition-all duration-200 focus:outline-none">
                Kartu Hasil Studi (KHS)
            </button>
        </div>
    </div>

     <div x-show="activeTab === 'komponen'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="space-y-6">
        @forelse ($nilai as $item)
   

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300" x-data="{ expanded: false }">
            
            <div @click="expanded = !expanded" class="p-5 cursor-pointer flex justify-between items-center bg-gray-50/50">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 font-bold p-3 rounded-lg text-center min-w-[60px]">
                        <div class="text-sm font-medium text-blue-800">{{ $item->matkul->nama_mk }}</div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-800">  </h3>
                        <p class="text-sm font-medium text-blue-800">SKS: {{ $item->matkul->sks }}</p>
                    </div>

                    <div class="bg-blue-100 text-blue-600 font-bold p-3 rounded-lg text-center min-w-[60px]">
                        <div class="text-sm font-medium text-blue-800">Grade: {{ $item->grade }}</div>
                    </div>
                    
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <span class="block text-sm text-gray-500">Total Nilai</span>
                        <span class="block text-xl font-bold text-gray-900">{{ $item->nilai_akhir }}</span>
                    </div>
                    <!-- Chevron Icon -->
                    <svg :class="expanded ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <!-- Body Card (Isi Detail Komponen) -->
            <div x-show="expanded" x-collapse class="border-t border-gray-100 bg-white p-5">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                
                    <!-- Kehadiran -->
                    <div class="bg-blue-50 p-3 rounded-lg text-center">
                        <span class="text-xs text-gray-900 font-bold block">Kehadiran</span>
                        <span class="text-xl text-gray-500 font-bold block">{{ $item->kehadiran }}</span>
                    </div>
                    <!-- Attitude -->
                    <div class="bg-purple-50 p-3 rounded-lg text-center">
                        <span class="text-xs text-gray-500 block">Attitude</span>
                        <span class="text-xl text-gray-500 font-bold block">{{ $item->attitude }}</span>
                    </div>
                    <!-- Tugas -->
                    <div class="bg-orange-50 p-3 rounded-lg text-center">
                        <span class="text-xs text-gray-500 block">Rata-rata Tugas</span>
                        <span class="font-bold block text-xl text-orange-700">{{ $item->nilai_tugas }}</span>
                    </div>
                    <!-- Quiz -->
                    <div class="bg-pink-50 p-3 rounded-lg text-center">
                        <span class="text-xs text-gray-500 block">Formative/Quiz</span>
                        <span class="font-bold block text-xl text-pink-700">{{ $item->nilai_formative }}</span>
                    </div>
                </div>
                <!-- Progress Bar untuk Ujian Besar -->
                <div class="grid grid-cols-1 md:grid-cols-2 rounded gap-6 mt-4">
                    <div>
                        <div class="flex justify-between bg-green-400 px-4 py-2 rounded-lg text-sm mb-1">
                            <span class="text-gray-800 font-bold">UTS (Ujian Tengah Semester)</span>
                            <span class="font-bold block text-xl text-green-900">{{ $item->nilai_uts }}</span>
                        </div>
                        
                    </div>
                    <div>
                        <div class="flex justify-between bg-yellow-400 px-4 py-2 rounded text-sm mb-1">
                            <span class="text-gray-800 font-bold">UAS (Ujian Akhir Semester)</span>
                            <span class="font-bold block text-xl ltext-gray-900">{{ $item->nilai_uas }}</span>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>

        @empty
        <div class="bg-pink-50 p-3 rounded-lg text-center">
            <span class="text-xs text-gray-500 block">Maaf Nilai Belum Tersedia</span>
        </div>
        @endforelse
    </div>

    <div x-show="activeTab === 'khs'" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         style="display: none;">
        
        <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 p-6 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-2 text-sm text-gray-700">
                        <div class="flex gap-2"><span class="w-24 font-semibold">Nama</span>:   </div>
                        <div class="flex gap-2"><span class="w-24 font-semibold">NIM</span>:   </div>
                        <div class="flex gap-2"><span class="w-24 font-semibold">Prodi</span>:   </div>
                        <div class="flex gap-2"><span class="w-24 font-semibold">Tahun Ajaran</span>: 2024/2025 Ganjil</div>
                    </div>
                    <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-3 py-1.5 rounded text-xs font-medium shadow-sm transition">
                        🖨️ Cetak KHS
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kode MK</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">SKS (K)</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Nilai (N)</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Bobot (B)</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">K x B</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">  </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">  </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                      
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">  </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-bold">  </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">Total</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900">  </td>
                            <td colspan="2" class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">Total K x B</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-900">  </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="p-6 bg-blue-50 border-t border-blue-100">
                <div class="flex justify-end gap-8">
                    <div class="text-right">
                        <span class="text-xs uppercase text-gray-500 font-semibold tracking-wider">Indeks Prestasi (IP)</span>
                        <div class="text-3xl font-bold text-blue-700"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
