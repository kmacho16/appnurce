@extends('home')
@section('contenido-seg')
	<div  class="col-md-9" >
		<div id="map" style="height: 500px; border:0px solid red;border-radius: 15px;">
		</div>
		
	</div>
	<div class="col-md-3">
		<div class="form-group" id="form_ubicacion">
			@include('ubicaciones.forms.form_create')
		</div>

	

		<hr>
		<a href="#" class="thumbnail text-center" id="btn_nueva">
			<i class="fa fa-plus fa-fw"></i>
			<strong>Nueva</strong>
		</a>
		<h5 class="color-rosa text-center text-uppercase">Tus lugares guardados</h5>

		

		@foreach ($ubicaciones as $ubicacion)

		<div id="posicion">
			<form class="form-inline">
			  <div class="form-group">
			    <div class="input-group" id="otro">
			      	<label class="form-control" >
			    		<i class="fa fa-thumb-tack fa-fw"></i>{{ $ubicacion->nombre }}
			    	</label>
					<input type="hidden" value="{{ $ubicacion->latitud }}" id="lat">
					<input type="hidden" value="{{ $ubicacion->longitud }}" id="lng">
					<input type="hidden" value="{{ $ubicacion->nombre }}" id="name">
			      	<a href="#" class="input-group-addon" data-toggle="collapse" data-target="#collapse{{ $ubicacion->id }}"><i class="fa fa-plus"></i></a>
			    </div>
			  </div>
			</form>
{{-- 
			<a id="otro" href="#"  data-toggle="collapse" data-target="#collapse{{ $ubicacion->id }}">
			
				
			</a> --}}
			<div id="collapse{{ $ubicacion->id }}" class="collapse panel panel-default" style="padding:10px;">
				<i class='fa fa-edit fa-fw'></i>{!! link_to_route("ubicaciones.edit",$title=" Actualizar ubicacion",$parameters = $ubicacion->id) !!} <br>
				<i class="fa fa-times fa-fw"></i><a href="#" onclick="confirmarEliminar('eliminar{{ $ubicacion->id }}')"> Eliminar </a>
			</div>
		</div>
		{!!Form::open(['route'=>['ubicaciones.destroy',$ubicacion->id],'method'=>'DELETE'])!!}
				{!!Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$ubicacion->id])!!}
			{!!Form::close()!!}
		<br>
		@endforeach
	</div>


@endsection