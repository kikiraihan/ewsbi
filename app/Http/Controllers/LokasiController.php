<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi=Lokasi::all();
        $columns = Lokasi::first()->getFillable();

        return view('lokasi.master',compact(['lokasi','columns']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'nama'=>"required|string",
            'jenis_pasar'=>"required|string",
            'alamat'=>"required|string",
        ]);

        $lokasi= new Lokasi;
        $columns = $lokasi->getFillable();
        foreach($columns as $col){
            $lokasi->$col=$request->$col;
        }
        $lokasi->save();

        return redirect()->route('lokasi');
    }


    public function edit($id)
    {
        $lokasi=Lokasi::find($id);
        $columns = $lokasi->getFillable();

        return view('lokasi.edit',compact(['lokasi','columns']));
    }


    public function update(Request $request, $id)
    {
        //validasi
        $CustomMessages = [
            'required'=>'Kolom :attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            'nama'=>"required|string",
            'jenis_pasar'=>"required|string",
            'alamat'=>"required|string",
        ],$CustomMessages);

        //simpan
        $lokasi= Lokasi::find($id);

        $lokasi->nama=$request->nama;
        $lokasi->jenis_pasar=$request->jenis_pasar;
        $lokasi->alamat=$request->alamat;
        $lokasi->save();

        return redirect()->route('lokasi');
    }


    public function destroy($id)
    {
        Lokasi::find($id)
            ->delete();
        return redirect()->route('lokasi');
    }
}
