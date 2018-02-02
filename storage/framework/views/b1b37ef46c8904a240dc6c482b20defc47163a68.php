<?php $__env->startSection('contenido'); ?>
    <div class="row">
        <div class="col-md-12 contenido">
            <?php echo $__env->yieldContent('contenido-seg'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>