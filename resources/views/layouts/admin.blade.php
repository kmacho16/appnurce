<!DOCTYPE html>
<html lang="es">
<title>NurceApp</title>
<head>
	<meta charset="UTF-8">
	<title>{{ config('app.name', 'Laravel') }}</title>
	{!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/font-awesome.min.css')!!}
    {!!Html::style('css/metisMenu.min.css')!!}    
    {!!Html::style('css/sb-admin-2.css')!!}
    {!!Html::style('css/jquery-ui.css')!!}
    {!!Html::style('css/style2.css')!!}
    {!!Html::style('css/fullcalendar.min.css')!!}

    {!!Html::script('js/jquery.min.js')!!}
    {!!Html::script('js/moment.min.js')!!}
    {!!Html::script('js/fullcalendar.min.js')!!}

    @inject('cantidad','App\historial_chat')

</head>
<body>
    <div id="wrapper">

        
        <nav class="navbar navbar-default navbar-static-top" role="navigation" id="navmio" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
           <a class="navbar-bran color-blanco" href="{{ url('usuarios') }}"> <i class="fa fa-2x fa-heartbeat" aria-hidden="true"></i></a>


            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        <a href="{{ url('/logout') }}" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw"></i> 
                                Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Usuario<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route('usuarios.create') !!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="{!!route('usuarios.index') !!}"><i class='fa fa-list-ol fa-fw'></i> Usuarios</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-globe fa-fw"></i> Mis ubicaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!!  route('ubicaciones.create')  !!}"><i class='fa fa-plus fa-fw'></i> Agregar</a>
                                </li>
                                <li>
                                    <a href="{!!  route('ubicaciones.index')  !!}"><i class='fa fa-map-marker fa-fw'></i> Ubicaciones</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="{!!  route('eventos.index')  !!}"><i class="fa fa-calendar fa-fw"></i> Calendario</a>
                            
                        </li>

                        <li>
                            <a href="{!!route('mensajes.index') !!}"><i class="fa fa-inbox fa-fw"></i> Mensajes <span class="badge"> {{ $cantidad->cantidadMensajes()[0]->total  }}</span>
                            
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

     </nav>

        <div id="page-wrapper">
            @yield("contenido")
        </div>
{{-- <p>SELECT id,id_user,nombre,latitud,longitud, (6371 * ACOS( SIN(RADIANS(latitud)) * SIN(RADIANS(4.702033048673515)) + COS(RADIANS(longitud - -74.143700845166)) * COS(RADIANS(latitud)) * COS(RADIANS(4.702033048673515)) ) ) AS Distancia from ubicaciones ORDER by Distancia ASC
</p> --}}
    </div>
    

    
    {!!Html::script('js/bootstrap.min.js')!!}
    {!!Html::script('js/metisMenu.min.js')!!}
    {!!Html::script('js/jscolor.min.js')!!}
    {!!Html::script('js/sb-admin-2.js')!!}
    {!!Html::script('js/miScript.js')!!}   
    {!!Html::script('js/gmaps.js')!!}
    {!!Html::script('js/jquery-ui.js')!!}
{{-- 
    {!!Html::script('js/localeAll.js')!!} --}}

<script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy/mm/dd',minDate: 0 }).val();
    $( "#datepicker2" ).datepicker({ dateFormat: 'yy/mm/dd',minDate: 0 }).val();
    
    
  } );
</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjtPdNSeeVGUgaaL8a7MN5yG4ZETeQeq4&callback=initMap"></script>
</body>
</html>