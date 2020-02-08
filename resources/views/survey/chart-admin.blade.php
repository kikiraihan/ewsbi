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

                        @foreach ($chart as $instansi=>$chartPerInstansi)
                        @php $linkInstansi=str_replace(" ","-", $instansi) @endphp

                        <div class="accordion" id="{{$linkInstansi}}">
                            <div class="card">
                                <div class="card-header text-center" id="headingOne"  data-toggle="collapse" data-target="#{{$linkInstansi.'-target'}}">
                                    <small >
                                        - {{$instansi}} -
                                    </small>
                                </div>
                                <div id="{{$linkInstansi.'-target'}}" class="collapse show" data-parent="#{{$linkInstansi}}">
                                    <div class="card-body">

                                        @foreach ($chartPerInstansi as $nama_lokasi=>$chartPerLokasi)
                                        <span>
                                            <i class="fas fa-store small text-secondary"></i>
                                            {{$nama_lokasi}}
                                        </span>
                                        <hr>
                                        <div class="row m-2">
                                            @foreach ($chartPerLokasi as $charta)
                                            <div class="col-lg-4 float-left" >
                                                <div>
                                                    {!! $charta->container() !!}
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
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
    @foreach ($chart as $chartPerInstansi)
    @foreach ($chartPerInstansi as $chartPerLokasi)
    @foreach ($chartPerLokasi as $charta)
        {!! $charta->script() !!}
    @endforeach
    @endforeach
    @endforeach

    <script>
        $(document).ready(function() {
            {{-- $('.collapse').collapse("show") --}}
            setTimeout(function () {
                    $('.collapse').collapse("hide")
            }, 3000);

        });
    </script>

@endsection