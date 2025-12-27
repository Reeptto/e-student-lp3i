@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-indigoDye">
            {{ $tugas->judul_tugas }}
        </h2>
        <p class="text-sm text-gray-500">
            Mata Kuliah: {{ $tugas->matkul->nama_mk }}
        </p>
    </div>

    {{-- DETAIL TUGAS --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
        <h3 class="font-semibold text-gray-800 mb-2">Deskripsi Tugas</h3>
        <p class="text-gray-700 mb-4">
            {{ $tugas->deskripsi }}
        </p>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 text-sm">
            <p class="text-gray-600">
                ⏰ Deadline:
                <span class="font-semibold">{{ $tugas->time_end }}</span>
            </p>

            {{-- MATERI (OPTIONAL) --}}
            @if($tugas->file_materi)
                <a href="{{ asset('storage/'.$tugas->file_materi) }}"
                   class="text-viridian font-semibold hover:underline">
                    📥 Download Materi
                </a>
            @else
                <span class="text-gray-400 italic">
                    Tidak ada materi tambahan
                </span>
            @endif
        </div>
    </div>

    {{-- STATUS DEADLINE --}}
    @if($isExpired && !$submission)
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            Waktu pengumpulan telah berakhir.
        </div>
    @endif

    {{-- SUBMISSION AREA --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

        {{-- JIKA BELUM SUBMIT --}}
        @if(!$submission && !$isExpired)
            <h3 class="font-semibold text-gray-800 mb-4">
                Upload Jawaban Tugas
            </h3>

            <form action="{{ route('submission.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <input type="hidden" name="tugas_id" value="{{ $tugas->id }}">

                <input type="file" name="file_tugas_mhs"
                    class="w-full border rounded-lg p-2" required>

                <button type="submit"
                    class="px-4 py-2 bg-viridian text-white rounded-lg">
                    Kumpulkan
                </button>
            </form>
        @endif

        {{-- JIKA SUDAH SUBMIT --}}
        @if($submission)
            <h3 class="font-semibold text-gray-800 mb-4">
                Status Pengumpulan
            </h3>

            <div class="space-y-3 text-sm">
                <p>
                    📄 File:
                    <a href="{{ asset('storage/'.$submission->file_tugas_mhs) }}"
                       class="text-viridian font-semibold hover:underline">
                        Download Jawaban
                    </a>
                </p>

                <p>
                    🕒 Waktu Submit:
                    <span class="font-semibold">
                        {{ $submission->submitted_at }}
                    </span>
                </p>

                <p>
                    📌 Status:
                    <span class="font-semibold
                        @if($submission->status === 'Terlambat') text-red-600
                        @elseif($submission->status === 'Dinilai') text-green-600
                        @else text-yellow-600 @endif">
                        {{ $submission->status }}
                    </span>
                </p>

                <p>
                    📝 Nilai:
                    @if($submission->nilai !== null)
                        <span class="font-semibold text-indigoDye">
                            {{ $submission->nilai }}
                        </span>
                    @else
                        <span class="italic text-gray-400">
                            Belum dinilai
                        </span>
                    @endif
                </p>
            </div>
        @endif

    </div>

</div>
@endsection
