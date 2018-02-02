<?php $__env->startSection('contenido'); ?>
<div class="row">
	<div id="controles" style="margin-top:2em;padding: 0 30px">
        <div class="col-md-10" style="height: 600px; border-radius: 20px 0 0 20px" id="map"></div>
		<input type="text" id="buscar" name="buscar" class="form-control" style="width: 50%; margin-top: 15px">
        <div class="col-md-2 pull-right" style="background-color: #fff; height: 600px;border-radius: 0 20px 20px 0;">

        	<a target="_blank" href="<?php echo e(url('profile')); ?>" class="btn btn-block btn-primary pull-bottom"><i class="fa fa-user" aria-hidden="true"></i> VER PERFIL</a target="_blank">
        	<hr>
			<h3 class="color-rosa text-uppercase text-center">Informacion</h3>
			<?php echo Form::model(Request::only(['lat','lng','rad']),['url'=>'/search','method'=>'get']); ?>

				
				<?php echo Form::hidden('lat',null,["id"=>"lat","value"=>"4.683940718364223"]); ?>

				<?php echo Form::hidden('lng',null,["id"=>"lng","value"=>"-74.09151578657224"]); ?>

				<div class="form-inline">
					<div class="form-group">
						<div class="input-group">
					      <div class="input-group-addon">Radio </div>
					      <?php echo Form::number('radio',1,["class"=>'form-control', "id"=>"radio","min"=>"1","max"=>"20"]); ?>

					      <div class="input-group-addon">km</div>
					    </div>
					</div>
				</div>
				<button class="btn btn-warning btn-block" id="btn_buscar">BUSCAR</button>
				<div class="text-center" style="padding: 1em;" >
					<a href="#" id="ver_todos" class="text-uppercase"><i class="fa fa-globe" aria-hidden="true"></i> Ver todos</a>
				</div>
			<?php echo Form::close(); ?>

			<div id="personal_box">

			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				  <div class="item active">
				  <?php 
				  	$cuenta =1;
				   ?>
					<?php $__currentLoopData = $ubicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div id="persona">
							<div class="col-md-12" style="margin-top: 15px">
								<div class="col-md-4" style="padding:0 ">
								
									<?php if(empty($personal->img_perfil)): ?>
										<img src="img/profile.ico" class="img-responsive">
									<?php else: ?>
										<img src="<?php echo e(url("uploads/".$personal->img_perfil)); ?>" class="img-responsive">
									<?php endif; ?>
								</div>
								<div class="col-md-8">
									
									<a href="#" id="nombre" style="font-size: 11px;"> <strong class="color-rosa text-uppercase text-center"><?php echo e($cuenta); ?>) <?php echo e($personal->name); ?></strong>
									<input type="hidden" name="person_nom" id="person_nom" value="<?php echo e($personal->name); ?>">
									<input type="hidden" name="person_lat" id="person_lat" value="<?php echo e($personal->latitud); ?>">
									<input type="hidden" name="person_lng" id="person_lng" value="<?php echo e($personal->longitud); ?>">						
									<input type="hidden" name="person_id" id="person_id" value="<?php echo e($personal->id_user); ?>">
									<input type="hidden" id="person_distancia" value="<?php echo e(substr($personal->distancia,0,3)); ?>">
									<?php if(empty($personal->img_perfil)): ?>
										<input type="hidden" id="person_img" value="img/profile.ico">
									<?php else: ?>
										<input type="hidden" id="person_img" value="<?php echo e(url("uploads/".$personal->img_perfil)); ?>">
									<?php endif; ?>

									</a>
									<?php if($loop->first): ?>
										<i class="fa fa-star" style="color: yellow;"></i>
									<?php endif; ?>
									<span class="color-rosa text-uppercase text-center" id="person_distancia"><?php echo e(substr($personal->distancia,0,3)); ?>Km</span>
									<br>
									
								</div>
							</div>
						</div>
						<?php if(($cuenta%4)==0 && !$loop->last): ?>
							</div><div class="item">
						<?php elseif($loop->last): ?>
							</div>	
						<?php endif; ?>
						<?php 
							$cuenta++;
						 ?>
		        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
				</div>

			  <!-- Controls -->
			    <!-- Indicators -->
			</div>
				<?php 
			    	$pages = round($cuenta/4,0, PHP_ROUND_HALF_UP);
			     ?>
			    <?php if($pages>1): ?>
			    	<ul class="pagination" style="margin:10px 10px;" >
			        <?php for($i = 1; $i <=$pages ; $i++): ?>
			        	<li data-target="#carousel-example-generic" data-slide-to="<?php echo e($i-1); ?>">
				        	<a href="#"><?php echo e($i); ?></a>
				        </li>
			        <?php endfor; ?>
			      </ul>
			      <a href="#carousel-example-generic" style="margin-top: 18px; " class="pull-left" data-slide="prev">
		            <i class="fa fa-chevron-left" aria-hidden="true"></i>
		          </a>
		        
		          <a href="#carousel-example-generic" style="margin-top: 18px; " class="pull-right" data-slide="next">
		            <i class="fa fa-chevron-right" aria-hidden="true"></i>
		          </a>
			    <?php endif; ?>
        	</div>
        	
        </div>
	</div>
</div>
<?php echo e(json_encode($ubicaciones)); ?>


<script>
	var findDirecciones= <?php echo json_encode($ubicaciones); ?>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>