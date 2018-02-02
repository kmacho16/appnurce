<?php $__env->startSection('contenido-seg'); ?>

<div class="form-inline">
		<?php echo Form::model(Request::only(['search','type']),['url'=>'usuarios','method'=>'get']); ?>

			<div class="form-group">
				<input type="text" name="search" class="form-control" placeholder="Buscar...">
				<?php echo Form::select('type',$roles,null,['class'=>'form-control','placeholder'=>'Seleccione rol de su usuario']); ?>

				<?php echo Form::submit('Buscar',['class'=>'btn btn-info']); ?>

			</div>
		<?php echo Form::close(); ?>

</div>

		<hr>
	<table class=" table table-striped">
		<th>Rol</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Email</th>
		<th>Telefono</th>
		<th>Opciones</th>
		<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td>
				<?php if($usuario->id_rol == 1): ?>
					Administrador
				<?php elseif($usuario->id_rol == 2): ?>
					Prestador
				<?php else: ?>
					Visitante
				<?php endif; ?>
			</td>
			<td><?php echo e($usuario->name); ?></td>
			<td><?php echo e($usuario->last_name); ?></td>
			<td><?php echo e($usuario->email); ?></td>
			<td><?php echo e($usuario->telefono); ?></td>
			<td>
			<?php echo link_to_route('usuarios.edit'," Editar",$parameters = $usuario->id,$attributes=['class'=>'fa fa-gear']); ?>

			<button class="btn btn-danger" onclick="confirmarEliminar('eliminar<?php echo e($usuario->id); ?>')"><i class="fa fa-times"></i></button>

			<a href="<?php echo e(url('ubicacion',$usuario->id)); ?>" class="btn btn-success" ><i class="fa fa-map"></i></a>
			</td>	
			<?php echo Form::open(['route'=>['usuarios.destroy',$usuario->id],'method'=>'DELETE']); ?>

				<?php echo Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$usuario->id]); ?>

			<?php echo Form::close(); ?>

		</tr>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</table>

	<?php echo e($user->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>