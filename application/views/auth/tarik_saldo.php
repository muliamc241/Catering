
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
                <h1>Form Penarikan Saldo</h1>
                <hr>
                <form action="<?= base_url('user/tarik_saldo')?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="hidden" name="email" value="<?= $user['email']?>">
                    <input type="text" name="z" class="form-control" disabled value="<?= $user['email']?>" >
                    <small class="text-danger" > <?= form_error('email'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="saldo">Jumlah yang ingin ditarik?</label>
                    <input type="number" name="saldo" placeholder="Jumlah yang di tarik?" class="form-control" value="<?= set_value('saldo') ?>">
                    <small class="text-danger"> <?= form_error('saldo'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="foto">Bank</label>
                    <select class="form-control" id="bank" placeholder="Bank?" name="bank" value="<?= set_value('bank') ?>">
                      <option value="">Pilih</option>
                      <option value="BNI">BNI</option>
                      <option value="Mandiri">Mandiri</option>
                      <option value="BCA">BCA</option>
                      <option value="BRI">BRI</option>
                    </select>
                    <small class="text-danger"> <?= form_error('bank'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="saldo">Nomor Rekening</label>
                    <input type="number" name="rekening" placeholder="Nomor Rekening" class="form-control" value="<?= set_value('rekening') ?>">
                    <small class="text-danger"> <?= form_error('rekening'); ?></small>
                  </div>      
                  <div class="text-center">
                    <button type="submit" value="Daftar" name="simpan" class="btn btn-primary"> Tarik </button>
                  </div>
                </form>
              </div>
            </div>
      </div>
    </div>
  </div>
  </div>

