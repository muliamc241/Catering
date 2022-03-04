
    <!-- navbar-->

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('mitra/index')?>">Home</a></li>
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
              <!-- <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
              <span class="sr-only">Loading…</span> -->

                <div class="card-header">
                  <h3 class="h4 card-title">Mitra</h3>
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
            <div class="col-lg-9 mb-5">
              <div class="box">
                <div class="row">
                <div class="card col-md-6 mr-4 ml-3 mb-5">
                <div class="row no-gutters">
                  <div class="col-md-4 mt-3">
                  <img src="<?= base_url('img/dompet.jpg');?>" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Dompet</h5>
                    <p class="card-text"><?= $mitra['email']; ?></p>
                    <?php if($mitra['dompet_saldo'] == 0){ ?>
                    <p class="card-text text-danger">Rp, <?= number_format($mitra['dompet_saldo'],0,",",".") ?></p>
                    <?php } else { ?>
                    <p class="card-text text-success">Rp, <?= number_format($mitra['dompet_saldo'],0,",",".") ?></p>
                    <?php } ?>
                    <p></p>
                    <p class="card-text"><small class="text-muted">Dompet Catering Mart © <?= Date('Y')?></small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

