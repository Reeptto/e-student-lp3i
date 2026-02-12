<div class="space-y-6">
    
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 relative z-30">
        <div class="flex flex-col md:flex-row gap-3 items-center">
            
            <div class="w-full md:w-1/4 relative">
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-400">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>
                
                <select wire:model.live="semester" 
                    class="appearance-none w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-3 py-2.5 focus:ring-[#004269] focus:border-[#004269] cursor-pointer">
                    <option value=""> Pilih Semester </option>
                    @foreach($list_semester as $sem)
                        <option value="{{ $sem }}">Semester {{ $sem }}</option>
                    @endforeach
                </select>
            </div>

            {{-- 2. FILTER MATA KULIAH --}}
            <div class="w-full md:w-2/4 relative">
                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-slate-400">
                    <i class="fas fa-chevron-down text-xs"></i>
                </div>

                {{-- Logic disabled diatur via Blade, tapi update isinya otomatis via Livewire --}}
                <select wire:model.live="id_mk" 
                    class="appearance-none w-full bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg px-3 py-2.5 focus:ring-[#004269] focus:border-[#004269] cursor-pointer disabled:bg-slate-100 disabled:text-slate-400"
                    {{ empty($list_semester) ? 'disabled' : '' }}>
                    
                    <option value="">
                        {{ empty($semester) ? ' Pilih Semester Terlebih Dahulu ' : ' Semua Materi Ajar ' }}
                    </option>

                    @foreach($list_matkul as $mk)
                        <option value="{{ $mk->id_mk }}">{{ $mk->nama_mk }}</option>
                    @endforeach
                </select>
            </div>

            <div wire:loading class="text-sm text-slate-500">
                Memuat data...
            </div>

            {{-- 3. TOMBOL RESET --}}
            @if($semester || $id_mk)
                <div class="w-full md:w-auto">
                    {{-- Tombol reset cukup dengan wire:click --}}
                    <button wire:click="$set('semester', '')" 
                    class="block w-full px-4 py-2.5 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 text-sm font-bold text-center border border-red-100 transition-colors">
                        Reset
                    </button>
                </div>
            @endif


        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 relative z-0">
            @forelse ($materi as $item)
                {{-- Padding dikurangi jadi p-5 --}}
                <div class="card p-5 flex flex-col h-full bg-white group relative overflow-hidden">
                    
                    {{-- Dekorasi Samping Tipis --}}
                    <div class="absolute top-0 left-0 w-[3px] h-full bg-slate-100 group-hover:bg-[#004269] transition-colors duration-300"></div>

                    {{-- Badge MK --}}
                    <div class="mb-2 pl-3">
                        <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-[#004269] uppercase tracking-wider border border-blue-100">
                            {{ Str::limit($item->materiAjar->nama_mk ?? 'Umum', 20) }}
                        </span>
                    </div>

                    {{-- Judul (Size dikurangi dikit) --}}
                    <h3 class="font-bold text-base md:text-lg text-slate-800 mb-2 line-clamp-1 pl-3 group-hover:text-[#004269] transition-colors" title="{{ $item->judul_materi }}">
                        {{ $item->judul_materi }}
                    </h3>

                    {{-- Deskripsi (Line clamp jadi 2 baris biar pendek) --}}
                    <p class="text-xs text-slate-500 flex-1 line-clamp-2 leading-relaxed pl-3 mb-3">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>

                    {{-- Footer Card --}}
                    <div class="pt-3 border-t border-slate-100 flex items-center justify-between pl-3 mt-auto">
                        <div class="flex items-center gap-1.5 text-[10px] text-slate-400">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ $item->tgl_upload ? \Carbon\Carbon::parse($item->tgl_upload)->format('d M Y') : '-' }}</span>
                        </div>

                    @if ($item->file_materi == !null)
                        <a href="{{ route('material.download', $item->id_materi) }}"
                        class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-[#004269] hover:bg-blue-800 px-3 py-1.5 rounded-lg transition-colors shadow-sm shadow-blue-900/10">
                            <span>Unduh</span>
                            <i class="fas fa-download text-[9px]"></i>
                        </a>
                    @elseif ($item->link_materi == !null)
                        <a href="{{ $item->link_materi }}" target="_blank"
                        class="inline-flex items-center gap-1.5 text-xs font-bold text-white bg-[#004269] hover:bg-blue-800 px-3 py-1.5 rounded-lg transition-colors shadow-sm shadow-blue-900/10">
                            <span>Lihat Materi</span>
                            <i class="fas fa-eye text-[9px]"></i>
                        </a>
                    @endif

                        
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-3 text-slate-300">
                        <i class="fas fa-folder-open text-2xl"></i>
                    </div>
                    <p class="text-slate-500 text-sm">Data Kosong</p>
                </div>
            @endforelse
        </div>

    <div class="mt-4">
        {{ $materi->links() }}
    </div>
</div>