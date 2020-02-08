@extends('layouts.app',[
'title'=>'User',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">






            <div class="card">
                <div class="card-header pl-3">Aproval Survey </div>
                <div class="card-body container">
                    <small class="d-block">
                        Instansi : {{auth::user()->instansi->nama_instansi}} <br>
                        Waktu : Minggu Ke-{{$waktu->week }}, {{$waktu->monthName }}
                    </small class="d-block">
                    <hr>


                    <span >Validated </span>




                    <table class="table table-success table-borderless border border-white-50 table-sm small">
                        {{-- <caption class="text-left ">Data hasil survey</caption> --}}
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>

                                <th class="text-capitalize">Lokasi</th>
                                <th class="text-capitalize">Komoditas</th>
                                <th class="text-capitalize">Harga</th>
                                <th class="text-capitalize">Kenaikan</th>
                                <th class="text-capitalize">Merk</th>
                                <th class="text-capitalize">Valid</th>
                                <th class="text-capitalize">Counted at</th>
                                <th class="text-capitalize">Surveyor</th>


                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @foreach ($survey_valid as $survey_pecah)
                            <tr>
                                <th>{{ ++$no }}</th>



                                <td>{{  $survey_pecah->tugas->lokasi->nama }} </td>
                                <td>{{ $survey_pecah->tugas->komoditas->nama }}</td>
                                <td>{{ $survey_pecah->harga }}</td>
                                <td>{{ $survey_pecah->kenaikan }}</td>
                                <td>{{ $survey_pecah->merek }}</td>
                                <td>{{ $survey_pecah->valid }}</td>
                                <td>{{ $survey_pecah->counted_at }}</td>
                                <td>{{ $survey_pecah->user->name }}</td>



                                <td class="text-center">


                                    <a class="" href="{{ route('survey.unaprove', ['id'=>$survey_pecah->id]) }}">
                                        <i data-feather="slash" style="color: #ed8585"></i>
                                        {{-- <i class="fas fa-ban "  style="color: #ed8585;" ></i> --}}
                                    </a>


                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>




                    <br><br>
                    {{-- <hr> --}}

                    <span >Baru</span>

                    @if (session('message'))
                    <div class="alert alert-warning">
                        <i data-feather="alert-triangle"></i> {{ session('message') }}
                    </div>
                    @endif

                    <table class="table table-striped table-borderless border border-white-50 table-sm small">
                        {{-- <caption class="text-left ">Data hasil survey</caption> --}}
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>

                                <th class="text-capitalize">Lokasi</th>
                                <th class="text-capitalize">Komoditas</th>
                                <th class="text-capitalize">Harga</th>
                                <th class="text-capitalize">Kenaikan</th>
                                <th class="text-capitalize">Merk</th>
                                <th class="text-capitalize">Valid</th>
                                <th class="text-capitalize">Counted at</th>
                                <th class="text-capitalize">Surveyor</th>


                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @foreach ($survey_baru as $survey_pecah)
                            <tr>
                                <th>{{ ++$no }}</th>



                                <td>{{  $survey_pecah->tugas->lokasi->nama }} </td>
                                <td>{{ $survey_pecah->tugas->komoditas->nama }}</td>
                                <td>{{ $survey_pecah->harga }}</td>
                                <td>{{ $survey_pecah->kenaikan }}</td>
                                <td>{{ $survey_pecah->merek }}</td>
                                <td>{{ $survey_pecah->valid }}</td>
                                <td>{{ $survey_pecah->counted_at }}</td>
                                <td>{{ $survey_pecah->user->name }}</td>



                                <td class="text-center dropdown dropleft">


                                    <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                        ☰
                                    </span>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item small" href="{{ route('survey.aprove', ['id'=>$survey_pecah->id]) }}">
                                            <i class="far fa-check-circle"></i> Aprove
                                        </a>


                                        <form style="display: inline;" method="post" action="{{ route('survey.destroy', ['id'=>$survey_pecah->id]) }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field()}}
                                            <button class="dropdown-item small text-danger" ><i class="far fa-trash-alt"></i> Hapus</button>
                                        </form>


                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>








                    <br><br>
                    <hr>

                    <span >Expired</span>
                    <a href="{{ route('survey.kosongkan') }}" class="btn-outline-danger btn btn-sm float-right mb-3"><i class="far fa-trash-alt"></i> Kosongkan</a>

                    {{-- @if (session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                    @endif --}}

                    <table class="table table-warning table-borderless border border-white-50 table-sm small">
                        {{-- <caption class="text-left ">Data hasil survey</caption> --}}
                        <thead class="thead-light text-center">
                            <tr>
                                <th>No</th>

                                <th class="text-capitalize">Lokasi</th>
                                <th class="text-capitalize">Komoditas</th>
                                <th class="text-capitalize">Harga</th>
                                <th class="text-capitalize">Kenaikan</th>
                                <th class="text-capitalize">Merk</th>
                                <th class="text-capitalize">Valid</th>
                                <th class="text-capitalize">Counted at</th>
                                <th class="text-capitalize">Surveyor</th>


                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php $no=0 @endphp
                            @foreach ($survey_expired as $survey_pecah)
                            <tr>
                                <th>{{ ++$no }}</th>



                                <td>{{  $survey_pecah->tugas->lokasi->nama }} </td>
                                <td>{{ $survey_pecah->tugas->komoditas->nama }}</td>
                                <td>{{ $survey_pecah->harga }}</td>
                                <td>{{ $survey_pecah->kenaikan }}</td>
                                <td>{{ $survey_pecah->merek }}</td>
                                <td>{{ $survey_pecah->valid }}</td>
                                <td>{{ $survey_pecah->counted_at }}</td>
                                <td>{{ $survey_pecah->user->name }}</td>



                                <td class="text-center dropdown dropleft">


                                    <span class="btn btn-sm btn-light"data-toggle="dropdown">
                                        ☰
                                    </span>
                                    <div class="dropdown-menu">

                                        {{--  <a class="dropdown-item small" href="{{ route('survey.aprove', ['id'=>$survey_pecah->id]) }}">Validasi</a>  --}}


                                        <form style="display: inline;" method="post" action="{{ route('survey.destroy', ['id'=>$survey_pecah->id]) }}">
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

@endsection



@section('css-halaman')
<style>
    table tbody tr th{
        text-align: center;
        width: 1em;
    }


    .feather {
        width: 17px;
        height: 17px;
        //stroke: currentColor;
        //color: #ed8585;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
    }

</style>



{{--  <label class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input">
    <span class="custom-control-indicator"></span>
</label>


<style>
    .custom-checkbox {
        min-height: 1rem;
        padding-left: 0;
        margin-right: 0;
        cursor: pointer;
    }
    .custom-checkbox .custom-control-indicator {
        content: "";
        display: inline-block;
        position: relative;
        width: 30px;
        height: 10px;
        background-color: #818181;
        border-radius: 15px;
        margin-right: 10px;
        -webkit-transition: background .3s ease;
        transition: background .3s ease;
        vertical-align: middle;
        margin: 0 16px;
        box-shadow: none;
    }
    .custom-checkbox .custom-control-indicator:after {
        content: "";
        position: absolute;
        display: inline-block;
        width: 18px;
        height: 18px;
        background-color: #f1f1f1;
        border-radius: 21px;
        box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
        left: -2px;
        top: -4px;
        -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
        transition: left .3s ease, background .3s ease, box-shadow .1s ease;
    }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
        background-color: #84c7c1;
        background-image: none;
        box-shadow: none !important;
    }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator:after {
        background-color: #84c7c1;
        left: 15px;
    }
    .custom-checkbox .custom-control-input:focus ~ .custom-control-indicator {
        box-shadow: none !important;
    }
</style>  --}}



@endsection



@section('script-halaman')
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>


<script>
    feather.replace()
</script>


@endsection