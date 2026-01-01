<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'E-Student LP3I') }}</title>
    
    <!-- Tailwind CSS (CDN for Preview) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#004269',
                        secondary: '#002845',
                        accent: '#009DA5',
                        'accent-light': '#3DBFC6',
                        'paper': '#ffffff', // Warna kertas putih untuk style komik
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    boxShadow: {
                        // Shadow keras untuk efek 2D/Komik
                        'comic': '4px 4px 0px 0px rgba(0,0,0,1)',
                        'comic-sm': '2px 2px 0px 0px rgba(0,0,0,1)',
                        'comic-lg': '6px 6px 0px 0px rgba(0,0,0,1)',
                    },
                    borderWidth: {
                        '3': '3px',
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"> -->

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 20px 20px;
        }

        .sidebar-scroll::-webkit-scrollbar { width: 6px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #002845; border: 1px solid white; border-radius: 10px; }

        [x-cloak] { display: none !important; }

        .btn-comic:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-800 overflow-x-hidden">

    <div x-data="{ isMobileSidebarOpen: false, activeDropdown: null }" class="min-h-screen flex flex-col lg:flex-row">
        
        <!-- Mobile Overlay -->
        <div 
            x-show="isMobileSidebarOpen" 
            @click="isMobileSidebarOpen = false; activeDropdown = null" 
            x-transition:enter="ease-out duration-300"
            x-transition:leave="ease-in duration-200"
            class="fixed inset-0 bg-black/80 z-40 lg:hidden backdrop-blur-sm" 
            style="display: none;"
        ></div>

        {{-- 1. SIDEBAR (2D Comic Style) --}}
        {{-- Fixed: Changed min-h-screen to h-screen and lg:static to lg:sticky lg:top-0 --}}
        <aside 
            x-bind:class="{ 'translate-x-0': isMobileSidebarOpen, '-translate-x-full': !isMobileSidebarOpen }" 
            class="w-64 bg-primary text-white h-screen fixed left-0 top-0 z-50 transform transition-transform duration-300 lg:translate-x-0 lg:sticky lg:top-0 flex flex-col justify-between overflow-hidden border-r-4 border-black shadow-comic-lg lg:shadow-none"
        > 
            <!-- Background Decoration (Comic Halftone/Shapes) -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0 opacity-10">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white rounded-full border-4 border-black"></div>
                <div class="absolute bottom-20 -left-10 w-20 h-20 bg-accent rotate-45 border-4 border-black"></div>
            </div>

            <div class="relative z-10 flex flex-col h-full">
                {{-- LOGO SECTION --}}
                <div class="px-6 py-6 lg:py-8 flex items-center justify-center border-b-4 border-black bg-primary">
                    <a href="{{ route('dashboard') }}" class="text-white group relative z-10 w-full">
                        <div class="flex items-center gap-3 p-3 bg-secondary border-2 border-black shadow-comic-sm rounded-xl hover:-translate-y-1 hover:shadow-comic transition-all duration-200">
                            <!-- Icon Container -->
                            <div class="w-10 h-10 bg-accent border-2 border-black rounded-lg flex items-center justify-center text-white shrink-0">
                                <i class="fas fa-graduation-cap text-lg"></i>
                            </div>
                            
                            <div class="flex flex-col min-w-0">
                                <span class="text-lg font-black tracking-wide leading-none text-white truncate" style="text-shadow: 2px 2px 0px #000;">E-Student</span>
                                <span class="text-[10px] font-bold uppercase tracking-wider mt-1 text-accent">Information System</span>
                            </div>
                        </div>
                    </a>
                </div>

                {{-- NAVIGATION LINKS --}}
                <nav class="flex-1 overflow-y-auto sidebar-scroll mt-4 px-4 pb-6 space-y-3">
                    @php
                        $currentRoute = Route::currentRouteName() ?? 'dashboard'; 
                        
                        // Style Menu Aktif
                        $activeClass = 'bg-white text-black border-2 border-black shadow-comic font-bold translate-x-1';
                        // Style Menu Hover
                        $hoverClass = 'text-white hover:bg-secondary hover:border-2 hover:border-black hover:shadow-comic-sm transition-all duration-200 border-2 border-transparent';
                        // Base Class
                        $baseClass = 'relative flex items-center px-4 py-3 rounded-lg text-sm transition-all duration-200';
                        
                        $academicRoutes = ['krs.menu', 'score.index', 'krs.index', 'nilai'];
                        $isAcademicActive = in_array($currentRoute, $academicRoutes);

                        $learningRoutes = ['tugas.index', 'materi', 'ebook.search', 'tugas', 'material.index'];
                        $isLearningActive = in_array($currentRoute, $learningRoutes);
                    @endphp
                    
                    <div class="bg-black text-white text-[10px] font-bold px-2 py-1 inline-block transform -skew-x-12 border border-white/20 mb-1">
                        MAIN MENU
                    </div>

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                        class="{{ $baseClass }} {{ $currentRoute == 'dashboard' ? $activeClass : $hoverClass }}"
                        @click="activeDropdown = null; isMobileSidebarOpen = false">
                        <i class="fas fa-th-large w-6 text-center mr-2"></i> 
                        Dashboard
                    </a>

                    {{-- Academic Dropdown --}}
                    <div class="relative">
                        <button 
                            @click.prevent="activeDropdown = (activeDropdown === 'academicDropdown' ? null : 'academicDropdown')" 
                            class="{{ $baseClass }} w-full text-left focus:outline-none {{ $isAcademicActive ? $activeClass : $hoverClass }}">
                            <i class="fas fa-graduation-cap w-6 text-center mr-2"></i>
                            Academic
                            <i class="fas fa-chevron-right text-[10px] ml-auto border-2 border-current rounded-full p-0.5 w-4 h-4 flex items-center justify-center transition-transform duration-200"
                                :class="{ 'rotate-90': activeDropdown === 'academicDropdown' }"></i>
                        </button>
                        
                        <div 
                            x-cloak 
                            x-show="activeDropdown === 'academicDropdown'"
                            x-transition:enter="ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-secondary border-2 border-black rounded-lg mt-2 mx-1 overflow-hidden shadow-comic-sm">
                            
                            <a href="{{ route('krs.index') }}" 
                                class="block px-4 py-2.5 text-sm text-gray-200 hover:text-white hover:bg-primary border-b border-black/20"
                                @click="isMobileSidebarOpen = false">
                                <i class="fas fa-caret-right mr-2"></i> KRS (Study Plan)
                            </a>

                            <a href="{{ route('nilai') }}" 
                                class="block px-4 py-2.5 text-sm text-gray-200 hover:text-white hover:bg-primary"
                                @click="isMobileSidebarOpen = false">
                                <i class="fas fa-caret-right mr-2"></i> Score (KHS)
                            </a>
                        </div>
                    </div>

                    {{-- Learning Dropdown --}}
                    <div class="relative">
                        <button 
                            @click.prevent="activeDropdown = (activeDropdown === 'learningDropdown' ? null : 'learningDropdown')" 
                            class="{{ $baseClass }} w-full text-left focus:outline-none {{ $isLearningActive ? $activeClass : $hoverClass }}">
                            <i class="fas fa-book-open w-6 text-center mr-2"></i>
                            Learning
                            <i class="fas fa-chevron-right text-[10px] ml-auto border-2 border-current rounded-full p-0.5 w-4 h-4 flex items-center justify-center transition-transform duration-200"
                                :class="{ 'rotate-90': activeDropdown === 'learningDropdown' }"></i>
                        </button>

                        <div 
                            x-cloak 
                            x-show="activeDropdown === 'learningDropdown'"
                            x-transition:enter="ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-secondary border-2 border-black rounded-lg mt-2 mx-1 overflow-hidden shadow-comic-sm">
                            
                            <a href="{{ route('tugas') }}"
                                class="block px-4 py-2.5 text-sm text-gray-200 hover:text-white hover:bg-primary border-b border-black/20"
                                @click="isMobileSidebarOpen = false">
                                <i class="fas fa-caret-right mr-2"></i> Assignments
                            </a>

                            <a href="{{ route('material.index') }}" 
                                class="block px-4 py-2.5 text-sm text-gray-200 hover:text-white hover:bg-primary"
                                @click="isMobileSidebarOpen = false">
                                <i class="fas fa-caret-right mr-2"></i> Materials
                            </a>
                        </div>
                    </div>

                    <div class="bg-black text-white text-[10px] font-bold px-2 py-1 inline-block transform -skew-x-12 border border-white/20 mb-1 mt-4">
                        GENERAL
                    </div>

                    {{-- Finance --}}
                    <a href="{{ route('infopembayaran.index') }}" 
                        class="{{ $baseClass }} {{ $currentRoute == 'infopembayaran.index' ? $activeClass : $hoverClass }}"
                        @click="activeDropdown = null; isMobileSidebarOpen = false">
                        <i class="fas fa-wallet w-6 text-center mr-2"></i>
                        Finance
                    </a>

                    {{-- Announcement --}}
                    <a href="{{ route('pengumuman.index') }}" 
                        class="{{ $baseClass }} {{ $currentRoute == 'pengumuman.index' ? $activeClass : $hoverClass }}"
                        @click="activeDropdown = null; isMobileSidebarOpen = false">
                        <i class="fas fa-bullhorn w-6 text-center mr-2"></i>
                        Announcements
                    </a>
                </nav>
                
                <div class="p-4 border-t-4 border-black bg-secondary">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 text-sm font-bold text-white bg-primary border-2 border-black shadow-comic hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px] hover:bg-red-600 active:translate-x-[2px] active:translate-y-[2px] active:shadow-comic-sm rounded-lg transition-all duration-100">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>SIGN OUT</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
            
            <header class="sticky top-0 z-30 px-4 py-4">
                <div class="bg-white border-2 border-black shadow-comic rounded-xl p-3 px-4 lg:px-5 flex items-center justify-between transition-all duration-300">
                    <div class="flex items-center gap-3">
                         <button @click="isMobileSidebarOpen = !isMobileSidebarOpen; activeDropdown = null" class="text-black p-2 rounded-lg border-2 border-transparent hover:border-black hover:bg-gray-100 lg:hidden focus:outline-none transition-all">
                            <i class="fas fa-bars w-5 h-5"></i>
                        </button>
                        
                        <div class="flex flex-col">
                            <h1 class="text-base sm:text-lg font-black text-primary tracking-tight leading-tight">E-Student </h1>
                            <p class="text-[10px] sm:text-xs text-gray-600 font-medium hidden sm:block">LP3I College Karawang</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4" x-data="{ profileOpen: false }">                    

                        <div class="h-6 sm:h-8 w-1 bg-black mx-1 rounded-full opacity-20"></div>

                        <!-- Profile -->
                        <div class="relative">
                            <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 sm:gap-3 p-1 rounded-lg hover:bg-gray-100 border-2 border-transparent hover:border-black transition-all duration-200 group focus:outline-none">
                                <div class="hidden md:flex flex-col items-end">
                                    <p class="text-sm font-bold text-black leading-none max-w-[100px] truncate">
                                        {{ auth()->user()?->mahasiswa?->nama_mhs ?? 'Guest User' }}
                                    </p>
                                    <p class="text-[10px] text-white bg-black px-1.5 py-0.5 rounded-sm font-bold mt-1">
                                        {{ auth()->user()?->mahasiswa?->nipd ?? 'STUDENT' }}
                                    </p>
                                </div>
                                <div class="relative">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-black overflow-hidden bg-accent shrink-0">
                                        <img src="{{ auth()->user()?->mahasiswa?->foto
                                                ? asset('storage/image/' . auth()->user()->mahasiswa->foto)
                                                : 'https://ui-avatars.com/api/?name=' . (auth()->user()?->mahasiswa?->nama_mhs ?? 'Guest') . '&background=009DA5&color=fff' }}" 
                                             class="w-full h-full object-cover" 
                                             alt="Profile">
                                    </div>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-black transition-transform duration-200 hidden sm:block" :class="{ 'rotate-180': profileOpen }"></i>
                            </button>

                            <!-- Profile Dropdown (Comic Style) -->
                            <div 
                                x-show="profileOpen" 
                                @click.outside="profileOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute right-0 top-full mt-3 w-56 sm:w-60 bg-white rounded-xl border-2 border-black shadow-comic py-0 z-50 origin-top-right overflow-hidden"
                                style="display: none;">
                                
                                <!-- <div class="px-5 py-4 border-b-2 border-black bg-yellow-50 block md:hidden">
                                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Signed in as</p>
                                    <p class="text-sm font-black text-primary truncate">{{ auth()->user()?->mahasiswa?->nama_mhs ?? 'Guest' }}</p>
                                </div> -->
                                
                                <div class="px-5 py-4 border-b-2 border-black bg-yellow-50">
                                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Signed in as</p>
                                    <p class="text-sm font-black text-primary truncate">{{ auth()->user()?->mahasiswa?->nama_mhs ?? 'Guest' }}</p>
                                    <p class="text-sm font-black text-primary truncate">{{ auth()->user()?->mahasiswa?->nipd ?? 'Guest' }}</p>
                                </div>

                                <div class="p-2 space-y-1">
                                    <a href="{{ route('profile.mahasiswa') }}" class="flex items-center px-4 py-2.5 text-sm font-bold text-gray-700 hover:bg-primary hover:text-white border-2 border-transparent hover:border-black rounded-lg transition-all">
                                        <i class="far fa-user w-5 mr-2"></i> My Profile
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm font-bold text-gray-700 hover:bg-primary hover:text-white border-2 border-transparent hover:border-black rounded-lg transition-all">
                                        <i data-lucide="user" class="w-4 h-4"></i>  My Account
                                    </a>
                                </div>
                                
                                <div class="p-2 border-t-2 border-black">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <!-- <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm font-bold text-black hover:bg-red-500 hover:text-white hover:border-black border-2 border-transparent rounded-lg transition-all">
                                            <i class="fas fa-sign-out-alt w-5 mr-2"></i> Sign Out
                                        </button> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Main Content Area -->
            <div class="relative flex-1 px-4 lg:px-8 pb-8 overflow-y-auto">
                <div class="relative z-10 pt-4">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </div>

            <div class="px-8 pb-6 mt-auto">
                   <x-app-footer /> 
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