		<h4 class="color-rosa">Documentos</h4>
		<hr>
		<div class="row">
		{!! Form::open(['url'=>['filesUser',$usuario->id],'method'=>'post','files'=>true]) !!}
			@for ($i = 1; $i <=6 ; $i++)
				<div class="col-xs-6 col-md-2">
			    <a href="#" class="thumbnail" style="padding: 10px;height: 150px;" onclick="$('#miDocImg{{ $i }}').click()" >
			  	
			  	<?php $carga=""; $boton = 0; ?>

			    @foreach ($archivos as $archivo)
			    	@if ($archivo->id_campo == $usuario->id.''.$i)
			    		<?php $carga = "/uploads/".$archivo->ruta; $boton = 1; ?>
			    	@endif
			    @endforeach
			    @if ($carga =="")
			    	<?php $carga = "http://icons.iconarchive.com/icons/graphicloads/100-flat-2/256/add-icon.png"; ?>	
			    @endif
			    <img  id="mi_img{{ $i }}" src="{{ $carga }}" alt="..." class="img-responsive" style="height: 90%;">
			    </a>
			    @if ($boton == 1)
			    <a class="btn btn-danger btn-block" onclick="$('#borrarImg{{ $i }}').click()">Eliminar</a>
			    @endif

			    {!!Form::file("documento$i",array('id'=>"miDocImg$i",'style'=>'display:none'))!!}
			  </div>
			@endfor
		</div>
			<button class="btn btn-rosa center-block" style="margin-top: 10px">Enviar documentos</button>
		  	<hr>
		{!! Form::close() !!}
		@for ($i = 1; $i <=6 ; $i++)
			{!!Form::open(['url'=>['filesUserDestroy',$usuario->id.''.$i],'method'=>'DELETE'])!!}
				{!!Form::submit('Eliminar',['style'=>'display:none','id'=>'borrarImg'.$i])!!}
			{!!Form::close()!!}
		@endfor