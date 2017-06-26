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
var mlat = 4.4734284;
var mlgn =  -74.1181233;

function initMap() {

    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 4.4734284, lng: -74.1181233},
      zoom: 15
    });
    	$("#latitud").val(4.4734284);
    	$("#longitud").val(-74.1181233);

    var marker = new google.maps.Marker({
          position:  {lat: 4.4734284, lng: -74.1181233},
          map: map,
          draggable:true,
          icon:"https://cdn2.iconfinder.com/data/icons/snipicons/500/map-marker-128.png",
          title: 'Click to zoom'
        });

       

      
        google.maps.event.addListener(marker, 'drag', function() { 
        	$("#latitud").val(this.getPosition().lat());
        	$("#longitud").val(this.getPosition().lng());
        } );

        $("button").click(function(){

        	$("#map").css({'height':'500px'});
        	var mlat = $("#lat").val();
        	var mlng = $("#lng").val();
        	var location = new google.maps.LatLng(mlat,mlng);
        	map = new google.maps.Map(document.getElementById('map'), {
		      center: location,
		      zoom: 15
		    });

		  var marker = new google.maps.Marker({
          position:  location,
          map: map,
          draggable:false,
          icon:"https://cdn2.iconfinder.com/data/icons/snipicons/500/map-marker-128.png",
          title: 'Click to zoom'
        });
        });



   



     // Try HTML5 geolocation.
     /*if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(function(position) {
         var pos = {
           lat: position.coords.latitude,
           lng: position.coords.longitude
         };

         infoWindow.setPosition(pos);
         infoWindow.setContent('Location found.');
         map.setCenter(pos);
       }, function() {
         handleLocationError(true, infoWindow, map.getCenter());
       });
     } else {
       // Browser doesn't support Geolocation
       handleLocationError(false, infoWindow, map.getCenter());
     }
      var infoWindow = new google.maps.InfoWindow({map: map});*/
  }
 

 

    
   

/*   function handleLocationError(browserHasGeolocation, infoWindow, pos) {
     infoWindow.setPosition(pos);
     infoWindow.setContent(browserHasGeolocation ?
                           'Error: The Geolocation service failed.' :
                           'Error: Your browser doesn\'t support geolocation.');
   }
*/