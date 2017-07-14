@extends('home')
@section('contenido-seg')
	<div class="col-md-3">
	@if (empty($usuario->foto_perfil))
		<img src="{{ url('img/profile.ico') }}" alt="" class="img-responsive">
	@else

		<img src="/uploads/{{ $usuario->foto_perfil }}" alt="" class="img-responsive">
	@endif
	</div>
	<div class="col-md-offset-1 col-md-6">
	<h2>Información de usuario</h2>
		<table class="table table-hover">
			<tr>
				<th>Nombre:</th>
				<td>{{ $usuario->name }}</td>
			</tr>
			<tr>
				<th>Apellidos:</th>
				<td>{{ $usuario->last_name }}</td>
			</tr>
			<tr>
				<th>Telefono:</th>
				<td>{{ $usuario->telefono }}</td>
			</tr>
			<tr>
				<th>Correo:</th>
				<td>{{ $usuario->email }}</td>
			</tr>
			<tr>
				<th>Nombre:</th>
				<td>Nombre</td>
			</tr>
		</table>
	</div>

@endsection