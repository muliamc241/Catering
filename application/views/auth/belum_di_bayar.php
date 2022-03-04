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
                    <a href="<?= base_url('user/pesanan_user/'.$user['id'])?>" class="nav-link"><i class="fa fa-list"></i> Pesanan</a><a href="" class="nav-link"><i class="fa fa-sign-out"></i> Lanjut Belanja</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div id="customer-order" class="col-lg-9"  style="margin-bottom: 85px">
              <div class="box">
                <h1>Pesanan || Belum Di Bayar
                </h1>
                <div class="table-responsive mb-4">
                  <table class="table">
                    <thead>
                      <tr class="text-center">
                          <th>No</th>
                          <th>Product</th>
                          <th></th>
                          <th></th>
                          <th>Quantity</th>
                          <th>Harga</th>
                          <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach (array_reverse($produk) as $row) {
                      $keranjang = $this -> db ->get_where('keranjang', ['no_invoice' => $invoice['no_invoice']])->row_array();
                      $pesanan = $this -> db ->get_where('pesanan', ['invoice' => $invoice['no_invoice']])->row_array();
                      date_default_timezone_set('Asia/Jakarta');
                      ?>
                      <tr class="text-center">
                          <td><?= $i++?></td>
                          <td>#<?= $row['no_invoice'] ?></td>
                          <td style="text-transform: capitalize;"><a href="<?php echo base_url();?>shopping/detail_produk/<?php echo $keranjang['product_id'];?>"><?= $keranjang['name']?></a></td>
                          <td></td>
                          <td><?= $row['qty'] ?></td>
                          <td>Rp. <?= number_format($row['price'])?></td>
                          <td>
                            <?php 
                            $invoice = $this -> db ->get_where('invoice', ['no_invoice' => $row['no_invoice']])->row_array();
                            if ($invoice) {
                             ?>
                            <a href="<?= base_url('user/pembayaran2/' . $row['no_invoice']) ?>" class="btn btn-primary">Bayar</a>
                            <?php } else { ?>
                            <a href="<?= base_url('user/cek_out/' . $row['user']) ?>" class="btn btn-primary">Bayar</a>
                            <?php }?>
                          </td>
                        </tr>
                     
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