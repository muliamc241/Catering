 <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item"><a>Pesanan Saya</a></li>
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
                  <h3 class="h4 card-title">Pesanan </h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column">
                  <a href="<?= base_url('user/pesanan_user/' . $user['id'])?>" class="nav-link">&nbsp;<i class="fas fa-clipboard-check"></i>&nbsp;&nbsp;&nbsp;Pesanan</a>
                  <a href="<?= base_url('user/pesanan_belum_bayar/' . $user['id'])?>" class="nav-link">&nbsp;<i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;&nbsp;Belum Di bayar</a>
                  <a href="<?= base_url('user/pesanan_user/' . $user['id'].'/4')?>" class="nav-link"><i class="far fa-handshake"></i>&nbsp;&nbsp;Pesanan Selesai</a>
                  <a href="<?= base_url('user/index')?>" class="nav-link"><i class="fa fa-sign-out"></i> Lanjut Belanja</a>
                  </ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div id="customer-order" class="col-lg-9"  style="margin-bottom: 130px">
              <div class="box">
                <h1>Pesanan</h1>
                <div class="table-responsive mb-4">
                  <table class="table">
                    <thead>
                      <tr class="text-center">
                        <th>Invoice</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Acara</th>
                        <th>Tanggal Di Pesan</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      foreach (array_reverse($produk) as $row) {
                      $invoice = $this -> db ->get_where('invoice', ['no_invoice' => $row['invoice']])->row_array();
                      $user = $this -> db ->get_where('user', ['id' => $row['id_user']])->row_array();
                      $simpan_pesanan = $this -> db ->get_where('simpan_pesanan', ['no_invoice' => $row['invoice']])->row_array();
                      $makanan = $this -> db ->get_where('makanan', ['product_id' => $simpan_pesanan['product_id']])->row_array();
                      date_default_timezone_set('Asia/Jakarta');
                      $awal  = date_create(); //waktu sekarang
                      $akhir = date_create($invoice['tgl_acara']); // waktu acara
                      $diff  = date_diff( $awal, $akhir );
                      ?>
                      <tr class="text-center">
                        <td>#<?= $row['invoice'] ?></td>
                        <td style="text-transform: capitalize;"><?= $user['nama'] ?></td>
                        <td><?= date('d F Y', strtotime($invoice['tgl_acara'])); ?></td>
                        <td><?= date('d F Y', $invoice['date_created']); ?></td>
                        <td class="text-center">
                             <a href="<?= base_url('user/detail_pesanan/'. $row['invoice'] . '/' . $user['id'])?>" class="btn btn-primary">Detail</a>
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