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

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Icons css -->
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

        <!-- Internal Data table css -->
        <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">

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
    </head>
    <body class="main-body app sidebar-mini">
        <div id="app">
            <!-- Loader -->
            <div id="global-loader">
                <img src="{{ asset('/assets/img/loader.svg') }}" class="loader-img" alt="Loader">
            </div>
            <!-- /Loader -->

            <!-- main-sidebar -->
            <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
            <aside class="app-sidebar sidebar-scroll">
                <div class="main-sidebar-header active">
                    <a class="desktop-logo logo-light active mr-3" href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('/assets/img/default-logo.svg') }}" class="main-logo" alt="logo">
                        <div class="app-sidebar__toggle" data-toggle="sidebar">
                            <a class="close-toggle" href="#">
                                <em class="header-icon fe fe-align-left"></em>
                            </a>
                        </div>

                    </a>
                    <a class="logo-icon mobile-logo icon-light active mr-3" href="{{ route('dashboard.index') }}">
                        <div class="app-sidebar__toggle" data-toggle="sidebar">
                            <a class="open-toggle" href="#">
                                <em class="header-icon fe fe-arrow-left" ></em>
                            </a>
                        </div>

                    </a>
                </div>
                        <div class="main-sidemenu">
                    <div class="app-sidebar__user clearfix">
                        <div class="dropdown user-pro-body">
                            @if(Auth::user()->google_avatar_url)
                                <div class="">
                                    <img alt="user-img" class="avatar avatar-xl brround mCS_img_loaded"
                                         src="{{ Auth::user()->google_avatar_url }}">
                                    <span class="avatar-status profile-status bg-green"></span>
                                </div>
                            @endif
                            <div class="user-info">
                                <h4 class="font-weight-semibold mt-3 mb-0">
                                    {{ Auth::user()->name }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <ul class="side-menu">
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('dashboard.index') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journals side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('orders.index') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket2 side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.111 7.186A.5.5 0 0 1 1.5 7h13a.5.5 0 0 1 .489.605l-1.5 7A.5.5 0 0 1 13 15H3a.5.5 0 0 1-.489-.395l-1.5-7a.5.5 0 0 1 .1-.42zM2.118 8l1.286 6h9.192l1.286-6H2.118z"/>
                                    <path fill-rule="evenodd" d="M11.314 1.036a.5.5 0 0 1 .65.278l2 5a.5.5 0 1 1-.928.372l-2-5a.5.5 0 0 1 .278-.65zm-6.628 0a.5.5 0 0 0-.65.278l-2 5a.5.5 0 1 0 .928.372l2-5a.5.5 0 0 0-.278-.65z"/>
                                    <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zM0 6.5A.5.5 0 0 1 .5 6h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                                <span class="side-menu__label">My Orders</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('invoices.index') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-checklist side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                </svg>
                                <span class="side-menu__label">My Invoices</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('settings') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear-wide side-menu__icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 0 0-9.995 4.998 4.998 0 0 0 0 9.996z"
                                    />
                                </svg>
                                <span class="side-menu__label">Settings</span>
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
            </aside>

            <!-- main-content -->
            <div class="main-content app-content">
                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                    <a class="logo-icon mobile-logo icon-light active mr-3" href="{{ route('dashboard.index') }}">
                        <img src="{{ asset('/assets/img/landing/icons/favicon.svg') }}" class="logo-icon" alt="logo">
                    </a>
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <button
                            type="button"
                            class="btn btn-purple float-left"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto"></ul>

                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

                <main class="py-4">
                    <flash levels="{{session('levels', 'success')}}" message="{{session('message')}}"></flash>
                    @yield('content')
                </main>
                @include('cookieConsent::index')
            </div>
        </div>

        <!-- JQuery min js -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Bundle js -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!--Internal  Chart.bundle js -->
        <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>

        <!-- Ionicons js -->
        <script src="{{ asset('assets/plugins/ionicons/ionicons.js') }}"></script>

        <!-- Moment js -->
        <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>

        <!-- Custom prediction chart -->
        <script src="{{ asset('/assets/js/prediction-graph.js') }}"></script>

        <!-- Internal Data tables -->
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>

        <!--Internal  Datatable js -->
        <script src="{{ asset('assets/js/table-data.js') }}"></script>

        <!--Internal  Flot js-->
        <script src="{{ asset('/assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('/assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('/assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('/assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
        <script src="{{ asset('/assets/js/dashboard.sampledata.js') }}"></script>
        <script src="{{ asset('/assets/js/chart.flot.sampledata.js') }}"></script>

        <!-- Custom Scroll bar Js-->
        <script src="{{ asset('/assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

        <!--Internal Apexchart js-->
        <script src="{{ asset('/assets/js/apex-charts.js') }}"></script>

        <!-- Rating js-->
        <script src="{{ asset('/assets/plugins/rating/jquery.rating-stars.js') }}"></script>
        <script src="{{ asset('/assets/plugins/rating/jquery.barrating.js') }}"></script>

        <!-- Eva-icons js -->
        <script src="{{ asset('assets/js/eva-icons.min.js') }}"></script>

        <!-- Left-menu js-->
        <script src="{{ asset('/assets/plugins/side-menu/sidemenu.js') }}"></script>

        <!-- Internal Map -->
        <script src="{{ asset('/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

        <!-- custom js -->
        <script src="{{ asset('/assets/js/custom.js') }}"></script>
        <script src="{{ asset('/assets/js/jquery.vmap.sampledata.js') }}"></script>

    </body>
</html>
