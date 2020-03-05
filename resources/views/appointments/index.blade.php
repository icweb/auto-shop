@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h3 class="display-4 mb-0" style="font-size:30px !important;">
                        <i class="far fa-calendar"></i> Schedule
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Schedule</li>
                        </ol>
                    </nav>
                </div>

                <div class="card">
                    <div class="card-body">
                       <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid', 'timeGrid', 'list' ],
                defaultView: 'timeGridWeek',
                header: {
                    left:   'prev,next',
                    center: 'title',
                    right:  'today,month,dayGridMonth,dayGridWeek,timeGridDay,list'
                },
                events: [
                    @foreach($appointments as $appointment)
                        {
                            id: 'a{{ $appointment->id }}',
                            title: '{{ preg_replace("/[^a-zA-Z]/", "", $appointment->customer->first_name . ' ' . $appointment->customer->last_name) }}',
                            start: '{{ $appointment->starts_at->format('Y-m-d H:i:s') }}',
                            end: '{{ $appointment->ends_at->format('Y-m-d H:i:s') }}',
                        },
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
@endsection
