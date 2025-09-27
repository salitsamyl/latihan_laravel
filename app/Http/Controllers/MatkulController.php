<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function index(){
        $data = Matkul::all();
        return view('matkul.index',compact('data'));
    }

    public function store(Request $request){
        Matkul::create($request->only('matkul','deskripsi'));
        return redirect()->back();
    }

    //Edit
    public function edit($id)
    {
        $matkul = Matkul::findOrfail($id);
        return view('matkul.edit', compact('matkul'));
    }

    //Update
    public function update(Request $request, $id)
    {
        $request->validate([
            'matkul' => 'required',
            'deskripsi'  => 'required',
        ]);

        $matkul = Matkul::findOrfail($id);
        $matkul->update($request->only('matkul','deskripsi'));

        return redirect()->route('matkul.index')->with('success', 'Data diupdate!');
    }

    //Delete
    public function destroy($id)
    {
        $matkul = Matkul::findOrfail($id);
        $matkul->delete();

        return redirect()->route('matkul.index')->with('success', 'Data berhasil dihapus!');
    }
}
