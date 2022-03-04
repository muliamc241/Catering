<!--script google map--><!-- 
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCPcLlmqybKSe8cvN_leVX_1tkuO_-aKLo"></script>
<script>
	var map;
	var markers = [];

	function initialize() {
		var mapOptions = {
		zoom: 14,
		// Center di kantor kabupaten kudus
		center: new google.maps.LatLng(3.589046,98.6493643)
		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		// Add a listener for the click event
		google.maps.event.addListener(map, 'rightclick', addLatLng);
		google.maps.event.addListener(map, "rightclick", function(event) {
		  var lat = event.latLng.lat();
		  var lng = event.latLng.lng();		  
		  $('#latitude').val(lat);
		  $('#longitude').val(lng);
		  //alert(lat +" dan "+lng);
		});
	}

        function addLatLng(event) {
		var marker = new google.maps.Marker({
		position: event.latLng,
		title: 'alamat',
		map: map
		});
		markers.push(marker);
	}
	//membersihkan peta dari marker
	function clearmap(e){
		e.preventDefault();
		$('#latitude').val('');
		$('#longitude').val('');
		setMapOnAll(null);
	}
	// Menampilkan marker lokasi jembatan
	function addMarker(nama,location) {
		var marker = new google.maps.Marker({
			position: location,
			map: map,
			title : nama
		});
		markers.push(marker);
	}
    // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<!-end script google map--> 
<div class="container mb-5">
	<div class="row mb-5">
		<div class="col-md-8 col-sm-8">
			<div class="panel panel-primary">
				<div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
				<div class="panel-body" style="height:300px;">	
				<?php echo $map['html']; ?>				
				</div>
			</div>
		</div>
		<div class="col-md-4 col-sm-4">
			<div class="panel panel-primary">
				<div class="panel-heading"><span class="glyphicon glyphicon-list"></span> Daftar Koordinat</div>
				<div class="panel-body" style="min-height:300px;">
					<form action="<?= base_url('user/alamat_peta')?>" method="post">
						<input type="hidden" name="id" value="">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<input type="text" id="myPlaceTextBox" style="width: 300px;" />
									<label for="latitude">Latitude</label>
									<input type="text" class="form-control" name="latitude" id="latitude">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label for="longitude">Longitude</label>
									<input type="text" class="form-control" name="longitude" id="longitude">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="datajembatan">Data jembatan</label>
						</div>
						<div class="form-group">
							<button class="btn btn-info btn-sm" id="simpandaftarkoordinat"><span class="glyphicon glyphicon-save"></span> Simpan</button>
							<a href="" class="btn btn-info btn-sm" id="clearmap"><span class="glyphicon glyphicon-globe"></span> ClearMap</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
