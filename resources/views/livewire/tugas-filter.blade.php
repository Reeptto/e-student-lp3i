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

    <div class="space-y-4 relative z-0">
            @forelse($tugas as $item)
                @php
                    $deadline   = \Carbon\Carbon::parse($item->deadline);
                    $submission = $item->submissionByAuth;
                    $isLate     = now()->isAfter($deadline);
                    $isDisabled = $isLate && !$submission; 
                @endphp

                <div class="clean-card rounded-xl p-5 md:p-6 flex flex-col md:flex-row gap-5 relative overflow-hidden group 
                    {{ $isDisabled ? 'opacity-60 bg-slate-50 grayscale-[0.8]' : '' }}">
                    
                    <div class="absolute left-0 top-0 bottom-0 w-[4px] 
                        {{ $submission ? 'bg-emerald-500' : ($isLate ? 'bg-red-500' : 'bg-[#009da5]') }}">
                    </div>

                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 rounded-xl flex flex-col items-center justify-center border 
                            {{ $submission ? 'bg-emerald-50 border-emerald-100 text-emerald-600' : ($isDisabled ? 'bg-slate-100 border-slate-200 text-slate-400' : 'bg-cyan-50 border-cyan-100 text-[#009da5]') }}">
                            <span class="text-[9px] font-bold uppercase tracking-wider opacity-70">{{ $deadline->format('M') }}</span>
                            <span class="text-xl font-heading font-bold">{{ $deadline->format('d') }}</span>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0 flex flex-col justify-center">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-bold tracking-widest text-slate-400 uppercase truncate">
                                {{ Str::limit($item->materiAjar->nama_mk ?? 'General', 30) }}
                            </span>
                            @if($isLate && !$submission)
                                <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-red-100 text-red-600 uppercase border border-red-200">Terlewat</span>
                            @endif
                        </div>
                        
                        <h3 class="text-base md:text-lg font-bold text-slate-800 mb-1 truncate pr-4 group-hover:text-[#009da5] transition-colors">
                            {{ $item->judul_tugas }}
                        </h3>

                        <div class="flex items-center gap-2 text-xs md:text-sm text-slate-500">
                            <i class="far fa-clock text-slate-400"></i>
                            <span class="font-medium">{{ $deadline->format('H:i') }} WIB</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-start md:justify-end pt-3 md:pt-0 border-t md:border-t-0 border-slate-100 mt-2 md:mt-0">
                        @if($submission)
                            <a href="{{ route('tugas.show', $item->id_tugas) }}" class="flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-50 text-emerald-700 text-sm font-medium hover:bg-emerald-100 transition-colors border border-emerald-100">
                                <i class="fas fa-check-circle"></i> <span>Terkirim</span>
                            </a>
                        @elseif($isDisabled)
                            <button disabled class="flex items-center gap-2 px-4 py-2 rounded-lg bg-slate-100 text-slate-400 text-sm font-medium cursor-not-allowed border border-slate-200">
                                <i class="fas fa-lock"></i> <span>Terkunci</span>
                            </button>
                        @else
                            <a href="{{ route('tugas.show', $item->id_tugas) }}" class="flex items-center gap-2 px-5 py-2 rounded-lg bg-[#009da5] text-white text-sm font-medium shadow-md shadow-cyan-700/10 hover:shadow-cyan-700/20 hover:bg-[#008a91] transition-all transform hover:-translate-y-0.5">
                                <span>Kerjakan</span> <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white border border-dashed border-slate-300 rounded-xl p-10 text-center">
                    <div class="w-12 h-12 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3 text-slate-300">
                        <i class="fas fa-clipboard-list text-xl"></i>
                    </div>
                    <h3 class="text-slate-800 font-bold text-sm">Tidak ada tugas</h3>
                    <a href="{{ route('tugas') }}" class="inline-block mt-2 text-[#009da5] text-xs font-bold hover:underline">Reset Filter</a>
                </div>
            @endforelse
        </div>

    <div class="mt-4">
        {{ $tugas->links() }}
    </div>
</div>