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

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('user/index')?>">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Edit Profil</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** CUSTOMER MENU ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu">


                <div class="card-header">
                  <h3 class="h4 card-title">Mitra</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column"><a href="<?= base_url('mitra/vedit_profil')?>" class="nav-link">&nbsp;<i class="fas fa-user-cog"></i>&nbsp; Edit Profil</a>
                    <a href="<?= base_url('mitra/vedit_password')?>" class="nav-link">&nbsp;<i class="fas fa-user-lock" aria-hidden="true"></i>&nbsp; Ganti Password</a>
                    <a href="<?= base_url('mitra/profil')?>" class="nav-link"><i class="fa fa-sign-out"></i> kembali</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h3>Alamat Mitra</h3>
                <?php 
                $map = $this-> db -> get_where('map_mitra', ['id_mitra' => $mitra['id']]) -> row_array();
                if($map){
                ?>
                <form action="<?= base_url('mitra/alamat_update')?>" method="post" enctype="multipart/form-data">
                  <input id="id" type="hidden" name="id" value="<?= $mitra['id'] ?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="map">Map</label>
                        <div class="panel-body" style="height:300px;" id="map-canvas"></div>
                        <small class="text-muted">Note : membuat tanda dengan klik kanan, jika tanda lebih dari 1 maka yang di baca yang ter akhir di tandai.</small>
                        <input type="hidden" class="form-control" name="lat" id="latitude">
                        <input type="hidden" class="form-control" name="lang" id="longitude"> 
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-map-marked-alt"></i> Ganti Alamat</button> <a href="" class="btn btn-primary" id="clearmap"><span class="glyphicon glyphicon-globe"></span> Hapus tanda</a>
                    </div>
                  </div>
                </form>
              <?php } else { ?>
                <form action="<?= base_url('mitra/alamat_tambah')?>" method="post" enctype="multipart/form-data">
                  <input id="id" type="hidden" name="id" value="<?= $mitra['id'] ?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="map">Map</label>
                        <div class="panel-body" style="height:300px;" id="map-canvas"></div>
                        <small class="text-muted">Note : membuat tanda dengan klik kanan, jika tanda lebih dari 1 maka yang di baca yang ter akhir di tandai.</small>
                        <input type="hidden" class="form-control" name="latitude" id="latitude">
                        <input type="hidden" class="form-control" name="longitude" id="longitude"> 
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button> <a href="" class="btn btn-primary" id="clearmap"><span class="glyphicon glyphicon-globe"></span> Hapus tanda</a>
                    </div>
                  </div>
                </form>
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
