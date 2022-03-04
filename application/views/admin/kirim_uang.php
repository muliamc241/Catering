
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">No Invoice</th>
                <th scope="col">Nama Catering</th>
                <th scope="col">Jumlah Yang Di Terima</th> 
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
                    $i = 1;
                   foreach ($saldo as $row) {
                    $mitra = $this-> db -> get_where('mitra', ['id' => $row['id_mitra']]) -> row_array();
                    $makanan = $this-> db -> get_where('makanan', ['product_id' => $row['product_id']]) -> row_array();
                    $pesanan = $this-> db -> get_where('pesanan', ['invoice' => $row['no_invoice']]) -> row_array();
                    $simpan_biaya = $this-> db -> get_where('simpan_biaya', ['no_invoice' => $row['no_invoice']]) -> row_array();
                  ?>
              <tr style="text-align: center;">
                
                <form method="post" action="<?php echo base_url('admin/actkirim_biaya/') . $row['no_invoice']?>">
                <th scope="row"><?= $i++?></th>
                <td>#<?= $row['no_invoice'] ?></td>
                <td><?= $mitra['nama_toko'] ?></td>
                <td>Rp, <?= number_format($makanan['harga']) ?></td>
                <?php 
                $y = $pesanan['total'] - $simpan_biaya['jumlah'];
                $z = $makanan['harga'];

                if ($y == $z){ ?>
                <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } else if($simpan_biaya['jumlah'] == 0) { ?>
                <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } else { ?>
                <td class="text-danger"><i class="fas fa-times-circle"></i></td>  
                <?php } ?>
                <!-- <td>
                    <input type="hidden" name="invoice" value="<?= $row['no_invoice'] ?>">
                    <input type="hidden" name="saldo" value="<?= $makanan['harga'] ?>">
                    <input type="hidden" name="email" value="<?= $mitra['email'] ?>">
                  <button type="submit" value="simpan" name="simpan" class="btn btn-primary">Kirim</button>
                  </form>
                </td> -->
              </tr>
              </form>
              <?php
                }
                ?>
            </tbody>
          </table>
          

        </div>
        <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>admin/tambah">
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                Anda yakin mau mengirim saldo?
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-sm btn-default">Ya</button>
                  </div>
                  
                  </form>
                </div>
                
              </div>
              </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



