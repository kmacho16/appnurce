@extends('home')
@section('contenido-seg')

<h3>Ubicaciones</h3>
{{ $ubicaciones }}
<button id="verMapa">ver Mapa</button>
<input type="text" value="{{ $ubicaciones[0]->latitud }}" id="lat">
<input type="text" value="{{ $ubicaciones[0]->longitud }}" id="lng">
<div class="map" id="map" style="border:2px solid red; height: 0px;width: 90%">
	
</div>
@endsection