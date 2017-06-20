@extends('layouts.base')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-reglog">
                <div class="panel-heading"><h4 class="text-uppercase text-center color-rosa">Registrar</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Ingresa tu Nombre" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Ingresa tu email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Ingresa tu contraseña" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Confirma tu contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                            <div class="checkbox text-center">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> He leido y acepto los <a href="#">Terminos y condiciones</a>
                                    </label>
                                    
                                </div><br>
                                <button type="submit" class="btn btn-rosa btn-block">
                                    Registrar
                                </button>

                                
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Olvidaste tu password
                                </a>
                                <a class="btn btn-link" href="{{ route('login') }}">
                                    Ya tienes cuenta? 
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
