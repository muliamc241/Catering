
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <table class="table table-bordered">
            <thead>
              <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Active</th>
                <th scope="col">Terakhir Login</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                    $i = 1;
                   foreach ($mitra as $row) {
                   $log = $this->m_admin->get_loglogin($row['id']);
                   foreach (array_reverse($log) as $last) {}
                  if ($row['is_active'] == 1) {
                    $a= 'Active';
                  } else {
                    $a = 'Non Active';
                  }
                  ?>
              
              <tr style="text-align: center;">
                <td><p><?= $i++; ?></p></td>
                <td><p><?= $row['nama_toko']; ?></p></td>
                <td><p><?= $row['email']; ?></p></td>
                <td><p><?= $a; ?></p></td>
                <td><?= date('d F Y', $last['off']) ?></td>
                <?php 
                  if($row['is_active'] == 1){
                 ?>
                 <td class="text-success"><i class="fas fa-check-circle"></i></td>
                <?php } else{ ?>
                  <td><a href="<?php echo base_url()?>admin/terima_mitra/<?php echo $row['id'];?>" class="btn btn-outline-primary">Terima</a>  <a data-toggle="modal" data-target="#hapusMitra" class="btn btn-outline-secondary" style=" :hover{color: white;} "><i class="fa fa-trash-o"></i> Hapus</a></a></td>
                <?php } ?>
                


              </tr>
              <?php
                }
                ?>
            </tbody>
          </table>
          

        </div>
        <form>
        <div class="modal fade" id="hapusMitra" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                Anda yakin Menerima Mitra?
                      
                  </div>
                  <div class="modal-footer">
                    <!-- <input type="hidden" name="id" value="<?php echo $row['id']; ?>" /> -->
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                    <a href="<?php echo base_url()?>admin/hapus_mitra/<?php echo $row['id'];?>" class="btn btn-outline-secondary">Hapus</a>
                  </div>
                  </form>
                </div>
                
              </div>
              </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->



