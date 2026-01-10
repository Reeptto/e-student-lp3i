<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Student LP3I') }}</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004269',      // Navy Blue Asli
                        secondary: '#002845',    // Darker Navy
                        accent: '#009DA5',       // Teal Asli
                        surface: '#f3f4f6',      // Light Gray Background
                    },
                    fontFamily: {
                        sans: ['Inter', 'Poppins', 'sans-serif'], 
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        [x-cloak] { display: none !important; }
        
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 10px; }
        .sidebar-scroll:hover::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.4); }
    </style>
</head>

<body class="text-slate-600 antialiased bg-surface">

    <div x-data="{ isMobileSidebarOpen: false, activeDropdown: null }" class="min-h-screen flex flex-col lg:flex-row">
        
        <div 
            x-show="isMobileSidebarOpen" 
            @click="isMobileSidebarOpen = false" 
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 lg:hidden"
            style="display: none;"
        ></div>

        {{-- 1. SIDEBAR (Warna Asli Navy #004269, tapi Desain Clean) --}}
        <aside 
            class="fixed inset-y-0 left-0 z-50 w-72 bg-primary text-white transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:h-screen flex flex-col shadow-2xl"
            :class="isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            {{-- Logo Section --}}
            <div class="h-20 flex items-center px-6 border-b border-white/10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group w-full">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-primary shadow-lg transition-transform group-hover:scale-105">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-white tracking-tight leading-none">E-Student</span>
                        <span class="text-[11px] font-medium text-accent uppercase tracking-wider mt-1">Information System</span>
                    </div>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 overflow-y-auto sidebar-scroll px-4 py-6 space-y-1">
                
                @php
                    $currentRoute = Route::currentRouteName() ?? 'dashboard';
                    
                    $linkBase = "group flex items-center w-full px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 ease-in-out";
                    
                    $linkInactive = "text-slate-300 hover:text-white hover:bg-white/10";
                    
                    $linkActive = "bg-white text-primary shadow-md font-bold";
                    
                    $linkDropdownActive = "bg-secondary text-white shadow-inner"; 

                    $academicRoutes = ['krs.menu', 'score.index', 'krs.index', 'nilai'];
                    $isAcademicActive = in_array($currentRoute, $academicRoutes);

                    $learningRoutes = ['tugas.index', 'materi', 'ebook.search', 'tugas', 'material.index'];
                    $isLearningActive = in_array($currentRoute, $learningRoutes);
                @endphp

                <div class="px-4 mb-2 mt-2 text-[10px] font-bold text-slate-400/80 uppercase tracking-widest">Menu Utama</div>

                {{-- Dashboard Link --}}
                <a href="{{ route('dashboard') }}" 
                   class="{{ $linkBase }} {{ $currentRoute == 'dashboard' ? $linkActive : $linkInactive }}">
                    <i class="fas fa-th-large w-5 text-center mr-3 text-lg {{ $currentRoute == 'dashboard' ? 'text-primary' : 'text-slate-400 group-hover:text-white' }}"></i>
                    Dashboard
                </a>

                {{-- Academic Dropdown --}}
                <div class="relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'academicDropdown' ? null : 'academicDropdown')"
                        class="{{ $linkBase }} {{ $isAcademicActive ? $linkDropdownActive : $linkInactive }} justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-graduation-cap w-5 text-center mr-3 text-lg {{ $isAcademicActive ? 'text-accent' : 'text-slate-400 group-hover:text-white' }}"></i>
                            Akademik
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200 opacity-70" 
                           :class="activeDropdown === 'academicDropdown' ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="activeDropdown === 'academicDropdown'" x-collapse class="pl-4 pr-2 space-y-1 mt-1 bg-black/10 rounded-xl py-2 mx-2">
                        <a href="{{ route('krs.index') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-white transition-colors {{ request()->routeIs('krs.*') ? 'text-accent font-bold' : 'text-slate-400' }}">
                            Kartu Rencana Studi
                        </a>
                        <a href="{{ route('nilai') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-white transition-colors {{ request()->routeIs('nilai') ? 'text-accent font-bold' : 'text-slate-400' }}">
                            Nilai (KHS)
                        </a>
                    </div>
                </div>

                {{-- Learning Dropdown --}}
                <div class="relative">
                    <button 
                        @click="activeDropdown = (activeDropdown === 'learningDropdown' ? null : 'learningDropdown')"
                        class="{{ $linkBase }} {{ $isLearningActive ? $linkDropdownActive : $linkInactive }} justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-book-open w-5 text-center mr-3 text-lg {{ $isLearningActive ? 'text-accent' : 'text-slate-400 group-hover:text-white' }}"></i>
                            Pembelajaran
                        </div>
                        <i class="fas fa-chevron-down text-xs transition-transform duration-200 opacity-70" 
                           :class="activeDropdown === 'learningDropdown' ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="activeDropdown === 'learningDropdown'" x-collapse class="pl-4 pr-2 space-y-1 mt-1 bg-black/10 rounded-xl py-2 mx-2">
                        <a href="{{ route('tugas') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-white transition-colors {{ request()->routeIs('tugas') ? 'text-accent font-bold' : 'text-slate-400' }}">
                            Tugas
                        </a>
                        <a href="{{ route('material.index') }}" class="block px-4 py-2 text-sm rounded-lg hover:text-white transition-colors {{ request()->routeIs('material.*') ? 'text-accent font-bold' : 'text-slate-400' }}">
                            Materi Perkuliahan
                        </a>
                    </div>
                </div>

                <div class="px-4 mb-2 mt-8 text-[10px] font-bold text-slate-400/80 uppercase tracking-widest">Keuangan & Info</div>

                {{-- Finance --}}
                <a href="{{ route('infopembayaran.index') }}" 
                   class="{{ $linkBase }} {{ $currentRoute == 'infopembayaran.index' ? $linkActive : $linkInactive }}">
                    <i class="fas fa-wallet w-5 text-center mr-3 text-lg {{ $currentRoute == 'infopembayaran.index' ? 'text-primary' : 'text-slate-400 group-hover:text-white' }}"></i>
                    Pembayaran
                </a>

                {{-- Announcement --}}
                <a href="{{ route('pengumuman.index') }}" 
                   class="{{ $linkBase }} {{ $currentRoute == 'pengumuman.index' ? $linkActive : $linkInactive }}">
                    <i class="fas fa-bullhorn w-5 text-center mr-3 text-lg {{ $currentRoute == 'pengumuman.index' ? 'text-primary' : 'text-slate-400 group-hover:text-white' }}"></i>
                    Pengumuman
                </a>

            </nav>

            {{-- Sidebar Footer (Logout) --}}
            <div class="p-4 border-t border-white/10 bg-secondary/50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center w-full gap-2 px-4 py-3 text-sm font-medium text-white bg-red-600/80 hover:bg-red-600 rounded-xl transition-all duration-200 shadow-lg hover:shadow-red-900/20">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 h-screen overflow-hidden bg-surface">
            

            <header class="h-20 bg-white border-b border-slate-200 sticky top-0 z-30 px-4 lg:px-8 flex items-center justify-between shadow-sm relative">

                {{-- BAGIAN KIRI: Toggle Menu + Logo --}}
                <div class="flex items-center gap-4 z-20">
                    {{-- Tombol Toggle (Hanya muncul di HP) --}}
                    <button @click="isMobileSidebarOpen = true" class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>

                    {{-- Logo Gambar (Sekarang di Kiri) --}}
                    <img src="{{ asset('/img/lp3i-kotak.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                    <img src="{{ asset('/img/global.png') }}" alt="Logo" class="h-10 w-auto object-contain">
                </div>

                {{-- BAGIAN TENGAH: Judul Halaman (Absolute Center Presisi) --}}
                <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 w-max text-center pointer-events-none">
                    <h2 class="hidden sm:block text-lg md:text-xl font-bold text-primary tracking-tight whitespace-nowrap">
                        @if(request()->routeIs('dashboard')) Dashboard
                        @elseif(request()->routeIs('krs.*')) Kartu Rencana Studi
                        @elseif(request()->routeIs('nilai')) Informasi Nilai
                        @elseif(request()->routeIs('tugas')) Tugas
                        @elseif(request()->routeIs('profile.mahasiswa')) Profile Mahasiswa
                        @elseif(request()->routeIs('tugas.show')) Detail Tugas
                        @elseif(request()->routeIs('material.index')) Materi Pembelajaran
                        @elseif(request()->routeIs('infopembayaran.index')) Informasi Keuangan
                        @elseif(request()->routeIs('pengumuman.index')) Informasi Perkuliahan
                        @else Halaman Akademik
                        @endif
                    </h2>
                </div>

                {{-- BAGIAN KANAN: Profile & Notifikasi --}}
                <div class="flex items-center gap-3 sm:gap-5 z-20" x-data="{ profileOpen: false }">
                    
                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                    {{-- Profile Menu --}}
                    <div class="relative">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-3 focus:outline-none group">
                            
                            {{-- Teks Nama (Hidden di HP) --}}
                            <div class="text-right hidden md:block">
                                <p class="text-sm font-bold text-slate-700 group-hover:text-primary transition-colors">
                                    {{ auth()->user()?->mahasiswa?->nama ?? 'Guest User' }}
                                </p>
                                <p class="text-[10px] font-bold text-accent uppercase">
                                    {{ auth()->user()?->mahasiswa?->nipd ?? 'Student' }}
                                </p>
                            </div>
                            
                            {{-- Foto Avatar --}}
                            <div class="relative">
                                <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-slate-100 overflow-hidden ring-2 ring-white shadow-md group-hover:ring-primary/20 transition-all">
                                    <img src="{{ auth()->user()?->mahasiswa?->foto
                                            ? asset('storage/image/' . auth()->user()->mahasiswa->foto)
                                            : 'https://ui-avatars.com/api/?name=' . (auth()->user()?->mahasiswa?->nama ?? 'Guest') . '&background=004269&color=fff' }}" 
                                        class="w-full h-full object-cover" 
                                        alt="Profile">
                                </div>
                            </div>
                            
                            <i class="fas fa-chevron-down text-slate-400 text-xs hidden md:block transition-transform duration-200" :class="{ 'rotate-180': profileOpen }"></i>
                        </button>

                        {{-- Dropdown Profile --}}
                        <div 
                            x-show="profileOpen" 
                            @click.outside="profileOpen = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute right-0 top-full mt-4 w-60 bg-white rounded-xl shadow-2xl border border-slate-100 py-2 z-50 origin-top-right"
                            style="display: none;"
                        >
                            <div class="px-5 py-4 border-b border-slate-50 bg-slate-50/50 block md:hidden">
                                <p class="text-xs text-slate-400 font-bold uppercase mb-1">Login sebagai</p>
                                <p class="text-sm font-bold text-primary truncate">{{ auth()->user()?->mahasiswa?->nama ?? 'Guest' }}</p>
                            </div>

                            <div class="p-2 space-y-1">
                                <a href="{{ route('profile.mahasiswa') }}" class="flex items-center px-3 py-2 text-sm font-medium text-slate-600 hover:text-primary hover:bg-slate-50 rounded-lg transition-colors">
                                    <i class="far fa-user w-5 mr-2 text-slate-400"></i> Profil Saya
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 text-sm font-medium text-slate-600 hover:text-primary hover:bg-slate-50 rounded-lg transition-colors">
                                    <i data-lucide="settings" class="w-4 h-4 mr-3 text-slate-400"></i> Pengaturan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            {{-- Content Area --}}
            <div class="flex-1 overflow-y-auto bg-surface p-4 lg:p-8">
                <div class="max-w-7xl mx-auto space-y-6">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
                
                <div class="mt-8 max-w-7xl mx-auto">
                    <x-app-footer /> 
                </div>
            </div>

        </main>
    </div>
    
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>
</html>