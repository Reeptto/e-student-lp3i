@extends('layouts.app')

@section('content')
<div class="w-full">

    <!-- HEADER -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-indigoDye">Assignments</h2>
        <p class="text-sm text-gray-500">Upload & track your submitted tasks</p>
    </div>

    <!-- FILTER -->
    <div class="bg-white shadow-sm rounded-xl p-5 mb-6 border border-gray-100">
        <form method="GET" action="{{ route('tugas') }}" class="flex flex-col md:flex-row items-start md:items-center gap-4">
            
            <div class="w-full md:w-64">
                <label class="text-sm font-semibold text-gray-700 mb-1 block">Filter by Subject</label>
                <select name="matkul" class="w-full px-3 py-2 rounded-lg border">
                    <option value="">— All Subjects —</option>
                    @foreach($matkul as $mk)
                        <option value="{{ $mk->id }}"
                            {{ request('matkul') == $mk->id ? 'selected' : '' }}>
                            {{ $mk->nama_mk }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="px-5 py-2 bg-viridian text-white rounded-lg hover:bg-[#008c94] transition">
                Apply
            </button>

        </form>
    </div>

    <!-- LIST TUGAS -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
        
        <table class="w-full text-left">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Subject</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Title</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Deadline</th>
                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($tugas as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $item->matkul->nama_mk }}</td>
                        <td class="px-4 py-3">{{ $item->judul_tugas }}</td>
                        <td class="px-4 py-3">{{ $item->time_end }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('tugas.show', $item->id) }}"
                            class="text-viridian font-semibold hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-400">
                            Tidak ada tugas
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
@endsection
