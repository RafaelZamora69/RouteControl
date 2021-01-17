@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <h3>Vehiculos</h3>
        <div class="row">
            <div class="col s12">
                <table class="striped centered responsive-table">
                    <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehiculos as $vehiculo)
                        <tr>
                            <td>{{$vehiculo->label}}</td>
                            <td>{{$vehiculo->brand}}</td>
                            <td>{{$vehiculo->model}}</td>
                            <td><a data-target="modalVehiculo" id="mostrar-{{$vehiculo->id}}" class="btn green white-text modal-trigger mostrar">Mostrar</a></td>
                            <td><a href="{{route('vehicle.edit', ['vehicle' => $vehiculo->id])}}" class="btn yellow black-text modal-trigger editar">Editar</a></td>
                            <td><a onclick="event.preventDefault();document.getElementById('delete-{{$vehiculo->id}}').submit();" class="btn red white-text">Borrar</a></td>
                            <form action="{{route('vehicle.delete',['vehicle' => $vehiculo->id])}}" id="delete-{{$vehiculo->id}}" method="post">
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
    <div id="modalVehiculo" class="modal">
        <div class="modal-content" id="modalContent"></div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/vehicles/index.js')}}"></script>
@endsection
