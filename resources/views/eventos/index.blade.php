@extends('home')
@section('contenido-seg')
<div class="col-md-3">
    <button class="btn btn-warning" data-toggle="modal" data-target="#modal_evento"><i class="fa fa-plus fa-fw"></i>Agregar Entrada</button>
</div>
<div class="col-md-7 col-md-offset-1"> 
    {!! $calendario->calendar() !!}
    {!! $calendario->script() !!}
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
      {!! Form::open(['route'=>['eventos.store'],'method'=>'POST']) !!}
        <div class="form-group">
            <div class="form-inline">
                <label for="">Titulo para el evento</label>
                <input type="text" class="form-control" name="nombre_evento" id="mi_titulo">
                <input type="hidden" name="mi_color" id="mi_color" value="#ebbfbf">
                <button class="btn btn-info jscolor {valueElement:'mi_color',styleElement:'mi_titulo'}"><i class="fa fa-eyedropper"></i></button>
            </div>
            <hr>
            <div class="form-inline">
                <label for="">Inicio evento</label>
                <input class="form-control" type="text" id="datepicker" name="f_ini">
                <input class="form-control" type="time" value="12:03" name="h_ini"> (Formato 24 horas)<br>
                <input type="checkbox" name="all_day" value="1">Todo el dia <br>
            </div>
            <hr>
            <div class="form-inline">
                <label for="">Fin evento</label>
                <input class="form-control" type="text" id="datepicker2" name="f_fin">
                <input class="form-control" type="time" value="12:03" name="h_fin"> (Formato 24 horas)<br>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
      {!! form::close() !!}
    </div>
  </div>
</div>


@endsection