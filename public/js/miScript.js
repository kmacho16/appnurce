$('#miImagenInput').change(function(){
	LeerURL(this);
});

function LeerURL(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};
/*******************************************/
$('#miDocImg1').change(function(){
	LeerURL1(this);
});
function LeerURL1(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img1").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};
/*******************************************/
$('#miDocImg2').change(function(){
	LeerURL2(this);
});
function LeerURL2(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img2").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg3').change(function(){
	LeerURL3(this);
});
function LeerURL3(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img3").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg4').change(function(){
	LeerURL4(this);
});
function LeerURL4(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img4").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg5').change(function(){
	LeerURL5(this);
});
function LeerURL5(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img5").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};/*******************************************/
$('#miDocImg6').change(function(){
	LeerURL6(this);
});

function LeerURL6(input){
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload=function(e){
			$("#mi_img6").attr('src',e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
};

function confirmarEliminar(btn){
	if(confirm("Esta seguro de eliminar")){
	$("#"+btn).click();
	}
}

$(".btn-prog-msj").hide();

$("#chat-panel .chat-person").click(function(e){
	e.preventDefault();
	var id = $(this).attr('id');
	var token = $('input[name=_token]').val();
	var nombre =  $(this).find('div #span_nombre').text();
	var mi_id = $(this).find('#mi_id').val();
	$("#nom_chat").text(nombre);
	$("#nombre_modal").text(nombre);
	$(".btn-prog-msj").fadeIn();
	//$("#nom_chat").append('<button class="btn btn-info pull-right btn-sm" data-toggle="modal" data-target="#modal_evento"><i class="fa fa-clock-o"></i> Programar cita</button>');	

	$("#chat_control textarea").prop("disabled",false);
	$("#chat_control button").prop("disabled",false);
	//alert(nombre);
	cargarMensajes(id,mi_id,token);
});

function cargarMensajes(id,mi_id,token){

	$("#respuesta-chat").empty();

				get_ultimo = false;
	$.ajax({
		url:'/consultarChat',
		method: 'POST',
		data:{
			id:id,
			_token:token,
		},
		success:function(data){
			$(data.reverse()).each(function(id,value){
				if(value.foto_perfil=='NULL' || value.foto_perfil==null){
					var image = "/img/profile.ico";
				}else{
					var image = "/uploads/"+value.foto_perfil;
				}


				if (value.id_user==mi_id){
					id_send = value.to_id_user;
					div = '<div class="col-md-12" style="margin:5px 0"> <div class=""> <div class="col-md-8 col-md-offset-1"> <div class="alert alert-warning"> <p data-toggle="tooltip" data-placement="left" title="'+value.created_at+'">'+value.mensaje+'</p> </div> </div> <div class="col-md-2"> <img src="'+image+'" alt="" class="img-responsive img-circle" width="70px" alt="Tu"> </div> </div>';
				}else{				
					$("#imagen_modal").attr('src',image);
					$("#modal_id").val(value.id_user);	
					id_send = value.id_user;
					div = '<div class="col-md-12" style="margin:5px 0"> <div class=""> <div class="col-md-2"> <img src="'+image+'" alt="" class="img-responsive img-circle" width="70px" alt="Tu"> </div>  <div class="col-md-8"> <div class="alert alert-success"> <p data-toggle="tooltip" data-placement="left" title="'+value.created_at+'">'+value.mensaje+'</p> </div> </div></div>';
				}

					id_ultimo = value.id;
				
				$("#respuesta-chat").append(div);
			});

			$("#chat_control input").val(id+"-"+id_send+'-'+id_ultimo);
			$("#respuesta-chat").scrollTop($("#respuesta-chat").height());
			/*$("#respuesta-chat").html(data);
			console.log(data);*/
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip();
			});

		},
		error:function(data){
			alert(data);
		}
	});
}

$("#chat_control button").click(function(e){
	e.preventDefault();
	var token = $('input[name=_token]').val();
	var ids= $("#chat_control input").val();
	exp_ids = ids.split('-');
	id = exp_ids[0];
	mi_id = $('#mi_id').val();
	/*alert(mi_id);*/
	mmensaje = $("#chat_control textarea").val();
	$.ajax({
		url:'/enviarMensaje',
		method: 'POST',
		data:{
			ids:ids,
			_token:token,
			mensaje:mmensaje,
		},
		success:function(data){
			$("#chat_control textarea").val('');
			cargarMensajes(id,mi_id,token);
		},
		error:function(data){
			alert(data);
		}
	});

});


/********************************************/
/*function localizame(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(coordenadas);
	}else{
		alert('Oops! Tu navegador no soporta geolocalización. Bájate Chrome, que es gratis!');
	}
}

function errores(err) {
    if (err.code == 0) {
      alert("Oops! Algo ha salido mal");
    }
    if (err.code == 1) {
      alert("Oops! No has aceptado compartir tu posición");
    }
    if (err.code == 2) {
      alert("Oops! No se puede obtener la posición actual");
    }
    if (err.code == 3) {
      alert("Oops! Hemos superado el tiempo de espera");
    }
}

function coordenadas(){
	var latitud = position.coords.latitude;
	var longitud = position.coords.longitude;
}*/
/*$("#btn_nueva").fadeOut();
$("#form_ubicacion").fadeIn();*/

$("#btn_nueva").fadeOut();
$("#nomb_direccion").prop("disabled",false);
$("#btn_direccion").prop("disabled",false);


function initMap() {

	var marcadores =[];
	var mlat = $('#latitud').val();
	var mlng = $('#longitud').val();
	var location = new google.maps.LatLng(mlat,mlng);	
    var infowindow = new google.maps.InfoWindow();
    var cityCircle = new google.maps.Circle();


  




    var map = new google.maps.Map(document.getElementById('map'), {
      center: location,
      zoom: 15
    });

    var iconPrincipal = {
        url:"../img/iconoMarker.png", // url
        scaledSize: new google.maps.Size(65, 110), // scaled size
    };

    var iconSecundario = {
    	url:"../img/iconoLove.png", // url
        scaledSize: new google.maps.Size(42, 70), // scaled size
        /*origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(0, 0)*/ // anchor
    }

    var iconoStar = {
    	url:"../img/iconoStar.png", // url
        scaledSize: new google.maps.Size(52, 75), // scaled size
        /*origin: new google.maps.Point(0,0), // origin
        anchor: new google.maps.Point(0, 0)*/ // anchor
    }

	var marker =new google.maps.Marker({
	      position: location,
	      map: map,
	      draggable:true,
	      icon:iconPrincipal,
	      title: 'Click to zoom'
	    });

 	google.maps.event.addListener(marker, 'drag', function() { 
        	$("#latitud").val(this.getPosition().lat());
        	$("#longitud").val(this.getPosition().lng());
        	$("#latBus").val(this.getPosition().lat());
        	$("#lngBus").val(this.getPosition().lng());
        	var location = new google.maps.LatLng(this.getPosition().lat(),this.getPosition().lng());
        });

    $("#posicion #otro").click(function(e){
 		$("#btn_nueva").fadeIn();
		$("#nomb_direccion").prop("disabled",true);
		$("#btn_direccion").prop("disabled",true);			
		$("#btn_act_posicion").css('visibility','visible');

     	for (var i=0; i < marcadores.length; i++) {
     		marcadores[i].setMap(null);
     	}
     	marcadores.length=0;
     	
		e.preventDefault();
		var mlat = $('#latitud').val();
		var mlng = $('#longitud').val();
		location = new google.maps.LatLng(mlat,mlng);
		marker.setPosition(location);
		marker.setDraggable(false);	
			
		var lugar_lat = $(this).find('#lat').val();
		var lugar_lng = $(this).find('#lng').val();
		location = new google.maps.LatLng(lugar_lat,lugar_lng);
     	
	    
		var markers =new google.maps.Marker({
	      position: location,
	      map: map,
	      icon:iconSecundario,
	    });
	    marcadores.push(markers);
    	

		/*ENCUENTA PUNTO MEDIO PARA CENTRAR*/
		x1 = parseFloat(mlat);
		y1 = parseFloat(mlng);
		x2 = parseFloat(lugar_lat);
		y2 = parseFloat(lugar_lng);
		center_lat = (x1+x2)/2;
		center_lng = (y1+y2)/2;
		location = new google.maps.LatLng(center_lat,center_lng);
		map.setCenter(location);
		map.setZoom(13);
	});


 	$("#posicion #finds").click(function(e){
	 	$("#btn_nueva").fadeIn();

	 	for (var i=0; i < marcadores.length; i++) {
	 		marcadores[i].setMap(null);
	 	}
	 		marcadores.length = 0;

		e.preventDefault();
		/*MARCADOR 1*/
		var mlat = $('#latitud').val();
		var mlng = $('#longitud').val();
		var mradio = $('#radio').val();
		var radio = mradio *1000;
		location = new google.maps.LatLng(mlat,mlng);
		marker.setPosition(location);
		marker.setIcon(iconPrincipal);
		marker.setDraggable(false);

		map.setCenter(location);

		/*MARCADOR 2*/
		var lugar_lat = $(this).find('#lat').val();
		var lugar_lng = $(this).find('#lng').val();
		location = new google.maps.LatLng(lugar_lat,lugar_lng);

		var markers =new google.maps.Marker({
		      position: location,
		      map: map,
		      draggable:false,
		      icon:iconSecundario,
		    });

	    marcadores.push(markers);
	    /*ENCUENTA PUNTO MEDIO PARA CENTRAR*/
		x1 = parseFloat(mlat);
		y1 = parseFloat(mlng);
		x2 = parseFloat(lugar_lat);
		y2 = parseFloat(lugar_lng);
		center_lat = (x1+x2)/2;
		center_lng = (y1+y2)/2;
		location = new google.maps.LatLng(center_lat,center_lng);
		map.setCenter(location);
		map.setZoom(13);
	});

	$("#btn_nueva").click(function(e){

		$("#btn_nueva").fadeOut();
		$("#nomb_direccion").prop("disabled",false);
		$("#btn_direccion").prop("disabled",false);
		e.preventDefault();

		cargarPuntos();

		var location = new google.maps.LatLng(4.677396568627247,-74.08310437910154);
		map.setCenter(location);
		marker.setPosition(location);
		marker.setIcon(iconPrincipal);
		marker.setDraggable(true);
	});	

 	function dibujaCirculo (radius,location){
		if(typeof(cityCircle)!="undefined"){
    		cityCircle.setMap(null);
    	}
	 	cityCircle.setOptions({
		            strokeColor: '#3291b1',
		            strokeOpacity: 0.8,
		            strokeWeight: 2,
		            fillColor: '#383957',
		            fillOpacity: 0.35,
		            map: map,
		            center: location,
		            radius: radius
		          });
	 }
  
    /*CARGAR PUNTOS*/
	if(typeof(misUbicaciones)!="undefined"){
			cargarPuntos();
		}
    function cargarPuntos(){
    	
     	marcadores.length=0;
		for (var i=0; i < misUbicaciones.data.length; i++) {
	    	//console.log("hola");
	    	location = new google.maps.LatLng(misUbicaciones.data[i].latitud,misUbicaciones.data[i].longitud);
	    	var markers  = new google.maps.Marker({
	    		position: location,
	    		map:map, 
	    		draggable:false,
	    		icon:iconSecundario
	    	});
	    	marcadores.push(markers);
	    	//console.log(misUbicaciones.data[i].latitud+" - "+misUbicaciones.data[i].longitud);
	    }
    }
    /*FIN CARGAR PUNTOS*/

	/*CARGAR PUNTOS FIND*/
    if(typeof(findDirecciones)!="undefined"){
    		cargarPuntosFind();
    	}
    function cargarPuntosFind(){
    		map.setZoom(13);

	    	var mlat = $('#latitud').val();
			var mlng = $('#longitud').val();
			var mradio = $('#radio').val();
			var radio = mradio *1000;
			location = new google.maps.LatLng(mlat,mlng);		
			dibujaCirculo(radio,location);

		for (var i=0; i < findDirecciones.length; i++) {
	    	location = new google.maps.LatLng(findDirecciones[i].latitud,findDirecciones[i].longitud);
	    	if(i==0){
	    		icon = iconoStar;
	    	}else{
	    		icon = iconSecundario;
	    	}
	    	var markers  = new google.maps.Marker({
	    		position: location,
	    		map:map, 
	    		draggable:false,
	    		icon:icon
	    	});

	    	google.maps.event.addListener(markers, 'click', (function(markers, i) {
	    	        return function() {
	    	        	var dista = findDirecciones[i].distancia.toString().substring(0,3);
	    	        	var nombre = findDirecciones[i].name;
	    	        	infowindow.setContent("hola soy "+nombre+" me encuentro a  "+dista+"Km de distancia <a href='/usuarios/"+findDirecciones[i].id_user+"'>link</a> ");
	    	        	infowindow.open(map, markers);
	    	        }
	    	      })(markers, i));
	    	marcadores.push(markers);
	    	//console.log(findDirecciones[i].latitud+" - "+findDirecciones[i].longitud);
	    }
    }
	/*FIN CARGAR PUNTOS FIND*/
}
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});
