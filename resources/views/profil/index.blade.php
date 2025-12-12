@extends('layouts.app')

@section('content')
<style>
    body {
        overflow: hidden;
    }
</style>
<div class="-z-10 bg-slate-50 absolute inset-0 overflow-hidden">
        {{-- Header Biru Polos --}}
        <div class="absolute top-0 left-0 w-full h-64 bg-teal-500">
            
        </div>
    </div>

    {{-- INIT ALPINE JS --}}
    <div class="py-6 px-4 sm:px-6 lg:px-8 relative" x-data="{ isEditing: false, activeTab: 'biodata', showSuccess: true }">
        
        {{-- Flash Message Success (Dummy Mockup) --}}
        <div class="max-w-6xl mx-auto mb-4 bg-emerald-50 text-emerald-700 border border-emerald-200 p-4 rounded-lg flex justify-between items-center shadow-sm" x-show="showSuccess" x-transition>
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium text-sm">Data berhasil diperbarui (Contoh Flash Message)</span>
            </div>
            <button @click="showSuccess = false" class="hover:text-emerald-900"><i class="fas fa-times"></i></button>
        </div>

        {{-- Header Navigation --}}
        <div class="max-w-6xl mx-auto mb-8 flex justify-between items-center text-white relative z-10">
            <button onclick="alert('Kembali ke dashboard')" class="flex items-center gap-2 hover:bg-white/10 px-3 py-2 rounded-lg transition text-sm">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </button>
            <div class="hidden md:block font-medium text-xs opacity-80 uppercase tracking-widest">Profil Mahasiswa</div>
        </div>

        {{-- Form Wrapper --}}
        <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Simulasi: Data disimpan!');">
            
            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                {{-- LEFT COLUMN: Profile Card --}}
                <div class="lg:col-span-4 space-y-4">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden sticky top-6">
                        
                        {{-- Header Kartu (Polos) --}}
                        <div class="h-24 bg-slate-100 border-b border-slate-200 relative overflow-hidden">
                             <!-- Optional: Pola garis tipis agar tidak terlalu kosong -->
                             <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#004269 1px, transparent 1px); background-size: 10px 10px;"></div>
                        </div>

                        <div class="px-6 pb-6 text-center relative">
                            {{-- Foto Profil --}}
                            <div class="-mt-12 mb-3 inline-block">
                                <div class="w-24 h-24 rounded-full border-4 border-white shadow-sm bg-white overflow-hidden">
                                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=004269&color=fff&size=512" alt="Profile" class="w-full h-full object-cover">
                                </div>
                            </div>

                            <h2 class="text-lg font-bold text-slate-800">Budi Santoso</h2>
                            <p class="text-slate-500 text-sm">Teknik Informatika - D3</p>
                            
                            <div class="mt-3 flex justify-center">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-700 uppercase tracking-wide border border-emerald-200">
                                    Mahasiswa Aktif
                                </span>
                            </div>

                            {{-- Stats Simple --}}
                            <div class="mt-6 pt-6 border-t border-slate-100 grid grid-cols-1 gap-4">
                                <div>
                                    <span class="block text-xl font-bold text-[#004269]">3.05</span>
                                    <span class="text-xs text-slate-400 font-medium uppercase tracking-wide">IPK Kumulatif</span>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="mt-6" x-show="!isEditing">
                                <button type="button" @click="isEditing = true" class="w-full py-2.5 rounded-lg bg-[#004269] text-white font-medium text-sm hover:bg-[#003354] transition shadow-lg shadow-blue-900/10 flex items-center justify-center gap-2">
                                    <i class="fas fa-pen text-xs"></i> Edit Profil
                                </button>
                            </div>
                            
                            <div class="mt-6 space-y-2" x-show="isEditing" x-cloak>
                                <button type="submit" class="w-full py-2.5 rounded-lg bg-[#009DA5] text-black font-medium text-sm hover:bg-[#008b93] transition shadow-lg shadow-teal-500/10 flex items-center justify-center gap-2">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <button type="button" @click="isEditing = false" class="w-full py-2.5 rounded-lg border border-slate-200 text-slate-600 font-medium text-sm hover:bg-slate-50 transition">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Content --}}
                <div class="lg:col-span-8 space-y-6">
                    
                    {{-- VIEW MODE --}}
                    <div x-show="!isEditing" x-transition.opacity.duration.300ms>
                        
                        {{-- Tabs Navigation (Simple Style) --}}
                        <div class="border-b border-slate-200 flex gap-6 mb-6 overflow-x-auto hide-scrollbar">
                            <div class="border-b border-slate-200 flex gap-6 mb-6 overflow-x-auto hide-scrollbar">
                                <button 
                                    type="button" 
                                    @click="activeTab = 'biodata'"
                                    :class="activeTab === 'biodata' 
                                        ? 'text-gray-800 border-emerald-600' 
                                        : 'text-slate-700 border-transparent hover:text-slate-600'"
                                    class="pb-3 text-sm font-bold border-b-2 transition whitespace-nowrap px-1">                                
                                    Biodata
                                </button>

                                <button 
                                    type="button" 
                                    @click="activeTab = 'alamat'"
                                    :class="activeTab === 'alamat' 
                                        ? 'text-gray-800 border-emerald-600' 
                                        : 'text-slate-700 border-transparent hover:text-slate-600'"
                                    class="pb-3 text-sm font-bold border-b-2 transition whitespace-nowrap px-1">
                                    Alamat
                                </button>

                                <button 
                                    type="button" 
                                    @click="activeTab = 'kontak'"
                                    :class="activeTab === 'kontak' 
                                        ? 'text-gray-800 border-emerald-200' 
                                        : 'text-slate-700 border-transparent hover:text-slate-600'"
                                    class="pb-3 text-sm font-bold border-b-2 transition whitespace-nowrap px-1">
                                
                                    Kontak Darurat
                                </button>
                            </div>

                        </div>

                        {{-- TAB 1: BIODATA --}}
                        <div x-show="activeTab === 'biodata'" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
                            <h3 class="text-base font-bold text-slate-800 mb-5 flex items-center gap-2">
                                <i class="far fa-user text-[#009DA5]"></i> Informasi Pribadi
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                                <div class="border-b border-slate-50 pb-2"><label class="text-[11px] text-slate-400 uppercase font-bold tracking-wider block mb-1">NIM</label><p class="text-slate-800 font-medium text-sm">2021004012</p></div>
                                <div class="border-b border-slate-50 pb-2"><label class="text-[11px] text-slate-400 uppercase font-bold tracking-wider block mb-1">Email</label><p class="text-slate-800 font-medium text-sm break-all">mahasiswa@lp3i.ac.id</p></div>
                                <div class="border-b border-slate-50 pb-2"><label class="text-[11px] text-slate-400 uppercase font-bold tracking-wider block mb-1">Tempat, Tgl Lahir</label><p class="text-slate-800 font-medium text-sm">Jakarta, 12 Agustus 2003</p></div>
                                <div class="border-b border-slate-50 pb-2"><label class="text-[11px] text-slate-400 uppercase font-bold tracking-wider block mb-1">Jenis Kelamin</label><p class="text-slate-800 font-medium text-sm">Laki-laki</p></div>
                                <div class="border-b border-slate-50 pb-2"><label class="text-[11px] text-slate-400 uppercase font-bold tracking-wider block mb-1">Agama</label><p class="text-slate-800 font-medium text-sm">Islam</p></div>
                                <div class="border-b border-slate-50 pb-2"><label class="text-[11px] text-slate-400 uppercase font-bold tracking-wider block mb-1">No. Telepon</label><p class="text-slate-800 font-medium text-sm">+62 812 3456 7890</p></div>
                            </div>
                        </div>

                        {{-- TAB 2: ALAMAT --}}
                        <div x-show="activeTab === 'alamat'" class="space-y-4">
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 transition hover:shadow-md">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-[#004269] shrink-0 mt-1">
                                        <i class="fas fa-id-card text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800 mb-1">Alamat KTP</h4>
                                        <p class="text-slate-600 text-sm leading-relaxed">Jl. Merdeka Selatan No. 45, RT.01/RW.02, Kel. Gambir, Kec. Gambir, Jakarta Pusat 10110</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 transition hover:shadow-md">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-teal-50 flex items-center justify-center text-[#009DA5] shrink-0 mt-1">
                                        <i class="fas fa-map-marker-alt text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-800 mb-1">Alamat Domisili</h4>
                                        <p class="text-slate-600 text-sm leading-relaxed">Kost Griya Sejahtera, Jl. Kramat Raya No. 128, Kamar 204, Senen, Jakarta Pusat 10430</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 3: KONTAK --}}
                        <div x-show="activeTab === 'kontak'" class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200 space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 shrink-0 border border-slate-100"><i class="fas fa-user-friends"></i></div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Orang Tua / Wali</p>
                                    <h4 class="text-base font-bold text-slate-800">Bpk. Supriyadi</h4>
                                    <p class="text-slate-600 text-sm font-medium mt-0.5">+62 811 9988 7766</p>
                                </div>
                            </div>
                            <div class="w-full h-px bg-slate-100"></div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-50 flex items-center justify-center text-slate-500 shrink-0 border border-slate-100"><i class="fas fa-ambulance"></i></div>
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Kerabat Dekat (Darurat)</p>
                                    <h4 class="text-base font-bold text-slate-800">Ibu Siti Aminah (Tante)</h4>
                                    <p class="text-slate-600 text-sm font-medium mt-0.5">+62 812 3344 5566</p>
                                </div>
                            </div>
                        </div>

                        {{-- Dosen Wali --}}
                        <div class="mt-6 bg-gradient-to-br from-[#004269] to-[#006080] rounded-2xl p-5 text-white shadow-sm flex items-center justify-between relative overflow-hidden group">
                            <!-- Dekorasi background -->
                            <div class="absolute right-0 top-0 h-full w-1/3 bg-white/5 skew-x-12 transform translate-x-8 group-hover:translate-x-4 transition duration-700"></div>
                            
                            <div class="relative z-10 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center backdrop-blur-sm">
                                    <i class="fas fa-chalkboard-teacher text-xl"></i>
                                </div>
                                <div>
                                    <p class="text-blue-200 text-[10px] font-bold uppercase tracking-wider mb-1">Dosen Pembimbing Akademik</p>
                                    <h4 class="text-lg font-bold">Dr. Budi Santoso, M.Kom</h4>
                                </div>
                            </div>
                            <button type="button" class="relative z-10 bg-white/10 hover:bg-white/20 p-3 rounded-xl transition backdrop-blur-sm border border-white/10">
                                <i class="fas fa-comment-dots"></i>
                            </button>
                        </div>
                    </div>

                    {{-- EDIT MODE --}}
                    <div x-show="isEditing" x-cloak x-transition.opacity.duration.300ms class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200">
                        <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100">
                            <h3 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-[#009DA5]/10 flex items-center justify-center text-[#009DA5] text-sm"><i class="fas fa-pen"></i></span>
                                Edit Data Profil
                            </h3>
                            <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-1 rounded border border-slate-200 font-bold uppercase tracking-wide">Mode Edit</span>
                        </div>

                        <div class="space-y-8">
                            {{-- Input Domisili --}}
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-[#F15B67]"></i> Alamat Domisili
                                </h4>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Alamat Lengkap Saat Ini</label>
                                    <textarea name="domisili" rows="3" class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#009DA5] focus:ring focus:ring-[#009DA5]/20 text-slate-700 text-sm transition p-3 leading-relaxed placeholder:text-slate-400" placeholder="Contoh: Nama Kost, Jalan, No Rumah...">Kost Griya Sejahtera, Jl. Kramat Raya No. 128, Kamar 204, Senen, Jakarta Pusat 10430</textarea>
                                    <p class="text-xs text-slate-400 mt-2">*Alamat ini akan digunakan untuk pengiriman surat akademik jika diperlukan.</p>
                                </div>
                            </div>

                            <div class="w-full h-px bg-slate-100"></div>

                            <div>
                                <h4 class="text-sm font-bold text-slate-800 mb-4 flex items-center gap-2">
                                    <i class="fas fa-address-book text-[#F15B67]"></i> Kontak Darurat
                                </h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">No. HP Pribadi (WhatsApp)</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-mobile-alt"></i></div>
                                            <input type="text" name="phone" value="+62 812 3456 7890" class="w-full pl-10 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#009DA5] focus:ring focus:ring-[#009DA5]/20 text-slate-700 text-sm h-11 transition">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">Nama Orang Tua</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-user"></i></div>
                                            <input type="text" name="parent_name" value="Bpk. Supriyadi" class="w-full pl-10 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#009DA5] focus:ring focus:ring-[#009DA5]/20 text-slate-700 text-sm h-11 transition">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">No. HP Orang Tua</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-phone"></i></div>
                                            <input type="text" name="parent_phone" value="+62 811 9988 7766" class="w-full pl-10 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#009DA5] focus:ring focus:ring-[#009DA5]/20 text-slate-700 text-sm h-11 transition">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wide mb-2">No. HP Kerabat Darurat</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400"><i class="fas fa-ambulance"></i></div>
                                            <input type="text" name="emergency_phone" value="+62 812 3344 5566" class="w-full pl-10 rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-[#009DA5] focus:ring focus:ring-[#009DA5]/20 text-slate-700 text-sm h-11 transition">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-sky-50 text-[#004269] text-xs p-4 rounded-xl border border-sky-100 flex gap-3 leading-relaxed">
                                <i class="fas fa-info-circle mt-0.5 text-base"></i>
                                <div>
                                    <span class="font-bold block mb-1">Catatan Penting:</span>
                                    Untuk perubahan biodata utama (Nama Lengkap, NIM, Tempat/Tanggal Lahir, Agama, dan Alamat KTP), silakan hubungi bagian <strong>Administrasi Akademik (BAA)</strong> dengan membawa dokumen pendukung yang sah.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection