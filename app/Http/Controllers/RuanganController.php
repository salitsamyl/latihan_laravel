<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuanganController extends Controller
{
    public function index(){
        $data = Ruangan::all();
        return view('ruangan.ruangan',compact('data'));
    }

    public function store(Request $request){
        Ruangan::create($request->only('nm_ruangan','kapasitas'));
        return redirect()->back();
    }
}
