@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <h3>Registrar vehículo</h3>
        <div class="row">
            <form action="{{route('vehicle.update',['vehicle' => $vehiculo->id])}}" class="col s12" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-panel">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="label" name="label" @error('label') class="invalid" @enderror value="{{$vehiculo->label}}">
                            <label for="label">Matrícula<span class="red-text"> *</span></label>
                            @error('label')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="brand" name="brand" @error('brand') class="invalid" @enderror value="{{$vehiculo->brand}}">
                            <label for="brand">Marca<span class="red-text"> *</span></label>
                            @error('brand')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input type="text" id="titular" name="titular" @error('titular') class="invalid" @enderror value="{{$vehiculo->titular}}">
                            <label for="titular">Titular<span class="red-text"> *</span></label>
                            @error('titular')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="driverId" name="driverId" @error('driverId') class="invalid" @enderror">
                            <label for="driverId">Conductor<span class="red-text"> *</span></label>
                            @error('driverId')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="date" name="date" class="datepicker" value="{{$vehiculo->date}}">
                            <label for="date">Fecha</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="model" name="model" @error('model') class="invalid" @enderror value="{{$vehiculo->model}}">
                            <label for="model">Modelo<span class="red-text"> *</span></label>
                            @error('model')
                            <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field file-field col s12 m6">
                            <div class="btn">
                                <span>Imagen</span>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="propulsion" name="propulsion" value="{{$vehiculo->propulsion}}">
                            <label for="propulsion">Propulsión</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="color" name="color" value="{{$vehiculo->color}}">
                            <label for="color">Color</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="engine" name="engine" value="{{$vehiculo->engine}}">
                            <label for="engine">Motor</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="engineId" name="engineId" value="{{$vehiculo->engineId}}">
                            <label for="engineId">Nº Motor</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="type" name="type" value="{{$vehiculo->type}}">
                            <label for="type">Tipo</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="cabina" name="cabina" value="{{$vehiculo->cabina}}">
                            <label for="cabina">Nº Cabina</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="rines" name="rines" value="{{$vehiculo->rines}}">
                            <label for="rines">Rines</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="llantas" name="llantas" value="{{$vehiculo->llantas}}">
                            <label for="llantas">Llantas</label>
                        </div>
                    </div>
                    <input type="submit" class="btn waves-effect waves-light" value="Actualizar">
                </div>
                <input type="hidden" name="id" id="id" value="{{$vehiculo->id}}">
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded',() => {
            const choferes = M.Autocomplete.init(document.getElementById('driverId'));
            const res = {!! json_encode($conductores->toArray()) !!};
            var data = {};
            for(i in res){
                data[res[i].name] = null;
            }
            choferes.updateData(data);
        });
    </script>
@endsection
