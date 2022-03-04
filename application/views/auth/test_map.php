<html>
  <head>
    <title></title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    <script>
      var placeSearch, autocomplete;
      /*
      kita siapin dulu komponen formnya, 
      untuk dokumentasinya ada disini
      https://developers.google.com/maps/documentation/geocoding/#JSON
      */
      var componentForm = {
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      /*
      kita bikin inisialisasinya dulu, dengan mendeklarasikan service Google Maps Autocomplete
      lalu ketika form autocomplete di isi, maka service ini akan berjalan,
      setelah itu maka script ini akan memanggil fungsi isiAlamat()
      */
      function initialize() {
        var input = document.getElementById('autocomplete');
        new google.maps.places.Autocomplete(input);
      }

      google.maps.event.addDomListener(window, 'load', initialize);
      // function initialize() {
      //   autocomplete = new google.maps.places.Autocomplete((document.getElementById('autocomplete')), {
      //     types: ['geocode']
      //   });

      //   google.maps.event.addListener(autocomplete, 'place_changed', function () {
      //     isiAlamat();
      //   });
      // }

      /*
      nah, fungsi ini untuk mengisi field-field pada form 
      dengan output hasil dari autocomplete tadi. 
      */
      function isiAlamat() {
        var place = autocomplete.getPlace();
        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      /*
      fungsi ini berguna untuk geolocate, dimana nama jalan yang akan tampil di autocomplete
      tidak akan jauh dengan lokasi tempat kita berada.
      Fungsi ini berguna karena tanpa fungsi ini, autocomplete akan menampilkan alamat yang kurang akurat
      atau bahkan ngaco.
      */
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function (position) {
            var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
          });
        }
      }

    </script>
    <style>
      .form {
        width: 300px;
      }
    </style>
  </head>

  <body>
    <h2>Geocoder Autocomplete</h2>
    <pre class="prettyprint lang-html"><input id="autocomplete" style="width: 500px;" type="text" />
</pre>
    <form>
      <table id="alamat">
        <tbody>
          <tr>
            <td>Alamat</td>
            <td><input id="route" class="form" type="text" /></td>
          </tr>
          <tr>
            <td>Kota</td>
            <td><input id="locality" class="form" type="text" /></td>
          </tr>
          <tr>
            <td>Kode Pos</td>
            <td><input id="postal_code" type="text" /></td>
          </tr>
          <tr>
            <td>Provinsi</td>
            <td><input id="administrative_area_level_1" class="form" type="text" /></td>
          </tr>
          <tr>
            <td>Negara</td>
            <td><input id="country" class="form" type="text" /></td>
          </tr>
        </tbody>
      </table>
    </form>
  </body>

</html>