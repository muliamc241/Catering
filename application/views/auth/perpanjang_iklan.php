
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
                  <h3 class="h4 card-title">Note</h3>
                </div>
                <div class="card-body">
                  <div class="alert alert-danger" role="alert">
                   <p>- Sebelum mengisi formulir kirim biaya iklan, Rp, 200.000/Bulan.<br>- Perpanjang iklan Rp, 150.000/Bulan, untuk formulir nya. <a href="">Klik</a></p>
                  </div>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9" style="margin-bottom: 100px;">
              <div class="box">
                <h3>Formulir Perpanjang Iklan</h3>
                <form action="<?= base_url('auth/perpanjang_iklanAction')?>" method="post" enctype="multipart/form-data">
                  <input id="email" type="hidden" name="email" value="<?= $email ?>">
                  <input type="hidden" name="id_iklan" value="<?= $id_iklan ?>">
                  <input type="hidden" name="token" value="<?= $token ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="email" disabled value="<?= $email ?>" class="form-control">
                        <small class="text-danger"> <?= form_error('email'); ?></small>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control">
                        <small class="text-danger"> <?= form_error('nama'); ?></small>
                      </div>
                    </div>
                  </div>
                  <!-- /.row-->
                  <div class="row">
                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                        <label for="">Bukti Transfer</label>
                        <input type="file" class="form-control" id="foto" placeholder="Foto" name="foto_transfer">
                        <small class="text-danger"> <?= form_error('foto_transfer'); ?></small>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                      <div class="form-group">
                          <label for="Email">Bulan</label>
                          <select class="form-control" name="bulan">
                            <?php 
                            $d = 0;
                            for ($i=0; $i < 12; $i++) {
                            $d++;
                            ?>
                            <option name="bulan" value="<?= $d ?>"><?= $d ?></option>
                            <?php } ?>
                          </select>
                          <small class="text-danger"> <?= form_error('bulan'); ?></small>
                        </div>
                    </div>
                
                      <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                        <label for="nama">Jumlah Transfer</label>
                        <input type="number" name="jml_transfer" class="form-control">
                        <small class="text-danger"> <?= form_error('jml_transfer'); ?></small>
                      </div>
                        
                      </div> 
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
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
