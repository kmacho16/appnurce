<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name', 'Laravel') }}</title>
	{!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/style.css')!!}
    {!!Html::script('js/jquery.min.js')!!}
</head>
<body>
	<div class="container">
		@yield("contenido")
	</div>
	{!!Html::script('js/bootstrap.min.js')!!}
</body>
</html>