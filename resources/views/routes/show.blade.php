@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h4>{{$route[0]->time}}</h4>
                <div class="row">
                    <div class="col s12 m6">
                        {!! $route[0]->streets !!}
                    </div>
                    <div class="col s12 m6">
                        {!! $route[0]->colony !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
