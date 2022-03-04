
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
            <div class="col-lg-3 mt-3">
              <!--
              *** CUSTOMER MENU ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu">
                <div class="card-header">
                  <h3 class="h4 card-title">Menu</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column">
                    <a href="<?= base_url('mitra/dompet_mitra')?>" class="nav-link"><i class="fa fa-google-wallet" aria-hidden="true"></i> Dompet</a>
                    <a href="<?= base_url('mitra/vtarik_saldo')?>" class="nav-link"> &nbsp;<i class="fas fa-hand-holding" aria-hidden="true"></i> &nbsp;Tarik Saldo</a>
                  </ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>Form Penarikan Saldo</h1>
                <hr>
                <form action="<?= base_url('mitra/tarik_saldo')?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="hidden" name="email" value="<?= $mitra['email']?>">
                    <input type="text" name="z" class="form-control" disabled value="<?= $mitra['email']?>" >
                    <small class="text-danger" > <?= form_error('email'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="saldo">Jumlah yang ingin ditarik?</label>
                    <input type="number" name="saldo" placeholder="Jumlah yang di tarik?" class="form-control">
                    <small class="text-danger"> <?= form_error('saldo'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="foto">Bank</label>
                    <input type="text" class="form-control" id="bank" placeholder="Bank?" name="bank">
                    <small class="text-danger"> <?= form_error('bank'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="saldo">Nomor Rekening</label>
                    <input type="number" name="rekening" placeholder="Nomor Rekening" class="form-control">
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

