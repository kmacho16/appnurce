<?php $__env->startSection('contenido-seg'); ?>
	<div  class="col-md-9" >
		<div id="map" style="height: 500px; border:0px solid red;border-radius: 15px;">
		</div>
	</div>
	


	<div class="col-md-3">
	<?php echo Form::open(['url'=>['ubicacionFind'],'method'=>'POST']); ?>

		<input type="hidden"  class="form-control" id="latitud" name="latitud" placeholder="Latitud" value="<?php echo e($lat); ?> ">
		<input type="hidden"  class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="<?php echo e($lng); ?>">
		<input type="hidden"  class="form-control" id="latBus" name="latBus" placeholder="Latitud" value="<?php echo e($lat); ?> ">
		<input type="hidden"  class="form-control" id="lngBus" name="lngBus" placeholder="Longitud" value="<?php echo e($lng); ?>">
		<input type="text" class="form-control" id="radio" name="radio" placeholder="Longitud" value="<?php echo e($radio); ?>">
		<button class="btn btn-warning btn-block" id="btn_direccion">Buscar</button>
	<?php echo Form::close(); ?>

	<?php if(count($ubicacionesFind)==0): ?>
		No se encontraron Lugares
	<?php endif; ?>
		<?php $__currentLoopData = $ubicacionesFind; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubiFind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div id="posicion">
				<form class="form-inline">
				  <div class="form-group">
				    <div class="input-group" id="finds">
				      	<label class="form-control" >
				    		<i class="fa fa-thumb-tack fa-fw"></i><?php echo e($ubiFind->name); ?> a <?php echo e(substr($ubiFind->distancia,0,3)); ?>Km
				    	</label>
						<input type="hidden" value="<?php echo e($ubiFind->latitud); ?>" id="lat">
						<input type="hidden" value="<?php echo e($ubiFind->longitud); ?>" id="lng">
						<input type="hidden" value="<?php echo e($ubiFind->nombre); ?>" id="name">
				      	<a href="#" class="input-group-addon" data-toggle="collapse" data-target="#collapse<?php echo e($ubiFind->id); ?>"><i class="fa fa-plus"></i></a>
				    </div>
				  </div>
				</form>
				
				<div id="collapse<?php echo e($ubiFind->id); ?>" class="collapse panel panel-default" style="padding:10px;">
					<i class='fa fa-edit fa-fw'></i><?php echo link_to_route("ubicaciones.edit",$title=" Actualizar ubicacion",$parameters = $ubiFind->id); ?> <br>
					<i class="fa fa-times fa-fw"></i><a href="#" onclick="confirmarEliminar('eliminar<?php echo e($ubiFind->id); ?>')"> Eliminar </a>
				</div>
			</div>
			<br>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>

	<script>
		var findDirecciones = <?php echo json_encode($ubicacionesFind); ?>;
		//console.log(<?php echo json_encode($ubicacionesFind); ?>);
	</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>