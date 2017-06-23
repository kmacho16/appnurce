{!!Form::token()!!}

		<div class="col-xs-4 col-md-4">
			{!!Form::label('foto_perfil', 'Foto perfil: ')!!}
            <a href="#" class="thumbnail" onclick="$('#miImagenInput').click()">
            @if(!@isset($usuario))
            	<img class="img-responsive"  id="mi_img" src="{{ url('/img/profile.ico') }}">
            @elseif($usuario->foto_perfil=='' || $usuario->foto_perfil==null)
	            <img class="img-responsive"  id="mi_img" src="{{ url('/img/profile.ico') }}">
            @else
            	<img class="img-responsive"  id="mi_img" src="/uploads/{{ $usuario->foto_perfil }}">
            @endif
          </a>
        </div>

		<div class="col-md-8">
		<br>
		{!!Form::label('name', 'Nombre: ')!!}
		{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese su nombre aqui'])!!}

		{!!Form::label('last_name', 'Apellido: ')!!}
		{!!Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Ingrese su apellido aqui'])!!}
		
		{!!Form::label('telefono', 'Telefono: ')!!}
		{!!Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Ingrese su telefono aqui'])!!}
		{!!Form::file('foto_perfil',array('id'=>'miImagenInput','style'=>'display:none'))!!}
		{{-- {!!Form::file('image',array('id'=>'miImagenInput','style'=>'display:none'))!!}
		 --}}<hr>
		{!!Form::label('email', 'Email: ')!!}
		{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingrese su email aqui'])!!}

		{!!Form::label('password', 'Contraseña: ')!!}
		{!!Form::password('password',['class'=>'form-control','placeholder'=>'Ingrese su contraseña aqui'])!!}	


		 </div>
		
		
		
		<div class="col-md-12">
		
		<br>
      {!!Form::submit('Guardar',['class'=>'btn btn-rosa pull-right'])!!}
		</div>
		