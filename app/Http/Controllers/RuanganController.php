<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index(){
        $data = Ruangan::all();
        return view('ruangan.index',compact('data'));
    }

    public function store(Request $request){
        Ruangan::create($request->only('nm_ruangan','kapasitas'));
        return redirect()->back();
    }

    //Edit
    public function edit($id)
    {
        $ruang = Ruangan::findOrfail($id);
        return view('ruangan.edit', compact('ruang'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nm_ruangan' => 'required',
            'kapasitas'  => 'required',
        ]);

        $ruang = Ruangan::findOrfail($id);
        $ruang->update($request->only('nm_ruangan','kapasitas'));

        return redirect()->route('ruangan.index')->with('success', 'Data diupdate!');
    }

    //Delete
    public function destroy($id)
    {
        $ruang = Ruangan::findOrfail($id);
        $ruang->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus!');
    }
}
