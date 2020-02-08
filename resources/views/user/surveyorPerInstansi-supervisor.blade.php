@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">All User </div>
                <div class="card-body container">
                    <small class="d-block">
                        Instansi : {{auth::user()->instansi->nama_instansi}} <br>
                        Surveyor : {{$surveyor->count()}} Orang
                    </small class="d-block">
                    <hr>


                    <div class="row container">


                        <div class="col-md-6 ">
                            <div class="card ">
                                {{-- <div class="card-header pl-3 ">New +</div> --}}

                                <div class="container">
                                    <div class="card-body">

                                        <form action="{{ route('user.surveyor.store') }}" method="post">
                                            <input type="hidden" name="_method" value="put">
                                            {{ csrf_field() }}

                                            @foreach ($columns as $col)
                                            <div class="form-group row">
                                                <label class="col-xl-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                                <div class="col-xl-10">


                                                    <input name="{{$col}}" type="text"
                                                    class="form-control form-control-sm {{ $errors->has($col) ? ' is-invalid' : '' }}" value="{{ old($col) }}"
                                                    id="{{$col}}" placeholder="Masukan {{$col}}">

                                                    @if ($errors->has($col))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>*{{ $errors->first($col) }}</strong>
                                                    </span>
                                                    @endif

                                                </div>
                                            </div>
                                            @endforeach

                                            {{--  tambahan  --}}
                                            <div class="form-group row">
                                                <label class="col-xl-2 col-form-label col-form-label-sm text-capitalize" for="password">password </label>
                                                <div class="col-xl-10">


                                                    <input name="password" type="text"
                                                    class="form-control form-control-sm {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}"
                                                    id="password" placeholder="Masukan password">

                                                    @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>*{{ $errors->first('password') }}</strong>
                                                    </span>
                                                    @endif

                                                </div>
                                            </div>


                                            <div class="row">
                                                <button type='submit' class='mt-3  btn btn-sm btn-outline-secondary'>Create</button>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <table class="table table-striped table-borderless border border-white-50 table-sm small">
                                <caption class="text-left ">Data setiap Surveyor</caption>
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
                                    @foreach ($surveyor as $surveyor)
                                    <tr>
                                        <th>{{ ++$no }}</th>
                                        @foreach ($columns as $col)

                                        @if ($col=="id_instansi")
                                            <td>{{ $surveyor->instansi->nama_instansi }}</td>
                                        @else
                                            <td>{{ $surveyor->$col }}</td>
                                        @endif

                                        @endforeach

                                        <td class="text-center dropdown dropleft">

                                                <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                    ☰
                                                </span>
                                                <div class="dropdown-menu">

                                                    <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$surveyor->id]) }}">Edit</a>
                                                    <form style="display: inline;" method="post" action="{{ route('user.destroy', ['id'=>$surveyor->id]) }}">
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