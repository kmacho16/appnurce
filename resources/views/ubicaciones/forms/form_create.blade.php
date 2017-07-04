<h3 class="text-center text-uppercase color-rosa">Posicion</h3>
{!! Form::open(['route'=>'ubicaciones.store','method'=>'POST']) !!}
	{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese nombre de la direccion','required'=>true,'id'=>'nomb_direccion'])!!}
	<input type="hidden"  class="form-control" id="latitud" name="latitud" placeholder="Latitud" value="4.677396568627247">
	<input type="hidden"  class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="-74.08310437910154">
	<br>
	<button class="btn btn-rosa btn-block" id="btn_direccion">Guardar</button>
{!! Form::close() !!}
{!! Form::open(['url'=>['ubicacionFind'],'method'=>'POST']) !!}
	<input type="text" name="latBus" id="latBus" value="4.677396568627247">
	<input type="text" name="lngBus" id="lngBus" value="-74.08310437910154">
	<input type="number" name="radio" id="radio" min="1" max="20" value="1">
	<br>
	<button class="btn btn-warning btn-block" id="btn_direccion">Buscar</button>
{!! Form::close() !!}