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
/********************************************/
var map;

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

    var map = new google.maps.Map(document.getElementById('map'), {
      center: location,
      zoom: 11
    });
    /*var map = new GMaps({
      div: '#map',
      zoom: 11,
      center: location,
    });*/

    

     var marker =new google.maps.Marker({
          position: location,
          map: map,
          draggable:true,
          icon:"https://cdn2.iconfinder.com/data/icons/snipicons/500/map-marker-128.png",
          title: 'Click to zoom'
        });

  /* var marker = map.addMarker({
      position:location,
      icon: "https://cdn2.iconfinder.com/data/icons/snipicons/500/map-marker-128.png",
      draggable:true,
      click: function(e) {
        alert('You clicked in this marker');
      }
    });*/

    /*var cityCircle = new google.maps.Circle({
	            strokeColor: '#FF0000',
	            strokeOpacity: 0.8,
	            strokeWeight: 2,
	            fillColor: '#FF0000',
	            fillOpacity: 0.35,
	            map: map,
	            center: location,
	            radius: 600
	          });
*/
    

    function cargarPuntos(){
		for (var i=0; i < misUbicaciones.data.length; i++) {
	    	//console.log("hola");
	    	location = new google.maps.LatLng(misUbicaciones.data[i].latitud,misUbicaciones.data[i].longitud);
	    	var markers  = new google.maps.Marker({
	    		position: location,
	    		map:map, 
	    		draggable:false,
	    	});

	    	/*var markers = map.addMarker({
	    	      position:location,
	    	      icon: "https://docs.joeworkman.net/assets/rapidweaver/stacks/google-maps/google-maps@128.png",
	    	      draggable:false
	    	    });*/
	    	marcadores.push(markers);
	    	console.log(misUbicaciones.data[i].latitud+" - "+misUbicaciones.data[i].longitud);
	    }
    }




    if(typeof(misUbicaciones)!="undefined"){
    	cargarPuntos();
    }
      	

        google.maps.event.addListener(marker, 'drag', function() { 
        	$("#latitud").val(this.getPosition().lat());
        	$("#longitud").val(this.getPosition().lng());
        	$("#latBus").val(this.getPosition().lat());
        	$("#lngBus").val(this.getPosition().lng());
        	var location = new google.maps.LatLng(this.getPosition().lat(),this.getPosition().lng());
        });

        $("#posicion #otro").click(function(e){
        	for (var i=0; i < marcadores.length; i++) {
        		marcadores[i].setMap(null);
        	}
			e.preventDefault();

			$("#btn_nueva").fadeIn();
			$("#nomb_direccion").prop("disabled",true);
			$("#btn_direccion").prop("disabled",true);
			var mlat = $(this).find('#lat').val();
			var mlng = $(this).find('#lng').val();
			$("#btn_act_posicion").css('visibility','visible');
			location = new google.maps.LatLng(mlat,mlng);
			
			console.log(location);
			map.setCenter(location);
			marker.setPosition(location);
			marker.setIcon("https://docs.joeworkman.net/assets/rapidweaver/stacks/google-maps/google-maps@128.png");
			marker.setDraggable(false);
		});

		$("#btn_nueva").click(function(e){
			for (var i=0; i < marcadores.length; i++) {
        		marcadores[i].setMap(map);
        	}
			e.preventDefault();

			$("#btn_nueva").fadeOut();
			$("#nomb_direccion").prop("disabled",false);
			$("#btn_direccion").prop("disabled",false);
			var location = new google.maps.LatLng(4.677396568627247,-74.08310437910154);
			map.setCenter(location);
			marker.setPosition(location);
			marker.setIcon("https://cdn2.iconfinder.com/data/icons/snipicons/500/map-marker-128.png");
			marker.setDraggable(true);

		});
  }
