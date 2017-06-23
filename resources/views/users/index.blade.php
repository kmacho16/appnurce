@extends('home')
@section('contenido-seg')

<div class="form-inline">
		{!! Form::model(Request::only(['search','type']),['url'=>'usuarios','method'=>'get']) !!}
			<div class="form-group">
				<input type="text" name="search" class="form-control" placeholder="Buscar...">
				{{-- {!!Form::select('type',$roles,null,['class'=>'form-control','placeholder'=>'Seleccione rol de su usuario'])!!} --}}
				{!! Form::submit('Buscar',['class'=>'btn btn-info']) !!}
			</div>
		{!! Form::close() !!}
</div>

		<hr>
	<table class=" table table-striped">
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Email</th>
		<th>Telefono</th>
		<th>Opciones</th>
		@foreach($user as $usuario)
		<tr>
			<td>{{ $usuario->name }}</td>
			<td>{{ $usuario->last_name }}</td>
			<td>{{ $usuario->email }}</td>
			<td>{{ $usuario->telefono }}</td>
			<td><button class="btn btn-danger">Eliminar</button> 
			{!! link_to_route('user.edit',$title="Editar",$parameters = $usuario->id,$attributes=['class'=>'btn btn-warning']) !!}
			</td>	

		</tr>
		@endforeach
	</table>
@endsection