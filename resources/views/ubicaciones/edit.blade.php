@extends('home')
@section('contenido-seg')
<div  class="col-md-9" >
	<div id="map" style="height: 500px; border:0px solid red;border-radius: 15px;">
	</div>
	
</div>
<div class="col-md-3">
	<div class="form-group" id="form_ubicacion">
		@include('ubicaciones.forms.form_edit')
	</div>
	<hr>
</div>
@endsection
