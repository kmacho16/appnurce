<?php $__env->startSection('contenido-seg'); ?>
	<div  class="col-md-9" >
		<div id="map" style="height: 500px; border:0px solid red;border-radius: 15px;">
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group" id="form_ubicacion">
		<?php if(@isset ($id_user)): ?>
			<?php echo $__env->make('ubicaciones.forms.form_create_location', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php else: ?>
			<?php echo $__env->make('ubicaciones.forms.form_create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php endif; ?>
		</div>
		<hr>
		<a href="#" class="thumbnail text-center" id="btn_nueva">
			<i class="fa fa-plus fa-fw"></i>
			<strong>Nueva</strong>
		</a>
		<h5 class="color-rosa text-center text-uppercase">Tus lugares guardados</h5>
		<?php $__currentLoopData = $ubicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ubicacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

		<div id="posicion">
			<form class="form-inline">
			  <div class="form-group">
			    <div class="input-group" id="otro">
			      	<label class="form-control" >
			    		<i class="fa fa-thumb-tack fa-fw"></i><?php echo e($ubicacion->nombre); ?>

			    	</label>
					<input type="hidden" value="<?php echo e($ubicacion->latitud); ?>" id="lat">
					<input type="hidden" value="<?php echo e($ubicacion->longitud); ?>" id="lng">
					<input type="hidden" value="<?php echo e($ubicacion->nombre); ?>" id="name">
			      	<a href="#" class="input-group-addon" data-toggle="collapse" data-target="#collapse<?php echo e($ubicacion->id); ?>"><i class="fa fa-plus"></i></a>
			    </div>
			  </div>
			</form>
			
			<div id="collapse<?php echo e($ubicacion->id); ?>" class="collapse panel panel-default" style="padding:10px;">
				<i class='fa fa-edit fa-fw'></i><?php echo link_to_route("ubicaciones.edit",$title=" Actualizar ubicacion",$parameters = $ubicacion->id); ?> <br>
				<i class="fa fa-times fa-fw"></i><a href="#" onclick="confirmarEliminar('eliminar<?php echo e($ubicacion->id); ?>')"> Eliminar </a>
			</div>
		</div>
		<?php echo Form::open(['route'=>['ubicaciones.destroy',$ubicacion->id],'method'=>'DELETE']); ?>

				<?php echo Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$ubicacion->id]); ?>

			<?php echo Form::close(); ?>

		<br>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php echo e($ubicaciones->links()); ?>

		<script>
			var misUbicaciones = <?php echo json_encode($ubicaciones); ?>;
		</script>
	</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>