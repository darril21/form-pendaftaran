<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    private $jenkel;
    private $folderFoto;
    public function __construct()
    {
        $this->jenkel = array('L'=>'Laki-laki','P'=>'Perempuan');
        $this->folderFoto = public_path('upload/fotomahasiswa/');
    }

    public function index()
    {
        //tampilan keseluruhan data mahasiswa
        $jenkel = $this->jenkel;
        $mahasiswa = Mahasiswa::all();
        $title = "Data Keseluruhan Mahasiswa";
        return view('mahasiswa.index', compact('mahasiswa', 'jenkel', 'title'));   
    }

    public function create()
    {
        //tampilkan form tambah mahasiswa
        $title = "Form Tambah Mahasiswa";
        $jenkel = $this->jenkel;
        return view('mahasiswa.create', compact('jenkel', 'title'));
    }

    public function store(Request $request)
    {
        //proses insert data
        //validasi dulu
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jenkel' => 'required'
        ]);
        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->alamat = $request->alamat;
        $file = $request->file('foto');
        $nowTimestamp = now()->timestamp;
        $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";
        $file->move($this->folderFoto, $fileName);
        $mahasiswa->foto = $fileName;
    
        $mahasiswa->save();
    
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Berhasil menambah data');
    }

public function show(Mahasiswa $mahasiswa)
{
    //menampilkan detail data yang dipilih
    $title = "Data Mahasiswa NIM ".$mahasiswa->nim;
    $jenkel = $this->jenkel;
    return view('mahasiswa.show', compact('jenkel', 'mahasiswa','title'));
}

public function edit(Mahasiswa $mahasiswa)
{
    //menampilkan form edit
    $jenkel = $this->jenkel;
    $title = "Form Ubah Data Mahasiswa";
    return view('mahasiswa.edit', compact('jenkel', 'mahasiswa', 'title'));
}

public function update(Request $request, Mahasiswa $mahasiswa)
{
    //proses update data
    //validasi dulu
    $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'jenkel' => 'required'
    ]);
    if($request->file('foto')) {
        $file = $request->file('foto');
        $nowTimestamp = now()->timestamp;
        $fileName = "{$nowTimestamp}-{$file->getClientOriginalName()}";
        $file->move($this->folderFoto, $fileName);
        $mahasiswa->foto = $fileName;
    }
    $mahasiswa->nim = $request->nim;
    $mahasiswa->nama = $request->nama;
    $mahasiswa->alamat = $request->alamat;
    $mahasiswa->jenkel = $request->jenkel;
    $mahasiswa->save();

    return redirect()->route('mahasiswa.index')
    ->with('success', 'Berhasil mengubah data');
}

public function destroy(Mahasiswa $mahasiswa)
    {
        //hapus data
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data Berhasil Dihapus');
    }
}