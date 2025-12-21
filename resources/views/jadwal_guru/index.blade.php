<x-app-layout>
    
    {{-- Slot Header Breeze untuk Judul Halaman --}}
    <x-slot name="header">
        
    </x-slot>

    {{-- Main Content Container --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center bg-pink-500 p-4 sm:rounded ">
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
            <i class="fas fa-calendar-alt mr-2 text-3xl"></i> 
            {{ __('Schedule / Lecturer Schedule') }}
        </h1></div><br>            

            {{-- Form Box (Ungu) --}}
            <div class="form-box bg-indigo-600 p-0 rounded-xl shadow-2xl overflow-hidden">
                
                {{-- Tombol Collapse di ujung atas --}}
                <div class="collapse-toggle flex justify-end items-center p-3 sm:p-4 cursor-pointer hover:bg-indigo-700 transition duration-150" id="collapseBtn">
                    <i class="fas fa-chevron-down text-white text-xl transition duration-400 ease-in-out"></i>
                </div>

                {{-- Konten Form --}}
                <div class="form-content p-6 sm:p-8" id="formContent">
                    <form action="#" method="GET"> {{-- Ganti action URL sesuai kebutuhan --}}
                        <div class="form-row flex flex-wrap gap-6 sm:gap-8 mb-6">
                            
                            {{-- Group Semester --}}
                            <div class="form-group flex-1 min-w-[250px]">
                                <label for="semester-select" class="block mb-2 font-semibold text-lg text-white">Semester</label>
                                <select id="semester-select" name="semester" 
                                    class="form-control w-full p-3 sm:p-4 border-2 border-pink-400 rounded-lg bg-white text-indigo-700 text-base appearance-none cursor-pointer focus:ring-pink-500 focus:border-pink-500 transition duration-300">
                                    <option value="" disabled selected>-- Choose Semester --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                            {{-- Group Subject --}}
                            <div class="form-group flex-1 min-w-[250px]">
                                <label for="subject-select" class="block mb-2 font-semibold text-lg text-white">Subject</label>
                                <select id="subject-select" name="subject"
                                    class="form-control w-full p-3 sm:p-4 border-2 border-pink-400 rounded-lg bg-white text-indigo-700 text-base appearance-none cursor-pointer focus:ring-pink-500 focus:border-pink-500 transition duration-300">
                                    <option value="" disabled selected>-- Choose Subject --</option>
                                    <option value="k3">K3 & ISO</option>
                                    <option value="sda">System Design Analyst</option>
                                    <option value="ewc">English for Workplace Communication</option>
                                    <option value="mp">Mobile Programming</option>
                                    <option value="dl">Digital Literacy</option>
                                    <option value="dg2">Design Graphics 2</option>
                                    <option value="fp">Framework Programming</option>
                                    <option value="ns">Network Security</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tombol Search --}}
                        <button type="submit" class="search-button bg-pink-500 text-white py-3 px-8 border-none rounded-lg font-bold uppercase tracking-wide shadow-lg hover:bg-pink-600 hover:scale-[1.02] transition duration-200">
                            <i class="fas fa-search mr-2"></i> Search
                        </button>
                    </form>

                    {{-- Pesan No Data (Akan disembunyikan jika ada hasil) --}}
                    <div class="no-data-message mt-8 pt-5 text-lg sm:text-xl font-bold text-white border-t-4 border-white">
                        Sorry, There no data shown.
                    </div>
                </div> {{-- End form-content --}}
            </div> {{-- End form-box --}}
        </div>
    </div>
    
    {{-- Menambahkan JavaScript di bagian akhir body --}}
    @push('scripts')
    <script>
        const collapseBtn = document.getElementById('collapseBtn');
        const formContent = document.getElementById('formContent');
        const icon = collapseBtn.querySelector('i');

        // Untuk mempertahankan efek transisi halus, kita akan menggunakan class kustom dan max-height
        
        // 1. Tambahkan CSS kustom ke body (Breeze tidak menyediakan transisi max-height secara default)
        // Kita gunakan Tailwind utilitas yang tersedia untuk mengatur transisi
        formContent.classList.add('transition-[max-height,padding,opacity]', 'duration-500', 'ease-in-out');

        // 2. Fungsi Toggle
        window.toggleCollapse = function() {
            // Rotasi Ikon
            icon.classList.toggle('rotate-180'); 

            // Logika Collapse/Expand menggunakan max-height
            if (formContent.style.maxHeight && formContent.style.maxHeight !== '0px') {
                // Tutup (Set max-height kembali ke 0)
                formContent.style.maxHeight = '0px';
                formContent.style.opacity = '0';
                formContent.style.paddingTop = '0';
                formContent.style.paddingBottom = '0';
            } else {
                // Buka: Set ketinggian ke scrollHeight (ketinggian konten penuh)
                formContent.style.maxHeight = formContent.scrollHeight + "px";
                formContent.style.opacity = '1';
                formContent.style.paddingTop = '2rem'; // Padding sesuai design asli
                formContent.style.paddingBottom = '2rem'; // Padding sesuai design asli
            }
        }

        // Hubungkan tombol ke fungsi global
        collapseBtn.addEventListener('click', window.toggleCollapse);
        
        // Atur status awal (terbuka) saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            // Atur max-height awal dan padding agar konten terlihat
            formContent.style.maxHeight = formContent.scrollHeight + "px";
            formContent.style.opacity = '1';
            formContent.style.paddingTop = '2rem';
            formContent.style.paddingBottom = '2rem';
        });

        // Hapus fungsi JS yang tidak terpakai dari file asli
        // fetch('foter.html')...
    </script>
    @endpush
</x-app-layout>