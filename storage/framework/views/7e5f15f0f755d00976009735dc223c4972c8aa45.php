<?php $__env->startSection('contenido'); ?>
	<div class="row">
		<div id="controles" style="margin-top: 3em; padding: 0 30px">
			 <div>
	   <!-- Nav tabs -->
	   <ul class="nav nav-tabs" role="tablist">
	     <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
	     <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
	     <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
	     <li role="presentation" class="pull-right"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
	   </ul>
	   <!-- Tab panes -->
	   <div class="tab-content">
	     <div role="tabpanel" class="tab-pane fade in active" id="home">
	     	<?php echo $__env->make('principal.maps', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	     </div>
	     <div role="tabpanel" class="tab-pane" id="profile">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa est nemo, voluptate culpa molestias esse. Nesciunt sint, nisi, non, fuga maxime ab iure enim sapiente quibusdam necessitatibus magni eum accusantium. ipsum dolor sit amet, consectetur adipisicing elit. Laborum, ex corrupti omnis sit. Hic architecto libero ipsum voluptas perspiciatis totam possimus velit atque officia, cumque corporis, delectus reiciendis iusto similique.</div>
	     <div role="tabpanel" class="tab-pane" id="messages">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque ipsum magnam eveniet maiores accusantium, fugiat quis. Illum quam enim veritatis, vitae sequi fugit dolor impedit consequatur optio maxime error fuga?</div>
	     <div role="tabpanel" class="tab-pane" id="settings">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis iure ab fugit optio rerum quos ullam molestiae deleniti voluptatibus commodi, provident in mollitia animi, delectus facere dignissimos praesentium nihil eveniet.</div>
	   </div>
	 </div>
	        
		</div>
    </div>

    <script>
    	var findDirecciones= <?php echo json_encode($ubicaciones); ?>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.Log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>