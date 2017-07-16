@extends('home')
@section('contenido-seg')
<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
    <li role="presentation" ><a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">Documentos</a></li>
    <li role="presentation"><a href="#comentarios" aria-controls="comentarios" role="tab" data-toggle="tab">Comentarios</a></li>

    <li role="presentation"><a href="#mensajes" aria-controls="mensajes" role="tab" data-toggle="tab">Mensajes @if ($cantidad[0]->total>0)
        <span class="badge">{!! $cantidad[0]->total !!}</span>
    @endif</a></li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profile">

    	<div class="col-md-4" style="margin-top: 1em;"> 
    	@if (empty($usuario->foto_perfil))
    		<img src="{{ url('img/profile.ico') }}" alt="" class="img-responsive">
    	@else

    		<img src="/uploads/{{ $usuario->foto_perfil }}" alt="" class="img-responsive">
    	@endif
    	</div>
    	<div class="col-md-8">
    		<h2 class="color-rosa text-uppercase text-center">Información de usuario</h2>
    			<table class="table table-hover">
    				<tr>
    					<th>Nombre:</th>
    					<td>{{ $usuario->name }}</td>
    				</tr>
    				<tr>
    					<th>Apellidos:</th>
    					<td>{{ $usuario->last_name }}</td>
    				</tr>
    				{{-- <tr>
    					<th>Telefono:</th>
    					<td>{{ $usuario->telefono }}</td>
    				</tr> --}}
    				<tr>
    					<th>Correo:</th>
    					<td>{{ $usuario->email }}</td>
    				</tr>
    				<tr>
    					<th>Contactar:</th>
    					<td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">Solicitar informacion</button></td>
    				</tr>
    			</table>
    	</div>
        

    </div>
    <div role="tabpanel" class="tab-pane fade" id="documentos">
        <div class="row" style="padding-top: 1em;">
            @foreach ($documentos as $documento)
                <div class="col-xs-6 col-md-3">
                    <a href="/uploads/{{ $documento->ruta }}" target="_blank" class="thumbnail">
                       <img src="/uploads/{{ $documento->ruta }}" alt="" class="img-responsive">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="comentarios">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto in sit, adipisci cum unde dignissimos animi modi quaerat provident, numquam blanditiis quos maiores mollitia ut, neque inventore. Culpa, nisi maxime.
    </div>
    <div role="tabpanel" class="tab-pane fade" id="mensajes">
    <table class="table table-hover">
    <th>Nombre</th><th>Mensaje</th><th>Estado</th><th>Opciones</th>
    @foreach ($mensajes as $mensaje)
        <tr>
        <td>
            @if ($mensaje->id_user == Auth::user()->id )
                YO
            @else
                {{ $mensaje->name }}
            @endif
        </td>
        <td>
            {!!$mensaje->mensaje  !!}
        </td>
        <td>
        @if (($mensaje->id_user == Auth::user()->id) )
            <i class="fa fa-check fa-2x"></i>
        @endif
        </td>
        <td>
            <a href="#"  data-toggle="modal" data-target="#{{ $mensaje->id_chat}}">Responder</a> 
            <a href="#">Eliminar</a></td>
        </tr>
    @endforeach
        
    </table>
        
    </div>
  </div>

</div>
	

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-uppercase text-center color-rosa" id="myModalLabel">Informacion de contacto</h4>
      </div>
    {!! Form::open(['route'=>['mensajes.store'],'method'=>'Post']) !!}
      <div class="modal-body">
        Por favor indicanos para que fecha desear realizar una cotizacion, y una pequeña descripcion de lo que necesitas, de esta forma podremos responderte de una forma mas formal y personalizada, Prometemos no tardar mucho.
        <hr>
        <div class="form-group ">
        <input type="text" name="id_user" value="{{ $usuario->id }}">
            <label for="">Fecha </label>
            <input type="text" value="07/12/17" class="form-control" id="datepicker" name="fecha"><br>
            <label for="">Direccion </label>
            <input type="text" value="" class="form-control" name="direccion"><br>           
            <label for="">Informacion </label>
            <textarea name="comentario" id="" cols="30" rows="10" class="form-control" placeholder="aqui pudes contarnos mas sobre lo que necesitas"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@foreach ($mensajes as $mensaje)
    <div class="modal fade" id="{{ $mensaje->id_chat }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-uppercase text-center color-rosa" id="myModalLabel">Informacion de contacto</h4>
          </div>
        {!! Form::open(['route'=>['mensajes.store'],'method'=>'Post']) !!}
          <div class="modal-body">
            {!! $mensaje->mensaje !!}
            <hr>
            <div class="form-group ">
                <label for="">Informacion </label>                
                <input type="text" name="id_user" value="{{ $mensaje->id_user }}">
                <input type="text" name="id_chat" value="{{ $mensaje->id }}">
                <textarea name="comentario" id="" cols="30" rows="10" class="form-control" placeholder="aqui pudes contarnos mas sobre lo que necesitas"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
@endforeach


@endsection