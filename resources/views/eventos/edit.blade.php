@extends('home')
@section('contenido-seg')
@php
  $fecha_ini = explode(" ", $evento->fecha_inicio);
  $fecha_fin = explode(" ", $evento->fecha_fin);
@endphp

      {!! Form::model($evento,['route'=>['eventos.update',$evento->id],'method'=>'PUT']) !!}
        <div class="form-group">
            <div class="form-inline">
                <label for="">Titulo para el evento</label>
                {!! Form::text('nombre_evento',null,['class'=>'form-control','id'=>'mi_titulo']) !!}
                {!! form::hidden('color',null,['id'=>'mi_color']) !!}
                <button class="btn btn-info jscolor {valueElement:'mi_color',styleElement:'mi_titulo'}"><i class="fa fa-eyedropper"></i></button>
            </div>
            <hr>
            <div class="form-inline">
                <label for="">Inicio evento</label>
                {!! Form::text('f_ini',$fecha_ini[0] ,['class'=>'form-control','id'=>'datepicker']) !!}    
                <input class="form-control" type="time" value="{{ $fecha_ini[1] }}" name="h_ini"> (Formato 24 horas)<br>
                {{-- <input type="checkbox" name="all_day" value="1">Todo el dia  --}}
                {!! Form::checkbox('dia_completo') !!}Todo el día<br>
            </div>
            <hr>
            <div class="form-inline">
                <label for="">Fin evento</label>
                {!! Form::text('f_fin',$fecha_fin[0] ,['class'=>'form-control','id'=>'datepicker2']) !!}
                <input class="form-control" type="time" value="{{ $fecha_fin[1] }}" name="h_fin"> (Formato 24 horas)<br>
            </div>
        </div>
        <a type="button" class="btn btn-default" data-dismiss="modal" href="{{ route('eventos.index') }}"><i class="fa fa-arrow-left"></i> Volver</a>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a class="btn btn-danger" onclick="confirmarEliminar('eliminar{{ $evento->id }}')"><i class="fa fa-times"></i>ELIMINAR</a>
      
      {!! form::close() !!}

      {!!Form::open(['route'=>['eventos.destroy',$evento->id],'method'=>'DELETE'])!!}
        {!!Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$evento->id])!!}
      {!!Form::close()!!}


@endsection