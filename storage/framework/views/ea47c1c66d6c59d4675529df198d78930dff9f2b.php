<?php $__env->startSection('contenido-seg'); ?>

<div class="col-md-3" style="border-right: 2px solid #dadada; height: 550px; margin-left: 0px;" id="chat-panel">
    <section style="height: 500px;overflow: auto;">
        <div class="text-center text-uppercase color-rosa"><h4>Mensajes</h4></div>
            <?php $__currentLoopData = $mensajes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mensaje): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="#" class="chat-person 
            <?php if(!$mensaje->leido && $mensaje->to_id_user == Auth::user()->id ): ?>
                sin_leer
            <?php endif; ?>

            " id="<?php echo e($mensaje->id_chat); ?>">
            <?php echo Form::token(); ?>

            <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" id="mi_id">
            <div class="col-md-12" style="margin-bottom: 20px;">
                <div class="col-md-4" style="padding:0 ">
                <?php if($mensaje->id_user == Auth::user()->id ): ?>
                    <?php if(empty($mensaje->to_img)): ?>
                        <img src="img/profile.ico" class="img-responsive img-circle">
                    <?php else: ?>
                        <img src="<?php echo e(url("uploads/".$mensaje->to_img)); ?>" class="img-responsive img-circle">
                    <?php endif; ?>
                <?php else: ?>
                    <?php if(empty($mensaje->from_img)): ?>
                        <img src="img/profile.ico" class="img-responsive img-circle">
                    <?php else: ?>
                        <img src="<?php echo e(url("uploads/".$mensaje->from_img)); ?>" class="img-responsive img-circle">
                    <?php endif; ?>
                <?php endif; ?>
                </div>
                
                <div class="col-md-8">
                    <span id="span_nombre">
                        <?php if($mensaje->id_user == Auth::user()->id ): ?>
                            <?php echo e($mensaje->to_nombre); ?>

                        <?php else: ?>
                            <?php echo e($mensaje->from_nombre); ?>

                        <?php endif; ?>
                    </span>
                    <br>
                    <span style="font-size: 11px">
                        <?php if($mensaje->id_user == Auth::user()->id ): ?>
                            Tú: 
                        <?php endif; ?>
                        <?php echo substr($mensaje->mensaje, 0,20); ?>...
                    </span>
                </div>
            </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
    <section>
        
    </section>
</div>

<div class="col-md-9">
 <button class="btn btn-info btn-sm btn-prog-msj" data-toggle="modal" data-target="#modal_evento"><i class="fa fa-clock-o" ></i> Programar cita</button>
 <button class="btn btn-warning btn-sm btn-prog-msj" data-toggle="modal" data-target="#modal_calendario"><i class="fa fa-calendar" ></i> Mi calendario</button>
    <h4 class="text-center color-rosa text-uppercase" id="nom_chat">
        NOMBRE DEL USUARIO
     </h4>
    <div id="respuesta-chat" style="height: 400px;overflow: auto;">

        <div class="col-md-12">
            <div class="pull-left">
                <div class="col-md-2">
                    <img src="img/profile.ico" alt="" class="img-responsive" width="70px" alt="WANG">
                </div>
                <div class="col-md-10">
                    <div type="button" class="alert alert-success">
                        <p data-toggle="tooltip" data-placement="right" title="2017-12-12 05:20">
                            Los mensajes de tus usuarios seran de color verde y apareceran en el lado Izquierdo de la pantalla....
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="">
                    <div class="col-md-8 col-md-offset-1">
                    <div class="alert alert-warning">
                        <p  data-toggle="tooltip" data-placement="left" title="2017-12-12 05:20">
                        Tus mensajes apareceran en el lado Derecho de la pantalla y seran de color amarillo
                        </p>
                    </div>
                     </div>
                    <div class="col-md-2">
                        <img src="img/profile.ico" alt="" class="img-responsive" width="70px" alt="Tu">
                    </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="pull-left">
                <div class="col-md-2">
                    <img src="img/profile.ico" alt="" class="img-responsive" width="70px" alt="WANG">
                </div>
                <div class="col-md-10">
                    <div type="button" class="alert alert-success">
                        <p data-toggle="tooltip" data-placement="right" title="2017-12-12 05:20">
                            La unica forma de que los mensajes aparezcan como <strong>leido</strong>, es si los respondes
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="form-group" id="chat_control">

        <div class="col-md-10">
          <textarea class="form-control" cols="40" rows="1" style="resize: vertical;" disabled="true"></textarea>
        </div>
        <div class="col-md-2">
            <button class="btn btn-rosa" disabled="true"><i class="fa fa-send"></i> Enviar</button>
        </div>
        <input type="hidden" value="">
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center text-uppercase color-rosa" id="myModalLabel">Sincronizar evento con el usuario</h4>
      </div>
      <div class="modal-body">

      <?php echo Form::open(['route'=>['eventos.store'],'method'=>'POST']); ?>

      <div class="row">
      <div class="col-md-4 text-center" >
        <span class="text-uppercase color-rosa" id="nombre_modal" style="font-size: 12px;">Juan camilo camacho</span>
        <img id="imagen_modal" src="<?php echo e(url('img/profile.ico')); ?>" alt="" class="img-responsive img-circle">
        <input type="hidden" id="modal_id" name="user_id">
      </div>
      <div class="col-md-8">
        <div class="form-group">
                <label for="">Titulo para el evento</label>
            <div class="form-inline">
                <input type="text" class="form-control" name="nombre_evento" id="mi_titulo">
                <input type="hidden" name="mi_color" id="mi_color" value="#ebbfbf">
                <button class="btn btn-info jscolor {valueElement:'mi_color',styleElement:'mi_titulo'}"><i class="fa fa-eyedropper"></i></button>
            </div>
            </div>
                <label for="">Inicio evento</label> 
                <?php echo Form::checkbox('dia_completo'); ?> Estaras en este evento todo el día<br>
            <div class="form-inline">
                <input class="form-control" type="text" id="datepicker" name="f_ini">
                <input class="form-control" type="time" value="12:03" name="h_ini"> (24H)<br>
            </div>
                <label for="">Fin evento</label>
            <div class="form-inline">
                <input class="form-control" type="text" id="datepicker2" name="f_fin">
                <input class="form-control" type="time" value="12:03" name="h_fin"> (24H)<br>
            </div>
            <br>
            
        </div>
        <div class="col-md-12">
            <div class="form-group">
            <label for="descripcion">Descripcion Eventos</label>
              <textarea name="descripcion" id="" cols="30" rows="10" class="form-control" placeholder="Ejemplo: El evento es en la direccion XXX con el señor YYYY"></textarea>
            </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      <?php echo form::close(); ?>

    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="modal_calendario" tabindex="-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center text-uppercase color-rosa" id="myModalLabel">Mi calendario de eventos</h4>
      </div>
      <div class="modal-body">
            <?php echo $calendario->calendar(); ?>

            <?php echo $calendario->script(); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>