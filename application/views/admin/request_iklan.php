
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Gambar Iklan</th>
                <th scope="col">Bukti Transfer</th>
                <th scope="col">Lama Iklan</th>
                <th scope="col">Tanggal Request</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <tr>
                <?php
                    $i = 1;
                   foreach ($reqiklan as $row) {
                  ?>
                <th scope="row"><?= $i++?></th>
                <td><?= $row['nama'] ?></td>
                <td><a  href="" data-toggle="modal" data-target="#myModal<?= $row['id']  ?>"><img src="<?= base_url('img/admin/request_iklan/') . $row['iklan'];?>" class="img-fluid" style=" height: 100px; width: 300px;"></a></td>
                <td><a href="" data-toggle="modal" data-target="#myModall<?= $row['id']  ?>"><img src="<?= base_url('img/admin/request_iklan/') . $row['bukti'];?>" class="img-fluid" style=" height: 100px; width: 300px;"></a></td>
                <td><?= $row['bulan'] ?></td>
                <td><?= date('d F Y', $row['date_created']) ?></td>
                <?php 
                if ($row['status'] == 1) {?>
                <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } else { ?>
                <td>
                <a href="" data-toggle="modal" data-target="#edit<?= $row['id']  ?>" class="btn btn-primary">Terbitkan</a>
                </td>
                <?php } ?>
              </tr>
              <div class="modal fade" id="edit<?= $row['id']  ?>" role="dialog">
              <div class="modal-dialog modal-mt" style="margin-top: 200px;">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>admin/action_tambah_iklan" enctype="multipart/form-data">
                  <div class="modal-header">
                    <h4 class="modal-title">Perpanjang Iklan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                   <?php
                    $lama = 0;
                    if ($row['bulan'] == 1) {
                      $lama = 30;
                    } else if($row['bulan'] == 2){
                      $lama = 60;
                    } else if($row['bulan'] == 3){
                      $lama = 90;
                    } else if($row['bulan'] == 4){
                      $lama = 120;
                    } else if($row['bulan'] == 5){
                      $lama = 150;
                    } else if($row['bulan'] == 6){
                      $lama = 180;
                    } else if($row['bulan'] == 7){
                      $lama = 210;
                    } else if($row['bulan'] == 8){
                      $lama = 240;
                    } else if($row['bulan'] == 9){
                      $lama = 270;
                    } else if($row['bulan'] == 10){
                      $lama = 300;
                    } else if($row['bulan'] == 11){
                      $lama = 330;
                    } else if($row['bulan'] == 12){
                      $lama = 360;
                    } else{}
                    $batas = (time()+((60*60*24)*$lama)); //  strtotime('2020-02-02 14:18:00');
                    $jam = date('H', $row['date_created']);
                    $menit = date('i', $row['date_created']);
                    $detik = date('s',$row['date_created']);
                    $hari = date('d', $batas);
                    $bulan = date('m',$batas);
                    $tahun = date('Y',$batas);
                    $waktu_tujuan = mktime($jam,$menit,$detik,$bulan,$hari,$tahun);
                    $waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                    $selisih_waktu = $waktu_tujuan - $waktu_sekarang;
                    $jumlah_hari = floor($selisih_waktu/86400);
                    $sisa = $selisih_waktu % 86400;
                    $jumlah_jam = floor($sisa/3600);
                    $sisa = $sisa % 3600;
                    $jumlah_menit = floor($sisa/60);
                    $sisa = $sisa % 60;
                    $jumlah_detik = floor($sisa/1);
                              
                              
                   ?>
                  <div class="modal-body">
                    <input type="hidden" name="id_iklan" class="form-control" value="<?= $row['id']?>">
                    <input type="hidden" name="email" class="form-control" value="<?= $row['email']?>">
                  <div class="form-group">
                        <label for="company">Gambar Iklan</label>
                        <input type="file" class="form-control" id="foto" placeholder="Foto" name="foto_iklan">
                        <small class="text-danger"> <?= form_error('iklan'); ?></small>
                   </div>
                  <div class="form-group">
                    <label for="date">Tanggal Selesai</label>
                    <input type="text" class="form-control" disabled placeholder="Khusus Iklan" name="tgl_selesai" value="<?= date('d F Y', $waktu_tujuan) ?>">
                    <input type="date" class="form-control" id="date" placeholder="Khusus Iklan" name="tgl_selesai" value="<?= date('d-F-Y', $waktu_tujuan) ?>">
                    <small class="text-danger"> <?= form_error('tgl_selesai'); ?></small>
                  </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-sm btn-secondary">Kirim</button>
                  </div>
                  
                  </form>
                </div>
                
              </div>
              </div>

              <div class="modal fade" id="myModal<?= $row['id'] ?>" role="dialog">
              <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>admin/tambah">
                  <div class="modal-header">
                    <h4 class="modal-title">Iklan Priview</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <img src="<?= base_url('img/admin/request_iklan/') . $row['iklan'];?>" class="img-fluid" style=" height: 200px; width: 750px;">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tutup</button>
                  </div>
                  </form>
                </div>
              </div>
              </div>

              <div class="modal fade" id="myModall<?= $row['id'] ?>" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>admin/tambah">
                  <div class="modal-header">
                    <h4 class="modal-title">Bukti Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <img src="<?= base_url('img/admin/request_iklan/') . $row['bukti'];?>" class="img-fluid" style=" height: 300px; width: 500px;">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tutup</button>
                  </div>
                  </form>
                </div>
              </div>
              </div>
              <?php
                }
                ?>
            </tbody>
          </table>
          

        </div>

        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



