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

@if(session('mensajes'))
	<div class="alert alert-success">
		{{ session('mensajes') }}
	</div>
@endif



<h4 class="color-rosa">Formulario edicion</h4>
<hr>
	{!! Form::model($usuario,['route'=>['usuarios.update',$usuario->id],'method'=>'put','files'=>true]) !!}
	<div class="group-control">
		@include('users.forms.inputForm')
	</div>
	{!! Form::close() !!}

@if ($usuario->id_rol<3)
	<div class="col-md-12">
		@include('users.forms.formDocumentos')
	</div>
@endif
	


@endsection