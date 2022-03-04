
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Gambar</th>
                <th scope="col">Status</th>
                <th scope="col">Tanggal Selesai</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <tr>
                <?php
                    $i = 1;
                   foreach ($iklan as $row) {
                  ?>
                <th scope="row"><?= $i++?></th>
                <td><?= $row['email'] ?></td>
                <td><img src="<?= base_url('img/galeri/iklan/') . $row['image'];?>" class="img-fluid" style=" height: 100px; width: 300px;"></td>
                <?php 
                if ($row['is_active'] == 1) {
                ?>
                <td>Active <i class="fas fa-check-circle" style="color: #5aff33"></i></td>
                
                <?php } else { ?>
                <td>Non Active <i class="fas fa-times-circle" style="color: #e10000"></i></td>
                <?php } ?>
                <td><?= date('d F Y', strtotime($row['tgl_selesai'])) ?></td>
                <td>
                  <?php 
                  $tgl_selesai = date('d F Y', strtotime($row['tgl_selesai']));
                  if ($tgl_selesai <= date('d F Y')) {?>
                  <a href="" data-toggle="modal" data-target="#edit<?= $row['id']  ?>" class="btn btn-primary">Edit</a>
                  <?php } else { ?>
                  <a class="btn btn-primary" style="color: #fff">Edit</a>
                  <?php } ?>
                </td>
              </tr>
              <div class="modal fade" id="edit<?= $row['id']  ?>" role="dialog">
              <div class="modal-dialog modal-mt" style="margin-top: 200px;">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>admin/kirim_email_perpanjang">
                  <div class="modal-header">
                    <h4 class="modal-title">Perpanjang Iklan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id_iklan" class="form-control" value="<?= $row['id']?>">
                    <input type="hidden" name="email" class="form-control" value="<?= $row['email']?>">
                    <input type="hidden" name="gambar" class="form-control" value="<?= $row['image']?>">
                    <p>Kirim email Perpajang iklan kepada : <?= $row['email'] ?></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-sm btn-secondary">Kirim</button>
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



