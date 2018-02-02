		<h4 class="color-rosa">Documentos</h4>
		<hr>
		<div class="row">
		<?php echo Form::open(['url'=>['filesUser',$usuario->id],'method'=>'post','files'=>true]); ?>

			<?php for($i = 1; $i <=6 ; $i++): ?>
				<div class="col-xs-6 col-md-2">
			    <a href="#" class="thumbnail" style="padding: 10px;height: 150px;" onclick="$('#miDocImg<?php echo e($i); ?>').click()" >
			  	
			  	<?php $carga=""; $boton = 0; ?>

			    <?php $__currentLoopData = $archivos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $archivo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    	<?php if($archivo->id_campo == $usuario->id.''.$i): ?>
			    		<?php $carga = "/uploads/".$archivo->ruta; $boton = 1; ?>
			    	<?php endif; ?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    <?php if($carga ==""): ?>
			    	<?php $carga = "http://icons.iconarchive.com/icons/graphicloads/100-flat-2/256/add-icon.png"; ?>	
			    <?php endif; ?>
			    <img  id="mi_img<?php echo e($i); ?>" src="<?php echo e($carga); ?>" alt="..." class="img-responsive" style="height: 90%;">
			    </a>
			    <?php if($boton == 1): ?>
			    <a class="btn btn-danger btn-block" onclick="$('#borrarImg<?php echo e($i); ?>').click()">Eliminar</a>
			    <?php endif; ?>

			    <?php echo Form::file("documento$i",array('id'=>"miDocImg$i",'style'=>'display:none')); ?>

			  </div>
			<?php endfor; ?>
		</div>
			<button class="btn btn-rosa center-block" style="margin-top: 10px">Enviar documentos</button>
		  	<hr>
		<?php echo Form::close(); ?>

		<?php for($i = 1; $i <=6 ; $i++): ?>
			<?php echo Form::open(['url'=>['filesUserDestroy',$usuario->id.''.$i],'method'=>'DELETE']); ?>

				<?php echo Form::submit('Eliminar',['style'=>'display:none','id'=>'borrarImg'.$i]); ?>

			<?php echo Form::close(); ?>

		<?php endfor; ?>