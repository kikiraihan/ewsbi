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
                    <a href="{{ route('komoditas') }}" class="btn btn-outline-secondary btn-sm border border-white-50">Komoditas</a>
                    <hr>

                    <div class="row">
                    @foreach ($komoditas as $key=>$komoditas)
                    <div class="col-lg-5 mr-4 ml-4">
                        <table class="table table-striped table-borderless border border-white-50 table-sm small">
                            <caption class="text-left ">
                                Tugas {{$komoditas[0]->instansi->nama_instansi}}
                            </caption>
                            <thead class="thead-light ">
                                <tr>
                                    <th>No</th>
                                    {{-- @foreach ($columns as $col)
                                    <th class="text-capitalize">{{ $col }}</th>
                                    @endforeach --}}

                                    <th class="text-capitalize">Lokasi</th>
                                    <th class="text-capitalize">Komoditas</th>
                                    <th class="text-capitalize">Instansi</th>


                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody class="">
                                @php $no=0 ; $wadahlokasi=NULL; @endphp
                                @foreach ($komoditas as $kom)
                                <tr>
                                    <th>{{ ++$no }}</th>



                                    <td>
                                        {{--  @if ($wadahlokasi!=$kom->lokasi->nama)
                                        @php $wadahlokasi=$kom->lokasi->nama; @endphp  --}}
                                        {{ $kom->lokasi->nama }}
                                        {{--  @else
                                        @endif  --}}
                                    </td>

                                    <td>{{ $kom->komoditas->nama }}</td>
                                    <td>{{ $kom->instansi->nama_instansi }}</td>

                                    <td class="text-center dropdown dropleft">

                                        <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                            ☰
                                        </span>
                                        <div class="dropdown-menu">

                                            {{-- <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$kom->id]) }}">Edit</a> --}}
                                            <form style="display: inline;" method="post" action="{{ route('user.destroy', ['id'=>$kom->id]) }}">
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