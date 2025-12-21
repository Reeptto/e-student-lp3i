
<x-app-layout>
    
    {{-- Slot Header Breeze untuk Judul Halaman --}}
    <x-slot name="header">
        
    </x-slot>

    {{-- Main Content Container --}}
    
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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


             <h1 class="text-2xl font-semibold text-white leading-tight flex items-center">
            <i class="fas fa-book header-icon mr-3 text-3xl"></i>
            {{ __('Materi') }}
        </h1>
        </div><br>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
                {{-- --- Header Konten (Learning Materials) --- --}}
                <div class="content-header bg-indigo-500 text-white p-4 sm:p-5 rounded-t-lg font-bold text-xl flex justify-between items-center">
                    Learning Materials
                </div>
                
                {{-- --- Container Folder --- --}}
                <div class="folder-container p-4 sm:p-6 border border-gray-200 border-t-0 rounded-b-lg">
                    
                    @php
                        // Data Mata Kuliah Mockup
                        $subjects = [
                            'k3' => [
                                'name' => 'K3 & ISO', 
                                'materials' => [
                                    ['title' => 'K3 Introduction', 'desc' => 'Materi Keselamatan Kerja', 'url' => 'https://materi-k3.com/intro'],
                                    ['title' => 'Sertifikasi ISO', 'desc' => 'Panduan Standar Mutu', 'url' => 'https://materi-iso.com/sertifikasi'],
                                ]
                            ],
                            'sda' => [
                                'name' => 'System Design Analyst', 
                                'materials' => [
                                    ['title' => 'UML Diagrams', 'desc' => 'Tutorial Use Case', 'url' => 'https://sda-kelas.com/uml'],
                                    ['title' => 'Requirement Gathering', 'desc' => 'Wawancara & Observasi', 'url' => 'https://sda-kelas.com/req-gathering'],
                                    ['title' => 'Desain Antarmuka', 'desc' => 'Panduan Wireframing', 'url' => 'https://sda-kelas.com/ui-design'],
                                ]
                            ],
                            'mp' => ['name' => 'Mobile Programming', 'materials' => []],
                            'ns' => ['name' => 'Network Security', 'materials' => []],
                        ];
                    @endphp

                    @foreach ($subjects as $id => $subject)
                        {{-- Header Folder --}}
                        <div class="subject-folder bg-gray-100 p-4 rounded-lg mb-2 cursor-pointer transition duration-200 hover:bg-gray-200 flex justify-between items-center" 
                            id="folder-{{ $id }}" onclick="toggleBooks('{{ $id }}')">
                            <div class="folder-title flex items-center">
                                <i class="fas fa-folder text-indigo-600 text-lg mr-3"></i> 
                                <h3 class="text-lg text-indigo-700 font-semibold m-0">{{ $subject['name'] }}</h3>
                            </div>
                            <i class="fas fa-chevron-up toggle-icon text-indigo-600 text-lg transition duration-300"></i>
                        </div>
                        
                        {{-- Konten Buku (Default Tersembunyi) --}}
                        <div id="{{ $id }}" class="book-wrapper hidden pt-5 mt-2 border-t-2 border-dashed border-gray-200 gap-5 flex-wrap justify-start">
                            
                            @forelse ($subject['materials'] as $material)
                                <div class="material-card bg-white shadow-md p-4 w-full sm:max-w-[200px] flex-grow text-center rounded-lg relative overflow-hidden transition duration-300 hover:shadow-lg">
                                    <div class="book-icon-bg bg-indigo-600 w-24 h-24 rounded-full mx-auto mb-3 flex items-center justify-center">
                                        <i class="fas fa-book-reader text-white text-4xl"></i>
                                    </div>
                                    <h4 class="text-base font-semibold text-gray-800 m-0">{{ $material['title'] }}</h4>
                                    <p class="text-xs text-gray-500 m-0">{{ $material['desc'] }}</p>
                                    
                                    {{-- Overlay Hover View --}}
                                    <div class="view-overlay absolute inset-0 bg-indigo-500/90 flex items-center justify-center opacity-0 transition duration-300 rounded-lg">
                                        <button class="view-btn bg-transparent border-2 border-white text-white py-2 px-5 rounded-md font-semibold text-sm uppercase hover:bg-white hover:text-indigo-600" 
                                                onclick="viewMaterial(this)" data-url="{{ $material['url'] }}">
                                            <i class="fas fa-search mr-1"></i> VIEW
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 p-4">Tidak ada materi ditemukan untuk mata kuliah ini.</p>
                            @endforelse

                        </div> {{-- End book-wrapper --}}
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
    
    {{-- Menambahkan JavaScript di bagian akhir body --}}
    @push('scripts')
    <script>
        // FUNGSI JAVASCRIPT UNTUK MEMBUKA/MENUTUP FOLDER INDIVIDUAL
        window.toggleBooks = function(id) {
            const wrapper = document.getElementById(id); // Konten buku
            const folder = document.getElementById('folder-' + id); // Header folder
            
            // Toggle display: flex/none pada wrapper
            wrapper.classList.toggle('hidden');
            wrapper.classList.toggle('flex');
            
            // Toggle kelas 'active' pada folder header untuk rotasi ikon
            if (folder) {
                folder.classList.toggle('active');
                const icon = folder.querySelector('.toggle-icon');
                if (icon) {
                    // Rotasi ikon
                    icon.classList.toggle('fa-chevron-up');
                    icon.classList.toggle('fa-chevron-down');
                }
            }
        }

        // FUNGSI JAVASCRIPT UNTUK KLIK TOMBOL VIEW (Navigasi Berdasarkan data-url)
        window.viewMaterial = function(buttonElement) {
            const targetUrl = buttonElement.getAttribute('data-url');
            
            if (targetUrl && !targetUrl.includes('materi-')) { // Cek URL placeholder
                window.location.href = targetUrl;
            } else {
                alert(`Redirecting to: ${targetUrl}. (Ini adalah URL placeholder).`);
            }
        }
        
        // PENTING: Atur status default semua folder menjadi tertutup saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
             // Pastikan semua wrapper buku tersembunyi
             document.querySelectorAll('.book-wrapper').forEach(el => {
                 el.classList.add('hidden');
                 el.classList.remove('flex');
             });
             // Ubah ikon semua folder menjadi panah bawah (tertutup)
             document.querySelectorAll('.subject-folder .toggle-icon').forEach(icon => {
                 icon.classList.remove('fa-chevron-up');
                 icon.classList.add('fa-chevron-down');
             });
        });
    </script>
    @endpush
</x-app-layout>
