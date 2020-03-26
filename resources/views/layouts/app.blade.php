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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <link href="{{ asset('vendor/fullcalendar/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('vendor/fullcalendar/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('vendor/fullcalendar/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('vendor/fullcalendar/list/main.css') }}" rel='stylesheet' />

    <script src="{{ asset('vendor/fullcalendar/core/main.js') }}"></script>
    <script src='{{ asset('vendor/fullcalendar/daygrid/main.js') }}'></script>
    <script src='{{ asset('vendor/fullcalendar/timegrid/main.js') }}'></script>
    <script src='{{ asset('vendor/fullcalendar/list/main.js') }}'></script>
    <script src='{{ asset('vendor/fullcalendar/interaction/main.js') }}'></script>

    <script src="https://kit.fontawesome.com/809967d1ac.js" crossorigin="anonymous"></script>

    <style type="text/css">
        .jumbotron
        {
            padding: 40px 40px 30px 40px;
        }

        .navbar
        {
            background-color: {{ \App\Setting::check('global_nav_background_color') }} !important;
            color: {{ \App\Setting::check('global_nav_foreground_color') }} !important;
        }

        .dropdown-toggle,
        .navbar-brand,
        .nav-item > .nav-link
        {
            color: {{ \App\Setting::check('global_nav_foreground_color') }} !important;
        }

        .full-cal-event {
            cursor: pointer;
        }
    </style>
    @yield('header')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Auto Shop') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('appointments.index') }}"><i class="far fa-calendar fa-fw"></i> Schedule</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="customersDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-users"></i> Customers <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customersDropdown">
                                    <a class="nav-link text-dark" href="{{ route('customers.search-form') }}"><i class="far fa-search fa-fw"></i> Search</a>
                                    <a class="nav-link text-dark" href="{{ route('customers.create') }}"><i class="far fa-plus fa-fw"></i> Create</a>
                                    <a class="nav-link text-dark" href="{{ route('customers.index') }}"><i class="far fa-users fa-fw"></i> All</a>
                                    <a class="nav-link text-dark" href="{{ route('customers.export') }}"><i class="far fa-download fa-fw"></i> Export</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="customersDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-cars"></i> Vehicles <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customersDropdown">
                                    <a class="nav-link text-dark" href="{{ route('vehicles.search') }}"><i class="far fa-search fa-fw"></i> Search</a>
                                    <a class="nav-link text-dark" href="{{ route('vehicles.index') }}"><i class="far fa-cars fa-fw"></i> All</a>
                                    <a class="nav-link text-dark" href="{{ route('vehicles.export') }}"><i class="far fa-download fa-fw"></i> Export</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="customersDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-file-invoice-dollar"></i> Invoices <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customersDropdown">
                                    <a class="nav-link text-dark" href="#"><i class="far fa-search fa-fw"></i> Search</a>
                                    <a class="nav-link text-dark" href="{{ route('invoices.index') }}"><i class="far fa-file-invoice-dollar fa-fw"></i> All</a>
                                    <a class="nav-link text-dark" href="#"><i class="far fa-download fa-fw"></i> Export</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="far fa-lock"></i> Admin <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="adminDropdown">
                                    <a class="nav-link text-dark" href="#"><i class="far fa-cog fa-fw"></i> Employees</a>
                                    <a class="nav-link text-dark" href="#"><i class="far fa-cog fa-fw"></i> Services</a>
                                    <a class="nav-link text-dark" href="#"><i class="far fa-cog fa-fw"></i> Logs</a>
                                    <a class="nav-link text-dark" href="#"><i class="far fa-cog fa-fw"></i> Settings</a>
                                </div>
                            </li>
                        @endauth
                    </ul>

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
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready( function () {
            $('.dt-table').DataTable();
        } );
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

@yield('footer')
</body>
</html>
