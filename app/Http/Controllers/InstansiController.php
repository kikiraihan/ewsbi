<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{

    public function index()
    {
        $instansi=Instansi::all();
        $columns = Instansi::first()->getFillable();
        // dd($columns);

        return view('instansi.master',compact(['instansi','columns']));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_instansi'=>"required|string",
            'alamat'=>"required|string",
        ]);

        $instansi= new Instansi;
        $columns = $instansi->getFillable();
        foreach($columns as $col){
            $instansi->$col=$request->$col;
        }
        $instansi->save();

        return redirect()->route('instansi');
    }

    public function edit($id)
    {
        $instansi=Instansi::find($id);
        $columns = $instansi->getFillable();

        return view('instansi.edit',compact(['instansi','columns']));
    }


    public function update(Request $request, $id)
    {
        //validasi
        $CustomMessages = [

            'required'=>'Kolom :attribute tidak boleh kosong',

        ];

        $this->validate($request, [
            'nama_instansi'=>"required|string",
            'alamat'=>"required|string",
        ],$CustomMessages);

        //simpan
        $instansi= Instansi::find($id);

        $instansi->nama_instansi=$request->nama_instansi;
        $instansi->alamat=$request->alamat;
        $instansi->save();

        return redirect()->route('instansi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Instansi::find($id)
            ->delete();
        return redirect()->route('instansi');
    }
}
