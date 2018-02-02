
<h3 class="text-center text-uppercase color-rosa">Posicion</h3>
<?php echo Form::model($ubicacion,['route'=>['ubicaciones.update',$ubicacion->id],'method'=>'PUT']); ?>

	<?php echo Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese nombre de la direccion','required'=>true]); ?>

	<input type="hidden"  class="form-control" id="latitud" name="latitud" placeholder="Latitud" value="<?php echo e($ubicacion->latitud); ?>">
	<input type="hidden"  class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="<?php echo e($ubicacion->longitud); ?>">
	<br>
	<button class="btn btn-warning btn-block">Actualizar</button>
<?php echo Form::close(); ?>