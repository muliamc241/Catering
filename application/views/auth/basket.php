
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Shopping cart</li>
                </ol>
              </nav>
            </div>
            <div id="basket" class="col-lg-8">
              <div class="box">
                <?= $this-> session ->flashdata('message-keranjang');?>
                  <h1>Shopping cart</h1>
                  <p class="text-muted"></p>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th colspan="2">Product</th>
                          <th>Quantity</th>
                          <th></th>
                          <th colspan="2">Harga</th>
                        </tr>
                      </thead>
                      
                      <tbody id="">
                        <?php
                          $i = 1;
                          $x = 0 ;
                          $y = 0 ;
                          $z = 0;
                          foreach ($produk as $row) {
                          $subtotal = $row['price'] *  $row['qty'] ;
                          $x += $subtotal;
                          $dp = 0.3*$x ;
                          $jumlah = $dp;
                          $z = $row['product_id'];
                        ?>
                        <tr>
                          <td><?= $i++?><? $z++?></td>
                          <td><a href="" class="front"><img src="<?= base_url('img/product/') . $row['gambar'];?>" class="img-fluid"></a></td>
                          <td><a href="<?php echo base_url();?>shopping/detail_produk/<?php echo $row['product_id'];?>"><?= $row['name']?></a></td>
                          <td>
                          <a href="<?php echo base_url()?>shopping/update/<?= $row['id_keranjang'];?>/<?= $row['qty'];?>" class="btn btn-outline-secondary btn-sm" style="margin-bottom: 5px;margin-left: 10px"><i class="fas fa-plus"></i></a>
                          <div class="text-center">
                          <input type="text" disabled="" value="<?= $row['qty']?>" class="form-control" style="text-align: center; text-decoration: none;"></div>
                          <a href="<?php echo base_url()?>shopping/kurang/<?= $row['id_keranjang'];?>/<?= $row['qty'];?>" class="btn btn-outline-secondary btn-sm" style="margin-top: 5px; margin-left: 10px"><i class="fas fa-minus"></i></a>
                          </td>
                          <td></td>
                          <td>Rp. <?= number_format($subtotal)?></td>
                          <td><a href="<?php echo base_url()?>shopping/hapus/<?php echo $row['id_keranjang'];?>/<?= $user['id'] ?>"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                        
                        
                        <?php
                        }
                        ?>
                      </tbody>
                      
                    </table>

                  </div>
                  <!-- /.table-responsive-->
                  <div class="box-footer d-flex justify-content-between flex-column flex-lg-row">
                    <div class="left"><a href="<?= base_url('shopping/tampil_barang')?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Continue shopping</a></div>
                    <div class="right"><a data-toggle="modal" data-target="#myModal" class="btn btn-outline-secondary"><i class="fa fa-trash-o"></i> Hapus Semua</a></div>
                    <form action="<?= base_url('shopping/cekout_makanan')?>" method="post">
                        <input type="hidden" name="id_user" value="<?= $user['id'] ?>">
                        <input type="hidden" name="no_invoice" value="INV/<?= date('Ymd') .'/'. random_string('numeric', 8)?>">
                        <?php 
                          if ($z == 0) {
                         ?>
                         <input type="hidden" name="jumlah" value="">
                        <?php } else { ?>
                        <input type="hidden" name="jumlah" value="<?= $jumlah ?>">
                        <?php } ?>
                     <div class="right">
                      <button type="submit" value="simpan" name="simpan"  class="btn btn-outline-secondary">Proceed to checkout <i class="fa fa-chevron-right"></i></button>
                    </form>
                    </div>
                  </div>
              </div>
              
              <h5>Makanan yang di lihat sebelumnya</h5>
              <div class="row products">

                <?php 
                $yx = 0;
                foreach (array_reverse($recent) as $row) {
                  if ($yx == 4) { 
                    $this->cart->destroy();
                    break; }
                ?>
                <?php $yx++ ?>
                <div class="col-md-3 col-sm-6">
                  <div class="products">
                    <a href="<?php echo base_url('shopping/recent/'. $row['id'].'/'.$user['id']);?>" class="front"><img src="<?= base_url('img/product/') . $row['image'];?>" class="img-fluid" style="height: 100px; width: 200px; padding-bottom: 5px;"></a>
                    <div class="text">
                    <h2 style="font-size: 15px;"><a href="<?php echo base_url('shopping/recent/'. $row['id'].'/'.$user['id']);?>"><?= $row['name']; ?></a></h2>
                    <p class="price"> 
                      <del></del>Rp. <?= number_format($row['price'],0,",","."); ?>
                    </p>
                    </div>
                  </div>
                  <!-- /.product-->
                </div>
                <?php } ?>
              </div>
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-4">
              <div id="order-summary" class="box">
                <div class="box-header">
                  <h3 class="mb-0">Order summary</h3>
                </div>
                <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Order subtotal</td>
                        <th>Rp. <?= number_format($x)?></th>
                      </tr>
                      <tr>
                        <?php if ($x == 0){ ?>
                        <td>Dp</td>
                        <th>Rp. 0</th>
                        <?php } else{ ?>
                        <td>Dp</td>
                        <th>Rp. <?= number_format($dp)?></th>
                        <?php } ?>
                      </tr>
                      <tr class="total">
                        <td>Total</td>
                        <?php
                        if($x < 1){
                        ?>
                        <th>Rp. 0</th>
                        <?php } else {  ?>
                          <th>Rp. <?= number_format($jumlah)?></th>
                        <?php } ?>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- /.col-md-3-->
          </div>
        </div>
      </div>
    </div>


              <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  <form method="post" action="<?php echo base_url()?>shopping/hapus_semua/<?php echo $user['id'];?>">
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                Anda yakin mau mengosongkan Shopping Cart?
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Tidak</button>
                    <button type="submit"  class="btn btn-sm btn-outline-secondary">Ya</button>
                  </div>
                  
                  </form>
                </div>
                
              </div>
              </div>

                      
              