@extends('home')
@section('contenido-seg')
	<div  class="col-md-9" >
		<div id="map" style="height: 500px; border:0px solid red;border-radius: 15px;">
		</div>
	</div>
	


	<div class="col-md-3">
	{!! Form::open(['url'=>['ubicacionFind'],'method'=>'POST']) !!}
		<input type="hidden"  class="form-control" id="latitud" name="latitud" placeholder="Latitud" value="{{ $lat }} ">
		<input type="hidden"  class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="{{ $lng }}">
		<input type="hidden"  class="form-control" id="latBus" name="latBus" placeholder="Latitud" value="{{ $lat }} ">
		<input type="hidden"  class="form-control" id="lngBus" name="lngBus" placeholder="Longitud" value="{{ $lng }}">
		<input type="text" class="form-control" id="radio" name="radio" placeholder="Longitud" value="{{ $radio }}">
		<button class="btn btn-warning btn-block" id="btn_direccion">Buscar</button>
	{!! Form::close() !!}
	@if (count($ubicacionesFind)==0)
		No se encontraron Lugares
	@endif
		@foreach ($ubicacionesFind as $ubiFind)
			<div id="posicion">
				<form class="form-inline">
				  <div class="form-group">
				    <div class="input-group" id="finds">
				      	<label class="form-control" >
				    		<i class="fa fa-thumb-tack fa-fw"></i>{{ $ubiFind->name }} a {{ substr($ubiFind->distancia,0,3) }}Km
				    	</label>
						<input type="hidden" value="{{ $ubiFind->latitud }}" id="lat">
						<input type="hidden" value="{{ $ubiFind->longitud }}" id="lng">
						<input type="hidden" value="{{ $ubiFind->nombre }}" id="name">
				      	<a href="#" class="input-group-addon" data-toggle="collapse" data-target="#collapse{{ $ubiFind->id }}"><i class="fa fa-plus"></i></a>
				    </div>
				  </div>
				</form>
				{{--<a id="otro" href="#"  data-toggle="collapse" data-target="#collapse{{ $ubicacion->id }}">
				</a> --}}
				<div id="collapse{{ $ubiFind->id }}" class="collapse panel panel-default" style="padding:10px;">
					<i class='fa fa-edit fa-fw'></i>{!! link_to_route("ubicaciones.edit",$title=" Actualizar ubicacion",$parameters = $ubiFind->id) !!} <br>
					<i class="fa fa-times fa-fw"></i><a href="#" onclick="confirmarEliminar('eliminar{{ $ubiFind->id }}')"> Eliminar </a>
				</div>
			</div>
			<br>
		@endforeach
	</div>

	<script>
		var findDirecciones = {!! json_encode($ubicacionesFind) !!};
		//console.log({!! json_encode($ubicacionesFind) !!});
	</script>

@endsection