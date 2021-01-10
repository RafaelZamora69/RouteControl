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
    <script src="{{asset('js/calendar/index.js')}}"></script>
@endsection
