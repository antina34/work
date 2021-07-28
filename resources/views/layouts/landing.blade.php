<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/landing/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/landing/mobile.css') }}">
        <link rel="shortcut icon" href="{{ asset('/assets/img/landing/icons/favicon.svg') }}" type="image/x-icon">

        <!-- Icons css -->
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
        <title>MyBitcoin</title>
    </head>
    <body>
        <!-- /Loader -->
        <!-- main-content -->
        <div id="app">
            <main>
                @yield('content')
            </main>
            @include('cookieConsent::index')
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>

        {{--Button up--}}
        <script src="{{ asset('/assets/js/main.js') }}"></script>


        <!-- Moment js -->
        <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>

        <!-- Custom prediction chart -->
        <script src="{{ asset('/assets/js/prediction-graph.js') }}"></script>

        <script type="javascript" src="{{ asset('/assets/js/main.js') }}"></script>

        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"
        ></script>

        <!-- Moment js -->
        <script src="{{ asset('/assets/plugins/moment/moment.js') }}"></script>

        <!--Internal Apexchart js-->
        <script src="{{ asset('/assets/js/apex-charts.js') }}"></script>
    </body>
</html>
