<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Matkul;

class DosenController extends Controller
{
    public function index(){
        $data = Dosen::all();
        $matkul = Matkul::all();
        return view('dosen.index',compact('data','matkul'));
    }

    public function store(Request $request){
    $request->validate([
            'NID' => 'required|string|max:50|unique:dosen,NID',
            'namaD'  => 'required|string|max:255',
            'matkul_id' => 'required|exists:matakuliah,id',
            'alamat' => 'required|string|max:255',
        ]);
            Dosen::create([
            'NID' => $request->NID,
            'namaD' => $request->namaD,
            'matkul_id' => $request->matkul_id,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with(['alert'=> 'Data dosen berhasil ditambahkan','type'=>'success']);
    }

    //Edit
    public function edit($id)
    {
        $dosen = Dosen::findOrfail($id);
        $matkul=Matkul::all();
        return view('dosen.edit', compact('dosen', 'matkul'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'NID' => 'required',
            'namaD'  => 'required',
            'matkul_id' => 'required',
            'alamat' => 'required'
        ]);

        $dosen = Dosen::findOrfail($id);
        $dosen->update($request->only('NID','namaD','matkul_id','alamat'));

        return redirect()->route('dosen.index')->with(['alert' => 'Data diupdate!', 'type' => 'success']);
    }

    //Delete
    public function destroy($id)
    {
        $dosen = Dosen::findOrfail($id);
        $dosen->delete();

        return redirect()->route('dosen.index')->with(['alert' => 'Data berhasil dihapus!', 'type' => 'danger']);
    }
}

