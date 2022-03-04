

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Daftar Pesanan</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
            </div>
            <div class="col-lg-12" style="padding-bottom: 170px;">
              <div class="box">
                <h1>Detail Pesanan</h1>
                 <table class="table table-striped">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Product</th>
                    <th></th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
            <tbody>
              
                <?php
                  $i = 1;
                  foreach ($nama_catering as $row) {
                  $user = $this -> db ->get_where('user', ['id' => $row['id_user']])->row_array();
                  $invoice = $this -> db ->get_where('invoice', ['no_invoice' => $row['no_invoice']])->row_array();
                  $kecamatan = $this -> db ->get_where('kecamatan', ['id_kecamatan' => $invoice['kecamatan']])->row_array();
                  $pesanan = $this -> db ->get_where('pesanan', ['invoice' => $row['no_invoice']])->row_array();
                  $makanan = $this -> db ->get_where('makanan', ['product_id' => $row['product_id']])->row_array();
                  $jumlah = $makanan['harga'] * $row['qty'];
                  $awal  = date_create(); //waktu sekarang
                  $akhir = date_create($invoice['tgl_acara']); // waktu acara
                  $diff  = date_diff( $awal, $akhir );
                  ?>
              <tr class="text-center">
                  <td><?= $i++?></td>
                  <td><a href="" class="front"><img src="<?= base_url('img/product/') . $makanan['image'];?>" class="img-fluid" style="width: 100px; height: 50px;"></a></td>
                  <td style="text-transform: capitalize;"><a href=""><?= $makanan['nama']?></a></td>
                  <td><?= $row['qty'] ?> / Paket</td>
                  <td>Rp,  <?= number_format($makanan['harga'])?></td>
                  <td>
                  <a href="" data-toggle="modal" data-target="#isiPaket<?= $row['id'] ?>" class="btn btn-primary">Isi Paket</a>
                  </td>
                  <td>
                  <?php if ($row['status_pesanan'] == 0){ ?>
                  <a href="<?= base_url('mitra/update_status_terima/' . $row['id'].'/'. $mitra['id'])?>" class="btn btn-primary">Terima</a> <a  href="<?= base_url('mitra/tolak_pesanan/' . $row['id'].'/'. $mitra['id'])?>" class="btn btn-primary" style="background: #f30000">Tolak</a>
                  <?php } else { ?>
                  <a href="" data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-primary">Detail</a>
                  <?php } ?>
                  </td>
                  </tr>
              <div class="modal fade" id="isiPaket<?= $row['id'] ?>" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi || No. <?= $row['no_invoice']?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <div>
                    <h5>Tanggal Acara : <?= date('d/m/Y' , strtotime($invoice['tgl_acara']))  ?></h5>
                    <p>Jam Acara : <?= $invoice['jam_acara'] ?></p>
                    <p style="text-transform: capitalize;">Alamat : <?= $invoice['alamat']?>, <?= $kecamatan['kecamatan']?>, <?= $invoice['kode_pos']?></p>
                    <div class="text-right"><a href="<?= base_url('mitra/alamat_pesanan/'. $row['no_invoice']) ?>" class="btn btn-primary btn-sm">Lihat Map</a></div>
                    <hr>
                     <p><?= $makanan['deskripsi'] ?></p>
                  </div>
                  </div>

                  <div class="modal-footer">

                   
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                  </div>
                  </form>
                </div>
                
              </div>
              </div>
               <div class="modal fade" id="myModal<?= $row['id'] ?>" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi || No. <?= $row['no_invoice']?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <div>
                    <h5>Tanggal Acara : <?= date('d/m/Y' , strtotime($invoice['tgl_acara']))  ?></h5>
                    <p>Jam Acara : <?= date('h:i', strtotime($invoice['jam_acara'])) ?></p>
                    <p style="text-transform: capitalize;">Alamat : <?= $invoice['alamat']?>, <?= $kecamatan['kecamatan']?>, <?= $invoice['kode_pos']?></p>
                    <div class="text-right"><a href="<?= base_url('mitra/alamat_pesanan/'. $row['no_invoice']) ?>" class="btn btn-primary btn-sm">Lihat Map</a></div>
                    <hr>
                     <?php
                    $id_simpanpesanan= $row['id'] ;
                    $cek = $this-> db -> get_where('simpan_pesanan', ['id' => $id_simpanpesanan]) -> row_array();
                    if ($cek['status_pesanan'] == 1) {
                     ?>
                     <small class="text-muted">Update Status Pesanan!</small>
                     <br><a href="<?= base_url('mitra/update_status_proses/' . $row['id'].'/'. $mitra['id'])?>"  class="btn btn-primary">Di Proses</a> <a  class="btn btn-primary">Di Kirim</a>
                    <?php } else if($cek['status_pesanan'] == 2){ ?>
                      <small class="text-muted">Update Status Pesanan!</small>
                      <form action="<?= base_url('mitra/update_status_kirim')?>" method="post">
                        <input type="hidden" name="id_pesanan" value="<?= $row['id'] ?>">
                        <input type="hidden" name="bayar" value="<?= $invoice['total'] ?>">
                     <br><a  class="btn btn-primary">Di Proses</a> <button class="btn btn-primary">Di Kirim</button>
                      </form>
                    <?php } else if($cek['status_pesanan'] == 3){ ?>
                      <h5>Tunggu user menyelesaikan Pesanan </h5>
                    <?php } else if($cek['status_pesanan'] == 4){ ?>
                      <h5>Tunggu user memberikan rating atas pelayanan anda </h5>
                    <?php } else if($cek['status_pesanan'] == 5){ ?>
                      <h5 class="text-danger">Anda telah menolak pesanan</h5>
                    <?php } else if($cek['status_pesanan'] == 6){ ?>
                      <h5>Pesanan telah selesai </h5>
                      <?php 
                      if ($reting['rate'] == 5) { ?>
                      <div style="color: #FFC107">
                      Rating : <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 
                      </div>
                      <div>
                        Komentar : <?= $reting['koment'] ?>
                        Saran : <?= $reting['saran'] ?>
                      </div>
                      <?php } else if ($reting['rate'] == 4) { ?>
                        <div style="color: #FFC107">
                      Rating : <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <div>
                        Komentar : <?= $reting['koment'] ?>
                        Saran  : <?= $reting['saran'] ?>
                      </div>
                      <?php } else if ($reting['rate'] == 3) { ?>
                      <div style="color: #FFC107">
                      Rating : <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <div>
                        Komentar : <?= $reting['koment'] ?>
                        Saran  : <?= $reting['saran'] ?>
                      </div>
                      <?php } else if ($reting['rate'] == 2) { ?> 
                      <div style="color: #FFC107">
                      Rating : <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <div>
                        Komentar :<?= $reting['koment'] ?>
                        Saran  : <?= $reting['saran'] ?>
                      </div>
                      <?php } else if ($reting['rate'] == 1) { ?>
                      <div style="color: #FFC107">
                      Rating : <i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <div>
                        Komentar : <?= $reting['koment'] ?>
                        Saran  : <?= $reting['saran'] ?>
                      </div>
                      <?php } else { ?>
                        <br><p>Tidak di Rating</p>
                      <?php } ?>
                    <?php } else {} ?>
                  </div>
                  </div>

                  <div class="modal-footer">

                   
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
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
        </div>
</div>
</div>

          
