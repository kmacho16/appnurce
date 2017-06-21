@extends('home')
@section('contenido-seg')
	{!! Form::model(Auth::user(),['route'=>['user.update',Auth::user()->id],'method'=>'Post']) !!}
		{!!Form::token()!!}
		{!!Form::label('name', 'Nombre: ')!!}
		{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese su nombre aqui'])!!}
	{!! Form::close() !!}
@endsection