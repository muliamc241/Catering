<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Menghitung Tarif Berdasarkan Jarak Dengan Google Maps</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
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
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCPcLlmqybKSe8cvN_leVX_1tkuO_-aKLo"></script>

  <script type="text/javascript">
    var map;
    var geocoder;
    var bounds = new google.maps.LatLngBounds();
    var markersArray = [];
    var no=1;
      
    // setting marker untuk marker asal dan tujuan
    var destinationIcon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000";
    var originIcon = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000";

    // tentukan terlebih dahulu letak petanya 
    function initialize() {
      
      var mapOptions = {
    zoom: 14,
    // Center 
    center: new google.maps.LatLng(3.589046,98.6493643)
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    geocoder = new google.maps.Geocoder();

    google.maps.event.addListener(map, 'rightclick', addLatLng);
    google.maps.event.addListener(map, "rightclick", function(event) {
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();     
      $('#latitude').val(lat);
      $('#longitude').val(lng);
    });

      // setting agar texfield pada kolom asal dan juga tujuan dapat memanggil fungsi autocomplete
      var asal = new google.maps.places.Autocomplete((document.getElementById('origins')),{ types: ['geocode'] });
      var tujuan = new google.maps.places.Autocomplete((document.getElementById('destinations')),{ types: ['geocode'] });
    }

    function addLatLng(event) {
    var marker = new google.maps.Marker({
    position: event.latLng,
    title: 'alamat',
    map: map
    });
    markers.push(marker);
    no=no+1;
  }

    /*      
    menghitung jarak dari data yg dikirim dari form
    disini saya setting untuk mode DRIVING dan menggunakan jalan raya atau juga tol,
    jika ingin mengganti konfigurasinya, silahkan ganti false dengan true
    */
    function calculateDistances() {
      var service = new google.maps.DistanceMatrixService();
      service.getDistanceMatrix(
      { 
        origins: [document.getElementById("origins").value],
        destinations: [document.getElementById("destinations").value],
        travelMode: google.maps.TravelMode.DRIVING, 
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
      }, callback);
    }
      
    // responde dari Googlemaps Distance Matrix akan diolah dan di kirim ke output HTML
    function callback(response, status) {
      if (status != google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
      } else {
        var origins = response.originAddresses;
        var destinations = response.destinationAddresses;
        deleteOverlays();

        for (var i = 0; i < origins.length; i++) {
          var results = response.rows[i].elements;
          addMarker(origins[i], false);
          for (var j = 0; j < results.length; j++) {
            addMarker(destinations[j], true);
          }
    
          /*          
            disini perhitungan tarif, pertama hilangkan dulu 'km'
            dan ubah tanda desimal koma dengan titik. 
          */
          var str = results[0].distance.text;
          var distance = str.replace(' km', '');
          var distance = distance.replace(',','.');

          /*          
            jumlah kilometer dikalikan dengan 500 
            setelah itu hasilnya kita konversikan kedalam format kurs rupiah
          */
          var tarif = "Rp."+ formatNumber(distance * 500)+",-"; 
          document.getElementById("billing").value = tarif;
          document.getElementById("distance").value = results[0].distance.text;
    
        }
      }
    }
    // fungsi sederhana untuk mengkonversi bilangan bulat menjadi format kurs rupiah
    function formatNumber (num) {
      return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
    }

    // menampilkan marker untuk origin dan juga destination
    function addMarker(location, isDestination) {
      var icon;
      if (isDestination) {
        icon = destinationIcon;
      } else {
        icon = originIcon;
      }
      geocoder.geocode({'address': location}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          bounds.extend(results[0].geometry.location);
          map.fitBounds(bounds);
          var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
            icon: icon
          });
          markersArray.push(marker);
        } else {
          alert("Terjadi kesalahan: "
            + status);
        }
      });
    }
      
    // menghapus koordinat marker sebelumnya dan menggantinya dengan koordinat yang baru
    function deleteOverlays() {
      if (markersArray) {
        for (i in markersArray) {
          markersArray[i].setMap(null);
        }
        markersArray.length = 0;
      }
    }
  </script>        
</head>
<body onload="initialize()">
  <nav class="light-green darken-1" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo" style="font-size: 18px;">Menghitung Tarif Berdasarkan Jarak Dengan Google Maps</a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="row">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s6">
              <input placeholder="Isi Asal" id="origins" type="text" class="validate">
              <label for="origins">Asal</label>
            </div>
            <div class="input-field col s6">
              <input id="destinations" placeholder="Isi Tujuan" type="text" class="validate">
              <label for="destinations">Tujuan</label>
            </div>
            <div class="input-field col s6">
              <a class="btn waves-effect waves-light" onclick="calculateDistances();">Hitung</a>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <input id="distance" type="text" placeholder="Jarak">
          <label for="distance">Jarak</label>
        </div>
        <div class="input-field col s6">
          <input id="billing" type="text" placeholder="Total Tarif">
          <label for="billing">Tarif (Rp.500,- / Km)</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <p>
            * <br>
            O = Origin / Asal <br>
            D = Destination / Tujuan 
          </p>
          <div id="map"></div>
        </div>
      </div>
    </div>
  </div>
  </body>
</html>