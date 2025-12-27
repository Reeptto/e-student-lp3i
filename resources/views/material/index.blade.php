@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-6">

    <h1 class="text-2xl font-bold text-indigoDye mb-6">
        Materi Perkuliahan
    </h1>

    <form method="GET" class="mb-4">
        <select name="mk_id"
            onchange="this.form.submit()"
            class="px-4 py-2 border rounded-lg">
            <option value="">Semua Mata Kuliah</option>

                @foreach ($mataKuliah as $mk)
                    <option value="{{ $mk->id }}"
                        {{ request('mk_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama_mk }}
                    </option>
                @endforeach
        </select>
    </form>


    <div class="overflow-x-auto bg-white rounded-xl shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Mata Kuliah</th>
                    <th class="px-4 py-3 text-left">Judul Materi</th>
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Pertemuan</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materi as $item)
                <tr class="border-t">
                    <td class="px-4 py-3">
                        {{ $item->matkul->nama_mk }}
                    </td>
                    <td class="px-4 py-3 font-medium">
                        {{ $item->nama_materi }}
                    </td>
                    <td class="px-4 py-3 font-medium">
                        {{ $item->deskripsi }}
                    </td>
                    <td class="px-4 py-3 text-gray-500">
                        {{ $item->tgl_upload }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $item->pertemuan }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('materi.download', $item->id) }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            ⬇ Download
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                        Belum ada materi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
