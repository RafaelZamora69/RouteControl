@extends('layouts.sidenav')
@section('content')
    <div class="container">
        <h3>Registrar vehículo</h3>
        <div class="row">
            <form action="{{route('vehicle.store')}}" class="col s12" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                <div class="card-panel">
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="label" name="label" @error('label') class="invalid" @enderror value="{{old('label')}}">
                            <label for="label">Matrícula<span class="red-text"> *</span></label>
                            @error('label')
                                <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="brand" name="brand" @error('brand') class="invalid" @enderror value="{{old('brand')}}">
                            <label for="brand">Marca<span class="red-text"> *</span></label>
                            @error('brand')
                                <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <input type="text" id="titular" name="titular" @error('titular') class="invalid" @enderror value="{{old('titular')}}">
                            <label for="titular">Titular<span class="red-text"> *</span></label>
                            @error('titular')
                                <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="driverId" name="driverId">
                            <label for="driverId">Conductor</span></label>
                            @error('driverId')
                                <span class="helper-text" data-error="{{$message}}"></span>
                            @enderror
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="year" name="year">
                            <label for="date">Año</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="model" name="model" @error('model') class="invalid" @enderror value="{{old('model')}}">
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
                            <input type="text" id="propulsion" name="propulsion">
                            <label for="propulsion">Propulsión</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="color" name="color">
                            <label for="color">Color</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="engine" name="engine">
                            <label for="engine">Motor</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="engineId" name="engineId">
                            <label for="engineId">Nº Motor</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="type" name="type">
                            <label for="type">Tipo</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="cabina" name="cabina">
                            <label for="cabina">Nº Cabina</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="text" id="rines" name="rines">
                            <label for="rines">Rines</label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" id="llantas" name="llantas">
                            <label for="llantas">Llantas</label>
                        </div>
                    </div>
                    <input type="submit" class="btn waves-effect waves-light" value="Registrar">
                </div>
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
        })
    </script>
@endsection
