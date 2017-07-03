<h3 class="text-center text-uppercase color-rosa">Posicion</h3>
{!! Form::open(['url'=>['ubicacionStore',$id_user],'method'=>'POST']) !!}
	{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese nombre de la direccion','required'=>true,'id'=>'nomb_direccion'])!!}
	<input type="hidden"  class="form-control" id="latitud" name="latitud" placeholder="Latitud" value="4.677396568627247">
	<input type="hidden"  class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="-74.08310437910154">
	<br>
	<button class="btn btn-rosa btn-block" id="btn_direccion">Guardar</button>
{!! Form::close() !!}