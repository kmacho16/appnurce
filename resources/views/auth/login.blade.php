@extends('layouts.base')

@section('contenido')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-reglog">
                <div class="panel-heading"><h4 class="text-uppercase text-center color-rosa">Bienvenido a nurceApp</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                                </label>
                            </div>
                            <br>
                                <button type="submit" class="btn btn-rosa btn-block">
                                    Login
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Olvidaste tu password
                                </a>
                                <a class="btn btn-link" href="{{ route('register') }}">
                                    Aun no tienes cuenta? 
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
