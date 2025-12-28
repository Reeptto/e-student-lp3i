@extends('layouts.app')

@section('content')

    {{-- 1. SETUP STYLE & ANIMASI --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .fade-in { animation: fadeIn 0.4s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* Animasi Floating Halus */
        .animate-float-slow { animation: floatSlow 8s ease-in-out infinite alternate; }
        @keyframes floatSlow {
            0% { transform: translateY(0px); }
            100% { transform: translateY(-15px); }
        }
        [x-cloak] { display: none !important; }
    </style>

    {{-- 2. BACKGROUND DECORATIVE (Sama seperti referensi) --}}
    <div class="fixed inset-0 -z-10 bg-[#F8FAFC] overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-[400px] bg-[#004269] relative overflow-hidden rounded-b-[3rem]">
            
            {{-- POLA HEXAGON BACKGROUND --}}
            <div class="absolute top-[-10%] right-[-5%] w-[900px] h-[600px] pointer-events-none animate-float-slow opacity-20">
                <svg viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <path d="M225 43.3 L280 75 V138 L225 170 L170 138 V75 Z" fill="#009DA5" opacity="0.5"/>
                    <path d="M150 0 L225 43.3 V129.9 L150 173.2 L75 129.9 V43.3 Z" stroke="white" stroke-width="1.5" opacity="0.3"/>
                    <path d="M50 86.6 L0 115.5 V173.2 L50 202.1 L100 173.2 V115.5 Z" fill="#ffffff" opacity="0.1"/>
                    <path d="M75 129.9 L40 150" stroke="white" stroke-width="1.5" opacity="0.5"/>
                    <circle cx="40" cy="150" r="4" fill="white"/>
                </svg>
            </div>

            {{-- Gradient Overlay --}}
            <div class="absolute bottom-0 left-0 w-full h-full bg-gradient-to-t from-[#004269] via-transparent to-transparent"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
        </div>
    </div>

    {{-- 3. MAIN CONTENT WRAPPER --}}
    <div class="py-10 px-4 sm:px-6 lg:px-8 relative font-sans" x-data="{ isEditing: false, activeTab: 'akademik' }">
        
        {{-- Flash Message --}}
        @if(session('success'))
        <div class="max-w-6xl mx-auto mb-6 bg-emerald-500 text-white p-4 rounded-xl shadow-lg fade-in flex justify-between items-center" x-data="{ show: true }" x-show="show">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="hover:bg-white/20 p-2 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
        </div>
        @endif

        {{-- Grid Layout --}}
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ========================================== --}}
            {{-- KOLOM KIRI: KARTU PROFIL UTAMA --}}
            {{-- ========================================== --}}
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-[2rem] shadow-2xl overflow-hidden relative border border-slate-100 sticky top-6">
                    
                    {{-- Header Kartu --}}
                    <div class="h-36 bg-gradient-to-br from-[#009DA5] to-[#004269] relative overflow-hidden">
 <div class="absolute top-[-10%] right-[-5%] w-[900px] h-[600px] pointer-events-none animate-float-slow opacity-20">
                <svg viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <path d="M225 43.3 L280 75 V138 L225 170 L170 138 V75 Z" fill="#009DA5" opacity="0.5"/>
                    <path d="M150 0 L225 43.3 V129.9 L150 173.2 L75 129.9 V43.3 Z" stroke="white" stroke-width="1.5" opacity="0.3"/>
                    <path d="M50 86.6 L0 115.5 V173.2 L50 202.1 L100 173.2 V115.5 Z" fill="#ffffff" opacity="0.1"/>
                    <path d="M75 129.9 L40 150" stroke="white" stroke-width="1.5" opacity="0.5"/>
                    <circle cx="40" cy="150" r="4" fill="white"/>
                </svg>
            </div>
                            </div>

                    {{-- Foto & Nama --}}
                    <div class="px-6 pb-8 text-center relative z-10">
                        <div class="-mt-16 mb-4 inline-block relative group">
                            <div class="w-32 h-32 rounded-full border-[5px] border-white shadow-xl overflow-hidden bg-slate-100">
                                
                                     <img src="{{ auth()->user()?->mahasiswa?->foto
                                                    ? asset('storage/image/' . auth()->user()->mahasiswa->foto)
                                                    : 'https://ui-avatars.com/api/?name=Guest' }}"
                                            alt="Profile"
                                            class="w-full h-full rounded-full object-cover transition transform hover:scale-110 duration-500"
                                            />
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-[#004269]">{{ $mahasiswa->nama_mhs }}</h2>
                        <p class="text-[#009DA5] text-sm font-semibold mt-1">{{ $mahasiswa->kelas->jurusan->nama_jurusan }}</p>
                        
                        <div class="mt-4 flex justify-center gap-2">
                            <span class="px-4 py-1.5 rounded-full bg-slate-100 text-slate-600 text-xs font-bold border border-slate-200">
                                {{ $mahasiswa->nipd }}
                            </span>
                        </div>

                        {{-- Tombol Edit/View Switcher --}}
                        <div class="mt-8">
                            <button type="button" @click="isEditing = !isEditing" 
                                    class="w-full py-3 rounded-xl font-semibold text-sm shadow-lg transition transform hover:-translate-y-1 flex items-center justify-center gap-2"
                                    :class="isEditing ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-[#004269] text-white shadow-blue-900/30'">
                                <span x-text="isEditing ? 'Batal Edit' : 'Edit Profil'"></span>
                                <svg x-show="!isEditing" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- KOLOM KANAN: DETAIL & FORM EDIT --}}
            {{-- ========================================== --}}
            <div class="lg:col-span-8">

                {{-- MODE VIEW (TABS) --}}
                <div x-show="!isEditing" class="fade-in space-y-6">
                    
                    {{-- Navigasi Tab --}}
                    <div class="bg-white/80 backdrop-blur-md rounded-2xl p-1.5 shadow-sm border border-slate-200 flex gap-1 overflow-x-auto">
                        <button @click="activeTab = 'akademik'" :class="activeTab === 'akademik' ? 'bg-[#009DA5] text-white shadow-md' : 'text-slate-500 hover:bg-slate-50'" class="flex-1 py-2.5 px-4 rounded-xl font-bold text-sm transition">Akademik</button>
                        <button @click="activeTab = 'pribadi'" :class="activeTab === 'pribadi' ? 'bg-[#009DA5] text-white shadow-md' : 'text-slate-500 hover:bg-slate-50'" class="flex-1 py-2.5 px-4 rounded-xl font-bold text-sm transition">Data Pribadi</button>
                        <button @click="activeTab = 'kontak'" :class="activeTab === 'kontak' ? 'bg-[#009DA5] text-white shadow-md' : 'text-slate-500 hover:bg-slate-50'" class="flex-1 py-2.5 px-4 rounded-xl font-bold text-sm transition">Kontak & Alamat</button>
                    </div>

                    {{-- Konten Tab --}}
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-slate-100 relative overflow-hidden min-h-[400px]">
                        
                        {{-- Tab 1: Akademik --}}
                        <div x-show="activeTab === 'akademik'" class="fade-in space-y-6">
                            <h3 class="text-lg font-bold text-[#004269] flex items-center gap-2 mb-4">
                                <span class="w-1.5 h-6 bg-[#F15B67] rounded-full"></span> Informasi Akademik
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase">NIPD / NIM</span>
                                    <p class="text-lg font-bold text-[#004269] mt-1">{{ $mahasiswa->nipd }}</p>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase">Kelas Saat Ini</span>
                                    <p class="text-lg font-bold text-[#004269] mt-1">{{ $mahasiswa->kelas->kode_kelas }}</p>
                                </div>
                                <div class="md:col-span-2 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase">Program Studi</span>
                                    <p class="text-lg font-bold text-[#004269] mt-1">{{ $mahasiswa->kelas->jurusan->nama_jurusan }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Tab 2: Pribadi --}}
                        <div x-show="activeTab === 'pribadi'" x-cloak class="fade-in space-y-6">
                            <h3 class="text-lg font-bold text-[#004269] flex items-center gap-2 mb-4">
                                <span class="w-1.5 h-6 bg-[#F15B67] rounded-full"></span> Biodata Diri
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#009DA5]/10 flex items-center justify-center text-[#009DA5]"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                                    <div><span class="text-xs text-slate-400 font-bold uppercase">Nama Lengkap</span><p class="font-bold text-[#004269]">{{ $mahasiswa->nama_mhs }}</p></div>
                                </div>
                                <div class="flex items-center p-4 bg-slate-50 rounded-2xl border border-slate-100 gap-4">
                                    <div class="w-10 h-10 rounded-full bg-[#009DA5]/10 flex items-center justify-center text-[#009DA5]"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                                    <div><span class="text-xs text-slate-400 font-bold uppercase">Tempat, Tanggal Lahir</span><p class="font-bold text-[#004269]">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tanggal_lahir }}</p></div>
                                </div>
                            </div>
                        </div>

                         {{-- Tab 3: Kontak --}}
                         <div x-show="activeTab === 'kontak'" x-cloak class="fade-in space-y-6">
                            <h3 class="text-lg font-bold text-[#004269] flex items-center gap-2 mb-4">
                                <span class="w-1.5 h-6 bg-[#F15B67] rounded-full"></span> Kontak & Domisili
                            </h3>
                            <div class="grid gap-4">
                                <div class="p-5 bg-gradient-to-br from-slate-50 to-white rounded-2xl border border-slate-100 shadow-sm">
                                    <span class="text-xs font-bold text-[#009DA5] uppercase mb-1 block">Email</span>
                                    <p class="font-bold text-slate-700">{{ $mahasiswa->email }}</p>
                                </div>
                                <div class="p-5 bg-gradient-to-br from-slate-50 to-white rounded-2xl border border-slate-100 shadow-sm">
                                    <span class="text-xs font-bold text-[#009DA5] uppercase mb-1 block">No. Handphone</span>
                                    <p class="font-bold text-slate-700">{{ $mahasiswa->no_telp }}</p>
                                </div>
                                <div class="p-5 bg-gradient-to-br from-slate-50 to-white rounded-2xl border border-slate-100 shadow-sm">
                                    <span class="text-xs font-bold text-[#009DA5] uppercase mb-1 block">Alamat Domisili</span>
                                    <p class="font-bold text-slate-700 leading-relaxed">{{ $mahasiswa->Domisili }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- MODE EDIT (FORM UPDATE) --}}
                <div x-show="isEditing" x-cloak class="fade-in">
                    <form method="POST" action="{{ route('profile.updates') }}"  enctype="multipart/form-data" class="bg-white rounded-[2.5rem] p-8 shadow-2xl border-2 border-[#009DA5] relative">
                        @csrf
                        @method('PATCH')

                        <div class="flex items-center justify-between mb-8 border-b border-slate-100 pb-4">
                             <h3 class="text-2xl font-bold text-[#004269] flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-[#009DA5] text-white flex items-center justify-center text-sm"><i class="fas fa-pen"></i></div>
                                Edit Data
                            </h3>
                            <span class="text-xs font-bold bg-blue-50 text-blue-600 px-3 py-1 rounded-full">Mode Edit Aktif</span>
                        </div>

                        <div class="space-y-6">
                            <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-100 mb-6">
                                <p class="text-xs text-yellow-700"><strong>Catatan:</strong> Data Nama, NIPD, dan Jurusan tidak dapat diubah di sini. Hubungi admin untuk perubahan data akademik.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-[#004269] mb-2">Alamat Domisili</label>
                                <textarea name="Domisili" rows="3" 
                                    class="w-full rounded-xl border-slate-300 focus:border-[#009DA5] focus:ring focus:ring-[#009DA5]/20 text-slate-700 transition shadow-sm p-4"
                                    placeholder="Masukkan alamat lengkap...">{{ old('Domisili', $mahasiswa->Domisili) }}</textarea>
                                @error('Domisili')
                                    <small class="text-red-500 font-bold mt-1 block">{{ $message }}</small>
                                @enderror
                            </div>

                             <div>
                                <label class="block text-sm font-bold text-[#004269] mb-2">Foto Profil</label>
                                <div class="flex items-center gap-4">
                                    <!-- Preview Foto Lama / Default -->
                                    <img id="previewImg" src="{{ $mahasiswa->foto ? asset('storage/image/' . $mahasiswa->foto) : 'https://ui-avatars.com/api/?name=Guest' }}" 
                                        class="w-20 h-20 rounded-full object-cover border border-slate-200 shadow" />

                                    <!-- Custom File Upload Button -->
                                    <label class="cursor-pointer bg-[#009DA5] text-white px-4 py-2 rounded-xl hover:bg-[#00787f] transition flex items-center gap-2">
                                        Pilih Foto
                                        <input type="file" name="foto" class="hidden" onchange="previewFile(this)">
                                    </label>
                                </div>
                                @error('foto')
                                    <small class="text-red-500 font-bold mt-1 block">{{ $message }}</small>
                                @enderror
                            </div>

                            <script>
                            function previewFile(input){
                                const file = input.files[0];
                                const preview = document.getElementById('previewImg');
                                if(file){
                                    const reader = new FileReader();
                                    reader.onload = function(e){
                                        preview.src = e.target.result;
                                    }
                                    reader.readAsDataURL(file);
                                }
                            }
                            </script>


                            <div class="pt-6">
                                <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-[#004269] to-[#009DA5] text-white font-bold text-lg shadow-lg hover:shadow-xl hover:scale-[1.01] transition duration-300 flex items-center justify-center gap-2">
                                    <span>Simpan Perubahan</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection