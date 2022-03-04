var map;
	var RuteTampil;
	var RuteService;
	var pasangantitik=[];
	var no=1;


	function initmap() {
		
		var mapOptions = {
			center: new google.maps.LatLng(3.589046,98.6493643),
			zoom: 15,
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