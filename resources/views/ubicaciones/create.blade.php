@extends('home')
@section('contenido-seg')
	<div class="col-md-9"  id="map" style="height: 500px; border:0px solid red; margin-bottom: 20px;border-radius: 15px;">
		
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<h3 class="text-center text-uppercase color-rosa">Posicion</h3>
			{!! Form::open(['route'=>'ubicaciones.store','method'=>'POST']) !!}
				{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese nombre de la direccion','required'=>true])!!}
				<input type="text"  class="form-control" id="latitud" name="latitud" placeholder="Latitud">
				<input type="text"  class="form-control" id="longitud" name="longitud" placeholder="Longitud">
				<br>
				<button class="btn btn-rosa btn-block">Guardar</button>
			{!! Form::close() !!}
			
		</div>
	</div>


@endsection