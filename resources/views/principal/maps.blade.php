        <div class="col-md-10" style="height: 600px; border-radius: 20px 0 0 20px" id="map">
        </div>
		<input type="text" id="buscar" name="buscar" class="form-control" style="width: 50%; margin-top: 15px">
        <div class="col-md-2 pull-right" style="background-color: #fff; height: 600px;border-radius: 0 20px 20px 0;">
				<h3 class="color-rosa text-uppercase text-center">Informacion</h3>
				{!! Form::model(Request::only(['lat','lng','rad']),['url'=>'/search','method'=>'get']) !!}{{-- 
				<input type="text" placeholder="Buscar..." class="form-control"><br> --}}
				{{-- {!! Form::text('lat',null,["class"=>'form-control', "id"=>"lat"]) !!}
				{!! Form::text('lng',null,["class"=>'form-control', "id"=>"lng"]) !!} --}}
				{!! Form::hidden('lat',null,["id"=>"lat"]) !!}
				{!! Form::hidden('lng',null,["id"=>"lng"]) !!}
				<div class="form-inline">
					<div class="form-group">
						<div class="input-group">
					      <div class="input-group-addon">Radio </div>
					      {!! Form::number('radio',1,["class"=>'form-control', "id"=>"radio","min"=>"1","max"=>"20"]) !!}
					      <div class="input-group-addon">km</div>
					    </div>
					</div>
				</div>
				
				<button class="btn btn-warning btn-block" id="btn_buscar">BUSCAR</button>
				<div class="text-center" style="padding: 1em;" >
					<a href="#" id="ver_todos" class="text-uppercase"><i class="fa fa-globe" aria-hidden="true"></i> Ver todos</a>
				</div>
				{!! Form::close() !!}

			<div id="personal_box">

			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			  <div class="item active">
			  @php
			  	$cuenta =1;
			  @endphp
				@foreach ($ubicaciones as $personal)
					<div id="persona">
						<div class="col-md-12" style="margin-top: 15px">
							<div class="col-md-4" style="padding:0 ">
							
								@if (empty($personal->img_perfil))
									<img src="img/profile.ico" class="img-responsive">
								@else
									<img src="{{ url("uploads/".$personal->img_perfil) }}" class="img-responsive">
								@endif
							</div>
							<div class="col-md-8">
								
								<a href="#" id="nombre" style="font-size: 11px;"> <strong class="color-rosa text-uppercase text-center">{{ $cuenta }}) {{ $personal->name }}</strong>
								<input type="hidden" name="person_nom" id="person_nom" value="{{ $personal->name }}">
								<input type="hidden" name="person_lat" id="person_lat" value="{{ $personal->latitud }}">
								<input type="hidden" name="person_lng" id="person_lng" value="{{ $personal->longitud }}">						
								<input type="hidden" name="person_id" id="person_id" value="{{ $personal->id_user }}">
								<input type="hidden" id="person_distancia" value="{{ substr($personal->distancia,0,3) }}">
								@if (empty($personal->img_perfil))
									<input type="hidden" id="person_img" value="img/profile.ico">
								@else
									<input type="hidden" id="person_img" value="{{ url("uploads/".$personal->img_perfil) }}">
								@endif

								</a>
								@if ($loop->first)
									<i class="fa fa-star" style="color: yellow;"></i>
								@endif
								<span class="color-rosa text-uppercase text-center" id="person_distancia">{{ substr($personal->distancia,0,3) }}Km</span>
								<br>
								
							</div>
						</div>
					</div>
					@if (($cuenta%4)==0 && !$loop->last)
						</div><div class="item">
					@elseif($loop->last)
						</div>	
					@endif
					@php
						$cuenta++;
					@endphp
	        	@endforeach 
			  </div>

			  <!-- Controls -->
			    <!-- Indicators -->
			</div>
				@php
			    	$pages = round($cuenta/4,0, PHP_ROUND_HALF_UP);
			    @endphp
			    @if ($pages>1)
			    	<ul class="pagination" style="margin:10px 10px;" >
			        @for ($i = 1; $i <=$pages ; $i++)
			        	<li data-target="#carousel-example-generic" data-slide-to="{{ $i-1 }}">
				        	<a href="#">{{ $i }}</a>
				        </li>
			        @endfor
			      </ul>
			      <a href="#carousel-example-generic" style="margin-top: 18px; " class="pull-left" data-slide="prev">
		            <i class="fa fa-chevron-left" aria-hidden="true"></i>
		          </a>
		        
		          <a href="#carousel-example-generic" style="margin-top: 18px; " class="pull-right" data-slide="next">
		            <i class="fa fa-chevron-right" aria-hidden="true"></i>
		          </a>
			    @endif
        	</div>
        	{{-- {!! json_encode($ubicaciones) !!} --}}
        </div>