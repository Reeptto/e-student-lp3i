@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
</style>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 font-[Poppins]">

    {{-- HEADER --}}
    <div class="mb-10 border-b pb-6">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            📢 Pengumuman
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Informasi dan pengumuman terbaru
        </p>

        <p class="text-xs text-gray-400 mt-2">
            Total: <span class="font-semibold text-red-500">{{ $pengumuman->count() }}</span> pengumuman
        </p>
    </div>

    {{-- LIST --}}
    <div class="space-y-4">
        @forelse ($pengumuman as $item)
        <article class="bg-white border rounded-xl p-5 hover:shadow-md transition">

            <div class="flex items-center justify-between mb-2">
                <h2 class="text-base font-semibold text-gray-800">
                    {{ $item->judul_informasi }}
                </h2>

                <span class="text-xs text-gray-400">
                    {{ \Carbon\Carbon::parse($item->tanggal_terbit)->diffForHumans() }}
                </span>
            </div>

            <p class="text-sm text-gray-600 leading-relaxed">
                {{ $item->deskripsi }}
            </p>

            <div class="mt-4 flex justify-end">
                <button class="text-xs text-gray-500 hover:text-red-500 transition">
                    Tandai dibaca
                </button>
            </div>

        </article>
        @empty
        <div class="text-center py-12 text-gray-400">
            <div class="text-4xl mb-2">🔕</div>
            <p class="text-sm">Belum ada pengumuman</p>
        </div>
        @endforelse
    </div>

</div>
@endsection
