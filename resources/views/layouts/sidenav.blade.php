@extends('layouts.app')
@section('sidenav')
    <ul class="sidenav sidenav-fixed">
        <li>
            <div class="user-view">
                <div class="background">
                    <img class="responsive-img" src="{{url('storage/images/background.png')}}">
                </div>
                <a><img src="{{url('storage/' . Auth::user()->profilePick)}}" alt="profilePick" class="circle"></a>
                <a><span class="white-text name">{{Auth::user()->name}} {{Auth::user()->surnames}}</span></a>
                <a><span class="white-text email">Curp: {{Auth::user()->curp}}</span></a>
            </div>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->jobId == 1)
        <li><a class="subheader">Administración</a></li>
        <li class="no-padding">
            <a href="{{ route('register') }}">Agregar usuario<i class="material-icons">person_add</i></a>
        </li>
        <li class="no-padding">
            <a href="{{route('routes.new')}}">Agregar ruta<i class="material-icons">add_road</i></a>
        </li>
        <li class="no-padding">
            <a href="{{route('vehicle.new')}}">Agregar vehículo<i class="material-icons">commute</i></a>
        </li>
        @endif
        <li class="no-padding">
            <a href="{{route('maintenances.new')}}">Mantenimientos<i class="material-icons">construction</i></a>
        </li>
        <li><div class="divider"></div></li>
        <li><a href="" class="subheader">Control</a></li>
        <li class="no-padding">
            <a href="{{route('maintenances.calendar')}}">Calendario<i class="material-icons">date_range</i></a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->jobId == 1)
        <li class="no-padding">
            <a href="{{route('user.index')}}">Usuarios<i class="material-icons">group</i></a>
        </li>
        <li class="no-padding">
            <a href="{{route('vehicles.index')}}">Vehículos<i class="material-icons">commute</i></a>
        </li>
        <li class="no-padding">
            <a href="{{route('routes.index')}}">Rutas<i class="material-icons">map</i></a>
        </li>
        <li class="no-padding">
            <a href="{{route('maintenances.index')}}">Mantenimientos<i class="material-icons">plumbing</i></a>
        </li>
        @endif
        <li><div class="divider"></div></li>
        <li class="no-padding">
            <a href="{{ route('logout') }}">Cerrar sesión<i class="material-icons">exit_to_app</i></a>
        </li>
    </ul>
@endsection
