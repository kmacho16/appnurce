@extends('home')
@section('contenido-seg')

@if($errors->any())
	<div class="alert alert-danger">
		@foreach($errors->all() as $error)
			{{$error}}
			<br>
		@endforeach
	</div>
@endif



<h4 class="color-rosa">Formulario registro</h4>
<hr>
	{!! Form::open(['route'=>['user.store'],'method'=>'Post','files'=>true]) !!}
	<div class="group-control">
		@include('users.forms.inputForm')
	</div>
	{!! Form::close() !!}
@endsection