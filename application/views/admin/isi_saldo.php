
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Nama Pengirim</th>
                <th scope="col">Email</th>
                <th scope="col">Jumlah Saldo Di isi</th>
                <th scope="col">Bukti Pembayaran</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <tr >
                <?php
                    $i = 1;
                   foreach ($saldo as $row) {
                    $user = $this-> db -> get_where('user', ['email' => $row['email']]) -> row_array();
                  ?>
                
                <th scope="row"><?= $i++?></th>
                <td><?= $row['nama_pengirim'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>Rp, <?= number_format($row['jumlah']) ?></td>
                <td><a href="#" data-toggle="modal" data-target="#myModal<?= $row['id_isisaldo'] ?>"><img src="<?= base_url('img/admin/bukti_pembayaran/') . $row['image'];?>" class="img-fluid" style=" height: 100px; width: 200px;"></a></td>
                <?php if ($row['status_isisaldo'] == 0){ ?>
                <td>
                <a href="#" data-toggle="modal" data-target="#modalkirim<?= $row['id_isisaldo'] ?>" class="btn btn-primary">Isi Saldo</a>
                </td>
                <?php } else if ($row['status_isisaldo'] == 2) {?>
                <td class="text-danger"><i class="fas fa-times-circle"></i></td>
                <?php } else { ?>
                 <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } ?>
                
              </tr>
              <div class="modal fade" id="myModal<?= $row['id_isisaldo'] ?>" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>admin/tambah">
                  <div class="modal-header">
                    <h4 class="modal-title">Bukti Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <img src="<?= base_url('img/admin/bukti_pembayaran/') . $row['image'];?>" class="img-fluid" style=" height: 300px; width: 500px;">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tutup</button>
                  </div>
                  </form>
                </div>
              </div>
              </div>

              <div class="modal fade" id="modalkirim<?= $row['id_isisaldo'] ?>" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url('admin/kirim_saldo/') . $row['id_isisaldo']?>">
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                Anda yakin mau mengirim saldo ke <?= $user['nama'] ?>? 
                      
                  </div>
                  <div class="modal-footer">
                    <a href="<?= base_url('admin/tolak_isiSaldo/'.$row['id_isisaldo']) ?>" class="btn btn-sm btn-primary">Tolak</a>
                    <button type="submit" class="btn btn-sm btn-secondary">Terima</button>
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



