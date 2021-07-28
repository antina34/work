<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!--  Owl-carousel css-->
    <link href="{{ asset('/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />

    <!--  Custom Scroll bar-->
    <link href="{{ asset('/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet"/>

    <!--  Right-sidemenu css -->
    <link href="{{ asset('/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/sidemenu.css') }}">

    <!-- Maps css -->
    <link href="{{ asset('/assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

    <!-- style css -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style-dark.css') }}" rel="stylesheet">

    <!---Skinmodes css-->
    <link href="{{ asset('/assets/css/skin-modes.css') }}" rel="stylesheet" />

    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{--    favicon--}}
    <link rel="shortcut icon" href="{{ asset('/assets/img/landing/icons/favicon.svg') }}" type="image/x-icon">


</head>
<body>
<!-- /Loader -->
<!-- main-content -->
<div id="app">
    @include('partials.loader')

    <main>
        @yield('content')
    </main>
</div>

<!-- JQuery min js -->
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Bundle js -->
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Ionicons js -->
<script src="{{ asset('/assets/plugins/ionicons/ionicons.js') }}"></script>

<!-- Moment js -->
<script src="{{ asset('/assets/plugins/moment/moment.js') }}"></script>

<!-- eva-icons js -->
<script src="{{ asset('/assets/js/eva-icons.min.js') }}"></script>

<!-- custom js -->
<script src="{{ asset('/assets/js/custom.js') }}"></script>
</body>
</html>
