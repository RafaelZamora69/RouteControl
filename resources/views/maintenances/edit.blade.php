@extends('layouts.sidenav')
@section('cdns')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection
@section('content')
    <div class="backgroundMain">
        <div class="container">
            <h3>Registrar mantenimiento</h3>
            <div class="row">
                <form action="{{route('maintenance.update', ['maintenance' => $maintenance[0]->id])}}" class="col s12" method="POST" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-panel">
                        <div class="row">
                            <div class="input-field col s3">
                                <input type="text" id="vehicleId" name="vehicleId" class="autocomplete @error('vehicleId') invalid @enderror">
                                <label for="vehicleId">Matrícula vehículo<span class="red-text"> *</span></label>
                                @error('vehicleId')
                                <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="createdAt" name="createdAt" class="datepick @error('createdAt') invalid @enderror" value="{{$maintenance[0]->createdAt}}">
                                <label for="createdAt">Fecha<span class="red-text"> *</span></label>
                                @error('createdAt')
                                <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="finishedAt" name="finishedAt" class="datepick @error('finishedAt') invalid @enderror" value="{{$maintenance[0]->finishedAt}}">
                                <label for="createdAt">Terminado</label>
                                @error('finishedAt')
                                <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="text" id="partnerId" name="partnerId" class="autocomplete @error('partnerId') invalid @enderror">
                                <label for="partnerId">Proveedor<span class="red-text"> *</span></label>
                                @error('partnerId')
                                <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-field col s3">
                                <input type="number" id="amount" name="amount" class=" @error('amount') invalid @enderror" value="{{$maintenance[0]->amount}}">
                                <label for="amount">Total<span class="red-text"> *</span></label>
                                @error('amount')
                                <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="hidden" id="report" name="report" value="{{$maintenance[0]->report}}">
                                <trix-editor input="report" class="@error('report') invalid @enderror"></trix-editor>
                                @error('report')
                                <span class="helper-text" data-error="{{$message}}" data-success="right">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <input type="submit" class="btn waves-effect waves-light" value="Actualizar">
                    </div>
                    <input type="hidden" name="id" id="id" value="{{$maintenance[0]->id}}">
                </form>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            M.Datepicker.init(document.getElementById('createdAt'));
            M.Datepicker.init(document.getElementById('finishedAt'));
            const labels = M.Autocomplete.init(document.getElementById('vehicleId'));
            M.Datepicker.init(document.getElementById('createdAt'),{
                format: 'yyyy-mm-dd'
            });
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
