@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f1f5f9;
    }

    .card {
        background: white;
        border-radius: 14px;
        border: 1px solid #e2e8f0;
    }

    .label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #0f172a;
        margin-top: 4px;
    }

    .btn-primary {
        background: #0f172a;
        color: white;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 600;
    }

    .btn-secondary {
        background: #f8fafc;
        border: 1px solid #cbd5f5;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 600;
        color: #334155;
    }

    input, textarea {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 10px 12px;
        font-size: 0.9rem;
    }
</style>

<div class="max-w-6xl mx-auto px-4 py-12" x-data="{ isEditing: false }">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-2xl font-semibold text-slate-900">Profil Mahasiswa</h1>
        <p class="text-sm text-slate-500 mt-1">
            Informasi identitas dan akademik mahasiswa
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

        {{-- SIDEBAR --}}
        <div class="card p-6 text-center">
            <img
                src="{{ auth()->user()?->mahasiswa?->foto
                        ? asset('storage/image/' . auth()->user()->mahasiswa->foto)
                        : 'https://ui-avatars.com/api/?name=Guest' }}"
                class="w-32 h-32 mx-auto rounded-full object-cover border">
            

            <h2 class="mt-4 font-semibold text-lg text-slate-800">
                {{ $mahasiswa->nama ?? '-' }}
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                {{ $mahasiswa->bidangKeahlian->nama_bidang_keahlian ?? '-' }}
            </p>

            <div class="mt-4 text-sm font-medium text-slate-700">
                NIPD: {{ $mahasiswa->nipd ?? '-'}}
            </div>

            <button
                @click="isEditing = !isEditing"
                class="mt-6 w-full bg-teal-500 px-5 py-3 rounded-lg font-bold hover:bg-teal-600 hover:text-primary ">
                <span x-text="isEditing ? 'Batal Edit' : 'Edit Profil'"></span>
            </button>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="md:col-span-2 card p-8">

            {{-- VIEW MODE --}}
            <div x-show="!isEditing" class="space-y-6">

                <h3 class="font-semibold text-primary text-lg mb-4">
                    Data Pribadi Lengkap
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    <div>
                        <div class="label">Nama Lengkap</div>
                        <div class="value">{{ $mahasiswa->nama ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="label">No. Handphone</div>
                        <div class="value">{{ $mahasiswa->no_tlp ?? '-' }}</div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="label">Alamat Lengkap</div>
                        <div class="value">{{ $mahasiswa->alamat ?? '-' }}</div>
                    </div>

                     <div class="md:col-span-2">
                        <div class="label">Domisili</div>
                        <div class="value">{{ $mahasiswa->domisili ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="label">Tempat Lahir</div>
                        <div class="value">{{ $mahasiswa->tempat_lahir ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="label">Tanggal Lahir</div>
                        <div class="value">{{ $mahasiswa->tgl_lahir ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="label">Agama</div>
                        <div class="value">{{ $mahasiswa->agama ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="label">Email</div>
                        <div class="value">{{ $mahasiswa->email ?? '-' }}</div>
                    </div>

                    <div>
                        <div class="label">Nama Ayah</div>
                        <div class="value">Hambali</div>
                    </div>

                    <div>
                        <div class="label">Nama Ibu</div>
                        <div class="value">Julianti</div>
                    </div>

                </div>

            </div>

            <br><br>

            <div x-show="!isEditing" class="space-y-6">

                <h3 class="font-semibold text-primary text-lg mb-4 mt-10">
                    Informasi Akademik
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    <div>
                        <div class="label">NIPD</div>
                        <div class="value">{{ $mahasiswa->nipd ?? '-'}}</div>
                    </div>

                    <div>
                        <div class="label">Kelas</div>
                        <div class="value">{{ $mahasiswa->kelas?->nama_kelas ?? '-' }}</div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="label">Bidang Keahlian</div>
                        <div class="value">
                            {{ $mahasiswa->bidangKeahlian?->nama_bidang_keahlian ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <div class="label">Periode</div>
                        <div class="value">{{ $mahasiswa->periode ?? '-' }}</div>
                    </div>
                </div>
            </div>

            {{-- EDIT MODE --}}
            <div x-show="isEditing" x-cloak>
                <form
                    method="POST"
                    action="{{ route('profile.updates') }}"
                    enctype="multipart/form-data"
                    class="space-y-6">
                
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="label">domisili</label>
                        <textarea name="domisili" rows="3">
                            {{ old('domisili', $mahasiswa->domisili) }}
                        </textarea>
                    </div>

                    <div>
                        <label class="label">Foto Profil</label>
                        <input type="file" name="foto">
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <button type="button"
                            @click="isEditing = false"
                            class="btn-secondary">
                            Batal
                        </button>

                        <button type="submit" class="btn-primary">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
