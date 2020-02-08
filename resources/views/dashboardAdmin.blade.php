@extends('layouts.app',[
'title'=>'home',
'bodyStyle'=>""
])

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="row text-center p-2">



                        @foreach ($survey as $s)
                            <div class="col-lg-2">
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
</style>
@endsection