@extends('layouts.sidenav')
@section('content')
<div class="container">
    <h3>Mantenimiento</h3>
    <div class="row">
        <div class="col s12">
            <table class="striped centered responsive-table">
                <thead>
                <tr>
                    <th>Vehículo</th>
                    <th>Fecha</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($maintenances as $maintenance)
                    <tr>
                        <td>{{$maintenance->vehicle}}</td>
                        <td>{{$maintenance->createdAt}}</td>
                        <td>- - -</td>
                        <td><a href="{{route('maintenance.show',['maintenance' => $maintenance->id])}}" class="btn green white-text">Mostrar</a></td>
                        <td><a href="{{route('maintenance.edit', ['maintenance' => $maintenance->id])}}" class="btn yellow black-text modal-trigger editar">Editar</a></td>
                        <form action="{{route('vehicle.delete',['vehicle' => $maintenance->id])}}">
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
