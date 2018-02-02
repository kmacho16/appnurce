<?php echo Form::token(); ?>


		<div class="col-xs-4 col-md-4">
			<?php echo Form::label('foto_perfil', 'Foto perfil: '); ?>

            <a href="#" class="thumbnail" onclick="$('#miImagenInput').click()">
            <?php if(!@isset($usuario)): ?>
            	<img class="img-responsive"  id="mi_img" src="<?php echo e(url('/img/profile.ico')); ?>">
            <?php elseif($usuario->foto_perfil=='' || $usuario->foto_perfil==null): ?>
	            <img class="img-responsive"  id="mi_img" src="<?php echo e(url('/img/profile.ico')); ?>">
            <?php else: ?>
            	<img class="img-responsive"  id="mi_img" src="/uploads/<?php echo e($usuario->foto_perfil); ?>">
            <?php endif; ?>
          </a>
        </div>

		<div class="col-md-8">
		<br>
		<?php echo Form::label('name', 'Nombre: '); ?>

		<?php echo Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese su nombre aqui']); ?>


		<?php echo Form::label('last_name', 'Apellido: '); ?>

		<?php echo Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Ingrese su apellido aqui']); ?>

		
		<?php echo Form::label('telefono', 'Telefono: '); ?>

		<?php echo Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Ingrese su telefono aqui']); ?>

		
		<?php echo Form::label('id_rol', 'Seleccione rol de usuario: '); ?>

		<?php echo Form::select('id_rol',$roles,null,['class'=>'form-control','placeholder'=>'Seleccione rol de su usuario']); ?>


		<?php echo Form::file('foto_perfil',array('id'=>'miImagenInput','style'=>'display:none')); ?>

		

		<hr>
		<?php echo Form::label('email', 'Email: '); ?>

		<?php echo Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingrese su email aqui']); ?>


		<?php echo Form::label('password', 'Contraseña: '); ?>

		<?php echo Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese su contraseña aqui']); ?>	


		 </div>
		
		
		
		<div class="col-md-12">
		
		<br>
      <?php echo Form::submit('Guardar',['class'=>'btn btn-rosa pull-right']); ?>

		</div>
		