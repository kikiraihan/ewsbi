@extends('layouts.app',[
'title'=>'Create Mahasiswa',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">Edit</div>

                <div class="container">
                    <div class="card-body">

                        <form action="{{ route('tugas_survey.update', ['id'=>$model->id]) }}" method="post">
                            <input type="hidden" name="_method" value="put">
                            {{ csrf_field() }}

                            @foreach ($columns as $col)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                    <div class="col-sm-10">


                                        @if ($col=='id_lokasi')
                                        <select  name="{{$col}}" class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                            <option class="m-2" value="">-Lokasi-</option>

                                            @foreach ($lokasi as $l)
                                            <option class="m-2" value="{{$l->id}}" {{old($col,$model->$col)==$l->id?"selected":"" }}>{{$l->nama}}</option>
                                            @endforeach

                                        </select>
                                        @elseif($col=='id_komoditas')
                                        <select  name="{{$col}}" class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                            <option class="m-2" value="">-Komoditas-</option>

                                            @foreach ($komoditas as $k)
                                            <option class="m-2" value="{{$k->id}}" {{old($col,$model->$col)==$k->id?"selected":"" }}>{{$k->nama}}</option>
                                            @endforeach

                                        </select>
                                        @else
                                            <input name="{{$col}}" type="text"
                                            class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col,$model->$col) }}"
                                            id="{{$col}}" placeholder="Masukan {{$col}}">
                                        @endif

                                        @if ($errors->has($col))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>*{{ $errors->first($col) }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            @endforeach


                            <div class="row">
                                <button type='submit' class='mt-3  btn btn-sm btn-secondary'>Update</button>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css-halaman')

@endsection

@section('script-halaman')
{{-- <script src="{{ asset('assets/form_kriteria.js') }}"></script> --}}
@endsection