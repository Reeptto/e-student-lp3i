<x-app-layout>

@if ($errors->any())
<div class="mb-4 p-4 rounded-xl bg-red-100 border border-red-300 text-red-700 shadow">
    @foreach ($errors->all() as $error)
        <div>⚠️ {{ $error }}</div>
    @endforeach
    <button onclick="this.parentElement.remove()" class="absolute top-2 right-3 text-red-500 font-bold">✕</button>
</div>
@endif

@if(session('success'))
<div class="mb-4 p-4 rounded-xl bg-green-100 border border-green-300 text-green-700 shadow">
    ✅ {{ session('success') }}
</div>
@endif

<div style="max-width:1100px; margin:0 auto 1rem;">
    <a href="{{ route('tugas') }}" wire:navigate style="padding:8px 16px; background:#e5e7eb; border-radius:8px; font-weight:600;">← Kembali</a>
</div>

<div class="task-wrapper">
    <div class="task-header">
        <div>
            <span>Mata Kuliah</span>
            <h2>{{ $tugas->materiAjar->nama_mk }}</h2>
        </div>
        <div>
            <span>ID Tugas</span>
            <h2>#{{ $tugas->id_tugas }}</h2>
        </div>
    </div>

    <div class="task-body">
        <div class="task-content">
            <h1>{{ $tugas->judul_tugas }}</h1>

            <div class="task-desc">
                {!! nl2br(e($tugas->deskripsi)) !!}
            </div>

            @if($tugas->file_materi)
                <div class="file-box">
                    <span>File Materi</span>
                    <a href="{{ asset('storage/'.$tugas->file_materi) }}">Download</a>
                </div>
            @endif
        </div>

        <div class="task-side">
            <div class="deadline">
                <div class="deadline-time">
                    {{ \Carbon\Carbon::parse($tugas->deadline)->format('H:i') }}
                </div>
                <div class="deadline-date">
                    {{ \Carbon\Carbon::parse($tugas->deadline)->format('d F Y') }}
                </div>
            </div>

            <div class="action">
                @if(!$submission && !$isExpired)
                    <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_tugas" value="{{ $tugas->id_tugas }}">

                        <div class="upload-box">
                            <input type="file" name="file_tugas" required>
                        </div>

                    <button type="submit" class="btn-submit"
                        onclick="this.disabled=true; this.innerText='Mengirim...'; this.form.submit();">
                        Kirim Tugas
                    </button>

                    </form>

            @elseif($submission)
                <div class="status-box {{ $submission->nilai ? '' : '' }}">
                    
                    @if($submission->nilai)
                        <h3 style="font-size:20px; font-weight:800;">Nilai Anda</h3>
                        <div style="font-size:40px; font-weight:900; color:#2563eb;">
                            {{ $submission->nilai }}
                        </div>

                        <div style="margin-top:15px; text-align:left;">
                            <label style="font-weight:600; font-size:14px;">Catatan Dosen:</label>
                            <textarea readonly style="width:100%; margin-top:5px; padding:10px; border-radius:8px; border:1px solid #ddd;">{{ trim($submission->catatan ?? 'Tidak ada catatan') }}</textarea>
                        </div>
                    @else
                        <strong>Tugas Terkirim</strong>
                        <p>{{ $submission->created_at->format('d/m/Y H:i') }}</p>
                        <p style="margin-top:10px; font-size:12px; color:#555;">Menunggu penilaian dosen</p>
                    @endif

                </div>
                @else
                    <div class="status-box expired">
                        <strong>Waktu Habis</strong>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
</x-app-layout>
