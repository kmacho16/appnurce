<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo e(config('app.name', 'Laravel')); ?></title>
	<?php echo Html::style('css/bootstrap.min.css'); ?>

    <?php echo Html::style('css/font-awesome.min.css'); ?>

    <?php echo Html::style('css/style.css'); ?>

    <?php echo Html::style('css/owl.carousel.min.css'); ?>

    <?php echo Html::style('css/owl.theme.default.min.css'); ?>



    <?php echo Html::script('js/scriptSearch.js'); ?>

     
</head>
<body>
	<div class="container-fluid">
		<?php echo $__env->yieldContent("contenido"); ?>
	</div>

    <?php echo Html::script('js/jquery.min.js'); ?>

	<?php echo Html::script('js/bootstrap.min.js'); ?>

    <?php echo Html::script('js/owl.carousel.min.js'); ?>

	<script>
    	$('.carousel').carousel({
		  interval: false
		});
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjtPdNSeeVGUgaaL8a7MN5yG4ZETeQeq4&libraries=places&callback=initMap"></script>
</body>
</html>