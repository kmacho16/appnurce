<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name', 'Laravel') }}</title>
	{!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/style.css')!!}
    {!! Html::style('css/owl.carousel.min.css') !!}
    {!! Html::style('css/owl.theme.default.min.css') !!}


    {!!Html::script('js/scriptSearch.js')!!}
     
</head>
<body>
	<div class="container-fluid">
		@yield("contenido")
	</div>

    {!!Html::script('js/jquery.min.js')!!}
	{!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/owl.carousel.min.js')!!}
	<script>
    	$('.carousel').carousel({
		  interval: false
		});
    </script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjtPdNSeeVGUgaaL8a7MN5yG4ZETeQeq4&libraries=places&callback=initMap"></script>
</body>
</html>