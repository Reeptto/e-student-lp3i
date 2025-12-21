@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10 px-6">

        <h2 class="text-2xl font-bold mb-6">Profil Mahasiswa</h2>

        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.updates') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            {{-- NIM --}}
            <div>
                <label class="text-sm text-gray-600">NIPD</label>
                <input type="text" value="{{ $mahasiswa->nipd }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

            {{-- Nama --}}
            <div>
                <label class="text-sm text-gray-600">Nama</label>
                <input type="text" value="{{ $mahasiswa->nama_mhs }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

            {{-- Kelas --}}
            <div>
                <label class="text-sm text-gray-600">Kelas</label>
                <input type="text" value="{{ $mahasiswa->kelas->kode_kelas }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

            {{-- Jurusan --}}
            <div>
                <label class="text-sm text-gray-600">Jurusan</label>
                <input type="text" value="{{ $mahasiswa->kelas->jurusan->nama_jurusan }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

            {{-- Email --}}
            <div>
                <label class="text-sm text-gray-600">Email</label>
                <input type="text" value="{{ $mahasiswa->email }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

             {{-- No Telp --}}
            <div>
                <label class="text-sm text-gray-600">No. Handphone</label>
                <input type="text" value="{{ $mahasiswa->no_telp }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

             {{-- Tempat Lahir --}}
            <div>
                <label class="text-sm text-gray-600">Tempat Lahir</label>
                <input type="text" value="{{ $mahasiswa->tempat_lahir }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="text-sm text-gray-600">Tanggal Lahir</label>
                <input type="text" value="{{ $mahasiswa->tanggal_lahir }}"
                       class="w-full bg-gray-100 border rounded px-3 py-2"
                       readonly>
            </div>

            {{-- DOMISILI (EDITABLE) --}}
            <div>
                <label class="text-sm text-gray-600">Domisili</label>
                <input type="text" name="Domisili"
                       value="{{ old('Domisili', $mahasiswa->Domisili) }}"
                       class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-300">
                @error('Domisili')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan Domisili
                </button>
            </div>
        </form>

    </div>
@endsection


