<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(){
        $data = Mahasiswa::all();
        return view('mahasiswa.mahasiswa',compact('data'));
    }

    public function store(Request $request){
        Mahasiswa::create($request->only('nama','nim', 'jurusan'));
        return redirect()->back();
    }
}
