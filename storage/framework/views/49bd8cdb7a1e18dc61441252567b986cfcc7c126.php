<?php $__env->startSection('contenido-seg'); ?>

<h3>Ubicaciones</h3>
<?php echo e($ubicaciones); ?>

<button id="verMapa">ver Mapa</button>
<input type="text" value="<?php echo e($ubicaciones[0]->latitud); ?>" id="lat">
<input type="text" value="<?php echo e($ubicaciones[0]->longitud); ?>" id="lng">
<div class="map" id="map" style="border:2px solid red; height: 0px;width: 90%">
	
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>