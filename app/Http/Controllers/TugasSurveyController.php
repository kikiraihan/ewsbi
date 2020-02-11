<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TugasSurvey;
use App\Models\Lokasi;
use App\Models\Komoditas;
use Illuminate\Support\Facades\Auth;

class TugasSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $komoditas=TugasSurvey::with(['instansi','lokasi','komoditas'])
            // ->where('id_instansi', Auth::user()->id_instansi)
            ->orderBy('id_lokasi')
            ->get()
            ->groupBy('id_instansi')
            ;

        $template=new TugasSurvey;
        $columns = $template->getFillable();

        // dd($komoditas);

        return view('tugas_survey.index-admin',compact(['komoditas','columns']));
    }


    public function tugasInstansi()
    {
        $tugas=TugasSurvey::with(['instansi','lokasi','komoditas'])
            ->where('id_instansi', Auth::user()->id_instansi)
            ->orderBy('created_at')
            ->get()
            ->groupBy('id_lokasi')
            // ->dd()
            ;

        $lokasi=Lokasi::all(['nama','id']);
        $komoditas=Komoditas::all(['nama','id']);


        $template=new TugasSurvey;
        $columns = $template->getFillable();
        // dd($lokasi);


        return view('tugas_survey.tugasinstansi-supervisor',compact(['tugas','columns','komoditas','lokasi']));
    }


    public function store(Request $request)
    {

        // dd($request->user()->id_instansi);

        //validasi
        $CustomMessages = [
            'id_komoditas.unique' => 'Duplikasi data, ganti komoditas pilihan',
            'id_lokasi.unique' => 'Duplikasi data, ganti lokasi pilihan',
            'required'=>'Kolom :attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            "id_komoditas" => 'required|unique:tugas_surveys,id_komoditas,null,null,id_lokasi,'
            .$request->id_lokasi.',id_instansi,'.$request->user()->id_instansi
            ,
            "id_lokasi" => 'required|unique:tugas_surveys,id_lokasi,null,null,id_komoditas,'
                            .$request->id_komoditas.',id_instansi,'.$request->user()->id_instansi
        ],$CustomMessages);

        //simpan
        $user=new TugasSurvey;
        $user->id_komoditas=$request->id_komoditas;
        $user->id_lokasi=$request->id_lokasi;
        $user->id_instansi=$request->user()->id_instansi;

        $user->save();

        return redirect()->route('tugas_survey.instansi');
    }

    public function edit($id)
    {
        $lokasi=Lokasi::all(['nama','id']);
        $komoditas=Komoditas::all(['nama','id']);

        $model=TugasSurvey::find($id);
        $columns = $model->getFillable();
        unset($columns[2]);

        return view('tugas_survey.edit',compact(['model','columns','lokasi','komoditas']));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $CustomMessages = [
            'required'=>'Kolom :attribute tidak boleh kosong',
        ];

        $this->validate($request, [
            'id_komoditas'=>"required|string",
            'id_lokasi'=>"required|string",
        ],$CustomMessages);

        //simpan
        $tugas= TugasSurvey::find($id);

        $tugas->id_komoditas=$request->id_komoditas;
        $tugas->id_lokasi=$request->id_lokasi;
        $tugas->save();

        return redirect()->route('tugas_survey.instansi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey=TugasSurvey::find($id);
        $survey->delete();
        return redirect()->route('tugas_survey.instansi');
    }
}
