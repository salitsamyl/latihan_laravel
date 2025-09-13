<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matkul;

class MatkulController extends Controller
{
    public function index(){
        $data = Matkul::all();
        return view('matkul.matkul',compact('data'));
    }

    public function store(Request $request){
        Matkul::create($request->only('matkul','deskripsi'));
        return redirect()->back();
    }
}
