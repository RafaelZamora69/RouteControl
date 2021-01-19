@extends('layouts.sidenav')
@section('content')
    <div class="backgroundMain">
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h4>Mantenimiento programado para: {{$maintenance[0]->createdAt}}</h4>
                    <div class="row">
                        <div class="col s12 m6">
                            {!! $maintenance[0]->report !!}
                            <p><h5>Costo de reparación: ${!! $maintenance[0]->amount !!}</h5></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
