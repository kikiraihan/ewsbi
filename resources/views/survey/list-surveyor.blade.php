@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">







            {{-- <div class="card ">
                <div class="card-header pl-3">Survey Baru +</div>

                <div class="container">
                    <div class="card-body">
                        <small class="d-block">
                            Instansi : {{auth::user()->instansi->nama_instansi}} <br>
                            Waktu : Minggu Ke-{{$waktu->week }}, {{$waktu->monthName }}
                        </small class="d-block">

                        <hr><br>

                        <form action="{{ route('user.store') }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}


                            <b class="text-capitalize ">
                                <i class="fas fa-store "></i> Pasar Sentral
                            </b> <br><br>


                            @foreach ($columns as $col)
                            <div class="form-group row ml-3 mr-3">
                                <label class="col-md-2 col-form-label text-capitalize" for="{{$col}}">

                                    Komoditas-A
                                </label>
                                <div class="col-md-10">
                                    <input name="{{$col}}" type="number"
                                    class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                    id="{{$col}}" placeholder="Rp. 0">

                                    @if ($errors->has($col))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>*{{ $errors->first($col) }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            @endforeach

                            <hr >

                                <div class="row justify-content-center">
                                    <button type='submit' class='mt-3  btn btn-sm btn-secondary'>Simpan</button>
                                </div>


                            </form>


                        </div>
                    </div>
                </div> --}}



                {{-- INI KLO PAKE CARD INPUT --}}
                {{-- <br><br>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <p class="card-header text-center bg-white ">Lisa Torphy DDS</p>
                        <div class="card-body text-center">
                            <label class="small">Harga :</label>
                            <div class="container-fluid">
                                <input name="{{$col}}" type="number" class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}"
                                value="{{ old($col) }}" id="{{$col}}" placeholder="Rp. 0">
                            </div>
                        </div>
                    </div>
                </div> --}}

                <br><br>



                <div class="container">
                    <div class="card">
                        <p class="card-header pl-3">Survey Baru +</p>
                        <div class="card-body text-center">

                            <form action="{{ route('survey.store') }}" method="post">
                                <input type="hidden" name="_method" value="put">
                                {{ csrf_field() }}

                            <div class="form-group row m-0">

                            <div class="col-12">

                                <select  name="{{'id_tugas_survey'}}" class=" custom-select custom-select-sm {{ $errors->has('id_tugas_survey') ? ' is-invalid' : '' }}">
                                    <option class="m-2 text-secondary" value="">-Item Survey-</option>

                                    @foreach ($tugas as $tgs)
                                    <option class="m-2" value="{{$tgs->id}}" {{old('id_tugas_survey')==$tgs->id?"selected":"" }}>{{$tgs->lokasi->nama}} - {{$tgs->komoditas->nama}}
                                        @if (!$tgs->surveysterakhir->isEmpty())
                                        : : Harga terakhir {{$tgs->surveysterakhir->first()->harga}}
                                        @endif
                                    </option>
                                    @endforeach

                                </select>
                                @if ($errors->has('id_tugas_survey'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>*{{ $errors->first('id_tugas_survey') }}</strong>
                                </span>
                                @endif

                            </div>


                            {{-- <i class="fas fa-store "></i> --}}

                                {{-- <div class="col-md-2">


                                        <select  name="{{'id_komoditas'}}" class="mb-2  custom-select custom-select-sm {{ $errors->has('id_komoditas') ? ' is-invalid' : '' }}">
                                            <option class="m-2" value="">-Komoditas-</option>

                                            @foreach ($komoditas as $k)
                                            <option class="m-2" value="{{$k->id}}" {{old('id_komoditas')==$k->id?"selected":"" }}>{{$k->nama}}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('id_komoditas'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first('id_komoditas') }}</strong>
                                        </span>
                                        @endif

                                </div> --}}



                                <div class="col-md-5">

                                    <div class="input-group input-group-sm ">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text inputGroup-sizing-sm" id="">Rp. </span>
                                        </div>
                                        <input name="harga" type="number"
                                        class="mb-2 form-control form-control-sm {{ $errors->has('harga') ? ' is-invalid' : '' }}" value="{{ old('harga') }}"
                                        id="harga" placeholder="0">
                                        @if ($errors->has('harga'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first('harga') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <input name="merek" type="text"
                                    class="mb-2 form-control form-control-sm {{ $errors->has('merek') ? ' is-invalid' : '' }}" value="{{ old('merek') }}"
                                    id="merek" placeholder="Merek/Penjual">
                                    @if ($errors->has('merek'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>*{{ $errors->first('merek') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <div class="col-md-7">
                                    <textarea name="komentar" id="komentar" cols="30" rows="3" placeholder="Komentar"
                                    class="form-control form-control-sm {{ $errors->has('komentar') ? ' is-invalid' : '' }}">{{ old('komentar') }}</textarea>

                                    @if ($errors->has('komentar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>*{{ $errors->first('komentar') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr >

                                <div class="row justify-content-center">
                                    <button type='submit' class='  btn btn-sm btn-secondary'>Simpan</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>








            <br><br>


            <hr class="mb-5 w-25">


            <div class="card">
                <div class="card-header pl-3">All Survey</div>
                <div class="card-body container">
                    <small class="d-block">
                        Instansi : {{auth::user()->instansi->nama_instansi}} <br>
                        Waktu : Minggu Ke-{{$waktu->week }}, {{$waktu->monthName }}
                    </small class="d-block">
                    <hr>
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data hasil survey</caption>
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                @foreach ($columns as $col)
                                <th class="text-capitalize">{{ $col }}</th>
                                @endforeach

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @foreach ($survey as $survey)
                            <tr>
                                <th>{{ ++$no }}</th>
                                @foreach ($columns as $col)

                                @if ($col=="id_tugas_survey")
                                <td>{{ $survey->tugas->lokasi->nama }} - {{ $survey->tugas->komoditas->nama }}</td>
                                @elseif ($col=="id_user")
                                <td>{{ $survey->user->name }}</td>
                                @else
                                <td>{{ $survey->$col }}</td>
                                @endif


                                @endforeach

                                <td class="text-center dropdown dropleft">

                                    <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                        ☰
                                    </span>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item small" href="{{ route('survey.edit', ['id'=>$survey->id]) }}">Edit</a>
                                        <form style="display: inline;" method="post" action="{{ route('survey.destroy', ['id'=>$survey->id]) }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field()}}
                                            <button class="dropdown-item small text-danger" >Hapus</button>
                                        </form>


                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>







            <hr class="mb-5 w-25">


            <div class="card">
                <div class="card-header pl-3">History Survey</div>
                <div class="card-body container">
                    <small class="d-block">
                        Instansi : {{auth::user()->instansi->nama_instansi}} <br>
                        Nama User : {{auth::user()->name}}
                    </small class="d-block">
                    <hr>
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data hasil survey</caption>
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>
                                @foreach ($columns as $col)
                                <th class="text-capitalize">{{ $col }}</th>
                                @endforeach

                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @foreach ($surveyTerdahulu as $st)
                            <tr>
                                <th>{{ ++$no }}</th>
                                @foreach ($columns as $col)

                                @if ($col=="id_tugas_survey")
                                <td>{{ $st->tugas->lokasi->nama }} - {{ $st->tugas->komoditas->nama }}</td>
                                @elseif ($col=="id_user")
                                <td>{{ $st->user->name }}</td>
                                @else
                                <td>{{ $st->$col }}</td>
                                @endif


                                @endforeach

                                {{-- <td class="text-center dropdown dropleft">

                                    <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                        ☰
                                    </span>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item small" href="{{ route('survey.edit', ['id'=>$st->id]) }}">Edit</a>
                                        <form style="display: inline;" method="post" action="{{ route('survey.destroy', ['id'=>$st->id]) }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field()}}
                                            <button class="dropdown-item small text-danger" >Hapus</button>
                                        </form>


                                    </div>

                                </td> --}}

                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>















            </div>
        </div>
    </div>

    @endsection



    @section('css-halaman')
    <style>
        table tbody tr th{
            text-align: center;
            width: 1em;
        }
    </style>
    @endsection



    @section('script-halaman')

    @endsection