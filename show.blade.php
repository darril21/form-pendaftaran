@extends('layouts.app')

@section('title', $title." ".$mahasiswa['nama'])

@section('content')
    <h1>{{ $title }}</h1>

    @if(isset($mahasiswa['nim']))
        NIM: <span class="info">{{ $mahasiswa['nim'] }}</span> <br>
    @endif

    @if(isset($mahasiswa['nama']))
        Nama: <span class="info">{{ $mahasiswa['nama'] }}</span> <br>
    @endif

    @if(isset($mahasiswa['alamat']))
        Alamat: <span class="info">{{ $mahasiswa['alamat'] }}</span> <br>
    @endif

    @if(isset($mahasiswa['jenkel']))
        Jenis Kelamin: <span class="info">{{ $jenkel[$mahasiswa['jenkel']] }}</span> <br>
    @endif

    @if(isset($mahasiswa['foto']))
        Foto: <img src="{{ asset('upload/fotomahasiswa/' . $mahasiswa['foto']) }}" width="150" height="150">
    @endif

    <hr>
    <a href="{{ route('mahasiswa.index') }}">Kembali Ke Halaman Data Mahasiswa</a>
@endsection

@push('css')
<style>
    .info { color: red; font-weight: bold; }
</style>
@endpush