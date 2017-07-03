@extends('home')
@section('contenido-seg')

<div class="form-inline">
		{!! Form::model(Request::only(['search','type']),['url'=>'usuarios','method'=>'get']) !!}
			<div class="form-group">
				<input type="text" name="search" class="form-control" placeholder="Buscar...">
				{!!Form::select('type',$roles,null,['class'=>'form-control','placeholder'=>'Seleccione rol de su usuario'])!!}
				{!! Form::submit('Buscar',['class'=>'btn btn-info']) !!}
			</div>
		{!! Form::close() !!}
</div>

		<hr>
	<table class=" table table-striped">
		<th>Rol</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Email</th>
		<th>Telefono</th>
		<th>Opciones</th>
		@foreach($user as $usuario)
		<tr>
			<td>
				@if ($usuario->id_rol == 1)
					Administrador
				@elseif($usuario->id_rol == 2)
					Prestador
				@else
					Visitante
				@endif
			</td>
			<td>{{ $usuario->name }}</td>
			<td>{{ $usuario->last_name }}</td>
			<td>{{ $usuario->email }}</td>
			<td>{{ $usuario->telefono }}</td>
			<td>
			{!! link_to_route('usuarios.edit'," Editar",$parameters = $usuario->id,$attributes=['class'=>'fa fa-gear']) !!}
			<button class="btn btn-danger" onclick="confirmarEliminar('eliminar{{ $usuario->id }}')"><i class="fa fa-times"></i></button>

			<a href="{{ url('ubicacion',$usuario->id) }}" class="btn btn-success" ><i class="fa fa-map"></i></a>
			</td>	
			{!!Form::open(['route'=>['usuarios.destroy',$usuario->id],'method'=>'DELETE'])!!}
				{!!Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$usuario->id])!!}
			{!!Form::close()!!}
		</tr>

		@endforeach
	</table>

	{{$user->links()}}
@endsection