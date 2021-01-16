@extends('layouts.sidenav')
@section('cdns')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection
@section('content')
    <div class="container">
        <h3>Registrar ruta</h3>
        <div class="row">
            <form action="{{route('routes.update',['route' => $route[0]->id])}}" class="col s12" method="POST" novalidate enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-panel">
                    <div class="row">
                        <div class="input-field col s4">
                            <input type="text" id="vehicleId" name="vehicleId" class="autocomplete @error('vehicleId') invalid @enderror">
                            <label for="vehicleId">Matrícula vehículo<span class="red-text"> *</span></label>
                            @error('vehicleId')
                            <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="colony" name="colony" class="required @error('colony') invalid @enderror" value="{{$route[0]->colony}}">
                            <label for="colony">Colonia<span class="red-text"> *</span></label>
                            @error('colony')
                            <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="input-field col s4">
                            <input type="text" id="time" name="time" class="timepicker @error('time') invalid @enderror" value="{{$route[0]->time}}">
                            <label for="time">Time<span class="red-text"> *</span></label>
                            @error('time')
                            <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="hidden" id="streets" name="streets" value="{{$route[0]->streets}}">
                            <trix-editor input="streets" class="@error('streets') invalid @enderror"></trix-editor>
                            @error('streets')
                            <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <input type="submit" class="btn waves-effect waves-light" value="Registrar">
                </div>
                <input type="hidden" name="id" id="id" value="{{$route[0]->id}}">
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            M.Timepicker.init(document.getElementById('time'));
            const labels = M.Autocomplete.init(document.getElementById('vehicleId'));
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
@endsection
