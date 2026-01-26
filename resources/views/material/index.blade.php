@extends('layouts.app')

@section('content')
<style>
    .card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        transition: all .25s ease;
    }
    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
    }
</style>

<div class="min-h-screen bg-slate-50 pb-20">

    {{-- HEADER --}}
    <div class="bg-primary py-14 mb-12 rounded-lg">
        <div class="max-w-7xl mx-auto px-6">
            <h1 class="text-3xl font-bold text-white">Pustaka Materi</h1>
            <p class="text-white/80 text-sm mt-1">
                Kelas: {{ auth()->user()->mahasiswa->kelas->nama_kelas ?? 'Umum' }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6">

        {{-- FILTER --}}
        <form method="GET" action="{{ route('material.index') }}"
              class="bg-white rounded-xl border p-5 mb-10 flex flex-col md:flex-row gap-4 items-center">

            <select name="semester"
                    onchange="this.form.submit()"
                    class="w-full md:w-1/3 border rounded-lg px-4 py-2 text-sm">
                <option value="">Pilih Semester</option>
                @for ($i = 1; $i <= 4; $i++)
                    <option value="{{ $i }}" {{ $semester == $i ? 'selected' : '' }}>
                        Semester {{ $i }}
                    </option>
                @endfor
            </select>

            <select name="id_mk"
                    onchange="this.form.submit()"
                    class="w-full md:w-2/3 border rounded-lg px-4 py-2 text-sm">
                <option value="">Pilih Materi Ajar</option>
                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->id_mk }}" {{ $id_mk == $mk->id_mk ? 'selected' : '' }}>
                        {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($materi as $item)
                <div class="card p-6 flex flex-col">

                    <span class="text-xs font-semibold text-[#009da5] uppercase mb-2">
                        {{ $item->materiAjar->nama_mk ?? 'Materi Umum' }}
                    </span>

                    <h3 class="font-bold text-slate-800 mb-2 line-clamp-2">
                        {{ $item->judul_materi }}
                    </h3>

                    <p class="text-sm text-slate-500 flex-1 line-clamp-3">
                        {{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}
                    </p>

                    <div class="mt-5 pt-4 border-t flex items-center justify-between">
                        <span class="text-xs text-slate-400">
                            {{ $item->tgl_upload
                                ? \Carbon\Carbon::parse($item->tgl_upload)->format('d/m/Y')
                                : '-' }}
                        </span>

                        <a href="{{ route('materi.download', $item->id_materi) }}"
                           class="text-sm font-semibold text-[#009da5] hover:underline">
                            Unduh
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <p class="text-slate-400 font-semibold">
                        Belum ada materi tersedia
                    </p>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection
