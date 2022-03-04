<div id="wrapper">
  <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Content Row -->
          <div class="row">
            <?php 
                  $i = 0;
                  $a = 0;
                  $b = 0;
                  $c = 0;
                  $d = 0;
                  $e = 0;
                  $f = 0;
                  $batal = 0;
                  $diterima = 0;
                  $diperoses = 0;
                  $dikirim = 0;
                  $rate = 0;
                  $selesai = 0;
                  $panding = 0;
                  $bulanan = 0;
                  $acc = 0;
                  foreach (array_reverse($pesanan) as $row) {
                  $i++;
                  $pesan = $this-> db -> get_where('pesanan', ['invoice' => $row['invoice']]) -> row_array();
                  $simpan_pesan = $this-> db -> get_where('simpan_pesanan', ['no_invoice' => $row['invoice']]) -> row_array();
                  $makanan =  $this-> db -> get_where('makanan', ['product_id' => $simpan_pesan['product_id']]) -> row_array();
                  $mitraa = $this-> db -> get_where('mitra', ['id' => $makanan['id_mitra']]) -> row_array();
                  if ($mitraa) {
                  if ($simpan_pesan['status_pesanan'] == 0){
                    $acc += 1;
                  }
                  else if ($simpan_pesan['status_pesanan'] == 1){
                    $b += 1;
                    $panding += $pesan['total'] ;
                  }
                  else if ($simpan_pesan['status_pesanan'] == 2){
                    $c += 1;
                    $panding += $pesan['total'] ;
                  }
                  else if ($simpan_pesan['status_pesanan'] == 3){
                    $d += 1;
                    $panding += $pesan['total'] ;                   
                  }
                  else if ($simpan_pesan['status_pesanan'] == 4){
                    $e += 1;
                    $f += 1;
                    $bulanan = $mitra['dompet_saldo']  ;
                  }
                  else if ($simpan_pesan['status_pesanan'] == 6){
                    $f += 1;
                    $bulanan = $mitra['dompet_saldo']  ;
                  }
                  else if ($simpan_pesan['status_pesanan'] == 5){
                    $a += 1;  
                  }
                  else {
                    break;
                  }
                
                 ?>
                 
               <?php 
                      if ($a == 0){
                        $batal = 0;
                      }
                      else if ($b == 0){
                        $diterima = 0;
                      }
                      else if ($c == 0){
                        $diperoses = 0;
                      }
                      else if ($d == 0){
                        $dikirim = 0;
                      }
                      else if ($e == 0){
                        $selesai = 0;  
                      }
                      else {
                        
                      }

                      $batal = ($a / $i) * 100;
                      $diterima = ($b / $i ) * 100;
                      $diperoses = ($c / $i) * 100;
                      $dikirim = ($d / $i) * 100;
                      $selesai = ($f / $i) * 100;

                  } else {
                    break;
                  }
                }
                ?>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan (Di Terima)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp, <?=  number_format($bulanan,0,",",".") ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pendapatan (Panding)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp, <?=  number_format($panding,0,",",".") ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Selesai</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($selesai) ?>%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $selesai ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="<?= base_url('mitra/lihat_pesanan_status/' . $mitra['id'] )?>/0" class="text-danger" style="text-decoration: none;">Pesanan Belum Diterima</a></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?=  $acc ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-times fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pesanan</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Pesanan Batal <span class="float-right"><?= number_format($batal) ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $batal ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Pesanan Diterima <span class="float-right"><?= number_format($diterima) ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $diterima ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Pesanan Diproses <span class="float-right"><?= number_format($diperoses) ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: <?= $diperoses ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Pesanan Dikirim <span class="float-right"><?= number_format($dikirim) ?>%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= $dikirim ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Pesanan Selesai <span class="float-right"><?= number_format($selesai) ?>%</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= $selesai ?>%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>

              <!-- Color System -->

                
                
                
                
                



            </div>


          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
  </div>