@extends('home')
@section('contenido-seg')

<div class="col-md-3" style="border-right: 2px solid #dadada; height: 550px; margin-left: 0px;" id="chat-panel">
    <section style="height: 500px;overflow: auto;">
        <div class="text-center text-uppercase color-rosa"><h4>Mensajes</h4></div>
            @foreach ($mensajes as $mensaje)
            <a href="#" class="chat-person 
            @if (!$mensaje->leido && $mensaje->to_id_user == Auth::user()->id )
                sin_leer
            @endif

            " id="{{ $mensaje->id_chat }}">
            {!! Form::token() !!}
            <input type="hidden" value="{{ Auth::user()->id }}" id="mi_id">
            <div class="col-md-12" style="margin-bottom: 20px;">
                <div class="col-md-4" style="padding:0 ">
                @if ($mensaje->id_user == Auth::user()->id )
                    @if (empty($mensaje->to_img))
                        <img src="img/profile.ico" class="img-responsive img-circle">
                    @else
                        <img src="{{ url("uploads/".$mensaje->to_img) }}" class="img-responsive img-circle">
                    @endif
                @else
                    @if (empty($mensaje->from_img))
                        <img src="img/profile.ico" class="img-responsive img-circle">
                    @else
                        <img src="{{ url("uploads/".$mensaje->from_img) }}" class="img-responsive img-circle">
                    @endif
                @endif
                </div>
                
                <div class="col-md-8">
                    @if ($mensaje->id_user == Auth::user()->id )
                        {{ $mensaje->to_nombre }}
                    @else
                        {{ $mensaje->from_nombre }}
                    @endif
                    <br>
                    <span style="font-size: 11px">
                        @if ($mensaje->id_user == Auth::user()->id )
                            Tú: 
                        @endif
                        {!! substr($mensaje->mensaje, 0,20)  !!}...
                    </span>
                </div>
            </div>
            </a>
        @endforeach
    </section>
    <section>
        <button class="btn btn-info btn-sm"><i class="fa fa-clock-o"></i> Programar</button>
        <button class="btn btn-warning btn-sm"><i class="fa fa-calendar"></i> Mi calendario</button>
    </section>
</div>

<div class="col-md-9">
    <div class="form-group" id="chat_control">
        <div class="col-md-10">
          <textarea class="form-control" cols="40" rows="1" style="resize: vertical;" disabled="true"></textarea>
        </div>
        <div class="col-md-2">
            <button class="btn btn-rosa" disabled="true"><i class="fa fa-send"></i> Enviar</button>
        </div>
        <input type="hidden" value="">
    </div>
    <hr><hr>
    <h4 class="text-center color-rosa text-uppercase" id="nom_chat">
        NOMBRE DEL USUARIO
    </h4>
    <div id="respuesta-chat" style="height: 450px;overflow: auto;">
        <div class="col-md-12">
            <div class="pull-left">
                <div class="col-md-2">
                    <img src="img/profile.ico" alt="" class="img-responsive" width="70px" alt="WANG">
                </div>
                <div class="col-md-10">
                    <div type="button" class="alert alert-success">
                        <p data-toggle="tooltip" data-placement="right" title="2017-12-12 05:20">
                            Los mensajes de tus usuarios seran de color verde y apareceran en el lado Izquierdo de la pantalla....
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="">
                    <div class="col-md-8 col-md-offset-1">
                    <div class="alert alert-warning">
                        <p  data-toggle="tooltip" data-placement="left" title="2017-12-12 05:20">
                        Tus mensajes apareceran en el lado Derecho de la pantalla y seran de color amarillo
                        </p>
                    </div>
                     </div>
                    <div class="col-md-2">
                        <img src="img/profile.ico" alt="" class="img-responsive" width="70px" alt="Tu">
                    </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="pull-left">
                <div class="col-md-2">
                    <img src="img/profile.ico" alt="" class="img-responsive" width="70px" alt="WANG">
                </div>
                <div class="col-md-10">
                    <div type="button" class="alert alert-success">
                        <p data-toggle="tooltip" data-placement="right" title="2017-12-12 05:20">
                            La unica forma de que los mensajes aparezcan como <strong>leido</strong>, es si los respondes
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>





</div>


@endsection