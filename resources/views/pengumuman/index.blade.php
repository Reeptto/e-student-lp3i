@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-xl font-bold mb-4">📢 Pengumuman</h1>

    <div class="space-y-4">
        @forelse ($pengumuman as $item)
            <div class="bg-white rounded-lg shadow p-4 border-l-4 border-indigo-500">
                <h2 class="font-semibold text-gray-800">
                    {{ $item->judul_informasi }}
                </h2>

                <p class="text-sm text-gray-600 mt-1">
                    {{ $item->deskripsi }}
                </p>

                <p class="text-xs text-gray-400 mt-2">
                    {{ \Carbon\Carbon::parse($item->tanggal_terbit)->format('d M Y') }}
                </p>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Belum ada pengumuman.</p>
        @endforelse
    </div>
</div>
@endsection
