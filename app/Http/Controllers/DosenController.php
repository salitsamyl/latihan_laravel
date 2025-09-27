<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index(){
        $data = Dosen::all();
        return view('dosen.index',compact('data'));
    }

    public function store(Request $request){
        Dosen::create($request->only('NID','namaD', 'alamat'));
        return redirect()->back();
    }

    //Edit
    public function edit($id)
    {
        $mhs = Dosen::findOrfail($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'NID' => 'required',
            'namaD'  => 'required',
            'alamat' => 'required',
        ]);

        $dosen = Dosen::findOrfail($id);
        $dosen->update($request->only('NID','namaD','alamat'));

        return redirect()->route('dosen.index')->with('success', 'Data diupdate!');
    }

    //Delete
    public function destroy($id)
    {
        $mhs = Dosen::findOrfail($id);
        $mhs->delete();

        return redirect()->route('dosen.index')->with('success', 'Data berhasil dihapus!');
    }
}

