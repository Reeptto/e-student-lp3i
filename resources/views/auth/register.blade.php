<x-guest-layout>
    <div class="flex flex-col lg:flex-row min-h-screen bg-gray-100">

        <!-- BAGIAN KIRI (FORM REGISTRASI) -->
        <div class="w-full lg:w-1/2 min-h-[50vh] lg:min-h-screen flex items-center justify-center p-6 relative" 
             style="background-image: url('/img/gedung.webp'); background-size: cover; background-position: center;">
            
            <!-- Overlay opsional jika gambar terlalu terang -->
            <!-- <div class="absolute inset-0 bg-black/10"></div> -->

            <div class="w-full max-w-md bg-white p-6 rounded-xl shadow-2xl relative z-10">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-extrabold text-indigo-600">
                        Daftar Akun
                    </h1>
                    <p class="mt-1 text-lg text-gray-600">
                        Bergabung di E-Student
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- NIPD -->
                    <div>
                        <x-input-label for="nipd" :value="__('NIPD')" class="text-base font-semibold text-gray-700 mb-1" />
                        <x-text-input id="nipd" class="input-style block mt-1 w-full" type="text" name="nipd" :value="old('nipd')" required autofocus autocomplete="nipd" placeholder="Masukkan NIPD" />
                        <x-input-error :messages="$errors->get('nipd')" class="mt-2" />
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" class="text-base font-semibold text-gray-700 mb-1" />
                        <x-text-input id="name" class="input-style block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Masukkan Nama Lengkap" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-base font-semibold text-gray-700 mb-1" />
                        <x-text-input id="email" class="input-style block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan Email Aktif" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-base font-semibold text-gray-700 mb-1" />
                        <x-text-input id="password" class="input-style block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Buat Password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-base font-semibold text-gray-700 mb-1" />
                        <x-text-input id="password_confirmation" class="input-style block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="submit-button bg-indigo-500 hover:bg-indigo-600 text-white py-3 px-6 rounded-lg font-bold uppercase tracking-wide shadow-lg w-full transition duration-300">
                            Daftar Sekarang
                        </button>
                    </div>
                    
                    <div class="text-center text-sm pt-2">
                        <span class="text-gray-600">Sudah punya akun?</span>
                        <a href="{{ route('auth.login') }}" class="font-medium text-indigo-600 hover:underline ml-1">
                            Login disini
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- BAGIAN KANAN (INFORMASI - SAMA PERSIS DENGAN LOGIN) -->
        <div class="relative overflow-hidden w-full lg:w-1/2 bg-white shadow-xl shadow-gray-300/40 rounded-2xl flex flex-col justify-center border border-gray-100" id="du">

            <div class="absolute top-0 right-0 -mt-24 -mr-24 w-64 h-64 bg-yellow-300 rounded-full z-0 opacity-90"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-48 h-48 bg-yellow-300 rounded-full z-0 opacity-90"></div>
            <div class="absolute top-5 left-1 w-24 h-32 opacity-70 z-0" style="background-image: radial-gradient(#4b2aad 1.5px, transparent 1.5px); background-size: 12px 12px;"></div>
            <div class="absolute bottom-10 right-10 w-24 h-32 opacity-70 z-0" style="background-image: radial-gradient(#4b2aad 1.5px, transparent 1.5px); background-size: 12px 12px;"></div>

            <div class="relative z-10 w-full p-10 lg:p-16">

                <div class="flex justify-between items-start mt-[-80px]">
                    <div>
                        <div class="bg-white rounded-lg p-2 w-[190px] inline-block shadow-md border border-gray-50 ml-[-50px]">
                            <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-900">
                                <span class="text-yellow-500">e</span>Student
                            </a>
                            <span class="block text-sm text-gray-500 font-medium mb-2 ml-4">Information System</span>
                        </div>
                    </div>
                    <div class="relative z-10">
                        <!-- Pastikan path gambar sesuai dengan project kamu -->
                        <img src="{{ asset('/img/2.webp') }}" class="w-[170px]" onerror="this.style.display='none'">
                    </div>
                </div>

                <h2 class="text-3xl lg:text-4xl font-extrabold text-[#4b2aad] mt-10">
                    Informasi E-Student
                </h2>
                <p class="text-black leading-relaxed mt-4">
                    Fasilitas ini ditujukan untuk seluruh mahasiswa LP3I yang aktif mengikuti perkuliahan. Di dalamnya terdapat berbagai layanan yang dapat mempermudah pengelolaan kegiatan akademik serta aktivitas lain yang berkaitan dengan proses pendidikan.
                </p>
                
                <div class="grid grid-cols-2 gap-x-6 gap-y-6 my-8">
                    
                    <div class="space-y-5">
                        <span class="flex items-center text-black font-medium">
                            <svg class="w-6 h-6 text-[#4b2aad] mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Biodata Mahasiswa
                        </span>
                        
                        <span class="flex items-center text-black font-medium">
                            <svg class="w-6 h-6 text-[#4b2aad] mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8z" />
                            </svg>
                            Komponen Penilaian
                        </span>

                        <span class="flex items-center text-black font-medium">
                            <svg class="w-6 h-6 text-[#4b2aad] mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path d="M12 14l9-5-9-5-9 5 9 5z" />
                              <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 14v6" />
                            </svg>
                            Kartu Hasil Studi
                        </span>
                    </div>

                    <div class="space-y-5">
                        <span class="flex items-center text-black font-medium">
                            <svg class="w-6 h-6 text-[#4b2aad] mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.682A4.01 4.01 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3.432C19.18 1.468 20 1.132 20 3.868v16.264c0 2.736-.82 2.4-2 1.432C16.457 20.034 12.9 18.8 8.832 18.8H7a4.01 4.01 0 01-1.564-.318l-2.147-6.15m0 0l2.147 6.15M5.436 13.682l-2.147-6.15m0 0a3.001 3.001 0 00-1.4 5.434" />
                            </svg>
                            Pengumuman
                        </span>

                        <span class="flex items-center text-black font-medium">
                            <svg class="w-6 h-6 text-[#4b2aad] mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Informasi Pembayaran
                        </span>

                        <span class="flex items-center text-black font-medium">
                            <svg class="w-6 h-6 text-[#4b2aad] mr-3 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Kalender Akademik
                        </span>
                    </div>
                </div>
                
                <p class="text-black leading-relaxed">
                    Silakan lengkapi data diri Anda pada formulir di samping untuk membuat akun baru. Pastikan data yang Anda masukkan valid dan sesuai dengan data akademik.
                </p>

            </div>
        </div>
    </div> 

    @push('styles')
    <style>
        /* Pastikan font Poppins sudah di-load di layout utama atau tambahkan @import di sini jika perlu */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        #du, .font-poppins, body {
            font-family: 'Poppins', sans-serif !important;
        }
        
        .input-style {
            padding: 10px 14px;
            border-radius: 8px;
            border: 2px solid #e5e7eb;
            transition: all 0.2s ease-in-out;
            width: 100%;
        }
        .input-style::placeholder {
            color: #9ca3af;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .input-style:focus {
            outline: none;
            border-color: #6366f1; /* Fokus warna Indigo */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
    </style>
    @endpush
</x-guest-layout>
