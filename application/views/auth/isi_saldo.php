
    <!-- navbar-->

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">My account</li>
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
                  <h3 class="h4 card-title">Customer section</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column"><a href="<?= base_url('user/dompet/'. $user['id'])?>" class="nav-link"><i class="fa fa-list"></i> Dompet</a><a href="<?= base_url('user/isi_saldo/'. $user['id'])?>" class="nav-link"><i class="fa fa-heart"></i> isi saldo</a><a href="<?= base_url('user/index/'. $user['id'])?>" class="nav-link"><i class="fa fa-sign-out"></i> lanjut Belanja </a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>Form Pengisian Saldo</h1>
                <hr>
                <form action="<?= base_url('user/tambah_saldo')?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="hidden" name="id_user" value="<?= $dompet['user_id']?>">
                    <input type="hidden" name="email" value="<?= $dompet['email']?>">
                    <input type="text" name="z" placeholder="<?= $dompet['email']?>" class="form-control" disabled value="<?= $user['email']?>" >
                    <small class="text-danger" > <?= form_error('email'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="ats_nama">Nama Pengirim</label>
                    <input type="text" name="nama_pengirim" placeholder="Nama Pengirim?" class="form-control" value="<?= set_value('nama_pengirim') ?>">
                    <small class="text-danger"> <?= form_error('nama_pengirim'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="saldo">Jumlah yang diisi?</label>
                    <input type="text" name="saldo" placeholder="Jumlah yang di transfer" class="form-control" <?= set_value('saldo') ?>>
                    <small class="text-danger"> <?= form_error('saldo'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="foto">Bukti Transfer</label>
                    <input type="file" class="form-control" id="foto" placeholder="Foto" name="image" <?= set_value('image') ?>>
                    <small class="text-danger"> <?= form_error('image'); ?></small>
                  </div>        
                  <div class="text-center">
                    <button type="submit" value="Daftar" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Kirim </button>
                  </div>
                  <p class="text text-muted"><i>Cara Mengisi saldo.</i><a href="#" data-toggle="modal" data-target="#info-isi"><i> Klik</i></a></p>
                </form>
              </div>
            </div>
              <div id="info-isi" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                <div class="modal-dialog modal-lm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Info Pengisian Saldo</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                      1.  Kirim kan saldo yang ingin di isi ke rekening Catering mart dengan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;nomor 4987562458 (BCA).<br>
                      2.  Klik logo dompet cemart dibagian pojok kanan atas.<br>
                      3.  Klik Isi saldo, maka akan di arahkan ke Dompet Isi saldo.<br>  
                      4.  Isi data yang deperlukan.<br>
                      <p class="text-right">
                        <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-secondary">Tutup</button>
                      </p>
                    </form>
                  </div>
                </div>
          </div>
        </div>
    </div>
  </div>
</div>
</div>

