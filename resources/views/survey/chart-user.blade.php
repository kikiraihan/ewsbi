@extends('layouts.app',[
'title'=>'Chart Survey',
'bodyStyle'=>""
])

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">



            <div class="card">
                <div class="card-header pl-3">All Survey</div>
                <div class="card-body container">

                    @foreach ($chart as $nama_lokasi => $chartLokasi)
                    <span>
                        <i class="fas fa-store  text-secondary"></i>
                        {{$nama_lokasi}}
                    </span>
                    <hr>
                    <div class="row m-2">
                        @foreach ($chartLokasi as $charta)
                        <div class="col-lg-4 float-left" >
                            <div>
                                {!! $charta->container() !!}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br><br><br>
                    @endforeach



                </div>
            </div>








        </div>
    </div>
</div>

@endsection



@section('css-halaman')

@endsection



@section('script-halaman')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    @foreach ($chart  as $chartLokasi)
    @foreach ($chartLokasi  as $charta)
    {!! $charta->script() !!}
    @endforeach
    @endforeach
@endsection