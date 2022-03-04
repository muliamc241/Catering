
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Email</th>
                <th scope="col">Bank</th>
                <th scope="col">Jumlah Yang Di kirim</th>
                <th scope="col">No Rekening</th>  
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr style="text-align: center;">
                <?php
                    $i = 1;
                   foreach ($saldo as $row) {
                    $mitra = $this-> db -> get_where('mitra', ['email' => $row['email']]) -> row_array();
                    $user = $this-> db -> get_where('user', ['email' => $row['email']]) -> row_array();
                    if ($mitra) {
                      $role_id = $mitra['role_id'];
                    } else {
                      $role_id = $user['role_id'];
                    }
                  ?>
                <form method="post" action="<?php echo base_url('admin/actkirim_saldo/') . $row['id']?>">
                <th scope="row"><?= $i++?></th>
                <td><?= $row['email'] ?></td>
                <td><?= $row['bank'] ?></td>
                <td>Rp, <?= number_format($row['jumlah']) ?></td>
                <td><?= $row['no_rekening'] ?></td>
                <?php if ($row['status'] == 0){ ?>
                <td>
                    <input type="hidden" name="saldo" value="<?= $row['jumlah'] ?>">
                    <input type="hidden" name="email" value="<?= $row['email'] ?>">
                    <input type="hidden" name="role_id" value="<?= $role_id ?>">
                    <button type="submit" value="simpan" name="simpan" class="btn btn-primary">Kirim</button>
                </td>
                <?php } else { ?>
                <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } ?>
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



