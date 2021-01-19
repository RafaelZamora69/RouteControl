@extends('layouts.sidenav')
@section('content')
    <div class="backgroundMain">
        <div class="container">
            <h3>Usuarios</h3>
            <div class="row">
                <div class="col s12">
                    <table class="striped centered responsive-table">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>curp</th>
                            <th>RFC</th>
                            <th>Teléfono</th>
                            <th>Unidad</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Usuarios as $User)
                            <tr>
                                <td>{{$User->name}} {{$User->surnames}}</td>
                                <td>{{$User->curp}}</td>
                                <td>{{$User->rfc}}</td>
                                <td>{{$User->phoneNumber}}</td>
                                @if(strcmp($User->vehicle,'sin asignar') != 0)
                                    <td><a href="#!" id="mostrarV-{{$User->vehicleId}}" class="mostrarV">{{$User->vehicle}}</a></td>
                                @else
                                    <td>{{$User->vehicle}}</td>
                                @endif
                                <td><a data-target="modalUsuario" id="mostrar-{{$User->id}}" class="btn green white-text modal-trigger mostrar">Mostrar</a></td>
                                <td><a href="{{route('user.edit', ['user' => $User->id])}}" class="btn yellow black-text modal-trigger editar">Editar</a></td>
                                <td><a onclick="event.preventDefault();document.getElementById('delete-{{$User->id}}').submit();" class="btn red white-text">Borrar</a></td>
                                <form action="{{route('user.delete',['user' => $User->id])}}" id="delete-{{$User->id}}" method="post">
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
    </div>
    <div id="modalUsuario" class="modal">
        <div class="modal-content" id="modalContent"></div>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/users/index.js')}}"></script>
@endsection
