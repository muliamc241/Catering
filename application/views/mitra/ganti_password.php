
    <!-- navbar-->

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('mitra/mitra_index')?>">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active"><?= $title ?></li>
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
                    <a href="<?= base_url('mitra/profil_mitra')?>" class="nav-link"><i class="fa fa-sign-out"></i> kembali</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9" style="margin-bottom: 100px;">
              <div class="box">
                <h3>Ganti Password</h3>
                <form action="<?= base_url('mitra/edit_password')?>" method="post" enctype="multipart/form-data">
                  <input id="email" type="hidden" name="email" value="<?= $mitra['email']; ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Password Lama</label>
                        <input type="password" name="password_lama" class="form-control">
                        <small class="text-danger"> <?= form_error('password_lama'); ?></small>
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Password Baru</label>
                        <input type="password" name="password_baru1" class="form-control">
                        <small class="text-danger"> <?= form_error('password_baru1'); ?></small>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="company">Re Password Baru</label>
                        <input type="password" name="password_baru2" class="form-control">
                        <small class="text-danger"> <?= form_error('password_baru2'); ?></small>
                      </div>
                    </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ganti Password</button>
                    </div>
                  </div>
                  <!-- /.row-->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
