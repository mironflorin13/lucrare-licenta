
@extends('layouts.dentist')
@section('content')

    <div class="card-body">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
        <div id='calendar'></div>
    </div>

@endsection

@section('scripts')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>

    <script>
       
        events={!!json_encode($events_list)!!};
          $('#calendar').fullCalendar({
            defaultView: 'agendaWeek',
            
            minTime: "08:00:00",
            maxTime: "20:00:00",
            height:840,
            events: events,
            firstDay: 1,
            allDaySlot: false,
          })
        
      </script>
@stop