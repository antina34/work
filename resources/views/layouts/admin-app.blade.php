<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

        <!--  Right-side-menu css -->
        <link href="{{ asset('/assets/plugins/sidebar/sidebar.css') }}" rel="stylesheet">

        <!-- Side-menu css -->
        <link rel="stylesheet" href="{{ asset('/assets/css/sidemenu.css') }}">

        <!-- Maps css -->
        <link href="{{ asset('/assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

        <!-- style css -->
        <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/css/style-dark.css') }}" rel="stylesheet">

        <!---Skin modes css-->
        <link href="{{ asset('/assets/css/skin-modes.css') }}" rel="stylesheet" />

        <!---FAVICON-->
        <link rel="shortcut icon" href="{{ asset('/assets/img/landing/icons/favicon.svg') }}" type="image/x-icon">
    </head>
    <body class="main-body app sidebar-mini">
        <div id="app">
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
                            <div class="user-info">
                                <h4 class="font-weight-semibold mt-3 mb-0">
                                    {{ Auth::guard('admin')->user()->name }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <ul class="side-menu">
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('admin.dashboard') }}">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journals side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 1H1v3h5V1zM1 0a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm14 12h-5v3h5v-3zm-5-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1h-5zM6 8H1v7h5V8zM1 7a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H1zm14-6h-5v7h5V1zm-5-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1h-5z"/>
                                </svg>
                                <span class="side-menu__label">Dashboard</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('admin.orders.index') }}" >
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket2 side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M1.111 7.186A.5.5 0 0 1 1.5 7h13a.5.5 0 0 1 .489.605l-1.5 7A.5.5 0 0 1 13 15H3a.5.5 0 0 1-.489-.395l-1.5-7a.5.5 0 0 1 .1-.42zM2.118 8l1.286 6h9.192l1.286-6H2.118z"/>
                                    <path fill-rule="evenodd" d="M11.314 1.036a.5.5 0 0 1 .65.278l2 5a.5.5 0 1 1-.928.372l-2-5a.5.5 0 0 1 .278-.65zm-6.628 0a.5.5 0 0 0-.65.278l-2 5a.5.5 0 1 0 .928.372l2-5a.5.5 0 0 0-.278-.65z"/>
                                    <path d="M4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zM0 6.5A.5.5 0 0 1 .5 6h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                                <span class="side-menu__label">Customer Orders</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="{{ route('admin.invoices.index') }}" >
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-checklist side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path fill-rule="evenodd" d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                                </svg>
                                <span class="side-menu__label">Invoices</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.products.index') }}" class="side-menu__item">
                                <svg
                                    width="1em"
                                    height="1em"
                                    viewBox="0 0 16 16"
                                    class="bi bi-box-seam side-menu__icon"
                                    fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"
                                    />
                                </svg>
                                <span class="side-menu__label">Products</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.subscription-plans.index') }}" class="side-menu__item">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-card-heading side-menu__icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M14.5 3h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                    <path fill-rule="evenodd" d="M3 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                    <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1z"/>
                                </svg>
                                <span class="side-menu__label">Subscriptions</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{ route('admin.prediction') }}" class="side-menu__item">
                                <svg viewBox="0 0 16 16" class="bi bi-graph-up side-menu__icon" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0h1v16H0V0zm1 15h15v1H1v-1z"/>
                                    <path fill-rule="evenodd" d="M14.39 4.312L10.041 9.75 7 6.707l-3.646 3.647-.708-.708L7 5.293 9.959 8.25l3.65-4.563.781.624z"/>
                                    <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4h-3.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                                <span class="side-menu__label">Prediction Graph</span>
                            </a>
                        </li>
                        <li class="slide">
                            <a href="/log-viewer" target="_blank" class="side-menu__item">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-journals side-menu__icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2z"/>
                                    <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2zM1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                </svg>
                                <span class="side-menu__label">Logs</span>
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
                        <button
                            class="navbar-toggler"
                            type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">

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

        @stack('scripts')

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

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
