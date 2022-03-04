

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
                  <ul class="nav nav-pills flex-column">
                    <a href="<?= base_url('mitra/detail_pesanan/'. $pesanan['no_invoice'])?>" class="nav-link"><i class="fa fa-sign-out"></i> kembali</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h3>Alamat Mitra</h3>
                  <input id="id" type="hidden" name="id" value="<?= $mitra['id'] ?>">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="map">Map</label>
                        <div class="panel-body"><?php echo $map['html'];?></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
