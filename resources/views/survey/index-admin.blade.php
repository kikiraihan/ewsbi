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
                        {{-- Instansi : {{auth::user()->instansi->nama_instansi}} <br> --}}
                        Waktu : Minggu Ke-{{$waktu->week }}, {{$waktu->monthName }}
                    </small class="d-block">
                    <hr>
                    @foreach ($task as $taskKom)
                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        <caption class="text-left ">Data di atas disurvey oleh : {{$taskKom[0]->instansi->nama_instansi}}</caption>
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>

                                <th class="text-capitalize">Lokasi</th>
                                <th class="text-capitalize">Komoditas</th>
                                <th class="text-capitalize">Merek</th>
                                <th class="text-capitalize">Harga</th>
                                <th class="text-capitalize">Kenaikan</th>
                                <th class="text-capitalize">Counted At</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp

                            @foreach($taskKom as $t)

                            <tr>
                                <th>{{ ++$no }}</th>
                                <td>{{ $t->lokasi->nama }}</td>
                                <td>{{ $t->komoditas->nama }}</td>
                                <td>{{ $t->survey[0]->merek }}</td>
                                <td>{{ $t->survey[0]->harga }}</td>
                                <td>{{ $t->survey[0]->kenaikan }}</td>
                                <td>{{ $t->survey[0]->counted_at }}</td>


                                <td class="text-center dropdown dropleft">

                                    <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                        ☰
                                    </span>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item small" href="{{ route('user.edit', ['id'=>$t->id]) }}">Edit</a>
                                        <form style="display: inline;" method="post" action="{{ route('survey.destroy', ['id'=>$t->id]) }}">
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
                    <br>
                    @endforeach

                </div>
            </div>



            <br><br>


            <hr class="mb-5 w-25">





                {{-- INI KLO PAKE CARD INPUT --}}
                {{-- <br><br>
                <div class="col-md-3 col-sm-6">
                    <div class="card">
                        <p class="card-header text-center bg-white ">Lisa Torphy DDS</p>
                        <div class="card-body text-center">
                            <label class="small">Harga :</label>
                            <div class="container-fluid">
                                <input name="{{'harga'}}" type="number" class="form-control form-control-sm {{ $errors->has('harga') ? ' is-invalid' : '' }}"
                                value="{{ old('harga') }}" id="{{'harga'}}" placeholder="Rp. 0">
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