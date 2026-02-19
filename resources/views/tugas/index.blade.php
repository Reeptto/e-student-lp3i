@extends('layouts.app') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-slate-800">Kumpulan Tugas</h1>

    @livewire('daftar-tugas')
    
</div>
@endsection