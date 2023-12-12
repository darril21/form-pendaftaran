@extends('layouts/app')
@section('title',$title)
@section('content')
<h1>{{$title}}</h1>
@include('layouts/alert')
<form class="card" method="POST" action="{{route('mahasiswa.store')}}" enctype="multipart/form-data">
    @csrf
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="input-placeholder">NIM</label>
            <input type="text" name="nim" id="nim" value="{{old('nim')}}" maxlength="10" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="input-placeholder">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{old('nama')}}"> <br>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="input-placeholder">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{old('alamat')}}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="input-placeholder">Jenis Kelamin</label>
            <select name="jenkel" id="jenkel" class="form-control">
            @foreach($jenkel as $index=>$val)
            <option value='{{$index}}'>{{$val}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label form="input-placeholder">Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
    </div>
    <footer class="card-footer text-right">
        <button class="btn btn-w-lg btn-primary" type="submit">Simpan</button>
        <a href="{{route('mahasiswa.index')}}" class="btn btn-w-lg btn-dark" trpe="reset">Kembali ke Daftar Mahasiswa</a>
    </footer>
</form>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
@endpush