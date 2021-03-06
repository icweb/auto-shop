@extends('layouts.app')

@section('content')
    <div style="margin-top: -1.5rem !important;">
        <div class="card">
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        const Schedule = {

            getColorByBgColor: function(bgColor) {
                if (!bgColor) { return ''; }
                return (parseInt(bgColor.replace('#', ''), 16) > 0xffffff / 2) ? '#000000' : '#ffffff';
            },

            updateEvent: function(info) {
                $.ajax({
                    url: '/appointments/' + info.event.extendedProps.meta.id,
                    data: {
                        starts_at: info.event.start.toISOString(),
                        ends_at: info.event.end.toISOString(),
                    },
                    type: 'PATCH',
                    success: function(){
                        toastr["success"]("Event updated");
                    },
                    error: function(){
                        info.revert();
                        toastr["error"]("Could not update event");
                    },
                });
            }

        };

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
                defaultView: 'timeGridWeek',
                header: {
                    left:   '{{ \App\Setting::check('calendar_left_buttons') }}',
                    center: '{{ \App\Setting::check('calendar_middle_buttons') }}',
                    right:  '{{ \App\Setting::check('calendar_right_buttons') }}'
                },
                editable: true,
                timeZone: 'America/New_York',
                customButtons: {
                    addEventButton: {
                        text: 'Add',
                        click: function() {

                        }
                    }
                },
                events: '{{ route('appointments.feed') }}',
                {{--events: [--}}
                {{--    //if (red*0.299 + green*0.587 + blue*0.114) > 186 use #000000 else use #ffffff--}}
                {{--    @foreach($appointments as $appointment)--}}
                {{--        {--}}
                {{--            id: 'a{{ $appointment->id }}',--}}
                {{--            title: '{{ preg_replace("/[^a-zA-Z]/", "", $appointment->customer->name) }}',--}}
                {{--            start: '{{ $appointment->starts_at->format('Y-m-d H:i:s') }}',--}}
                {{--            end: '{{ $appointment->ends_at->format('Y-m-d H:i:sP') }}',--}}
                {{--            rendering: '{{ $appointment->link === '#holiday' ? 'background' : '' }}',--}}
                {{--            backgroundColor: '{{ $appointment->color }}',--}}
                {{--            borderColor: '{{ $appointment->color }}',--}}
                {{--            textColor: Schedule.getColorByBgColor('{{ $appointment->color }}'),--}}
                {{--            overlap: true,--}}
                {{--            className: 'full-cal-event',--}}
                {{--            editable: true,--}}
                {{--            startEditable: true,--}}
                {{--            durationEditable: true,--}}
                {{--            meta: {--}}
                {{--                id: '{{ $appointment->id }}',--}}
                {{--                href: '{{ $appointment->link }}',--}}
                {{--                customer: {--}}
                {{--                    id: {{ $appointment->customer->id }},--}}
                {{--                    name: '{{ preg_replace("/[^a-zA-Z]/", "", $appointment->customer->name) }}'--}}
                {{--                },--}}
                {{--            }--}}
                {{--        },--}}
                {{--    @endforeach--}}
                {{--],--}}
                eventClick: function(info) {
                    window.open(
                        info.event.extendedProps.meta.href
                        // 'targetWindow',
                        // `toolbar=no,
                        // location=no,
                        // status=no,
                        // menubar=no,
                        // scrollbars=yes,
                        // resizable=yes,
                        // width=1200,
                        // height=650`
                    );
                },
                eventResize: function(info) {
                    Schedule.updateEvent(info);
                },
                eventDrop: function(info) {
                    Schedule.updateEvent(info);
                }
            });

            calendar.render();
        });
    </script>
@endsection
