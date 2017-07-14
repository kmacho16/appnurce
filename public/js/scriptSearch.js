/*ESTO SIRVE PARA CAPTURAR LA POSICION
function initMap() {
	var location = new google.maps.LatLng(4.677396568627247,-74.08310437910154);
	var map = new google.maps.Map(document.getElementById('map'), {
      center: location,
      zoom: 15
    });

        var infoWindow = new google.maps.InfoWindow({map: map});
// Try HTML5 geolocation.
    if (navigator.geolocation) {
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
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }*/


function initMap() {

	var marcadores =[];
	var mlat = $('#lat').val();
	var mlng = $('#lng').val();
  var cityCircle = new google.maps.Circle();    
  var infowindow = new google.maps.InfoWindow();    
  var input = document.getElementById('buscar');	
 	var searchBox = new google.maps.places.SearchBox(input);

  $("#ver_todos").fadeOut();

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
	
	if (mlat==='' || mlng==='') {
		mlat = 4.683940718364223;
		mlng = -74.09151578657224;
	}

	var location = new google.maps.LatLng(mlat,mlng);
  var infoWindow = new google.maps.InfoWindow({map: map});

	var map = new google.maps.Map(document.getElementById('map'), {
	    center: location,
	    zoom: 13
	  });

	var iconPrincipal = {
        url:"../img/iconoMarker.png", // url
        scaledSize: new google.maps.Size(65, 110), // scaled size
    };
    var iconSecundario = {
    	url:"../img/iconoLove.png", // url
        scaledSize: new google.maps.Size(25, 40), // scaled size
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
        	$("#lat").val(this.getPosition().lat());
        	$("#lng").val(this.getPosition().lng());
        	//var location = new google.maps.LatLng(this.getPosition().lat(),this.getPosition().lng());
        });

    if(typeof(findDirecciones)!="undefined"){
    		cargarPuntosFind();
    	}
    function cargarPuntosFind(){
	    var mlat = $('#lat').val();
			var mlng = $('#lng').val();
			var mradio = $('#radio').val();
			var radio = mradio * 1000;
			location = new google.maps.LatLng(mlat,mlng);
			dibujaCirculo(radio,location);
      var radioNum = parseInt(mradio);
      if (radioNum<3) {
        var zoom = 15; 
      }else if(radioNum<=5) {
        var zoom = 14;
      }else if(radioNum<=10) {
        var zoom = 12;
      }else{
        var zoom = 11;
      }



			map.setZoom(zoom);

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
                  var img_perfil = findDirecciones[i].img_perfil;
                  if (img_perfil == "" || img_perfil == null) {
                    img_perfil = "img/profile.ico"
                  }else{
                    img_perfil = "uploads/"+findDirecciones[i].img_perfil;
                  }
	    	        	infowindow.setContent("<div class='col-md-12'><div class='col-md-4'><br /> <img src='"+img_perfil+"' class='img-circle img-responsive' style='width:90%' /></div> <div class='col-md-8'><h3 class='color-rosa text-center text-uppercase'>Informacion Personal</h3>  <table class='table'><tr><th>Nombre: </th><td>"+nombre+"</td></tr> <tr><th>Distancia: </th><td>"+dista+"Km</td></tr><tr><th>Perfil: </th><td><a href='/usuarios/"+findDirecciones[i].id_user+"'>Ver Perfil</a></td> </tr> </table> </div></div>");
	    	        	infowindow.open(map, markers);
	    	        }
	    	      })(markers, i));
	    	marcadores.push(markers);
	    	//console.log(findDirecciones[i].latitud+" - "+findDirecciones[i].longitud);
	    }
    }

    function cuadroInfo(img_perfil,nombre,dista,id,map,marker){
      infowindow.setContent("<div class='col-md-12'><div class='col-md-4'><br /> <img src='"+img_perfil+"' class='img-circle img-responsive' style='width:90%' /></div> <div class='col-md-8'><h3 class='color-rosa text-center text-uppercase'>Informacion Personal</h3>  <table class='table'><tr><th>Nombre: </th><td>"+nombre+"</td></tr> <tr><th>Distancia: </th><td>"+dista+"Km</td></tr><tr><th>Perfil: </th><td><a href='/usuarios/"+id+"'>Ver Perfil</a></td> </tr> </table> </div></div>");
      infowindow.open(map, marker);
    }

    /*CUADRO DE BUSQUEDA*/
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
    map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          if (places.length == 0) {
            return;
          }
          
          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            marker.setPosition(place.geometry.location);
              $("#lat").val(place.geometry.location.lat);
        	    $("#lng").val(place.geometry.location.lng);
        	     

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
          map.setZoom(13);
          $('#radio').val(1);
          cityCircle.setMap(null);
          findDirecciones.length=0;
          $("#personal_box").empty();

        });
    /*END CUADRO DE BUSQUEDA*/

    /*RECUADROS USUARIOS*/
    $("#persona #nombre").click(function(e){
      //alert("HOla");
      $("#ver_todos").fadeIn();
      
      e.preventDefault();
      $("#btn_nueva").fadeIn();

      for (var i=0; i < marcadores.length; i++) {
        marcadores[i].setMap(null);
      }
      marcadores.length = 0;

      /*MARCADOR 1*/
      var mlat = $('#lat').val();
      var mlng = $('#lng').val();
      var mradio = $('#radio').val();
      var radio = mradio *1000;
      location = new google.maps.LatLng(mlat,mlng);
      marker.setPosition(location);
      marker.setIcon(iconPrincipal);
      marker.setDraggable(false);

      map.setCenter(location);

      /*MARCADOR 2*/
      var lugar_lat = $(this).find('#person_lat').val();
      var lugar_lng = $(this).find('#person_lng').val();


      location = new google.maps.LatLng(lugar_lat,lugar_lng);
      var markers =new google.maps.Marker({
            position: location,
            map: map,
            draggable:false,
            icon:iconSecundario,
          });
      marcadores.push(markers);
      cuadroInfo($(this).find("#person_img").val(),$(this).find("#person_nom").val(),$(this).find("#person_distancia").val(),$(this).find("#person_id").val(),map,markers)



        /*ENCUENTA PUNTO MEDIO PARA CENTRAR*/
      x1 = parseFloat(mlat);
      y1 = parseFloat(mlng);
      x2 = parseFloat(lugar_lat);
      y2 = parseFloat(lugar_lng);
      center_lat = (x1+x2)/2;
      center_lng = (y1+y2)/2;
      location = new google.maps.LatLng(center_lat,center_lng);
      map.setCenter(location);
      map.setZoom(14);
      /*cityCircle.setMap(null);*/
    });
    /*END RECUADROS USUARIOS*/

    $("#ver_todos").click(function(){
      $(this).fadeOut();
      for (var i=0; i < marcadores.length; i++) {
        marcadores[i].setMap(null);
      }
      marcadores.length = 0;
      cargarPuntosFind();
      infowindow.close();
    });

}
