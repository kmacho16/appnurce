<?php $__env->startSection('contenido-seg'); ?>

<?php if($errors->any()): ?>
	<div class="alert alert-danger">
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php echo e($error); ?>

			<br>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
<?php endif; ?>



<h4 class="color-rosa">Formulario registro</h4>
<hr>
	<?php echo Form::open(['route'=>['usuarios.store'],'method'=>'Post','files'=>true]); ?>

	<div class="group-control">
		<?php echo $__env->make('users.forms.inputForm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
	<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>