<!DOCTYPE html>
<html lang="es">
<title>NurceApp</title>
<head>
	<meta charset="UTF-8">
	<title><?php echo e(config('app.name', 'Laravel')); ?></title>
	<?php echo Html::style('css/bootstrap.min.css'); ?>

    <?php echo Html::style('css/font-awesome.min.css'); ?>

    <?php echo Html::style('css/metisMenu.min.css'); ?>    
    <?php echo Html::style('css/sb-admin-2.css'); ?>

    <?php echo Html::style('css/jquery-ui.css'); ?>

    <?php echo Html::style('css/style2.css'); ?>

    <?php echo Html::style('css/fullcalendar.min.css'); ?>


    <?php echo Html::script('js/jquery.min.js'); ?>

    <?php echo Html::script('js/moment.min.js'); ?>

    <?php echo Html::script('js/fullcalendar.min.js'); ?>


    <?php $cantidad = app('App\historial_chat'); ?>

</head>
<body>
    <div id="wrapper">

        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" id="navmio" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
           <a class="navbar-bran color-blanco" href="<?php echo e(url('usuarios')); ?>"> <i class="fa fa-2x fa-heartbeat" aria-hidden="true"></i></a>


            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        <a href="<?php echo e(url('/logout')); ?>" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> 
                                Logout
                        </a>
                        <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Usuario<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo route('usuarios.create'); ?>"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="<?php echo route('usuarios.index'); ?>"><i class='fa fa-list-ol fa-fw'></i> Usuarios</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-globe fa-fw"></i> Mis ubicaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo route('ubicaciones.create'); ?>"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="<?php echo route('ubicaciones.index'); ?>"><i class='fa fa-map-marker fa-fw'></i> Ubicaciones</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo route('eventos.index'); ?>"><i class="fa fa-calendar fa-fw"></i> Calendario</a>
                            
                        </li>

                        <li>
                            <a href="<?php echo route('mensajes.index'); ?>"><i class="fa fa-inbox fa-fw"></i> Mensajes <span class="badge"> <?php echo e($cantidad->cantidadMensajes()[0]->total); ?></span>
                            
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

     </nav>

        <div id="page-wrapper">
            <?php echo $__env->yieldContent("contenido"); ?>
        </div>

    </div>
    

    
    <?php echo Html::script('js/bootstrap.min.js'); ?>

    <?php echo Html::script('js/metisMenu.min.js'); ?>

    <?php echo Html::script('js/jscolor.min.js'); ?>

    <?php echo Html::script('js/sb-admin-2.js'); ?>

    <?php echo Html::script('js/miScript.js'); ?>   
    <?php echo Html::script('js/gmaps.js'); ?>

    <?php echo Html::script('js/jquery-ui.js'); ?>



<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy/mm/dd',minDate: 0 }).val();
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy/mm/dd',minDate: 0 }).val();
    
    
  } );
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjtPdNSeeVGUgaaL8a7MN5yG4ZETeQeq4&callback=initMap"></script>
</body>
</html>