<?php $__env->startSection('contenido'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-reglog">
                <div class="panel-heading"><h4 class="text-uppercase text-center color-rosa">Re-establecer Contraseña</h4></div>
                <div class="panel-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-8 col-md-offset-2">Ingrese la direccion de Email que tiene registrada en el sistema para reestablecer su contraseña: </label>

                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-rosa btn-block">
                                    Enviar link para reestablecer Contraseña
                                </button>
                            </div>
                        </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            
                            <a class="btn btn-link" href="<?php echo e(route('login')); ?>">
                                Volver al Login
                            </a>
                            <a class="btn btn-link" href="<?php echo e(route('register')); ?>">
                                Aun no tienes cuenta?  
                            </a>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>