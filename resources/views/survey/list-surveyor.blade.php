@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">



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

                                @if ($col=="id_instansi")
                                <td>{{ $survey->instansi->nama_instansi }}</td>
                                @elseif ($col=="id_komoditas")
                                <td>{{ $survey->komoditas->nama }}</td>
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

                                        <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$survey->id]) }}">Edit</a>
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



            <br><br>


            <hr class="mb-5 w-25">






            <div class="card ">
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
                                    {{-- <i class="fas fa-tag"></i> Harga --}}
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

                            <hr class="">

                            {{-- @foreach ($columns as $col)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                    <div class="col-sm-10">

                                        @if ($col=='kategori')

                                        <select  name="{{$col}}" class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                            <option class="m-2" value="">-Pilih-</option>
                                            <option class="m-2" value="Surveyor" {{old($col)=="Surveyor"?"selected":"" }}>Surveyor</option>
                                            <option class="m-2" value="Supervisor" {{old($col)=="Supervisor"?"selected":"" }}>Supervisor</option>
                                            <option class="m-2" value="Admin" {{old($col)=="Admin"?"selected":"" }}>Admin</option>
                                        </select>

                                        @elseif ($col=='password')
                                        <input name="{{$col}}" type="password"
                                        class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                        id="{{$col}}" placeholder="Masukan {{$col}}">



                                        @else

                                        <input name="{{$col}}" type="text"
                                        class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                        id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @endif

                                        @if ($errors->has($col))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>*{{ $errors->first($col) }}</strong>
                                        </span>
                                        @endif

                                    </div>
                                </div>
                                @endforeach --}}




                                <div class="row justify-content-center">
                                    <button type='submit' class='mt-3  btn btn-sm btn-secondary'>Simpan</button>
                                </div>


                            </form>


                        </div>
                    </div>
                </div>



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