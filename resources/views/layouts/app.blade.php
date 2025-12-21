<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Student LP3I Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigoDye: '#004269',
                        viridian: '#009DA5',
                        fieryRose: '#F15B67',
                        bgGray: '#F3F4F6'
                    }
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #003354; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #009DA5; border-radius: 2px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans text-gray-800 bg-bgGray overflow-hidden" 
      x-data="{ 
          sidebarOpen: window.innerWidth >= 1024,
          isMobile: window.innerWidth < 1024,
          init() {
              window.addEventListener('resize', () => {
                  this.isMobile = window.innerWidth < 1024;
                  if (!this.isMobile) this.sidebarOpen = true;
                  else this.sidebarOpen = false;
              });
          }
      }">

    <div class="flex h-screen">
        
        <!-- SIDEBAR -->
        <aside class="fixed lg:relative z-40 h-full flex-shrink-0 bg-indigoDye text-white transition-all duration-300 ease-in-out shadow-2xl"
               :class="sidebarOpen ? 'w-72 translate-x-0' : 'w-72 -translate-x-full lg:w-0 lg:-translate-x-full lg:overflow-hidden'">
            
            <div class="h-full flex flex-col w-72">
                <!-- Sidebar Logo -->
                <div class="flex items-center gap-3 px-6 py-6 border-b border-[#005585]">
                    <div class="flex flex-col items-center justify-center bg-white rounded-lg w-10 h-10 shadow-sm flex-shrink-0">
                        <span class="text-2xl font-bold text-indigoDye">E</span>
                    </div>
                    <div class="flex flex-col text-white min-w-0">
                        <span class="text-xl font-bold leading-none tracking-tight truncate">student<span class="text-yellow-400">🎓</span></span>
                        <span class="text-[9px] text-gray-300 font-medium uppercase tracking-wider mt-1 truncate">Information System</span>
                    </div>
                </div>

                <!-- Menu Area -->
                <nav class="flex-1 overflow-y-auto py-6 space-y-1 custom-scrollbar">
                    <p class="px-6 mb-2 text-xs font-bold text-viridian uppercase tracking-wider">Main Menu</p>
                    
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 flex items-center justify-between text-white bg-[#005585] border-l-4 border-viridian transition-all">
                        <div class="flex items-center gap-3">
                            <i data-lucide="home" class="w-[18px]"></i>
                            <span class="text-sm font-semibold">Dashboard</span>
                        </div>
                    </a>

                    <!-- Academics Dropdown -->
                    <div x-data="{ open: false }" class="select-none">
                        <div @click="open = !open" 
                             class="px-6 py-3 cursor-pointer flex items-center justify-between text-gray-300 hover:text-white hover:bg-[#005585] transition-all">
                            <div class="flex items-center gap-3">
                                <i data-lucide="graduation-cap" class="w-[18px]" :class="open ? 'text-viridian' : ''"></i>
                                <span class="text-sm" :class="open ? 'font-semibold text-white' : 'font-medium'">Academics</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-[14px] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </div>
                        
                        <div x-show="open" x-collapse class="bg-[#003354]">
                            <a href="{{route('krs.index')}}" class="block pl-10 pr-6 py-2 text-sm text-gray-400 hover:text-white hover:bg-[#004269]">KRS (Study Plan)</a>
                            <a href="{{ route('nilai') }}" class="block pl-10 pr-6 py-2 text-sm text-gray-400 hover:text-white hover:bg-[#004269]">Score</a>
                            
                            <!-- <a href="#" class="block pl-10 pr-6 py-2 text-sm text-gray-400 hover:text-white hover:bg-[#004269]">Exam Card</a> -->
                        </div>
                    </div>

                    <!-- Learning Dropdown -->
                    <div x-data="{ open: false }" class="select-none">
                        <div @click="open = !open" 
                             class="px-6 py-3 cursor-pointer flex items-center justify-between text-gray-300 hover:text-white hover:bg-[#005585] transition-all">
                            <div class="flex items-center gap-3">
                                <i data-lucide="book-open" class="w-[18px]" :class="open ? 'text-viridian' : ''"></i>
                                <span class="text-sm" :class="open ? 'font-semibold text-white' : 'font-medium'">Learning</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-[14px] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </div>
                        <div x-show="open" x-collapse class="bg-[#003354]">
                            <a href="{{ route('tugas') }}" class="block pl-10 pr-6 py-2 text-sm text-gray-400 hover:text-white hover:bg-[#004269]">Assignments</a>
                            <a href="#" class="block pl-10 pr-6 py-2 text-sm text-gray-400 hover:text-white hover:bg-[#004269]">Lecturer Schedule</a>
                        </div>
                    </div>

                    <a href="#" class="px-6 py-3 flex items-center justify-between text-gray-300 hover:text-white hover:bg-[#005585] transition-all">
                        <div class="flex items-center gap-3">
                            <i data-lucide="credit-card" class="w-[18px]"></i>
                            <span class="text-sm font-medium">Financial</span>
                        </div>
                    </a>

                    <a href="{{ route('pengumuman.index') }}" class="px-6 py-3 flex items-center justify-between text-gray-300 hover:text-white hover:bg-[#005585] transition-all">
                        <div class="flex items-center gap-3">
                            <i data-lucide="bell" class="w-[18px]"></i>
                            <span class="text-sm font-medium">Announcements</span>
                        </div>
                    </a>
                </nav>

                <!-- Footer Sidebar (Profile) -->
                <!-- PERBAIKAN: Layout diperketat agar teks tidak berantakan -->
                <div class="p-4 bg-[#003354] border-t border-[#005585]">
                    <div class="flex items-center gap-3 w-full">
                        <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center text-sm font-bold flex-shrink-0 text-white">
                            {{ isset($student['name']) ? substr($student['name'], 0, 1) : 'G' }}
                        </div>
                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                            <p class="text-sm font-semibold text-white truncate w-full block leading-tight">
                                {{ $student['name'] ?? 'Guest User' }}
                            </p>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400"></span>
                                <p class="text-xs text-gray-300 truncate">Online</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Overlay -->
        <div x-show="isMobile && sidebarOpen" 
             @click="sidebarOpen = false"
             x-transition.opacity
             class="fixed inset-0 bg-black/50 z-30 backdrop-blur-sm lg:hidden"></div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 lg:px-8 z-20">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg focus:outline-none lg:hidden">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-xl font-semibold text-indigoDye md:block">E-Student LP3I College Karawang</h1>
                </div>

                <div class="flex items-center gap-2 md:gap-4">
                    
                    <!-- Header Profile Dropdown -->
                    <!-- PERBAIKAN: Layout flex column + alignment right -->
                    <div class="flex items-center gap-3 border-l pl-4 ml-4 border-gray-200 relative" x-data="{ profileOpen: false }">
                        
                        <!-- Text Area -->
                        <div class="hidden md:flex flex-col items-end mr-1">
                            <span class="text-sm font-bold text-indigoDye leading-tight max-w-[150px] truncate">
                                {{ $student['name'] ?? 'Guest' }}
                            </span>
                            <span class="text-[10px] text-gray-500 font-medium bg-gray-100 px-1.5 py-0.5 rounded mt-0.5">
                                {{ $student['nim'] ?? '-' }}
                            </span>
                        </div>

                        <!-- Avatar Button -->
                        <div class="relative">
                            <button @click="profileOpen = !profileOpen" 
                                    class="w-10 h-10 rounded-full p-0.5 border-2 border-viridian overflow-hidden focus:outline-none hover:shadow-md transition-shadow">
                                <img src="{{ $student['avatar'] ?? 'https://ui-avatars.com/api/?name=Guest' }}" 
                                     alt="Profile" 
                                     class="w-full h-full rounded-full object-cover">
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="profileOpen" 
                                 @click.outside="profileOpen = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 top-full mt-2 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 origin-top-right">
                                
                                <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                    <p class="text-xs text-gray-500 font-medium">Signed in as</p>
                                    <p class="text-sm font-bold text-gray-800 truncate">{{ $student['name'] ?? 'Guest' }}</p>
                                    <p class="text-xs text-indigoDye font-mono mt-0.5">{{ $student['nim'] ?? '-' }}</p>
                                </div>
                                
                                <div class="py-1">
                                    <a href="{{ route('profile.mahasiswa') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-viridian transition-colors">
                                        <i data-lucide="user" class="w-4 h-4"></i> My Profile
                                    </a>
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-viridian transition-colors">
                                        <i data-lucide="user" class="w-4 h-4"></i> My Account
                                    </a>
                                    <a href="#" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-viridian transition-colors">
                                        <i data-lucide="settings" class="w-4 h-4"></i> Settings
                                    </a>
                                </div>

                                <div class="border-t border-gray-100 mt-1 py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 text-left transition-colors">
                                            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-8 scroll-smooth">
                @yield('content')
                
                <footer class="mt-12 text-center text-gray-200 bg-gray-500 rounded-lg text-xs pb-4">
                    <p class="pt-5">&copy; {{ date('Y') }} Politeknik LP3I. Crafted with <span class="text-[#FF0000]">❤</span> by IT Division.</p>
                </footer>
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
