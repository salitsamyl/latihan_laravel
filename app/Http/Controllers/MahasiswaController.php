<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(){
        $data = Mahasiswa::all();
        return view('mahasiswa.index',compact('data'));
    }

    public function store(Request $request){
        Mahasiswa::create($request->only('nama','nim', 'jurusan'));
        return redirect()->back();
    }

    //Edit
    public function edit($id)
    {
        $mhs = Mahasiswa::findOrfail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nim'  => 'required',
            'jurusan' => 'required',
        ]);

        $mhs = Mahasiswa::findOrfail($id);
        $mhs->update($request->only('nama','nim','jurusan'));

        return redirect()->route('mahasiswa.index')->with('success', 'Data diupdate!');
    }

    //Delete
    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrfail($id);
        $mhs->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }
}
