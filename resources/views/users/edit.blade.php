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



<h4 class="color-rosa">Formulario edicion</h4>
<hr>
	{!! Form::model($usuario,['route'=>['user.update',$usuario->id],'method'=>'put','files'=>true]) !!}
	<div class="group-control">
		@include('users.forms.inputForm')
	</div>
	{!! Form::close() !!}


	<div class="col-md-12">
		<h4 class="color-rosa">Documentos</h4>
		<hr>
		<div class="row">

		  <div class="col-xs-6 col-md-3">
		    <a href="#" class="thumbnail" style="padding: 10px;height: 270px;" onclick="$('#miDocImg1').click()" >
		      <img  id="mi_img1" src="{{ url('img/profile.ico') }}" alt="..." class="img-responsive" style="height: 90%;" >
		      <h5 class="text-center">Titulo imagen</h5>
		    </a>

		    {!!Form::file('foto_perfil',array('id'=>'miDocImg1','style'=>'display:none'))!!}
		
		  </div>

		  <div class="col-xs-6 col-md-3">
		    <a href="#" class="thumbnail">
		      <img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/256/add-icon.png" alt="...">
		     <h5 class="text-center">Titulo imagen</h5>
		    </a>
		  </div>

		  <div class="col-xs-6 col-md-3">
		    <a href="#" class="thumbnail" style="padding: 1.5em;">
		      <img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/256/add-icon.png" alt="...">
		    </a>
		  </div>

		  <div class="col-xs-6 col-md-3">
		    <a href="#" class="thumbnail">
		      <img src="http://icons.iconarchive.com/icons/graphicloads/100-flat-2/256/add-icon.png" alt="...">
		    </a>
		  </div>

		</div>
	</div>


@endsection