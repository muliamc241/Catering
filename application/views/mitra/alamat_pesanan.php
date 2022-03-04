

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Daftar Pesanan</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
            </div>
            <div class="col-lg-12" style="padding-bottom: 170px;">
              <div class="box">
                <a href="<?= base_url('mitra/detail_pesanan/'. $pesanan['no_invoice'])?>" class="btn btn-primary">Kembali</a>
                <h1>Alamat Pesanan</h1>
                <hr>
                <div class="text-center">
                <?php echo $map['html'];?>
                <div id="directionsDiv"></div>
                </div>
                </div>                
              </div>
        </div>
</div>
</div>

          
