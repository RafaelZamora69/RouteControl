@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <h3>Usuarios</h3>
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
                            <form action="{{route('vehicle.delete',['vehicle' => $ruta->id])}}">
                                @method('delete')
                                @csrf
                                <td><input type="submit" value="Eliminar" class="btn red white-text"></td>
                            </form>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
