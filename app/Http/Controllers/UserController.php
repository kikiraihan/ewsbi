<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\Schema;
use App\Traits\arrayTrait;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use arrayTrait;

    public function index()
    {
        $user=User::with(['instansi'])->get()->groupBy('kategori');

        $admin=$user['Admin'];
        $surveyor=$user['Surveyor'];
        $supervisor=$user['Supervisor'];

        // dd($admin[0]->instansi->nama_instansi);

        $columns = $admin[0]->getFillable();unset($columns[2]);
        // dd($columns);
        // $columns = $this->removeIdTimestampKategoriPasswordAndRememberTokenCol(Schema::getColumnListing('users'));


        return view('user.index',compact(['admin','surveyor','supervisor','columns']));

    }


    public function tampilSurveyorInstansi()
    {
        $surveyor=User::with(['instansi'])
        ->where('id_instansi',Auth::user()->id_instansi)
        ->where('kategori','Surveyor')
        ->get();

        // dd($admin[0]->instansi->nama_instansi);

        $columns = $surveyor[0]->getFillable();
        unset($columns[2],$columns[3],$columns[4]);
        // dd($columns);
        // $columns = $this->removeIdTimestampKategoriPasswordAndRememberTokenCol(Schema::getColumnListing('users'));


        return view('user.surveyorPerInstansi-supervisor',compact(['surveyor','columns']));

    }

    public function storeSurveyor(Request $request)
    {
         // dd($request->all());

        //validasi
        $CustomMessages = [
            'unique' => 'Duplikasi data, ganti pilihan',
            'required'=>'Kolom :attribute tidak boleh kosong',
            'email'=>'Kolom :attribute harus email',
            'string'=>'Kolom :attribute harus string',
            'password.min'=>'Kolom :attribute minimal 6',
        ];

        $this->validate($request, [
            "name" =>"required|string",
            "email" =>"required|email|unique:users",
            "password" =>"required|min:6",
            "username" => "required|unique:users",
        ],$CustomMessages);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());

        //simpan
        $user=new User;
        $columns = $user->getFillable();

        // 'name',
        // 'email',
        // 'password',
        // 'id_instansi',
        // 'kategori',
        // 'username'

        foreach($columns as $col){
            if($col=='id_instansi')
            $user->$col=$request->user()->id_instansi;
            elseif($col=='kategori')
            $user->$col='Surveyor';
            else
            $user->$col=$request->$col;
        }


        $user->assignRole('Surveyor');


        $user->save();

        return redirect()->route('user.surveyor');
    }


    public function create()
    {
        $instansi=Instansi::all();
        // dd($instansi);
        $user=new User;
        $columns = $user->getFillable();
        // $columns['field'] = $user->getFillable();
        // $columns['tipe'] = ['text',''];
        // dd($columns);

        return view('user.create',compact(['columns','instansi']));
    }


    public function store(Request $request)
    {

        // dd($request->all());

        //validasi
        $CustomMessages = [
            'unique' => 'Duplikasi data, ganti pilihan',
            'required'=>'Kolom :attribute tidak boleh kosong',
            'email'=>'Kolom :attribute harus email',
            'string'=>'Kolom :attribute harus string',
            'password.min'=>'Kolom :attribute minimal 6',
        ];

        $this->validate($request, [
            "kategori" =>"required|in:Surveyor,Supervisor,Admin",
            "name" =>"required|string",
            "email" =>"required|email|unique:users",
            "password" =>"required|min:6",
            "id_instansi" => "required",
            "username" => "required|unique:users",
        ],$CustomMessages);
        // echo "<p class='ini'>valid</p>";
        // dd($request->all());

        //simpan
        $user=new User;
        $columns = $user->getFillable();

        foreach($columns as $col)
            $user->$col=$request->$col;

        if($user->kategori=='Surveyor')
            $user->assignRole('Surveyor');
        elseif($user->kategori=='Admin')
            $user->assignRole('Admin');
        elseif($user->kategori=='Supervisor')
            $user->assignRole('Supervisor');

        $user->save();

        return redirect()->route('user');

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


    public function edit($id)
    {
        $instansi=Instansi::all();
        $user=User::find($id);

        // dd($user);
        $columns = $user->getFillable();

        //Kalau Supervisor Hapus Kolom instansi, kategori
        if(auth()->user()->hasRole('Supervisor'))
        {
            unset($columns[3],$columns[4]);
            if(!$user->hasRole("Surveyor")) abort(404);

        }

        // dd($columns);
        // $columns['field'] = $user->getFillable();
        // $columns['tipe'] = ['text',''];
        // dd($columns);

        return view('user.edit',compact(['columns', 'user','instansi']));
    }


    public function update(Request $request, $id)
    {
        //validasi
        $CustomMessages = [
            'unique' => 'Duplikasi data, ganti pilihan',
            'required'=>'Kolom :attribute tidak boleh kosong',
            'email'=>'Kolom :attribute harus email',
            'string'=>'Kolom :attribute harus string',
            'password.min'=>'Kolom :attribute minimal 6',
        ];

        $this->validate($request, [
            "kategori" =>"required|in:Surveyor,Supervisor,Admin",
            "name" =>"required|string",
            "id_instansi" =>"required|string",
            "email" =>['required','email',Rule::unique('users')->ignore($id),],
            "username" =>['required','string',Rule::unique('users')->ignore($id),],
            // "email" =>"required|email|unique:users",
            "password" =>"nullable|min:6",
        ],$CustomMessages);

        //simpan
        $user= User::find($id);
        $columns = $user->getFillable();
        foreach($columns as $col){

            if($col=='password')
            {
                // jika ubah password di isi
                if ($request->password!=null) $user->password=$request->password;
            }
            else
            {
                //input yang lain
                $user->$col=$request->$col;
            }


            if($user->kategori=='Surveyor')
                $user->assignRole('Surveyor');
            elseif($user->kategori=='Admin')
                $user->assignRole('Admin');
            elseif($user->kategori=='Supervisor')
                $user->assignRole('Supervisor');
        }
        $user->save();

        return redirect()->route('user');
    }



    public function updateBySupervisor(Request $request, $id)
    {
        //validasi
        $CustomMessages = [
            'unique' => 'Duplikasi data, ganti pilihan',
            'required'=>'Kolom :attribute tidak boleh kosong',
            'email'=>'Kolom :attribute harus email',
            'string'=>'Kolom :attribute harus string',
            'password.min'=>'Kolom :attribute minimal 6',
        ];

        $this->validate($request, [
            "name" =>"required|string",
            "email" =>['required','email',Rule::unique('users')->ignore($id),],
            "username" =>['required','string',Rule::unique('users')->ignore($id),],
            "password" =>"nullable|min:6",
        ],$CustomMessages);


        //simpan
        $user= User::find($id);
        // $columns = $user->getFillable();

        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        if ($request->password!=null) $user->password=$request->password;
        $user->save();

        return redirect()->route('user.surveyor');
    }



    public function editBiodata()
    {
        $instansi=Instansi::all();
        $user=User::find(Auth::user()->id);

        // dd($user);
        $columns = $user->getFillable();

        //Kalau Supervisor Hapus Kolom instansi, kategori
        if(auth()->user()->hasRole('Supervisor') OR auth()->user()->hasRole('Surveyor'))
        {
            unset($columns[3],$columns[4]);
            // if(!$user->hasRole("Surveyor")) abort(404);

        }

        return view('user.editBiodata',compact(['columns', 'user','instansi']));
    }


    public function updateBiodata(Request $request, $id)
    {
        //validasi
        $CustomMessages = [
            'unique' => 'Duplikasi data, ganti pilihan',
            'required'=>'Kolom :attribute tidak boleh kosong',
            'email'=>'Kolom :attribute harus email',
            'string'=>'Kolom :attribute harus string',
            'password.min'=>'Kolom :attribute minimal 6',

        ];

        $this->validate($request, [
            "name" =>"required|string",
            "email" =>['required','email',Rule::unique('users')->ignore($id),],
            "username" =>['required','string',Rule::unique('users')->ignore($id),],
            "password" =>"nullable|min:6",
        ],$CustomMessages);


        //simpan
        $user= User::find($id);
        // $columns = $user->getFillable();

        $user->name=$request->name;
        $user->username=$request->username;
        $user->email=$request->email;
        if ($request->password!=null) $user->password=$request->password;
        $user->save();

        return redirect()->route('home');

    }












    public function destroy($id)
    {
        User::find($id)
            ->delete();

        if (Auth::user()->hasRole('Supervisor')) {
            # code...
            return redirect()->route('user.surveyor');
        }
        if (Auth::user()->hasRole('Admin')) {
            # code...
            return redirect()->route('user');
        }
    }
}
