
<style>

.wrapper {
  position: relative;
  display: inline-block;
  border: none;
  font-size: 14px;
  margin: 5px;
  /*transform: translateX(-50%);*/
}

.wrapper input {
  border: 0;
  width: 1px;
  height: 1px;
  overflow: hidden;
  position: absolute !important;
  clip: rect(1px 1px 1px 1px);
  clip: rect(1px, 1px, 1px, 1px);
  opacity: 0;
}

.wrapper label {
  position: relative;
  float: right;
  color: #C8C8C8;
}

.wrapper label:before {
  margin: 5px;
  content: "\f005";
  font-family: FontAwesome;
  display: inline-block;
  font-size: 1.5em;
  color: #ccc;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.wrapper input:checked ~ label:before {
  color: #FFC107;
}

.wrapper label:hover ~ label:before {
  color: #ffdb70;
}

.wrapper label:hover:before {
  color: #FFC107;
}
</style>
 <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item"><a>My orders</a></li>
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
                  <ul class="nav nav-pills flex-column"><a href="" class="nav-link"><i class="fa fa-user"></i> My account</a>
                    <?php 
                    $email = $user['email'];
                    $dompet = $this-> db -> get_where('dompet', ['email' => $email]) -> row_array();
                    if (!$dompet) {
                    ?>
                    <a  class="nav-link"><i class="fa fa-google-wallet" aria-hidden="true"></i> Dompet</a>
                  <?php } else { ?>
                    <a href="<?= base_url('user/dompet')?>" class="nav-link"><i class="fa fa-google-wallet" aria-hidden="true"></i> Dompet</a>
                    <?php } ?>
                    <a href="<?= base_url('user/pesanan_user')?>" class="nav-link"><i class="fa fa-list"></i> Pesanan</a><a href="" class="nav-link"><i class="fa fa-sign-out"></i> Lanjut Belanja</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div id="customer-order" class="col-lg-9"  style="margin-bottom: 125px">
              <div class="box">
                <h1>Pesanan || No. #<?= $invoice['invoice'] ?></h1>
                <div class="text-right">
                  <a href="" data-toggle="modal" data-target="#gantiTanggal<?= $invoice['invoice'] ?>" class="btn btn-outline-secondary" style="margin-top: -80px; text-decoration: none;">Rubah tanggal acara</a>
                </div>
                <div class="table-responsive mb-4">
                  <table class="table">
                    <thead>
                      <tr class="text-center">
                          <th>No</th>
                          <th>Product</th>
                          <th></th>
                          <th>Quantity</th>
                          <th></th>
                          <th>Harga</th>
                          <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach (array_reverse($produk) as $row) {
                      // $xy = ($row['product_id'] - ($user['id'] * 10)) ;
                      $makanan = $this -> db ->get_where('makanan', ['product_id' => $row['product_id']])->row_array();
                      date_default_timezone_set('Asia/Jakarta');
                      $pesanan = $this -> db ->get_where('pesanan', ['invoice' => $row['no_invoice']])->row_array();
                      $invoicee = $this -> db ->get_where('invoice', ['no_invoice' => $row['no_invoice']])->row_array();
                      $mitra = $this -> db ->get_where('mitra', ['id' => $row['id_mitra']])->row_array();

                      $dompet = $this -> db ->get_where('dompet', ['email' => $user['email']])->row_array();
                      $simpan_biaya = $this -> db ->get_where('simpan_biaya', ['no_invoice' => $row['no_invoice']])->row_array();


                      ?>
                      <tr class="text-center">
                          <td><?= $i++?></td>
                          <td><a href="" class="front"><img src="<?= base_url('img/product/') . $makanan['image'];?>" class="img-fluid"></a></td>
                          <td style="text-transform: capitalize;"><a href="<?php echo base_url();?>shopping/detail_produk/<?php echo $row['product_id'];?>"><?= $makanan['nama']?></a></td>
                          <td><?= $row['qty'] ?> / Paket</td>
                          <td></td>
                          <td>Rp. <?= number_format($makanan['harga'])?></td>
                          <td>
                            <?php 
                            if ($row['status_pesanan'] == 1) {
                             ?>
                            <a data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-success"><i class="fas fa-clipboard-check"></i> Pesanan Telah Di konfirmasi</a>
                            <?php 
                            } else if ($row['status_pesanan'] == 2) {
                             ?>
                             <a data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-success">Di Masak</a>
                             <?php 
                            } else if ($row['status_pesanan'] == 3) {
                             ?>
                             <a data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-success"><i class="fas fa-shipping-fast"></i>Di Kirim</a>
                             <?php 
                            } else if ($row['status_pesanan'] == 4) {
                             ?>
                              <a data-toggle="modal" data-target="#rate_pesanan<?= $row['id'] ?>" class="btn btn-primary" style="float: right;">Reting Pesanan</a>
                            <?php 
                            } else if ($row['status_pesanan'] == 6) {
                             ?>
                             <a data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-success">Selesai</a>
                             <?php 
                            } else if ($row['status_pesanan'] == 5) {
                             ?>
                             <a data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-danger">Batal / Ditolak</a>
                           <?php } else { ?>
                             <a href="" data-toggle="modal" data-target="#myModal<?= $row['id'] ?>" class="btn btn-warning" style="color: #fff; text-decoration: none;">Menunggu Konfirmasi</a>
                           <?php } ?>
                          </td>
                        </tr>
                      <div class="modal fade" id="gantiTanggal<?= $invoice['invoice'] ?>" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- Modal content-->
                        <div class="modal-content">
                          
                          <div class="modal-header">
                            <h4 class="modal-title">Rubah Tanggal Acara?</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                           <form action="<?= base_url('user/rubah_tanggal')?>" method="post"> 
                            <input type="hidden" name="no_invoice" value="<?= $invoicee['no_invoice'] ?>">
                            <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                            <div class="form-group">
                                <label for="date">Tanggal Acara</label>
                                <input type="date" class="form-control" id="tgl_acara" placeholder="" name="tgl_acara" value="<?= $invoicee['tgl_acara'] ?>" >
                                <small class="text-danger"> <?= form_error('tgl_acara'); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="date">Jam Acara</label>
                                <input type="time" class="form-control" id="jam_acara" placeholder="" name="jam_acara" value="<?= $invoicee['jam_acara'] ?>" >
                                <small class="text-danger"> <?= form_error('jam_acara'); ?></small>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-primary">Rubah</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tidak</button>
                          </div>
                          </form>
                        </div>
                      </div>
                      </div>
                      <div class="modal fade" id="rate_pesanan<?= $row['id'] ?>" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- Modal content-->
                        <div class="modal-content">
                          
                          <div class="modal-header">
                            <h4 class="modal-title">Rating</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                           <form action="<?= base_url('user/rate_pesanan')?>" method="post"> 
                            <input type="hidden" name="id_pesanan" value="<?= $row['id'] ?>">
                            <input type="hidden" name="product_id" value="<?= $makanan['product_id'] ?>">
                            <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                            <div class="form-group">
                            <label for="keterangan">Rating Penjual</label>  
                            <ul class="menu list-inline mb-0">
                            <li class="list-inline-item">
                            <div class="wrapper">
                            <input type="radio" id="st1" value="5" name="rate" oninput="nilai(value)"/>
                            <label for="st1"></label>
                            <input type="radio" id="st2" value="4" name="rate" oninput="nilai(value)"/>
                            <label for="st2"></label>
                            <input type="radio" id="st3" value="3" name="rate" oninput="nilai(value)"/>
                            <label for="st3"></label>
                            <input type="radio" id="st4" value="2" name="rate" oninput="nilai(value)"/>
                            <label for="st4"></label>
                            <input type="radio" id="st5" value="1" name="rate" oninput="nilai(value)"/>
                            <label for="st5"></label>
                            <div><h4>Nilai Rating = <output for="vol" id="volume" style="margin-top: -50px;">1</output></h4></div>
                            
                            </div>
                            <li class="list-inline-item ml-3" ></li>
                            </ul>
                            </div>
                            <hr>
                              <div class="form-group">
                              <label for="koment">Komentari Makanan</label>
                              <?=
                                 $this->ckeditor->editor("koment","",set_value('koment'));
                              ?>
                              <small class="text-danger" > <?= form_error('koment'); ?></small>
                              </div>
                              <div class="form-group">
                              <label for="saran">Saran buat Penjual</label>
                              <?=
                                 $this->ckeditor->editor("saran","",set_value('saran'));
                              ?>
                              <small class="text-danger" > <?= form_error('saran'); ?></small>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-primary">Rate</button>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                          </div>
                          </form>
                        </div>
                      </div>
                      </div>
                      <div class="modal fade" id="myModal<?= $row['id'] ?>" role="dialog">
                      <div class="modal-dialog modal-md">
                        <!-- Modal content-->
                        <div  class="modal-content">
                          <?php
                              $batas = ($pesanan['date_created']+((60*60*24)*2)); //  strtotime('2020-02-02 14:18:00');
                              $jam = date('H', $pesanan['date_created']);
                              $menit = date('i', $pesanan['date_created']);
                              $detik = date('s',$pesanan['date_created']);
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
                              if ($row['status_pesanan'] == 0) {
                                if ($waktu_sekarang >= $waktu_tujuan) {
                                 $this->db->set('status_pesanan', 5);
                                 $this->db->where('id', $row['id']);
                                 $this->db->update('simpan_pesanan');

                                 $simpan_biaya['jumlah'] -= $makanan['harga'];
                                 $dompet['saldo'] += $simpan_biaya['jumlah'];
                                 $this->db->set('saldo',  $dompet['saldo']);
                                 $this->db->where('email', $user['email']);
                                 $this->db->update('dompet');

                                 $this->db->delete('simpan_biaya', ['no_invoice' => $row['no_invoice']]);
                                }
                              }
                              ?>
                          <div class="modal-header">
                            <h4 class="modal-title">Invoice</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                          <div>
                            <h5 style="text-transform: capitalize;">Nomor Invoice || <?= $row['no_invoice']?></h5>
                            <hr>
                            <?php 
                            if ($row['status_pesanan'] == 0) {
                             ?>
                            <p>Setatus pesanan : Menunggu Konfirmasi</p>
                            <p>Tanggal Pembelian : <?= date("d M Y", $invoice['date_created'])?> || <?= date("H:i:s", strtotime('-24 hours',$invoice['date_created']))?></p>
                            <p>Nama Catering : <?= $mitra['nama_toko'] ?></p>
                            Tanggal Acara : <?= date('d M Y', strtotime($pesanan['tgl_acara'])) ?><br>
                            <?php } else if($row['status_pesanan'] == 1) {
                            ?>
                            <p>Setatus pesanan : Pesanan Di Terima</p>
                            <p>Tanggal Pembelian : <?= date("d M Y", $invoice['date_created'])?> || <?= date("H:i:s", strtotime('-24 hours',$invoice['date_created']))?></p>
                            <p>Nama Catering : <?= $mitra['nama_toko'] ?></p>
                            Tanggal Acara : <?= date('d M Y', strtotime($pesanan['tgl_acara'])) ?><br>
                          <?php } else if($row['status_pesanan'] == 2) {
                            ?>
                            <p>Setatus pesanan : Pesanan Di Proses</p>
                            <p>Tanggal Pembelian : <?= date("d M Y", $invoice['date_created'])?> || <?= date("H:i:s", strtotime('-24 hours',$invoice['date_created']))?></p>
                            <p>Nama Catering : <?= $mitra['nama_toko'] ?></p>
                            Tanggal Acara : <?= date('d M Y', strtotime($pesanan['tgl_acara'])) ?><br>
                          <?php } else if($row['status_pesanan'] == 3) {
                            ?>
                            <p>Setatus pesanan : Pesanan Dikirim</p>
                            <p>Tanggal Pembelian : <?= date("d M Y", $invoice['date_created'])?> || <?= date("H:i:s", strtotime('-24 hours',$invoice['date_created']))?></p>
                            <p>Nama Catering : <?= $mitra['nama_toko'] ?></p>
                            Tanggal Acara : <?= date('d M Y', strtotime($pesanan['tgl_acara'])) ?><br>
                            <small class="text-muted">Selesaikan pesanan jika barang telah Tiba di acara. Dana akan Di teruskan ke penjual</small>
                          <?php } else if($row['status_pesanan'] == 5) { ?>
                            <p>Setatus pesanan :<p class="text-danger" style="padding-bottom: 20px;">Di Batalkan</p></p>
                            <p>Tanggal Pembelian : <?= date("d M Y", $invoice['date_created'])?> || <?= date("H:i:s", strtotime('-24 hours',$invoice['date_created']))?></p>
                            <p>Nama Catering : <?= $mitra['nama_toko'] ?></p>
                            Tanggal Acara : <?= date('d M Y', strtotime($pesanan['tgl_acara'])) ?><br>
                          <?php } else if($row['status_pesanan'] == 6) { ?>
                            <p>Setatus pesanan : Selesai</p>
                            <p>Tanggal Pembelian : <?= date("d M Y", $invoice['date_created'])?> || <?= date("H:i:s", strtotime('-24 hours',$invoice['date_created']))?></p>
                            <p>Nama Catering : <?= $mitra['nama_toko'] ?></p>
                            Tanggal Acara : <?= date('d M Y', strtotime($pesanan['tgl_acara'])) ?><br>
                          <?php } ?>
                            <?php if ($row['status_pesanan'] == 0){ ?>
                            <div id="remain" style="margin-top: 5px;">
                            <?php echo "Batal Otomatis ";?><br>
                            <a class="btn btn-warning" style="color: #fff; text-decoration: none;"><i class="far fa-clock"></i> <?= $jumlah_hari. ' Hari ' .$jumlah_jam.' Jam' ?></a>
                            </div>
                            <?php } else {
                              
                             ?>
                            <div id="remain">   
                            </div>
                            <?php } ?>
                          </div>
                          </div>
                          <div class="modal-footer">
                            <?php 
                            if ($row['status_pesanan'] == 3) {
                             ?>
                            <a href="<?= base_url('user/selesaikan_pesanan/' . $row['id'])?>" class="btn btn-primary">Selesaikan Pesanan</a>
                           <?php } else { ?>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
                           <?php } ?>
                          </div>
                          </form>
                        </div>
                      </div>
                      </div>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    