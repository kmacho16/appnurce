<?php $__env->startSection('contenido'); ?>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default panel-reglog">
                <div class="panel-heading"><h4 class="text-uppercase text-center color-rosa">Bienvenido a nurceApp</h4></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Email" id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">

                            <div class="col-md-8 col-md-offset-2">
                                <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                        <div class="col-md-8 col-md-offset-2">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Recuerdame
                                </label>
                            </div>
                            <br>
                                <button type="submit" class="btn btn-rosa btn-block">
                                    Login
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    Olvidaste tu password
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.Log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>