@extends('layouts.sidenav')
@section('cdns')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.css">
@endsection
@section('content')
    <div class="background-calendar">
        <h3>Calendario de mantenimientos</h3>
        <div class="row">
            <div class="col s12">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/locales-all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const values = [];
            getMaintenances();

            function getMaintenances(){
                fetch('getMaintenances')
                    .then(res => res.json())
                    .then(res => {
                        res.forEach(x => {
                            values.push({title:'Mantenimiento',start:x.createdAt,url:x.url});
                        });
                        getRoutes();
                    });
            }

            function getRoutes(){
                fetch('getRoutes')
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        res.forEach(x => {
                            values.push({title:'Ruta',start:x.created_at,url:x.url});
                        });
                        calendar(values);
                    });
            }

            function calendar(values){
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: values,
                    eventColor: '#378006',
                    eventBackgroundColor: 'red',
                    eventClick: (e) => {
                        e.jsEvent.preventDefault();
                        if(e.event.url){
                            window.open(e.event.url);
                        }
                    }
                });
                calendar.render();
            }
        });
    </script>
@endsection
