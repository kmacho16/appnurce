@extends('layouts.Log')

@section('contenido')
	<div class="row">
		<div id="controles" style="margin-top: 3em; padding: 0 30px">
	        <div class="col-md-10" style="height: 500px; border-radius: 20px 0 0 20px" id="map">
	        </div>

	        <div class="col-md-2 pull-right" style="background-color: #fff; height: 500px;border-radius: 0 20px 20px 0;">
			<div class="form-group">
				<h3 class="color-rosa text-uppercase text-center">Informacion</h3>
				{!! Form::model(Request::only(['lat','lng','rad']),['url'=>'/search','method'=>'get']) !!}{{-- 
				<input type="text" placeholder="Buscar..." class="form-control"><br> --}}
				{{-- {!! Form::text('lat',null,["class"=>'form-control', "id"=>"lat"]) !!}
				{!! Form::text('lng',null,["class"=>'form-control', "id"=>"lng"]) !!} --}}
				{!! Form::hidden('lat',null,["id"=>"lat"]) !!}
				{!! Form::hidden('lng',null,["id"=>"lng"]) !!}
				{!! Form::text('radio',null,["class"=>'form-control', "id"=>"radio"]) !!}
				
				<button class="btn btn-warning btn-block">BUSCAR</button>
				{!! Form::close() !!}
			</div>
			@foreach ($ubicaciones as $personal)
				<strong class="color-rosa text-uppercase">{{ $personal->name }}</strong> esta a <span class="color-rosa text-uppercase">{{ substr($personal->distancia,0,3) }}Km</span>
				@if ($loop->first)
					<i class="fa fa-star"></i>
				@endif
				<br>
        	@endforeach

	        </div>
		</div>
    </div>
    <script>
    	var findDirecciones= {!! json_encode($ubicaciones) !!}
    </script>
@endsection