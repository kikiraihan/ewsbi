@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">Tugas Survey </div>
                <div class="card-body container">


                    <div class="container">
                        <form action="{{ route('tugas_survey.store') }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}


                            {{-- <small class="text-secondary">
                                Tugas Baru
                            </small> --}}
                            <div class="form-group row">

                                <div class="col-xl-3">

                                    <select  name="{{'id_lokasi'}}" class="custom-select custom-select-sm {{ $errors->has('id_lokasi') ? ' is-invalid' : '' }}">
                                        <option class="m-2" value="">-Lokasi-</option>

                                        @foreach ($lokasi as $l)
                                        <option class="m-2" value="{{$l->id}}" {{old('id_lokasi')==$l->id?"selected":"" }}>{{$l->nama}}</option>
                                        @endforeach

                                    </select>


                                    @if ($errors->has('id_lokasi'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>*{{ $errors->first('id_lokasi') }}</strong>
                                    </span>
                                    @endif

                                </div>

                                <div class="col-xl-3">

                                    {{-- <input name="{{'id_komoditas'}}" type="text"
                                    class="form-control form-control-sm {{ $errors->has('id_komoditas') ? ' is-invalid' : '' }}" value="{{ old('id_komoditas') }}"
                                    id="{{'id_komoditas'}}" placeholder="Masukan {{'id_komoditas'}}"> --}}

                                    <select  name="{{'id_komoditas'}}" class="custom-select custom-select-sm {{ $errors->has('id_komoditas') ? ' is-invalid' : '' }}">
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

                                </div>




                                <div class="col-xl-1 text-center ">
                                    <button type='submit' class=' btn btn-sm btn-outline-primary'>Input</button>
                                </div>

                            </div>





                        </form>
                    </div>



                    <hr>

                    <div class="row">
                        @foreach ($tugas as $key=>$tgs)
                    <div class="col-lg-5 mr-4 ml-4">
                        <table class="table table-striped table-borderless border border-white-50 table-sm small ">
                            <small class="text-left text-secondary m-2 d-block">
                                <i class="fas fa-map-marker-alt "></i>
                                <b>{{$tgs[0]->lokasi->nama}} :</b> {{$tgs[0]->lokasi->alamat}}
                            </small>
                            <thead class="thead-light ">
                                <tr>
                                    <th>No</th>
                                    {{-- @foreach ($columns as $col)
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endforeach --}}

                                    <th class="text-capitalize">Komoditas</th>
                                    <th class="text-capitalize">Satuan</th>
                                    <th class="text-capitalize">Lokasi</th>
                                    {{-- <th class="text-capitalize">Instansi</th> --}}


                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody class="">
                                @php $no=0 @endphp
                                @foreach ($tgs as $t)
                                <tr>
                                    <th>{{ ++$no }}</th>


                                    <td>{{ $t->komoditas->nama }}</td>
                                    <td>{{ $t->komoditas->satuan }}</td>
                                    <td>{{ $t->lokasi->nama }}</td>
                                    {{-- <td>{{ $t->instansi->nama_instansi }}</td> --}}

                                    <td class="text-center dropdown dropleft">

                                        <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item small" href="{{ route('tugas_survey.edit', ['id'=>$t->id]) }}">Edit</a>
                                            <form style="display: inline;" method="post" action="{{ route('tugas_survey.destroy', ['id'=>$t->id]) }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{ csrf_field()}}
                                                <button class="dropdown-item small text-danger" >Hapus</button>
                                            </form>


                                        </div>

                                    </td>

                                </tr>
                                @endforeach

                            </table>
                    </div>
                    @endforeach

                            </div>







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