@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header pl-3">Master Lokasi </div>
                <div class="card-body container">
                    {{-- <a href="{{ route('lokasi.create') }}" class="btn btn-outline-primary btn-sm border border-white-50">Create +</a>
                    <form class="form-inline">
                        <input type="text" class="form-control form-control-sm mr-2" id="inputNama" placeholder="Nama Lengkap">
                        <button type="submit" class="btn btn-primary btn-sm">Sign in</button>
                    </form>
                    <hr> --}}

                    <div class="row container">


                        <div class="col-md-5 ">
                            <div class="card ">
                                {{-- <div class="card-header pl-3 ">New +</div> --}}

                                <div class="container">
                                    <div class="card-body">

                                        <form action="{{ route('lokasi.store') }}" method="post">
                                            <input type="hidden" name="_method" value="put">
                                            {{ csrf_field() }}

                                            @foreach ($columns as $col)
                                            <div class="form-group row">
                                                <label class="col-xl-2 col-form-label col-form-label-sm text-capitalize" for="{{$col}}">{{$col}} </label>
                                                <div class="col-xl-10">

                                                    @if ($col=='kategori')
                                                    <select name="{{$col}}" class="custom-select custom-select-sm {{ $errors->has($col) ? ' is-invalid' : '' }}">
                                                        <option class="m-2" value="">-Pilih-</option>
                                                        <option class="m-2" value="Sandang" {{old($col)=="Sandang"?"selected":"" }}>Sandang</option>
                                                        <option class="m-2" value="Pangan" {{old($col)=="Pangan"?"selected":"" }}>Pangan</option>
                                                        <option class="m-2" value="Papan" {{old($col)=="Papan"?"selected":"" }}>Papan</option>
                                                    </select>
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
                                            @endforeach


                                            <div class="row">
                                                <button type='submit' class='mt-3  btn btn-sm btn-outline-secondary'>Create</button>
                                            </div>

                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-7 "
                        {{-- style="overflow: auto; height: 35.6em; " --}}
                        >
                            <table class="table table-striped table-borderless border border-white-50 table-sm small">
                                <caption class="text-left ">
                                    Data Kategori
                                </caption>
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th>#</th>
                                        @foreach ($columns as $col)
                                        <th class="text-capitalize">{{ $col }}</th>
                                        @endforeach

                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody class="text-center">
                                    @php $no=0 @endphp
                                    @foreach ($lokasi as $lok)
                                    <tr>
                                        <th>{{ ++$no }}</th>
                                        @foreach ($columns as $col)
                                        <td>{{ $lok->$col }}</td>
                                        @endforeach

                                        <td class="text-center dropdown dropleft">

                                            <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                                ☰
                                            </span>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item small" href="{{ route('lokasi.edit', ['id'=>$lok->id]) }}">Edit</a>
                                                <form style="display: inline;" method="post" action="{{ route('lokasi.destroy', ['id'=>$lok->id]) }}">
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