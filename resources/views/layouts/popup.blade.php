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

    <link href="{{ asset('vendor/fullcalendar/core/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('vendor/fullcalendar/daygrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('vendor/fullcalendar/timegrid/main.css') }}" rel='stylesheet' />
    <link href="{{ asset('vendor/fullcalendar/list/main.css') }}" rel='stylesheet' />

    <script src="{{ asset('vendor/fullcalendar/core/main.js') }}"></script>
    <script src='{{ asset('vendor/fullcalendar/daygrid/main.js') }}'></script>
    <script src='{{ asset('vendor/fullcalendar/timegrid/main.js') }}'></script>
    <script src='{{ asset('vendor/fullcalendar/list/main.js') }}'></script>

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
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready( function () {
            $('.dt-table').DataTable();
        } );
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

@yield('footer')
</body>
</html>
