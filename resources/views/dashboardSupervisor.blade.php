@extends('layouts.app',[
'title'=>'home',
'bodyStyle'=>""
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">Dashboard Supervisor</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row text-center p-2">




                        {{-- /* PROFILE */ --}}
                        <!--Profile Card 4-->
                        <div class="col-md-3">
                            <div class="card ">
                                {{-- <img class="card-img-top" src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" style="overflow:hidden"> --}}
                                <div class="card-body">

                                    <img src="https://randomuser.me/api/portraits/women/14.jpg" alt="profile-image" class="profile rounded-circle mb-4"/>

                                    <h5 class="card-title text-capitalize">
                                        {{auth::user()->username}}
                                    </h5>
                                    {{-- <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis, autem.</p> --}}
                                    <p class="card-text">
                                        <small class="text-muted">
                                            {{auth::user()->name}}
                                            {{-- Last updated 3 mins ago --}}
                                        </small>
                                    </p>
                                    <ul class="list-group list-group-flush">
                                        {{-- <li class="list-group-item text-left small">Survey : <span class="float-right small ">{{auth::user()->survey->count()}}</span> </li> --}}
                                        <li class="list-group-item text-left small">Email : <span class="float-right small ">{{auth::user()->email}}</span> </li>
                                        <li class="list-group-item text-left small">Instansi : <span class="float-right small ">{{auth::user()->instansi->nama_instansi}}</span> </li>
                                        <li class="list-group-item text-left small">Otorisasi : <span class="float-right small ">{{auth::user()->kategori}}</span> </li>
                                    </ul>

                                    <button class="btn btn-sm btn-block mt-4 ">Edit</button>


                                </div>
                            </div>

                            <br>

                            <div class="card ">
                                <div class="card-body">


                                    <h5>Tugas Survey</h5><br>

                                    @foreach ($tugas as $key=>$tgs)

                                    <p class="card-text">
                                        <small class="text-left  m-2 d-block">
                                            <i class="fas fa-map-marker-alt "></i>
                                            <b>{{$tgs[0]->lokasi->nama}} :</b> {{$tgs[0]->lokasi->alamat}}
                                        </small>
                                    </p>
                                    <ul class="list-group ">
                                        @foreach ($tgs as $t)
                                        <li class="list-group-item text-left small text-center">
                                            {{-- Email : <span class="float-right small ">{{auth::user()->email}}</span>  --}}
                                            {{ $t->komoditas->nama }} - {{ $t->komoditas->satuan }}
                                        </li>
                                        @endforeach
                                    </ul>

                                    <br><br>
                                    @endforeach


                                    {{-- <button class="btn btn-sm btn-block mt-4 "></button> --}}

                                </div>
                            </div>



                        </div>







                        <div class="col-md-9 pt-0">
                            <div class="row pl-2 pr-2 pt-0 mt-0">

                                {{-- counter survey --}}
                                <div class="col-md-12">
                                    <div class="counter row m-0">
                                        <div class="col-md-12 ">
                                            <b class="text-secondary ">Survey minggu ini</b>
                                        </div>
                                        <div class="col-md-4 p-4">
                                            <h2 class="timer count-title count-number" data-to="{{$jumlahDisurvey}}" data-speed="800"></h2>
                                            <b class="text-success">
                                                Disurvey-Valid
                                            </b>
                                        </div>

                                        <div class="col-md-4 p-4">
                                            <h2 class="timer count-title count-number" data-to="{{$jumlahTugas-$jumlahDisurvey}}" data-speed="800"></h2>
                                            <b class="text-danger">
                                                Belum Disurvey
                                            </b>
                                        </div>

                                        <div class="col-md-4 p-4  border-left">
                                            <h2 class="timer count-title count-number" data-to="{{$jumlahTugas}}" data-speed="800"></h2>
                                            <b class="text-info">
                                                Jumlah Tugas
                                            </b>
                                        </div>



                                    </div>
                                </div>



                                {{-- Daftar Komunitas --}}
                                <div class="col-md-12">
                                    <div class="counter row m-0">
                                        <div class="col-md-12 ">
                                            <b class="text-secondary"> Survey </b>
                                        </div>


                                        @foreach ($isisurvey as $s)
                                        <div class="col-lg-4">
                                            <div class="counter">
                                                {{-- <i class="fa fa-code fa-2x"></i> --}}
                                                <b class="title-counter
                                                @if( $s->survey[0]->kenaikan =='naik')
                                                title-counter-naik
                                                @elseif ($s->survey[0]->kenaikan=='turun')
                                                title-counter-turun
                                                @endif
                                                ">
                                                @if ($s->survey[0]->kenaikan=='naik')
                                                <i class="fas fa-long-arrow-alt-up"></i>
                                                @elseif ($s->survey[0]->kenaikan=='stabil')
                                                <i class="far fa-dot-circle"></i>
                                                @elseif ($s->survey[0]->kenaikan=='turun')
                                                <i class="fas fa-long-arrow-alt-down"></i>
                                                @endif
                                                {{$s->komoditas->nama}}
                                                </b>
                                                {{-- <b class="title-counter">Rp.</b> --}}
                                                <h2 class="timer count-title count-number" data-to="{{$s->survey[0]->harga}}" data-speed="1500"></h2>
                                                <p class="count-text ">
                                                    Rupiah/{{$s->komoditas->satuan}}
                                                    {{-- Naik 10% --}}
                                                </p>
                                            </div>
                                        </div>
                                        @endforeach




                                </div>
                            </div>


                        </div>
                    </div>

                </div>
                <br>










            </div>

        </div>
    </div>
</div>
</div>
@endsection

@section('script-halaman')

<script type="text/javascript">
    (function ($) {
        $.fn.countTo = function (options) {
            options = options || {};

            return $(this).each(function () {
                // set options for current element
                var settings = $.extend({}, $.fn.countTo.defaults, {
                    from:            $(this).data('from'),
                    to:              $(this).data('to'),
                    speed:           $(this).data('speed'),
                    refreshInterval: $(this).data('refresh-interval'),
                    decimals:        $(this).data('decimals')
                }, options);

                // how many times to update the value, and how much to increment the value on each update
                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;

                // references & variables that will change with each update
                var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};

                $self.data('countTo', data);

                // if an existing interval can be found, clear it first
                if (data.interval) {
                    clearInterval(data.interval);
                }
                data.interval = setInterval(updateTimer, settings.refreshInterval);

                // initialize the element with the starting value
                render(value);

                function updateTimer() {
                    value += increment;
                    loopCount++;

                    render(value);

                    if (typeof(settings.onUpdate) == 'function') {
                        settings.onUpdate.call(self, value);
                    }

                    if (loopCount >= loops) {
                        // remove the interval
                        $self.removeData('countTo');
                        clearInterval(data.interval);
                        value = settings.to;

                        if (typeof(settings.onComplete) == 'function') {
                            settings.onComplete.call(self, value);
                        }
                    }
                }

                function render(value) {
                    var formattedValue = settings.formatter.call(self, value, settings);
                    $self.html(formattedValue);
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0,               // the number the element should start at
            to: 0,                 // the number the element should end at
            speed: 1000,           // how long it should take to count between the target numbers
            refreshInterval: 100,  // how often the element should be updated
            decimals: 0,           // the number of decimal places to show
            formatter: formatter,  // handler for formatting the value before rendering
            onUpdate: null,        // callback method for every time the element is updated
            onComplete: null       // callback method for when the element finishes updating
        };

        function formatter(value, settings) {
            return value.toFixed(settings.decimals);
        }
    }(jQuery));

    jQuery(function ($) {
        // custom formatting example
        $('.count-number').data('countToOptions', {
            formatter: function (value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });

        // start all the timers
        $('.timer').each(count);

        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
    });
</script>



@endsection



@section('css-halaman')
<style type="text/css">
    .counter {
        background-color:#f5f5f5;
        padding: 20px 0;
        border-radius: 5px;
    }

    .count-title {
        font-size: 40px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .count-text {
        font-size: 13px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .title-counter {
        margin: 0 auto;
        float: none;
        display: table;
        font-size: 18px;
        color: #4ecca1;
    }
    /* .title-counter-tetap {
        color: #3abbcf;
    } */
    .title-counter-turun {
        color: #edbe24;
    }
    .title-counter-naik {
        color: #ff7363;
    }









    /* PROFILE */
    .box { background-color: #fff; border-radius: 8px; border: 2px solid #e9ebef; padding: 50px; margin-bottom: 40px; }
    .box-title { margin-bottom: 30px; text-transform: uppercase; font-size: 16px; font-weight: 700; color: #094bde; letter-spacing: 2px; }
    .plan-selection { border-bottom: 2px solid #e9ebef; padding-bottom: 25px; margin-bottom: 35px; }
    .plan-selection:last-child { border-bottom: 0px; margin-bottom: 0px; padding-bottom: 0px; }
    .plan-data { position: relative; }
    .plan-data label { font-size: 20px; margin-bottom: 15px; font-weight: 400; }
    .plan-text { padding-left: 35px; }
    .plan-price { position: absolute; right: 0px; color: #094bde; font-size: 20px; font-weight: 700; letter-spacing: -1px; line-height: 1.5; bottom: 43px; }
    .term-price { bottom: 18px; }
    .secure-price { bottom: 68px; }
    .summary-block { border-bottom: 2px solid #d7d9de; }
    .summary-block:last-child { border-bottom: 0px; }
    .summary-content { padding: 28px 0px; }
    .summary-price { color: #094bde; font-size: 20px; font-weight: 400; letter-spacing: -1px; margin-bottom: 0px; display: inline-block; float: right; }
    .summary-small-text { font-weight: 700; font-size: 12px; color: #8f929a; }
    .summary-text { margin-bottom: -10px; }
    .summary-title { font-weight: 700; font-size: 14px; color: #1c1e22; }
    .summary-head { display: inline-block; width: 120px; }


    /* Profile */
    /*Profile card 4*/
    .profile-card-4 .card-img-block{
        float:left;
        width:100%;
        height:150px;
        overflow:hidden;
    }
    .profile-card-4 .card-body{
        position:relative;
    }
    .profile-card-4 .profile {
        border-radius: 50%;
        position: absolute;
        top: -62px;
        left: 50%;
        width:100px;
        border: 3px solid rgba(255, 255, 255, 1);
        margin-left: -50px;
    }
    .profile-card-4 .card-img-block{
        position:relative;
    }
    .profile-card-4 .card-img-block > .info-box{
        position:absolute;
        background:rgba(217,11,225,0.6);
        width:100%;
        height:100%;
        color:#fff;
        padding:20px;
        text-align:center;
        font-size:14px;
        -webkit-transition: 1s ease;
        transition: 1s ease;
        opacity:0;
    }
    .profile-card-4 .card-img-block:hover > .info-box{
        opacity:1;
        -webkit-transition: all 1s ease;
        transition: all 1s ease;
    }
    .profile-card-4 h5{
        font-weight:600;
        color:#d90be1;
    }
    .profile-card-4 .card-text{
        font-weight:300;
        font-size:15px;
    }
    .profile-card-4 .icon-block{
        float:left;
        width:100%;
    }
    .profile-card-4 .icon-block a{
        text-decoration:none;
    }
    .profile-card-4 i {
        display: inline-block;
        font-size: 16px;
        color: #d90be1;
        text-align: center;
        border: 1px solid #d90be1;
        width: 30px;
        height: 30px;
        line-height: 30px;
        border-radius: 50%;
        margin:0 5px;
    }
    .profile-card-4 i:hover {
        background-color:#d90be1;
        color:#fff;
    }



</style>
@endsection