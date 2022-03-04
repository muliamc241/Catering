
    <!-- navbar-->

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
                  <h3 class="h4 card-title">Edit Data</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column"><a href="<?= base_url('mitra/vedit_toko')?>" class="nav-link">&nbsp;<i class="fas fa-user-cog"></i>&nbsp; Edit Profil</a>
                    <a href="<?= base_url('mitra/vedit_password')?>" class="nav-link">&nbsp;<i class="fas fa-user-lock" aria-hidden="true"></i>&nbsp; Ganti Password</a>
                    <?php 
                    $map = $this-> db -> get_where('map_mitra', ['id_mitra' => $mitra['id']]) -> row_array();
                    if($map){
                     ?>
                    <a href="<?= base_url('mitra/alamat_mitra')?>" class="nav-link"> &nbsp;<i class="fas fa-map-marked-alt"></i> &nbsp;&nbsp;Alamat</a>
                    <?php } else { ?>
                    <a href="<?= base_url('mitra/map')?>" class="nav-link"> &nbsp;<i class="fas fa-map-marked-alt"></i> &nbsp;&nbsp;Alamat</a>
                    <?php } ?>
                    <a href="<?= base_url('mitra/profil_mitra')?>" class="nav-link"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;kembali</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h3>Edit Profil</h3>
                <form action="<?= base_url('mitra/edit_toko')?>" method="post" enctype="multipart/form-data">
                  <input id="email" type="hidden" name="email" value="<?= $mitra['email']; ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Full Name</label>
                        <input type="text" name="nama_toko" value="<?= $mitra['nama_toko'] ?>" class="form-control">
                        <small class="text-danger"> <?= form_error('nama_toko'); ?></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Email</label>
                        <input id="email" type="text" disabled value="<?= $mitra['email']; ?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="street">No Hp</label>
                        <input id="no_hp" type="number" name="no_hp" value="<?= $mitra['no_hp']; ?>" class="form-control">
                        <small class="text-danger"> <?= form_error('no_hp'); ?></small>
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <img src="<?= base_url('img/profile/') . $mitra['image'];?>" class="img-thumbnail">
                      </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <input type="file" class="form-control"  placeholder="Foto" name="image">
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
