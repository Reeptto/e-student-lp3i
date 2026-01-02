<x-guest-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* === GLOBAL SETTINGS === */
        body { 
            font-family: 'Poppins', sans-serif !important; 
            background-color: #e6eefa;
            color: #2d3748;
            /* Pola Dot Pattern Halus untuk Background */
            background-image: radial-gradient(#cbd5e0 15%, transparent 15%);
            background-size: 20px 20px;
        }
        
        :root {
            --teal-main: #009DA5;
            --navy-main: #004269;
            --metal-light: #f8fafc;
        }

        /* === BUBBLE TEXT STYLING (FIXED RESPONSIVE) === */
        /* Wrapper untuk posisi, TIDAK dianimasikan */
        .bubble-wrapper {
            position: absolute;
            z-index: 30;
            /* Posisi default untuk mobile (tengah atas) */
            top: -35px;
            left: 50%;
            transform: translateX(-50%);
            width: max-content; /* Agar lebar menyesuaikan konten */
        }

        /* Posisi khusus desktop */
        @media (min-width: 1024px) {
            .bubble-wrapper.bubble-left {
                top: -40px;
                left: -20px;
                transform: rotate(2deg); /* Rotasi statis */
            }
            .bubble-wrapper.bubble-right {
                bottom: 500px;
                left: 300px;
                top: auto; /* Reset top */
                transform: rotate(-2deg);
            }
        }

        /* Kotak bubble yang dianimasikan (hanya naik turun) */
        .bubble-box {
            background: white;
            border: 3px solid var(--navy-main);
            border-radius: 16px;
            padding: 12px 20px;
            box-shadow: 6px 6px 0px rgba(0, 157, 165, 0.3);
            max-width: 200px;
            animation: floatBubble 4s ease-in-out infinite;
            position: relative; /* Untuk psuedo-element */
        }

        /* Ekor Bubble */
        .bubble-box::after {
            content: ''; position: absolute;
            border-style: solid; border-width: 10px 10px 0;
            border-color: var(--navy-main) transparent;
            display: block; width: 0; z-index: 1; 
            /* Posisi ekor default (tengah bawah) */
            bottom: -10px; left: 50%; transform: translateX(-50%);
        }

        /* Penyesuaian ekor untuk desktop */
        @media (min-width: 1024px) {
            .bubble-left .bubble-box::after { left: 20px; transform: none; }
            .bubble-right .bubble-box { border-color: var(--teal-main); }
            .bubble-right .bubble-box::after { border-color: var(--teal-main) transparent; left: 20px; transform: none; }
        }

        @keyframes floatBubble {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        /* === COMPONENT: HYBRID CARD === */
        .hybrid-card {
            background: var(--metal-light);
            border-radius: 24px;
            border: 4px solid var(--navy-main); 
            box-shadow: 10px 10px 0px rgba(0, 66, 105, 0.15); 
            position: relative;
            z-index: 10;
            overflow: visible; 
        }

        /* === DEKORASI RIVET (PAKU) === */
        .rivet {
            position: absolute; width: 12px; height: 12px;
            background: var(--teal-main); border-radius: 50%;
            border: 2px solid var(--navy-main); z-index: 20;
            box-shadow: inset 2px 2px 0px rgba(255,255,255,0.4);
        }
        .rivet-tl { top: 12px; left: 12px; }
        .rivet-tr { top: 12px; right: 12px; }
        .rivet-bl { bottom: 12px; left: 12px; }
        .rivet-br { bottom: 12px; right: 12px; }

        /* === INPUT FIELDS === */
        .hybrid-input-group { position: relative; transition: transform 0.2s; }
        .hybrid-input-group:focus-within { transform: translateX(5px); } 
        
        .hybrid-input {
            width: 100%;
            padding: 16px 20px 16px 55px;
            background: #fff;
            border: 3px solid var(--navy-main);
            border-radius: 12px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--navy-main);
            transition: all 0.2s;
            box-shadow: 4px 4px 0px #e2e8f0;
        }
        .hybrid-input:focus {
            outline: none;
            border-color: var(--teal-main);
            box-shadow: 4px 4px 0px var(--teal-main);
        }
        .hybrid-icon {
            position: absolute; left: 15px; top: 50%; transform: translateY(-50%);
            color: var(--navy-main); z-index: 10;
        }

        /* === BUTTON === */
        .btn-hybrid {
            background: var(--navy-main);
            color: white;
            font-weight: 800;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 3px solid var(--navy-main);
            border-radius: 12px;
            padding: 16px;
            width: 100%;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 5px 5px 0px var(--teal-main);
            position: relative; top: 0; left: 0;
        }
        .btn-hybrid:hover {
            top: 2px; left: 2px;
            box-shadow: 2px 2px 0px var(--teal-main);
            background: var(--teal-main);
        }

        /* === RIGHT SIDE STYLES === */
        .info-panel {
            background: white;
            border: 3px solid var(--navy-main);
            border-radius: 20px;
            padding: 2rem;
            position: relative;
            box-shadow: 8px 8px 0px rgba(0, 66, 105, 0.1);
        }
        
        .menu-item {
            background: #f8fafc;
            border: 2px solid var(--navy-main);
            border-radius: 16px;
            padding: 15px;
            display: flex; align-items: center; gap: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .menu-item:hover {
            background: white;
            border-color: var(--teal-main);
            box-shadow: 4px 4px 0px var(--teal-main);
            transform: translateY(-3px);
        }
        .menu-icon {
            width: 45px; height: 45px;
            background: var(--teal-main);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white;
            border: 2px solid var(--navy-main);
        }

        /* === BACKGROUND PATTERNS (NEW) === */
        /* Pola Grid Teknikal untuk Bagian Kanan */
        .technical-grid-bg {
            background-color: #e6eefa;
            background-image: 
                linear-gradient(rgba(0, 66, 105, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 66, 105, 0.05) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* Dekorasi Geometri Melayang */
        .deco-shape { position: absolute; z-index: 0; pointer-events: none; }
        
        .deco-circle-outline {
            width: 300px; height: 300px;
            border: 4px dashed var(--navy-main);
            border-radius: 50%;
            opacity: 0.1;
            top: -50px; right: -50px;
            /* animation: spinSlow 60s linear infinite; */
        }
        
        .deco-square-solid {
            width: 150px; height: 150px;
            background: var(--teal-main);
            opacity: 0.1;
            bottom: 50px; left: 20px;
            transform: rotate(15deg);
        }

        @keyframes spinSlow { 100% { transform: rotate(360deg); } }

        /* Garis Strip Industrial (Caution Tape Style) */
        .industrial-stripe {
            height: 12px;
            width: 100%;
            background: repeating-linear-gradient(
                45deg,
                var(--navy-main),
                var(--navy-main) 10px,
                var(--teal-main) 10px,
                var(--teal-main) 20px
            );
            position: absolute; top: 0; left: 0;
            border-bottom: 2px solid var(--navy-main);
        }

    </style>
    @endpush

    <div class="flex flex-col lg:flex-row min-h-screen overflow-hidden font-['Poppins']">
        
        {{-- === BAGIAN KIRI: FORM LOGIN === --}}
        <div class="w-full lg:w-1/2 min-h-[100vh] flex items-center justify-center p-6 relative">
            
            {{-- Background Image Mobile/Desktop --}}
            <div class="absolute inset-0 z-0 bg-cover bg-center lg:rounded-r-[10px] border-r-0 lg:border-r-4 border-[#004269] overflow-hidden" 
                 style="background-image: url('/img/gedung.webp');">
                 <div class="absolute inset-0 bg-[#e6eefa] opacity-90 lg:opacity-80 lg:backdrop-blur-sm"></div>
            </div>

            {{-- LOGIN CARD --}}
            <div class="w-full max-w-md hybrid-card p-8 sm:p-12 bg-white relative mt-10 lg:mt-0"> {{-- Margin top di mobile agar bubble tidak kepotong --}}
                
                {{-- BUBBLE TEXT 1 (Sapaan) --}}
                {{-- Menggunakan wrapper strategy --}}
                <div class="bubble-wrapper bubble-left">
                    <div class="bubble-box">
                        <p class="text-xs font-bold text-[#004269]">👋 Hai! Silakan login untuk akses data.</p>
                    </div>
                </div>

                {{-- Rivets --}}
                <div class="rivet rivet-tl"></div><div class="rivet rivet-tr"></div>
                <div class="rivet rivet-bl"></div><div class="rivet rivet-br"></div>

                <div class="text-center mb-8 relative z-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl mb-4 bg-[#e6eefa] border-4 border-[#004269] text-[#009DA5]">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    </div>
                    <h1 class="text-3xl font-black text-[#004269] uppercase tracking-wider">Login Portal</h1>
                    <div class="h-1 w-20 bg-[#009DA5] mx-auto mt-2 rounded-full"></div>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-5 relative z-10">
                    @csrf
                    <div>
                        <x-input-label for="nipd" :value="__('NIPD / ID User')" class="text-xs font-bold text-[#004269] uppercase ml-1 mb-1 block" />
                        <div class="hybrid-input-group">
                            <div class="hybrid-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                            </div>
                            <input id="nipd" class="hybrid-input" type="text" name="nipd" required placeholder="1234xxxxx" />
                        </div>
                        <x-input-error :messages="$errors->get('nipd')" class="mt-1 text-xs font-bold text-red-500" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-xs font-bold text-[#004269] uppercase ml-1 mb-1 block" />
                        <div class="hybrid-input-group">
                            <div class="hybrid-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" class="hybrid-input" type="password" name="password" required placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs font-bold text-red-500" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn-hybrid">Masuk Sekarang</button>
                    </div>

                    <div class="text-center flex justify-between items-center text-xs font-bold">
                        <label class="flex items-center text-gray-500 cursor-pointer">
                            <input type="checkbox" class="mr-2 rounded border-2 border-[#004269] text-[#009DA5] focus:ring-0"> Ingat Saya
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[#009DA5] hover:underline decoration-2">Lupa Sandi?</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        {{-- === BAGIAN KANAN: DASHBOARD INFO === --}}
        <div class="w-full lg:w-1/2 p-6 lg:p-12 flex items-center justify-center technical-grid-bg relative overflow-hidden">
            
            {{-- Dekorasi Latar Belakang --}}
            <div class="deco-shape deco-circle-outline"></div>
            <div class="deco-shape deco-square-solid"></div>

            <div class="w-full max-w-xl relative z-10 mt-10 lg:mt-0"> {{-- Margin top mobile --}}
                
                {{-- BUBBLE TEXT 2 (Info) --}}
                {{-- Wrapper Strategy --}}
                <div class="bubble-wrapper bubble-right">
                    <div class="bubble-box">
                        <p class="text-xs font-bold text-[#009DA5]">🚀 Fitur Akademik Terlengkap ada di sini!</p>
                    </div>
                </div>

                {{-- INFO PANEL --}}
                <div class="info-panel mb-8">
                    {{-- Stripe Decoration --}}
                    <div class="industrial-stripe"></div>

                    <div class="flex items-center justify-between mb-6 border-b-2 border-dashed border-[#004269] pb-4 pt-4">
                        <div>
                            <span class="bg-[#004269] text-white text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-widest border border-[#009DA5]">Student Area</span>
                            <h2 class="text-4xl font-black text-[#004269] mt-2 tracking-tight">eStudent<span class="text-[#009DA5]">.</span></h2>
                        </div>
                        <img src="{{ asset('/img/2.webp') }}" class="w-20 opacity-90 drop-shadow-md">
                    </div>
                    
                    <p class="text-[#004269] font-medium text-sm leading-relaxed mb-6 bg-[#009DA5]/10 p-3 rounded-lg border-l-4 border-[#009DA5]">
                        Selamat datang di portal akademik terintegrasi. Kelola Kartu Rencana Studi (KRS), cek transkrip nilai, dan update biodata dalam satu dashboard yang responsif.
                    </p>

                    {{-- GRID MENU --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="menu-item group">
                            <div class="menu-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#004269] text-sm">Biodata</h4>
                                <span class="text-[10px] font-bold text-[#009DA5] uppercase">Update Data</span>
                            </div>
                        </div>

                        <div class="menu-item group">
                             <div class="menu-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#004269] text-sm">Nilai</h4>
                                <span class="text-[10px] font-bold text-[#009DA5] uppercase">Transkrip</span>
                            </div>
                        </div>

                        <div class="menu-item group">
                             <div class="menu-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#004269] text-sm">Studi</h4>
                                <span class="text-[10px] font-bold text-[#009DA5] uppercase">KRS Online</span>
                            </div>
                        </div>

                        <div class="menu-item group">
                            <div class="menu-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-[#004269] text-sm">Kalender</h4>
                                <span class="text-[10px] font-bold text-[#009DA5] uppercase">Agenda</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-guest-layout>