<?php

namespace App\Http\Controllers;

use App\Models\Instansi;

use App\Models\Komoditas;
use App\Models\TugasSurvey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $komoditas=Komoditas::all();
        $columns = $komoditas[0]->getFillable();

        return view('komoditas.master',compact(['komoditas','columns']));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pilihan=PilihanKomoditas::all();
        $instansi=Instansi::get(['nama_instansi','id']);
        $komoditas=new Komoditas;
        $columns = $komoditas->getFillable();

        // dd($instansi);

        return view('komoditas.create',compact(['pilihan','columns','instansi']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        dd($request->all());

        $this->validate($request, [
            // "kategori" =>"required|in:Surveyor,Supervisor,Admin",
            // "name" =>"required|string",
            // "email" =>"required|email|unique:users",
            // "password" =>"required|min:6",
            // "id_instansi" => "required",
            // "username" => "required|unique:users",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
