

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
                <h1>Daftar Pesanan</h1>
                <div class="col-lg-12 col-md-2 ">
                 <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col" >No</th>
                <th scope="col">Nama User</th>
                <th scope="col">Tanggal Acara</th>
                <th scope="col">Jam Acara</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
                <?php
                  $i = 1;
                  foreach ($nama_catering as $row) {
                  $kode = $row['id_user'] - $row['no_invoice'];
                  $id_user = 'USR'.$kode;
                  $user = $this -> db ->get_where('user', ['id' => $id_user])->row_array();
                  $invoice = $this -> db ->get_where('invoice', ['no_invoice' => $row['invoice']])->row_array();
                  $kecamatan = $this -> db ->get_where('kecamatan', ['id_kecamatan' => $invoice['kecamatan']])->row_array();
                  $keranjang = $this -> db ->get_where('simpan_pesanan', ['no_invoice' => $row['invoice']])->row_array();
                  $makanan = $this -> db ->get_where('makanan', ['product_id' => $keranjang['product_id']])->row_array();
                  $awal  = date_create(); //waktu sekarang
                  $akhir = date_create($invoice['tgl_acara']); // waktu acara
                  $diff  = date_diff( $awal, $akhir );
                  ?>
              <tr style="text-align: center;width: 140px;" >
                <th scope="row"><?= $i++;?></th>
                <td style="text-transform: capitalize; width: 110px;"><?= $user['nama']; ?></td>
                <td><?= $invoice['tgl_acara'] ?>, <?= $diff->days ; ?> Hari Lagi</td>
                <td><?= $invoice['jam_acara'] ?></td>
                <td>Rp, <?= number_format($invoice['total'],0,",","."); ?></td>
                
                <td style="">
                  <a href="<?= base_url('mitra/detail_pesanan/'. $row['invoice'].'/'.$mitra['id'])?>" class="btn btn-primary">Detail</a></td>

               </tr>
                <?php
                }
                ?>
                
            </tbody>
          </table>
                </div>
              </div>
        </div>
</div>
</div>

          
