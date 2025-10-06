<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

use function PHPSTORM_META\type;

class MahasiswaController extends Controller
{
    public function index(){
        //$data = Mahasiswa::all();
        //return view('mahasiswa.index',compact('data'));

        $data = Mahasiswa::with('kelas')->get();
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('mahasiswa.index', compact('data','kelas','jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswa,nim',
            'kelas_id' => 'required|exists:kelas,id',
            'jurusan_id' => 'required|exists:jurusan,id',
        ]);

        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'kelas_id' => $request->kelas_id,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->back()->with(['alert'=> 'Data mahasiswa berhasil ditambahkan','type'=>'success']);
    }

    //Edit
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrfail($id);
        $kelas = Kelas::all();
        $jurusan = Jurusan::all();
        return view('mahasiswa.edit', compact('mhs', 'kelas', 'jurusan'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim'  => 'required',
            'jurusan_id' => 'required',
            'kelas_id' => 'required'
        ]);

        $mhs = Mahasiswa::findOrfail($id);
        $mhs->update($request->only('nama','nim','jurusan_id', 'kelas_id'));

        return redirect()->route('mahasiswa.index')->with(['alert' => 'Data diupdate!', 'type' => 'success']);
    }

    //Delete
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrfail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')->with(['alert' => 'Data berhasil dihapus!', 'type' => 'danger']);
    }
}
