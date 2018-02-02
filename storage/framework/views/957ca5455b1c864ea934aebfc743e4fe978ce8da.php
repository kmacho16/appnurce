<?php $__env->startSection('contenido-seg'); ?>
<div class="col-md-2">
    <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#modal_evento"><i class="fa fa-plus fa-fw"></i>Agregar Entrada</button>
</div>
<div class="col-md-8 col-md-offset-1"> 
    <?php echo $calendario->calendar(); ?>

    <?php echo $calendario->script(); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="modal_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center text-uppercase color-rosa" id="myModalLabel">Agregar evento al calendario</h4>
      </div>
      <div class="modal-body">
      <div class="row">
      <div class="col-md-7">
      <?php echo Form::open(['route'=>['eventos.store'],'method'=>'POST']); ?>

        <div class="form-group">
                <label for="">Titulo para el evento</label>
            <div class="form-inline">
                <input type="text" class="form-control" name="nombre_evento" id="mi_titulo">
                <input type="hidden" name="mi_color" id="mi_color" value="#ebbfbf">
                <button class="btn btn-info jscolor {valueElement:'mi_color',styleElement:'mi_titulo'}"><i class="fa fa-eyedropper"></i></button>
            </div>
            <hr>
                <label for="">Inicio evento</label> <?php echo Form::checkbox('dia_completo'); ?> Estaras en este evento todo el día<br>
            <div class="form-inline">
                <input class="form-control" type="text" id="datepicker" name="f_ini">
                <input class="form-control" type="time" value="16:03" name="h_ini"><br>
            </div>
                <label for="">Fin evento</label>
            <div class="form-inline">
                <input class="form-control" type="text" id="datepicker2" name="f_fin">
                <input class="form-control" type="time" value="16:03" name="h_fin"><br>
            </div>
            <br>
            <div class="form-group">
        </div>
        </div>
        </div>
        <div class="col-md-5">
          <label for="descripcion">Descripcion Eventos</label>
              <textarea name="descripcion" cols="30" rows="10" class="form-control" placeholder="Ejemplo: El evento es en la direccion XXX con el señor YYYY" style="resize: vertical;"></textarea>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>