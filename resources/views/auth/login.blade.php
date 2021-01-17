@extends('layouts.app')

@section('login')
    <div class="loginWallpaper">
        <div class="container containerLogin">
            <div class="row">
                <div class="col s12">
                    <div class="card">
                        <h4 class="center-align">Iniciar sesión</h4>
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{ route('login') }}" novalidate class="col s12">
                                    @csrf
                                    <div class="input-field col s12">
                                        <input id="curp" type="email" class="form-control @error('curp') validate @enderror" name="curp" value="{{ old('curp') }}" required autocomplete="curp" autofocus>
                                        <label for="curp">Curp</label>
                                        @error('curp')
                                        <span class="helper-text" data-error="{{$message}}" data-success="right">Error</span>
                                        @enderror
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="password" type="password" class="form-control @error('password') validate @enderror" name="password" required autocomplete="current-password">
                                        <label for="password">Password</label>
                                        @error('password')
                                        <span class="helper-text" data-error="{{$message}}" data-success="right">Error</span>
                                        @enderror
                                    </div>
                                    <div class="input-field col s12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
