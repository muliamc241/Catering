        <?php 
            $u = 0;
            foreach ($online as $row) {
              $u += $row['online'];
            }
        ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php
            date_default_timezone_set('Asia/Jakarta');//Menyesuaikan waktu dengan tempat kita tinggal
            $timestamp = date('d M Y');//Menampilkan Jam Sekarang
            ?>
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <h2 id="carasingkat"></h2>
            <div class="text-left">
              <h2 id="jam"></h2>
            </div>
            
          </div>

          <!-- Content Row -->
          <div class="row">
            <?php 
            $l = 0;
            foreach ($pesananbulanan as $row) {
              $l++;
            }
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesanan Bulanan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $l ?></div>
                    </div>
                    <a href="" data-toggle="modal" data-target="#bulanan" class="btn btn-warning">detail</a> &nbsp;
                    <div class="col-auto">
                     <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             <?php 
            $jnyk = 0;
            foreach ($sblm_pesan as $row) {
              $jnyk++;
            }
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pesanan hari sebelumnya</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jnyk ?></div>

                    </div>
                    <a href="" data-toggle="modal" data-target="#info-modals" class="btn btn-success">detail</a> &nbsp;
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
            $bnyk = 0;
            foreach ($pesan as $row) {
              $bnyk++;
            }
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Hari ini</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $bnyk ?></div>

                    </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="" data-toggle="modal" data-target="#info-modal" class="btn btn-info">detail</a> &nbsp;
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php 
            $k = 0;
            foreach ($biaya as $row) {
              $k += $row['jumlah'];
            }
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Biaya Pesanan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($k,0,",",".") ?></div>

                    </div>
                    <!-- <a href="" data-toggle="modal" data-target="#info-modal" class="btn btn-info">detail</a> &nbsp; -->
                    <div class="col-auto">
                      <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

            <div id="bulanan" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                 <div class="modal-header">
                  <h5 class="modal-title">Pesanan Bulanan</h5>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body" style="overflow: auto; height: 500px;">
                  <table class="table table-striped">
                    <thead>
                     <tr>
                      <th scope="col">No</th>
                      <th scope="col">No invoice</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Tanggal Pesan</th>
                      <th scope="col">Tanggal Acara</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i= 1;
                    foreach ($pesananbulanan as $row) {
                      $user = $this-> db -> get_where('user', ['id' => $row['id_user']]) -> row_array();
                    ?>
                    <?php 
                    if($l == 0){?>
                      <tr>
                      <th scope="row">1</th>
                      <td colspan="3">Tidak ada Pesanan</td>
                      </tr>
                      <?php } else { ?>
                       <tr>
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $row['invoice']?></td>
                        <td><?= $user['nama']  ?></td>
                        <td><?= date("d M Y", strtotime($row['tgl_pesan']) )?></td>
                        <td><?= date("d M Y", strtotime($row['tgl_acara']))?></td>
                        </tr>
                      <?php } ?>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>

                <div id="info-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Pesanan Hari ini </h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body" style="overflow: auto; height: 500px;">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">No invoice</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Tanggal Acara</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $i= 1;
                            foreach ($pesan as $row) {
                              $user = $this-> db -> get_where('user', ['id' => $row['id_user']]) -> row_array();
                            ?>

                          <?php 
                            if($bnyk == 0){?>
                          <tr>
                            <th scope="row">1</th>
                            <td colspan="3">Tidak ada Pesanan</td>
                          </tr>
                          <?php } else { ?>
                          <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $row['invoice']?></td>
                            <td><?= $user['nama']  ?></td>
                            <td><?= date("d M Y", strtotime($row['tgl_pesan']) )?></td>
                            <td><?= date("d M Y", strtotime($row['tgl_acara']))?></td>
                          </tr>
                          <?php } ?>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

                <div id="info-modals" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Pesanan Hari Sebelumnya </h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body" style="overflow: auto; height: 500px;">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">No invoice</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Tanggal Acara</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $i= 1;
                            foreach ($sblm_pesan as $row) {
                              $user = $this-> db -> get_where('user', ['id' => $row['id_user']]) -> row_array();
                            ?>
                          <?php 
                            if($jnyk == 0){?>
                          <tr>
                            <th scope="row">1</th>
                            <td colspan="2">Tidak ada Pesanan</td>
                          </tr>
                          <?php } else { ?>
                          <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <td><?= $row['invoice']?></td>
                            <td><?= $user['nama']  ?></td>
                            <td><?= date("d M Y", strtotime($row['tgl_pesan']) )?></td>
                            <td><?= date("d M Y", strtotime($row['tgl_acara']))?></td>
                          </tr>
                          <?php } ?>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Histori Login</h6>
                  <div class="dropdown no-arrow">
                    Online <a class="btn btn-success rounded" style="color: #fff"><?= $u ?></a>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <div style="overflow: auto; height: 320px;">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Login</th>
                            <th scope="col">Logout</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                              $i = 1; 
                              foreach (array_reverse($online) as $row) {
                              $user = $this-> db -> get_where('user', ['id' => $row['id_user']]) -> row_array();
                              $mitra = $this-> db -> get_where('mitra', ['id' => $row['id_user']]) -> row_array();
                              date_default_timezone_set("ASIA/JAKARTA");
                          ?>
                          <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <?php if ($user){ ?>
                            <td><?= $user['nama']  ?></td>
                            <?php  } else { ?>
                            <td><?= $mitra['nama_toko'] ?></td>
                            <?php } ?>
                            <td><?= date("H:i:s", strtotime('-24 hours',$row['start']))?></td>
                            <?php if($row['off'] > 0){
                            ?>
                            <td><?= date("H:i:s", strtotime('-24 hours',$row['off']))?></td>
                            <td>Offline</td>
                           <?php } else { ?>
                            <td>-</td>
                            <td>Online</td>
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
                  
                  $simpan_pesanan = $this-> db -> get_where('simpan_pesanan', ['no_invoice' => $row['no_invoice']]) -> row_array();
                  $mitra = $this-> db -> get_where('mitra', ['id' => $simpan_pesanan['id_mitra']]) -> row_array();
                  $pesanan = $this-> db -> get_where('pesanan', ['invoice' => $row['no_invoice']]) -> row_array();
                  if ($mitra) {
                  if ($simpan_pesanan['status_pesanan'] == 0){
                    $acc += 1;
                  }
                  else if ($simpan_pesanan['status_pesanan'] == 1){
                    $b += 1;
                    $panding += $pesanan['total'] ;
                  }
                  else if ($simpan_pesanan['status_pesanan'] == 2){
                    $c += 1;
                    $panding += $pesanan['total'] ;
                  }
                  else if ($simpan_pesanan['status_pesanan'] == 3){
                    $d += 1;
                    $panding += $pesanan['total'] ;                   
                  }
                  else if ($simpan_pesanan['status_pesanan'] == 4){
                    $e += 1;
                    $f += 1;
                    $panding += $pesanan['total'] ;
                  }
                  else if ($simpan_pesanan['status_pesanan'] == 6){
                    $f += 1;
                    $bulanan += $pesanan['total']  ;
                  }
                  else if ($simpan_pesanan['status_pesanan'] == 5){
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
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

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



            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Komentar User</h6>
                </div>
                
                <div class="card-body">
                  <div id="demo" class="carousel slide" data-ride="carousel">

                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <li data-target="#demo" data-slide-to="0"></li>
                      <li data-target="#demo" data-slide-to="1"></li>
                      <li data-target="#demo" data-slide-to="2"></li>
                    </ul>
                    
                    
                    <!-- The slideshow -->
                    <div class="carousel-inner">  
                      <?php 
                      $as = 1;
                      foreach ($rating as $row) {
                       $user =  $this -> db -> get_where('user', ['id' => $row['id_user']]) -> row_array();
                      ?>
                      <div class="carousel-item <?php if($as <=1){ echo " active ";} ?>">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title"><?= $user['nama'] ?></h5>
                            <p class="card-text"><?= $row['koment'] ?></p>
                            <div class="text-right">
                            <!-- <a href="#" class="btn btn-primary">Hapus</a> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php $as++ ?>
                      <?php }  ?>
                    </div>
                    
                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                      <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                      <span class="carousel-control-next-icon"></span>
                    </a>
                  </div>
                </div>
                </div>



            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>