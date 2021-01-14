@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <div class="row">
            <form action="{{route('user.update',['user' => $usuario->id])}}" class="col s12" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-panel">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="name" name="name" @error('name') class="invalid" @enderror value="{{$usuario->name}}">
                            <label for="name">Nombre <span class="red-text"> *</span></label>
                            @error('name')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="surnames" name="surnames" @error('surnames') class="invalid" @enderror value="{{$usuario->surnames}}">
                            <label for="surnames">Apellidos<span class="red-text"> *</span></label>
                            @error('surnames')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="sex" name="sex" @error('sex') class="invalid" @enderror value="{{$usuario->sex}}">
                            <label for="sex">Sexo<span class="red-text"> *</span></label>
                            @error('sex')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="birthday" name="birthday" class="datepicker" @error('birthday') class="invalid" @enderror value="{{$usuario->birthday}}">
                            <label for="birthday">Fecha de nacimiento<span class="red-text"> *</span></label>
                            @error('birthday')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="jobId" id="jobId">
                                <option value="">--- Seleccione ---</option>
                                @foreach($jobs as $job)
                                    <option value="{{$job->id}}" {{$job->id == $usuario->jobId ? 'selected' : ''}}>{{$job->name}}</option>
                                @endforeach
                            </select>
                            <label for="jobId">Puesto</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="civilStatus" name="civilStatus" value="{{$usuario->civilStatus}}">
                            <label for="civilStatus">Estado civil</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="curp" name="curp" class="required" @error('curp') class="invalid" @enderror value="{{$usuario->curp}}">
                            <label for="curp">Curp<span class="red-text"> *</span></label>
                            @error('curp')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="rfc" name="rfc" class="required" @error('rfc') class="invalid" @enderror value="{{$usuario->rfc}}">
                            <label for="rfc">Rfc<span class="red-text"> *</span></label>
                            @error('rfc')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="adress" name="adress" class="required" @error('adress') class="invalid" @enderror value="{{$usuario->adress}}">
                            <label for="adress">Dirección<span class="red-text"> *</span></label>
                            @error('adress')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s12 m6">
                            <input type="text" id="street" name="street" class="required" @error('street') class="invalid" @enderror value="{{$usuario->street}}">
                            <label for="street">Colonia<span class="red-text"> *</span></label>
                            @error('street')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="text" id="postalCode" name="postalCode" value="{{$usuario->postalCode}}">
                            <label for="postalCode">Codigo postal</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input type="text" id="phoneNumber" name="phoneNumber" class="required" @error('phoneNumber') class="invalid" @enderror value="{{$usuario->phoneNumber}}">
                            <label for="phoneNumber">Celular<span class="red-text"> *</span></label>
                            @error('phoneNumber')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="text" id="scholarship" name="scholarship" value="{{$usuario->scholarship}}">
                            <label for="scholarship">Escolaridad</label>
                        </div>
                        <div class="input-field col s12 m6">
                            <input type="password" id="password" name="password" class="required" @error('password') class="invalid" @enderror">
                            <label for="password">Contraseña<span class="red-text"> *</span></label>
                            @error('password')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m6">
                            <input type="text" id="vehicleLabel" name="vehicleLabel">
                            <label for="vehicleLabel">Matrícula unidad</label>
                        </div>
                        <div class="input-field file-field col s12 m6">
                            <div class="btn">
                                <span>Imagen</span>
                                <input type="file" name="profilePick" id="profilePick">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn waves-effect waves-light" value="Registrar">
                </div>
                <input type="hidden" name="id" id="id" value="{{$usuario->id}}">
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const labels = M.Autocomplete.init(document.getElementById('vehicleLabel'));
            loadLabels();
            function loadLabels(){
                const res = {!! json_encode($labels->toArray()) !!};
                var data = {};
                for(i in res){
                    data[res[i].label] = null;
                }
                labels.updateData(data);
            }
        });
    </script>
    <script src="{{asset('js/users/register.js')}}"></script>
@endsection
