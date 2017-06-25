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
			<td><button class="btn btn-danger" onclick="confirmarEliminar('eliminar{{ $usuario->id }}')">Eliminar</button> 
			{!! link_to_route('usuarios.edit',$title="Editar",$parameters = $usuario->id,$attributes=['class'=>'btn btn-warning']) !!}
			</td>	
			{!!Form::open(['route'=>['usuarios.destroy',$usuario->id],'method'=>'DELETE'])!!}
				{!!Form::submit('Eliminar',['style'=>'display:none','id'=>'eliminar'.$usuario->id])!!}
			{!!Form::close()!!}
		</tr>

		@endforeach
	</table>

	{{$user->links()}}
@endsection