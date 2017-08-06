@extends('home')
@section('contenido-seg')
@php
  $fecha_ini = explode(" ", $evento->fecha_inicio);
  $fecha_fin = explode(" ", $evento->fecha_fin);
@endphp
<div class="col-md-12">
  <a type="button" class="btn btn-default pull-left" data-dismiss="modal" href="{{ route('eventos.index') }}"><i class="fa fa-arrow-left"></i> Volver</a><h4 class="text-center text-uppercase color-rosa">Editar evento</h4>
  <hr>
</div>
  <div class="col-md-4">

      {!! Form::model($evento,['route'=>['eventos.update',$evento->id],'method'=>'PUT']) !!}
        <div class="form-group">
        @if ($evento->to_id_user != Auth::user()->id)
           <h4>Tienes una cita con <a href="{{ route('usuarios.show',$evento->to_id_user) }}">Juan Camacho</a> </h4>
                {!! form::hidden('to_id_user',null) !!}
            <hr>
        @endif
               
            <label for="">Titulo para el evento</label>
            <div class="form-inline">
                {!! Form::text('nombre_evento',null,['class'=>'form-control','id'=>'mi_titulo']) !!}
                {!! form::hidden('color',null,['id'=>'mi_color']) !!}
                <button class="btn btn-default jscolor {valueElement:'mi_color',styleElement:'mi_titulo'}"><i class="fa fa-paint-brush"></i></button>
            </div>
            <hr>
            <label for="">Inicio evento</label>
            <div class="form-inline">
                {!! Form::text('f_ini',$fecha_ini[0] ,['class'=>'form-control','id'=>'datepicker']) !!}    
                <input class="form-control" type="time" value="{{ $fecha_ini[1] }}" name="h_ini"><br>
                {{-- <input type="checkbox" name="all_day" value="1">Todo el dia  --}}
                {!! Form::checkbox('dia_completo') !!}Estaras en este evento todo el día<br>
            </div>
            <hr>
                <label for="">Fin evento</label>
            <div class="form-inline">
                {!! Form::text('f_fin',$fecha_fin[0] ,['class'=>'form-control','id'=>'datepicker2']) !!}
                <input class="form-control" type="time" value="{{ $fecha_fin[1] }}" name="h_fin"><br>
            </div>
        </div>
        
      </div>
      <div class="col-md-8">
        <div class="form-group">
        <label for="descripcion">Descripcion Eventos</label>
          {!! Form::textarea('descripcion',null,['class'=>'form-control',"placeholder"=>"Ejemplo: El evento es en la direccion XXX con el señor YYYY"]) !!}
        </div>
        <div class="pull-left">
          <button class="btn"></button>
        </div>
        <div class="pull-right">
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
          <a class="btn btn-danger" onclick="confirmarEliminar('eliminar{{ $evento->id }}')"><i class="fa fa-times"></i> ELIMINAR</a>
        </div>
      </div>
        
      {!! form::close() !!}

      {!!Form::open(['route'=>['eventos.destroy',$evento->id],'method'=>'DELETE'])!!}
        {!!Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$evento->id])!!}
      {!!Form::close()!!}


@endsection