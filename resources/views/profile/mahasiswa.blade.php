@extends('layouts.app')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');
        
        /* --- GLOBAL --- */
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #F0F4F8;
            /* Pola Grid di Bagian Bawah */
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
        }

        [x-cloak] { display: none !important; }

        /* --- HEADER BACKGROUND KHUSUS (MEMPHIS STYLE - STATIS) --- */
        /* Ini background baru yang Anda minta */
        .memphis-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 480px; 
            background-color: #004269; /* Dasar Navy */
            border-bottom: 6px solid #009DA5;
            border-radius: 0 0 60px 60px;
            z-index: -10;
            overflow: hidden;
            box-shadow: 0 10px 0 rgba(0, 157, 165, 0.2);
        }

        /* Elemen Dekorasi Background (CSS Murni) */
        .pattern-dots {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 30px 30px;
        }
        .circle-1 {
            position: absolute; border-radius: 50%;
            width: 300px; height: 300px;
            border: 40px solid rgba(0, 157, 165, 0.2);
            top: -100px; left: -100px;
        }
        .circle-2 {
            position: absolute; border-radius: 50%;
            width: 400px; height: 400px;
            background-color: rgba(0, 66, 105, 1);
            border: 2px solid rgba(255, 255, 255, 0.1);
            bottom: -150px; right: -100px;
        }
        .deco-stripes {
            position: absolute; top: 100px; right: 10%; width: 100px; height: 100px;
            background-image: repeating-linear-gradient(45deg, rgba(0, 157, 165, 0.3) 0, rgba(0, 157, 165, 0.3) 10px, transparent 10px, transparent 20px);
        }
        .deco-grid-dots {
            position: absolute; bottom: 80px; left: 10%; width: 120px; height: 80px;
            background-image: radial-gradient(#009DA5 3px, transparent 3px);
            background-size: 20px 20px; opacity: 0.5;
        }


        /* --- CARD STYLE: POP-TECH LAYERED (KEMBALI KE YANG LAMA) --- */
        /* Ini desain kotak yang Anda suka (ada border dashed di dalam) */
        
        /* 1. Cangkang Luar */
        .pop-card {
            background: #ffffff;
            border: 4px solid #004269;
            border-radius: 30px;
            box-shadow: 0px 12px 0px #004269; /* Shadow Blok Bawah */
            padding: 12px;
            position: relative;
            z-index: 10;
        }

        /* 2. Isi Dalam (Dashed Border) */
        .pop-inner {
            background: #F1F8FA;
            border: 3px dashed #009DA5; /* Garis Putus-putus Khas */
            border-radius: 20px;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        /* 3. Kapsul Header (Floating Pill) */
        .pop-pill-header {
            position: absolute;
            top: -25px; left: 50%; transform: translateX(-50%);
            background: #009DA5; color: white;
            border: 4px solid #004269;
            padding: 8px 30px;
            border-radius: 50px;
            font-weight: 800; font-size: 1.1rem;
            text-transform: uppercase; letter-spacing: 1px;
            white-space: nowrap;
            box-shadow: 0 6px 0 rgba(0,0,0,0.1);
            z-index: 20;
            display: flex; align-items: center; gap: 8px;
        }

        /* 4. Dekorasi Bintang */
        .sparkle { position: absolute; color: #009DA5; font-size: 20px; z-index: 15; pointer-events: none; }
        .sp-1 { top: -15px; left: 20px; font-size: 24px; color: #004269; transform: rotate(-15deg); }
        .sp-2 { top: -10px; right: 30px; font-size: 18px; color: #009DA5; }

        /* --- COMPONENTS --- */
        .pop-btn {
            background: #004269; color: white; border: 3px solid #004269; border-radius: 16px; font-weight: 800; text-transform: uppercase;
            box-shadow: 0 6px 0 #002840; transition: all 0.1s; position: relative; top: 0; cursor: pointer;
        }
        .pop-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 0 #002840; background-color: #003355; }
        .pop-btn:active { top: 6px; box-shadow: 0 0 0 #002840; transform: translateY(0); }

        .pop-input {
            background: white; border: 3px solid #cbd5e1; border-radius: 16px; padding: 14px; font-weight: 600; width: 100%;
        }
        .pop-input:focus { border-color: #009DA5; box-shadow: 0 6px 0 #009DA5; outline: none; }

        .pop-tab {
            background: white; border: 3px solid #e2e8f0; color: #64748b; font-weight: 700; padding: 10px 20px; border-radius: 50px; cursor: pointer;
        }
        .pop-tab.active { background: #009DA5; color: white; border-color: #004269; box-shadow: 0 4px 0 #004269; }
        .pop-tab:hover:not(.active) { border-color: #009DA5; color: #009DA5; }

        .info-bubble { background: white; border: 2px solid #009DA5; border-radius: 12px; padding: 10px 16px; position: relative; margin-bottom: 12px; }
        .info-bubble-label { position: absolute; top: -10px; left: 12px; background: #009DA5; color: white; font-size: 0.65rem; font-weight: 800; padding: 2px 8px; border-radius: 8px; text-transform: uppercase; }

    </style>

    <div class="memphis-header">
        <div class="pattern-dots"></div>
        <div class="circle-1"></div>
        <div class="circle-2"></div>
        <div class="deco-stripes"></div>
        <div class="deco-grid-dots"></div>
    </div>

    <div class="py-20 px-4 sm:px-6 lg:px-8 relative font-sans min-h-screen flex justify-center items-start" x-data="{ isEditing: false, activeTab: 'akademik' }">
        
        @if(session('success'))
        <div class="fixed top-6 right-6 z-50">
            <div class="bg-[#ccfbf1] border-4 border-[#009DA5] text-[#004269] px-6 py-4 rounded-2xl shadow-[6px_6px_0px_#004269] flex items-center gap-3 font-bold" x-data="{ show: true }" x-show="show">
                <i class="fas fa-heart text-[#009DA5]"></i>
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 font-black">X</button>
            </div>
        </div>
        @endif

        {{-- MAIN CONTENT --}}
        <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-12 gap-12 mt-8">

            <div class="lg:col-span-4 space-y-8">
                <div class="pop-card">
                    <div class="pop-pill-header">
                        <i class="fas fa-id-badge"></i> Biografi
                    </div>
                    <i class="fas fa-star sparkle sp-1"></i>
                    <i class="fas fa-star sparkle sp-2"></i>

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
                        <p class="text-[#009DA5] text-sm font-semibold mt-1">{{ $mahasiswa->program_studi}}</p>
                        
                        <div class="mt-8 mb-6 relative group">
                            <div class="w-44 h-44 bg-white p-2 rounded-[2.5rem] border-[5px] border-[#004269] shadow-[8px_8px_0px_rgba(0,66,105,0.2)]">
                                <img src="{{ auth()->user()?->mahasiswa?->foto
                                            ? asset('storage/image/' . auth()->user()->mahasiswa->foto)
                                            : 'https://ui-avatars.com/api/?name=Guest' }}"
                                     class="w-full h-full object-cover rounded-[2rem]" />
                            </div>
                            <button @click="isEditing = !isEditing" class="absolute -bottom-4 -right-4 w-14 h-14 bg-[#009DA5] rounded-full border-[4px] border-white text-white flex items-center justify-center shadow-lg hover:bg-[#004269] transition-colors">
                                <i class="fas fa-xl" :class="isEditing ? 'fa-times' : 'fa-pen'"></i>
                            </button>
                        </div>

                        <h2 class="text-2xl font-black text-[#004269] uppercase leading-none mt-4">{{ $mahasiswa->nama_mhs }}</h2>
                        
                        <div class="inline-block bg-[#004269] text-white px-4 py-1.5 rounded-full border-2 border-[#009DA5] text-1x1 font-extrabold mt-3 shadow-sm">
                            NIPD: {{ $mahasiswa->nipd }}
                        </div>


                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="pop-card h-full">
                    <div class="pop-pill-header" style="background: #004269; border-color: #009DA5;">
                        <i class="fas fa-folder-open"></i> Tentangku
                    </div>
                    <i class="fas fa-star sparkle sp-2" style="top: -20px; right: 50px; color: #004269;"></i>

                    <div class="pop-inner p-8 pt-12 bg-white/80 backdrop-blur-sm">
                        
                        {{-- Tab 1: Akademik --}}
                        <div x-show="activeTab === 'akademik'" class="fade-in space-y-6">
                            <h3 class="text-lg font-bold text-[#004269] flex items-center gap-2 mb-4">
                                <span class="w-1.5 h-6 bg-[#F15B67] rounded-full"></span> Informasi Akademik
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase">NIPD</span>
                                    <p class="text-lg font-bold text-[#004269] mt-1">{{ $mahasiswa->nipd }}</p>
                                </div>
                                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase">Kelas</span>
                                    <p class="text-lg font-bold text-[#004269] mt-1">{{ $mahasiswa->kelas->kode_kelas }}</p>
                                </div>
                                <div class="md:col-span-2 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                    <span class="text-xs font-bold text-slate-400 uppercase">Bidang Keahlian</span>
                                    <p class="text-lg font-bold text-[#004269] mt-1">{{ $mahasiswa->program_studi }}</p>
                                </div>

                            </div>
                        </div>

                        {{-- EDIT MODE --}}
                        <div x-show="isEditing" x-cloak class="h-full flex flex-col">
                            <div class="bg-yellow-50 border-[3px] border-yellow-400 rounded-3xl p-6 mb-6 flex items-start gap-4 shadow-sm">
                                <div class="bg-[#009da5]

                                text-[#004269] rounded-full w-12 h-12 flex flex-shrink-0 items-center justify-center font-black text-2xl border-2 border-[#004269]">!</div>
                                <div>
                                    <h4 class="font-black text-lg text-[#004269] uppercase">MODE EDIT AKTIF</h4>
                                    <p class="text-sm font-bold text-yellow-800 leading-tight">Silakan perbarui data Anda. Data Nama & NIPD dikunci.</p>
                                </div>
                            </div>

                            <form method="POST" action="{{ route('profile.updates') }}" enctype="multipart/form-data" class="flex-grow flex flex-col gap-6">
                                @csrf
                                @method('PATCH')

                                <div>
                                    <label class="block font-bold text-[#004269] mb-2 ml-2">ALAMAT DOMISILI BARU</label>
                                    <textarea name="Domisili" rows="3" class="pop-input" placeholder="Tulis alamat baru...">{{ old('Domisili', $mahasiswa->Domisili) }}</textarea>
                                    @error('Domisili') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block font-bold text-[#004269] mb-2 ml-2">GANTI FOTO PROFIL</label>
                                    <div class="bg-white border-3 border-dashed border-[#009DA5] rounded-2xl p-4 flex items-center gap-4">
                                        <img id="previewImg" src="{{ $mahasiswa->foto ? asset('storage/app/public/image/' . $mahasiswa->foto) : 'https://ui-avatars.com/api/?name=Guest' }}" class="w-16 h-16 rounded-xl object-cover border-2 border-[#004269]">
                                        <label class="cursor-pointer bg-[#009DA5] text-white px-4 py-2 rounded-xl font-bold hover:bg-[#007f85] transition shadow-sm">
                                            Upload File
                                            <input type="file" name="foto" class="hidden" onchange="previewFile(this)">
                                        </label>
                                    </div>
                                    @error('foto') <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p> @enderror
                                </div>

                                <script>
                                    function previewFile(input){
                                        const file = input.files[0];
                                        const preview = document.getElementById('previewImg');
                                        if(file){
                                            const reader = new FileReader();
                                            reader.onload = function(e){ preview.src = e.target.result; }
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                </script>

                                <div class="mt-auto flex gap-4 pt-4">
                                    <button type="button" @click="isEditing = false" class="flex-1 py-3 font-bold text-slate-400 bg-white border-2 border-slate-200 rounded-2xl hover:bg-slate-100 transition">BATAL</button>
                                    <button type="submit" class="flex-[2] pop-btn py-3">SIMPAN PERUBAHAN</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection