
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
                  <ul class="nav nav-pills flex-column"><a href="<?= base_url('user/dompet/'. $user['id'])?>" class="nav-link"><i class="fa fa-google-wallet"></i> Dompet</a><a href="<?= base_url('user/isi_saldo/'. $user['id'])?>" class="nav-link"><i class="fa fa-heart"></i> isi saldo</a><a href="<?= base_url('user/tarik_saldo/'. $user['id'])?>" class="nav-link">&nbsp;<i class="fas fa-hand-holding"></i> &nbsp;Tarik Saldo </a><a href="<?= base_url('user/history/'. $user['id'])?>" class="nav-link"><i class="fa fa-history" aria-hidden="true"></i> &nbsp;History </a><a href="<?= base_url('user/index/'. $user['id'])?>" class="nav-link"><i class="fa fa-sign-out"></i> lanjut Belanja </a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <div class="row">
                <div class="card col-md-6 mr-4 ml-3">
                <div class="row no-gutters">
                  <div class="col-md-4 mt-3">
                  <img src="<?= base_url('img/dompet.jpg');?>" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Dompet</h5>
                    <p class="card-text"><?= $dompet['email']; ?></p>
                    <p class="card-text"><small class="text-muted"></small></p>
                    <p class="card-text">Saldo : Rp. <?= number_format($dompet['saldo'],0,",","."); ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $dompet['date_created']); ?></small></p>
                  </div>               
                   <div class="text-right mb-3">
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>


          <div class="col-lg-13">
              <div class="box">
                <div class="row">
                  <h3 class="text-left">Histori Pengisian Saldo</h3>
                   <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col" >No</th>
                <th scope="col">Jumlah Di isi</th>
                <th scope="col">Saldo Akhir</th>
                <th scope="col">Tanggal Pengisian</th>
                <th scope="col">Status</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $i = 1;
              foreach (array_reverse($isi_saldo) as $row) {


              ?>

              <tr style="text-align: center;width: 140px;" >
                <th scope="row"><?= $i++?></th>
                <td class="text-danger">Rp <?= number_format($row['jumlah'],0,",",".")?></td>
                <?php if($row['status_isisaldo'] == 0){ ?>
                <td class="text-danger">Rp <?= number_format($dompet['saldo'],0,",",".")?></td>
                <?php } else { ?>
                <td class="text-success">Rp <?= number_format($dompet['saldo'],0,",",".")?></td>
                <?php } ?>
                
                <td><?= date("d/m/Y", $row['date_created'])?></td>
                <?php if($row['status_isisaldo'] == 0){ ?>
                <td class="text-warning"><i class="fas fa-times-circle"></i></td>
                <?php } else if ($row['status_isisaldo'] == 2) {?>
                <td class="text-danger"><i class="fas fa-times-circle"></i></td>
                <?php } else { ?>
                <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } ?>
               </tr>
             <?php } ?>
            </tbody>
          </table>

          </div>
        </div>
      </div>

      <div class="col-lg-13">
              <div class="box">
                <div class="row">
                  <h3 class="text-left">Histori Penarikan Saldo</h3>
                   <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col" >No</th>
                <th scope="col">Jumlah Di Tarik</th>
                <th scope="col">Saldo Akhir</th>
                <th scope="col">Tanggal Penarikan</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              foreach (array_reverse($tarik_saldo) as $row) {


              ?>
              <tr style="text-align: center;width: 140px;" >
                <th scope="row"><?= $i++?></th>
                <td class="text-danger">Rp <?= number_format($row['jumlah'],0,",",".")?></td>
                <?php if($row['status'] == 0){ ?>
                <td class="text-danger">Rp <?= number_format($dompet['saldo'],0,",",".")?></td>
                <?php } else { ?>
                <td class="text-success">Rp <?= number_format($dompet['saldo'],0,",",".")?></td>
                <?php } ?>
                
                <td><?= date("d/m/Y", $row['date_created'])?></td>
                <?php if($row['status'] == 0){ ?>
                <td class="text-danger"><i class="fas fa-times-circle"></i></td>
                <?php } else { ?>
                <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } ?>
               </tr>
             <?php } ?>
            </tbody>
          </table>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
</div>

