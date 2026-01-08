@extends('layouts.app')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');


body {
    font-family: 'Poppins', sans-serif;
    background: #f5f7fb;
    color: #1f2937;
}

.task-wrapper {
    max-width: 1100px;
    margin: 2rem auto;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
}

.task-header {
    background: #0f2a44;
    color: #fff;
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.task-header h2 {
    font-size: 1.4rem;
    font-weight: 800;
    text-transform: uppercase;
}

.task-header span {
    font-size: .85rem;
    opacity: .8;
}

.task-body {
    display: grid;
    grid-template-columns: 1fr 360px;
}

@media (max-width: 1024px) {
    .task-body {
        grid-template-columns: 1fr;
    }
}

.task-content {
    padding: 2.5rem;
}

.task-content h1 {
    font-size: 2.2rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.task-desc {
    font-size: 1rem;
    line-height: 1.7;
    color: #374151;
    border-left: 4px solid #2563eb;
    padding-left: 1rem;
}

.file-box {
    margin-top: 2rem;
    padding: 1rem 1.2rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.file-box a {
    color: #2563eb;
    font-weight: 600;
}

.task-side {
    border-left: 1px solid #e5e7eb;
    background: #f9fafb;
}

.deadline {
    padding: 2rem;
    text-align: center;
    border-bottom: 1px solid #e5e7eb;
}

.deadline-time {
    font-size: 2.5rem;
    font-weight: 800;
}

.deadline-date {
    font-size: .9rem;
    color: #6b7280;
}

.action {
    padding: 2rem;
}

.upload-box {
    border: 2px dashed #cbd5e1;
    border-radius: 8px;
    padding: 1.5rem;
    text-align: center;
    background: #fff;
    margin-bottom: 1.5rem;
}

.upload-box:hover {
    background: #f1f5f9;
}

.btn-submit {
    width: 100%;
    background: #2563eb;
    color: #fff;
    padding: .9rem;
    border-radius: 8px;
    font-weight: 700;
}

.btn-submit:hover {
    background: #1e40af;
}

.status-box {
    text-align: center;
    padding: 2rem;
    border-radius: 8px;
    background: #e0f2fe;
}

.expired {
    background: #fee2e2;
}
</style>



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
                    {{ \Carbon\Carbon::parse($tugas->jam_selesai)->format('H:i') }}
                </div>
                <div class="deadline-date">
                    {{ \Carbon\Carbon::parse($tugas->jam_selesai)->format('d F Y') }}
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

                        <button class="btn-submit">Kirim Tugas</button>
                    </form>

                @elseif($submission)
                    <div class="status-box">
                        <strong>Tugas Terkirim</strong>
                        <p>{{ $submission->created_at->format('d/m/Y H:i') }}</p>
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
@endsection
