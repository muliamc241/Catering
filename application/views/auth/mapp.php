<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Trying Hard Now!</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="util.js"></script>
<style>
  html, body{
    height: 100%;
    margin: 0px;
    padding: 0px
  }
  #map_canvas {
    height: 100%;
    width: 100%;
  }
  #panel {
    position: absolute;
    height : 30%;
    width: 20%
    top: 30px;
    left: 15%;
    margin-left: -180px;
    z-index: 5;
    background-color: rgba(255,255,255,0);
    padding: 5px;
  }
  #outputDiv {
    font-size: 11px;
  }
</style>
<script type="text/javascript">
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var infowindow;
  var map;
  var origin = null;
  var destination = null;

  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var myLatlng = new google.maps.LatLng(3.589046,98.6493643);
    var myOptions = {
      zoom: 13,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);
    downloadUrl("xmltaxi.php", function(data) {
      var markers = data.documentElement.getElementsByTagName("marker");
      for (var i = 6; i < 16; i=i+8) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
        //var marker = createMarker(latlng);
        if (i == 6)
          origin = latlng;
        else
          destination = latlng;
        }
      });
    //calcRoute();
  }

  /*function createMarker(latlng) {
    var marker = new google.maps.Marker({position: latlng, map: map});
    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      //infowindow = new google.maps.InfoWindow({content: name});
      infowindow.open(map, marker);
    });
    return marker;
  }*/
  //calcRoute();
  function calcRoute() {
    var selectedMode = document.getElementById('mode').value;
    //var start = document.getElementById('start').value;
    //var end = document.getElementById('end').value;
    var request = {
      origin:origin,
      destination:destination,
      travelMode: google.maps.TravelMode[selectedMode]
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
       directionsDisplay.setDirections(response);
      }
    });
  }

  function calculateDistances() {
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: [origin],
      destinations: [destination],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, callback);
}

  function callback(response, status) {
  if (status != google.maps.DistanceMatrixStatus.OK) {
    alert('Error was: ' + status);
  } else {
    //var origin = response.originAddresses;
    //var destination = response.destinationAddresses;
    var outputDiv = document.getElementById('outputDiv');
    outputDiv.innerHTML = '';
    //  deleteOverlays();

    //for (var i = 0; i < origin.length; i++) {
      var results = response.rows[0].elements;
      //addMarker(origins[i], false);
      //for (var j = 0; j < results.length; j++) {
        //addMarker(destinations[j], true);
        outputDiv.innerHTML += results[0].distance.text + ' in '
            + results[0].duration.text + '<br>';
        //}
      //}
    }
  }
//}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</head>
<body>
  <div id="panel">
   <b>Search: </b>
    <select onchange="calcRoute();">
      <option></option>
      <option id="mode" value="DRIVING">Route</option>
    </select>
    <div id="inputs">
      <p><button type="button" onclick="calculateDistances();">Calculate
          distances</button></p>
    </div>
    <div id="outputDiv"></div>
  </div>
  <div id="map_canvas"></div>
</body>
</html>