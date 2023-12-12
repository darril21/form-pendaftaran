@extends('layouts/app')
@section('title',$title)
@section('content')
<h1>{{$title}}</h1>
@include('layouts/alert')
<p><a href="{{route('mahasiswa.create')}}">Tambah Data Mahasiswa</a>
<table class="table table-striped" id="tabeldata" width="100%">
    <thead> 
        <tr>
            <th>No</th> 
            <th>NIM</th> 
            <th>Nama</th>
            <th>Alamat</th> 
            <th>Foto</th> 
            <th class="col-md-2">Action</th> 
        </tr>        
    </thead> 
    
    <tbody>
    @foreach($mahasiswa as $data)
        <tr>
            <td>{{$loop->iteration}}</td> <td>{{$data['nim']}}</td>
            <td>{{$data['nama']}}</td> <td>{{$data['alamat']}}</td>
            <td><img src="upload/fotomahasiswa/{{$data['foto']}}" class='img-thumbnail' width='100' height="100"></td>
            <td><a class="btn btn-primary mb-2" href="{{route('mahasiswa.show',$data['id'])}}">Detail</a>
                <br><a class="btn btn-secondary d-inline mb-2" href="{{route('mahasiswa.edit',$data['id'])}}">Ubah </a> 
                <form class="mt-2" method="POST" action="{{route('mahasiswa.destroy',$data->id)}}" onsubmit="return hapus();">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE"> 
                    <button type="submit" class="btn btn-danger d-inline">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody> </table>
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
@endpush
@push('js')
<script>
function hapus(){
    if(confirm('Yakin ingin menghapus data ini?')){return true;}
    else{return false;}
}
</script>
@endpush