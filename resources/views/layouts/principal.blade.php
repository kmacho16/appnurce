<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name', 'Laravel') }}</title>
	{!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/style2.css')!!}
    {!!Html::script('js/jquery.min.js')!!}
</head>
<body>
	<div class="container-fluid">
		@yield("contenido")
	</div>
	{!!Html::script('js/bootstrap.min.js')!!}
</body>
</html>