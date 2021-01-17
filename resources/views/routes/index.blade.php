@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <h3>Rutas</h3>
        <div class="row">
            <div class="col s12">
                <table class="striped centered responsive-table">
                    <thead>
                    <tr>
                        <th>Vehículo</th>
                        <th>Tiempo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rutas as $ruta)
                        <tr>
                            <td>{{$ruta->vehicle}}</td>
                            <td>{{$ruta->time}}</td>
                            <td><a href="{{route('routes.show',['route' => $ruta->id])}}" class="btn green white-text">Mostrar</a></td>
                            <td><a href="{{route('routes.edit', ['route' => $ruta->id])}}" class="btn yellow black-text modal-trigger editar">Editar</a></td>
                            <td><a onclick="event.preventDefault();document.getElementById('delete-{{$ruta->id}}').submit();" class="btn red white-text">Borrar</a></td>
                            <form action="{{route('route.delete',['route' => $ruta->id])}}" id="delete-{{$ruta->id}}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
