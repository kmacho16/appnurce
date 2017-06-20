@extends('layouts.principal')

@section('contenido')
    <div class="row">
        <div class="col-md-2 sidebar">
            <h4 class="color-rosa text-uppercase text-center">Hola {{ Auth::user()->name }}</h4>
            <img src="{{ url('img/profile.ico') }}" alt="" class="img-circle center-block">
            <hr>

            <div class="list-group">
                <a href="#" class="list-group">prueba</a>
                <a href="#" class="list-group">prueba</a>
                <a href="#" class="list-group">prueba</a>
                <a href="#" class="list-group">prueba</a>
                <a href="#" class="list-group">prueba</a>
            </div>
             <div class="text-center">
                <a href="#">Salir</a>

            </div>
        </div>
        <div class="col-md-8"> 
        </div>
    </div>
@endsection
