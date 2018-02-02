<?php $__env->startSection('contenido'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-reglog">
                <div class="panel-heading"><h4 class="text-uppercase text-center color-rosa">Registrar</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Ingresa tu Nombre" id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Ingresa tu email" id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Ingresa tu contraseña" id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Confirma tu contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                            <div class="checkbox text-center">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> He leido y acepto los <a href="#">Terminos y condiciones</a>
                                    </label>
                                    
                                </div><br>
                                <button type="submit" class="btn btn-rosa btn-block">
                                    Registrar
                                </button>

                                
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    Olvidaste tu password
                                </a>
                                <a class="btn btn-link" href="<?php echo e(route('login')); ?>">
                                    Ya tienes cuenta? 
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