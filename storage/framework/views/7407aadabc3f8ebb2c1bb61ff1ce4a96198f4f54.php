<?php $__env->startSection('contenido-seg'); ?>
<div  class="col-md-9" >
	<div id="map" style="height: 500px; border:0px solid red;border-radius: 15px;">
	</div>
	
</div>
<div class="col-md-3">
	<div class="form-group" id="form_ubicacion">
		<?php echo $__env->make('ubicaciones.forms.form_edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<hr>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>