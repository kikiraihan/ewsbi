<?php

namespace App\Http\Controllers;

use App\Models\Instansi;

use App\Models\Komoditas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomoditasController extends Controller
{

    public function index()
    {

        $komoditas=Komoditas::all();
        $columns = Komoditas::first()->getFillable();

        return view('komoditas.master',compact(['komoditas','columns']));

    }


    // public function create()
    // {
    //     $pilihan=PilihanKomoditas::all();
    //     $instansi=Instansi::get(['nama_instansi','id']);
    //     $komoditas=new Komoditas;
    //     $columns = $komoditas->getFillable();

    //     // dd($instansi);

    //     return view('komoditas.create',compact(['pilihan','columns','instansi']));
    // }


    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'nama'=>"required|string",
            'kategori'=>"required|in:Sandang,Pangan,Papan",
            'satuan'=>"required|string",
        ]);

        $komoditas= new Komoditas;
        $columns = $komoditas->getFillable();
        foreach($columns as $col){
            $komoditas->$col=$request->$col;
        }
        $komoditas->save();

        return redirect()->route('komoditas');
    }


    public function edit($id)
    {
        $model=Komoditas::find($id);
        $columns = $model->getFillable();

        return view('komoditas.edit',compact(['model','columns']));
    }

    public function update(Request $request, $id)
    {

        //validasi
        $CustomMessages = [

            'required'=>'Kolom :attribute tidak boleh kosong',

        ];

        $this->validate($request, [
            'nama'=>"required|string",
            'kategori'=>"required|in:Sandang,Pangan,Papan",
            'satuan'=>"required|string",
        ],$CustomMessages);

        //simpan
        $komoditas= Komoditas::find($id);

        $komoditas->nama=$request->nama;
        $komoditas->kategori=$request->kategori;
        $komoditas->satuan=$request->satuan;
        $komoditas->save();

        return redirect()->route('komoditas');
    }


    public function destroy($id)
    {
        Komoditas::find($id)
            ->delete();
        return redirect()->route('komoditas');
    }
}
