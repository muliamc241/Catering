<!DOCTYPE html>
<html lang="en">
<head>
  <title>Menghitung Tarif Berdasarkan Jarak Dengan Google Maps</title>
  <style type="text/css">
    #map {
      height: 480px;
      width: 100%;
      border: solid thin #333;
      margin-top: 20px;
    }

    #map img { 
      max-width: none;
    }

    #mapCanvas label { 
      width: auto; display:inline; 
    } 
  </style>
  
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdAXZ71UsMUix1lMLLltWiQaB1jiHqgdQ"></script>
<script type="text/javascript">
	var map;
	var RuteTampil;
	var RuteService;
	var pasangantitik=[];
	var no=1;


	function initmap() {
		
		var mapOptions = {
			center: new google.maps.LatLng(3.589046,98.6493643),
			zoom: 15,
			mapTypeId: google.maps.MapTypeId.HYBRID
		};
		map = new google.maps.Map(document.getElementById('map'), mapOptions);

	map.addListener('click', function(e){
		var marker = new google.maps.Marker({
			position: e.latLng,
			map: map,
			label: String(no)
		});

		pasangantitik.push(e.latLng);
		no=no+1;

	});


	}

	function LihatRute()
	{
		var pilih = document.getElementById("slcJenis").value;

		var request = {
			origin: pasangantitik[0],
			destination: pasangantitik[1],
			travelMode: google.maps.TravelMode[pilih]
		};

		RuteService = new google.maps.DirectionsService();

		RuteService.route(request, function(response, status)
		{
			if (status == google.maps.DirectionsStatus.OK)
			{
				RuteTampil = new google.maps.DirectionsRenderer();
				RuteTampil.setDirections(response);
				RuteTampil.setMap(map);
			} 
			else 
			{
				alert("Informasi rute tidak dapat ditampilkan");
			}

			no=1;
			pasangantitik.length=0;
		});
	}



</script>
</head>
<body onload="initmap()">
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row">
        
          <div class="row">
          	<button id="btn" onclick="LihatRute()">Proses</button>
            	<select id="slcJenis">
            		<option value="DRIVING">Berkendara</option>
            		<option value="WALKING">Jalan Kaki</option>
            		<option value="BICYCLING">Bersepeda</option>
            		<option value="TRANSIT">Transit</option>
            	</select>
          </div>
        
      </div>
          <div id="map"></div>
        </div>
      </div>
  </body>
</html>