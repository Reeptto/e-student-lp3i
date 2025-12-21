<x-app-layout>
    
    {{-- Slot Header Breeze untuk Judul Halaman --}}
    <x-slot name="header">
       
    </x-slot>

    {{-- Main Content Container --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center bg-indigo-600 p-4 sm:rounded ">
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


             <h1 class="text-2xl font-semibold text-white leading-tight flex items-center gap-3">
            <i class="fas fa-wallet text-3xl"></i>
            {{ __('Billing Info') }}
        </h1></div><br>            

        {{-- Diubah max-width menjadi 4xl (896px) --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                {{-- --- Payment Plans and Realizations Header --- --}}
                <div class="flex justify-between items-center pb-4 mb-4 border-b border-gray-200">
                    <h2 class="text-xl font-medium text-gray-700">Payment Plans and Realizations</h2>
                    <button class="print-button bg-white text-gray-700 border border-gray-300 px-4 py-2 rounded-lg font-semibold hover:border-indigo-500 hover:shadow-md transition duration-200">
                        <i class="fas fa-print mr-2"></i> Print
                    </button>
                </div>
                
                {{-- --- Student Payment Plan Section --- --}}
                <div class="payment-section">
                    
                    {{-- Header Collapsible --}}
                    <div class="plan-header bg-indigo-600 text-white p-4 flex justify-between items-center rounded-t-lg cursor-pointer transition duration-300" 
                         id="plan-header" onclick="togglePlan()">
                        <div class="plan-header-content flex items-center gap-3 text-lg font-bold">
                            <i class="fas fa-calendar-alt"></i>
                            Student Payment Plan
                        </div>
                        <div class="plan-header-icons flex items-center gap-3">
                            <i class="fas fa-chevron-down transform transition duration-300" id="chevron-icon"></i>
                            <i class="fas fa-expand-alt hidden sm:inline-block"></i> {{-- Tombol expand disembunyikan di HP --}}
                        </div>
                    </div>
                    
                    {{-- Konten Collapsible --}}
                    <div id="plan-content" class="collapsible-content bg-white border border-gray-200 border-t-0 rounded-b-lg overflow-hidden transition-all duration-400 ease-in-out">
                        <div class="table-header-container">
                            
                            {{-- Header Tabel (Kuning Cerah) --}}
                            <div class="table-header flex text-center bg-yellow-300 text-gray-800 font-bold uppercase py-3 border-b-4 border-indigo-600 text-xs sm:text-sm">
                                <div class="flex-1 px-1">INSTALLATION</div>
                                <div class="flex-1 px-1">ACADEMIC YEAR</div>
                                <div class="flex-1 px-1">PLAN DATE</div>
                                <div class="flex-1 px-1">AMOUNT BILL</div>
                                <div class="flex-1 px-1">AMOUNT PAY</div>
                            </div>
                            
                            {{-- Data Baris (Menggunakan @foreach untuk data dinamis) --}}
                            @php
                                $payments = [
                                    ['ins' => '1', 'year' => '2024/2025', 'plan' => '10/01/2024', 'bill' => '1.500.000', 'pay' => '1.500.000'],
                                    ['ins' => '2', 'year' => '2024/2025', 'plan' => '10/02/2024', 'bill' => '500.000', 'pay' => '500.000'],
                                    ['ins' => '3', 'year' => '2024/2025', 'plan' => '10/03/2024', 'bill' => '700.000', 'pay' => '700.000'],
                                ];
                            @endphp

                            @foreach ($payments as $payment)
                                <div class="table-data-row flex text-center py-3 border-b border-gray-100 text-sm">
                                    <div class="flex-1 text-gray-700">{{ $payment['ins'] }}</div>
                                    <div class="flex-1 text-gray-700">{{ $payment['year'] }}</div>
                                    <div class="flex-1 text-gray-700">{{ $payment['plan'] }}</div>
                                    <div class="flex-1 font-semibold text-gray-800">{{ $payment['bill'] }}</div>
                                    <div class="flex-1 font-semibold text-green-600">{{ $payment['pay'] }}</div> {{-- Highlight jumlah bayar --}}
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    {{-- Menambahkan JavaScript di bagian akhir body --}}
    @push('scripts')
    <script>
        // Memastikan fungsi ada di scope global
        window.togglePlan = function() {
            const header = document.getElementById('plan-header');
            const content = document.getElementById('plan-content');
            const icon = document.getElementById('chevron-icon');

            // 1. Toggle kelas 'active' dan rotasi ikon
            header.classList.toggle('active');
            icon.classList.toggle('rotate-180'); 

            // 2. Logika Collapse/Expand menggunakan max-height
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                // Tutup (Set max-height kembali ke 0)
                content.style.maxHeight = '0px';
            } else {
                // Buka: Set ketinggian ke scrollHeight (ketinggian konten penuh)
                content.style.maxHeight = content.scrollHeight + "px";
            }
        }
        
        // PENTING: Buka Konten secara default saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.getElementById('plan-content');
            const header = document.getElementById('plan-header');
            const icon = document.getElementById('chevron-icon');
            
            // Periksa dan buka jika konten belum terbuka
            if (content && !content.style.maxHeight) {
                // Set max-height awal dan kelas aktif/rotasi
                content.style.maxHeight = content.scrollHeight + "px";
                header.classList.add('active'); 
                icon.classList.remove('rotate-180');
            }
        });
    </script>
    @endpush
</x-app-layout>