@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8fafc;
    }
</style>

<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">
            Daftar <span class="text-teal-00">Tugas</span>
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Kelola dan selesaikan tugas tepat waktu.
        </p>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('tugas') }}" class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-4 border rounded-lg shadow-sm">

            <select name="semester" onchange="this.form.submit()"
                class="border rounded px-3 py-2 text-sm">
                <option value="">Pilih Semester</option>
                @foreach($semesters as $s)
                    <option value="{{ $s }}" {{ request('semester') == $s ? 'selected' : '' }}>
                        Semester {{ $s }}
                    </option>
                @endforeach
            </select>

            <select name="matkul" onchange="this.form.submit()"
                class="border rounded px-3 py-2 text-sm">
                <option value="">Pilih Materi Ajar</option>
                @foreach($matkul as $mk)
                    <option value="{{ $mk->id_mk }}" {{ request('matkul') == $mk->id_mk ? 'selected' : '' }}>
                        {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>

            @if(request()->hasAny(['semester','matkul']))
                <a href="{{ route('tugas') }}"
                   class="text-center text-sm font-semibold text-white bg-gray-800 rounded py-2 hover:bg-[#f15b67] transition">
                    Reset Filter
                </a>
            @endif
        </div>
    </form>

    {{-- LIST TUGAS --}}
    <div class="space-y-4">
        @forelse($tugas as $item)
            @php
                $deadline   = \Carbon\Carbon::parse($item->deadline);
                $submission = $item->submissionByAuth;
                $isLate     = now()->isAfter($deadline);
            @endphp

            <a href="{{ route('tugas.show', $item->id_tugas) }}"
               class="block bg-white border rounded-lg p-5 hover:shadow-md transition">

                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-xs font-semibold text-gray-500 uppercase">
                            {{ $item->materiAjar->nama_mk ?? '-' }}
                        </span>

                        <h3 class="text-lg font-semibold text-gray-800 mt-1">
                            {{ $item->judul_tugas }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Deadline: {{ $deadline->translatedFormat('d F Y • H:i') }}
                        </p>
                    </div>

                    {{-- STATUS --}}
                    <div>
                        @if($submission)
                            <span class="px-3 py-1 text-xs font-semibold rounded bg-green-100 text-green-700">
                                Terkirim
                            </span>
                        @elseif($isLate)
                            <span class="px-3 py-1 text-xs font-semibold rounded bg-red-100 text-red-700">
                                Terlambat
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-700">
                                Belum Dikirim
                            </span>
                        @endif
                    </div>
                </div>
            </a>

        @empty
            <div class="bg-white border rounded-lg p-10 text-center text-gray-500">
                <p class="font-semibold">Tidak ada tugas</p>
                <p class="text-sm mt-1">Silakan pilih semester atau mata kuliah.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
