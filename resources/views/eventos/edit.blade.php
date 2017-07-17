@extends('home')
@section('contenido-seg')

      {!! Form::model($evento,['route'=>['eventos.update',$evento->id],'method'=>'PUT']) !!}
        <div class="form-group">
            <div class="form-inline">
                <label for="">Titulo para el evento</label>
                {!! Form::text('nombre_evento',null,['class'=>'form-control','id'=>'mi_titulo']) !!}
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      
      {!! form::close() !!}


@endsection