{{--
    Layout untuk Livewire Full-Page Components (wire:navigate SPA).
    File ini adalah jembatan antara Full-Page Livewire Component dan layout utama.
    Livewire secara otomatis mencari file ini untuk merender komponen full-page.
--}}
@extends('layouts.app')

@section('content')
    {{ $slot }}
@endsection
