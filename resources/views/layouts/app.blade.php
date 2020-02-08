<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <title>{{ $title }}</title>



    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    {{-- <link href="{{ asset('assets/bootstrap4/css/bootstrap.min.css') }}" rel="stylesheet"> --}}



    {{-- icon --}}
    {{-- <link href="{{ asset('assets/pe-icon-7-stroke.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    @yield('css-halaman')


</head>
<body style="{{ $bodyStyle }}">
    <div id="app" class="wrapper">
        @auth
        @include('layouts.sidebar')
        @endauth

        {{-- <main class="py-4">
            @yield('content')
        </main> --}}

        <div id="content">
            @include('layouts.navbar')

            <main class="py-4">
                @yield('content')
            </main>

        </div>


    </div>

    {{-- <footer class="footer text-center">
        ini footer
    </footer> --}}

    {{-- <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{ asset('assets/bootstrap4/js/jquery-3.3.1.js') }}" ></script>
    <!-- Popper.JS -->
    <script src="{{ asset('assets/bootstrap4/js/popper.js') }}" ></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/bootstrap4/js/bootstrap.js') }}" ></script> --}}

    <script type="text/javascript">
    // $('#sidebar').toggleClass('active');
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').css('width','calc(100%-250px)');
            });
        });

        $(function() {
            $('#sidebar a[href~="' + location.href + '"]').parents('li').addClass('active');
        });

    </script>

    @yield('script-halaman')





</body>
</html>
