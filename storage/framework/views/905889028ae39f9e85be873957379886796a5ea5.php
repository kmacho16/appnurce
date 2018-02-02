<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo e(config('app.name', 'Laravel')); ?></title>
	<?php echo Html::style('css/bootstrap.min.css'); ?>

    <?php echo Html::style('css/font-awesome.min.css'); ?>

    <?php echo Html::style('css/style.css'); ?>

    <?php echo Html::script('js/jquery.min.js'); ?>

     
</head>
<body>
	<div class="container">
		<?php echo $__env->yieldContent("contenido"); ?>
	</div>
	<?php echo Html::script('js/bootstrap.min.js'); ?>

</body>
</html>