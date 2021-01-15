@extends('layouts.sidenav')
@section('cdns')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">
@endsection
@section('content')
    <h3>Calendario de mantenimientos</h3>
    <div class="row">
        <div class="col s12">
            <div id="calendar"></div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            loadData();

            function loadData(){
                fetch('getData')
                    .then(res => res.json())
                    .then(res => {
                        const values = [];
                        res.forEach(x => {
                            values.push({title:'Titulo je',start:x.createdAt});
                        });
                        calendar(values);
                    })
            }

            function calendar(values){
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: values,
                    eventColor: '#378006',
                    eventBackgroundColor: 'red'
                });
                calendar.render();
            }
        });
    </script>
@endsection
