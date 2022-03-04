<div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Order review</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-8">
              <div class="box">
                <form method="post" action="<?= base_url()?>user/bayar">
                  <h1>Checkout - Order review</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.html" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker"></i>Address</a><a href="checkout3.html" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-money"></i>Pembayaran</a><a href="#" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-eye"></i>Order Review</a></div>                 
                  <div class="content">
                    <div class="table-responsive">
                      <table class="table">

                        <thead>
                          <tr>
                            <th colspan="2">Product</th>
                            <th>Quantity</th>
                            <th></th>
                            <th>Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $i = 1;
                          $x = 0 ;
                          $y = 0 ;
                          foreach ($produk as $row) {
                          $subtotal = $row['price'] *  $row['qty'] ;
                          $x += $subtotal;
                          $dp = 0.3*$x ;
                          $jumlah = $dp;
                          $no = substr($user['id'], 3, 1);
                          $xy = ($row['product_id'] - ($no * 10)) ;
                          $makanan = $this -> db -> get_where('makanan', ['product_id' => $xy]) -> row_array();
                        ?>
                          <tr>
                            <td><a href="" class="front"><img src="<?= base_url('img/product/') . $row['gambar'];?>" class="img-fluid"></a></td>
                            <td style="text-transform: capitalize;"><a href="<?php echo base_url();?>shopping/detail_produk/<?php echo $xy;?>"><?= $row['name']?></a></td>
                            <td>
                            <input type="text" name="" value="<?= $row['qty'] ?>" class="form-control" style="text-align: center;">
                            </td>
                            <td></td>
                            <td>Rp. <?= number_format($makanan['harga'])?></td>
                          </tr>
                          <div id="bayar-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
                          <div class="modal-dialog modal-lm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Dompet Pin</h5>
                                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="<?= base_url()?>user/bayar">
                                  <div class="form-group">
                                  <input type="hidden" name="saldo" value="<?= $dompet['saldo']?>">
                                  <input type="hidden" name="total" value="<?= $invoice['total']?>">
                                  <input type="hidden" name="email" value="<?= $user['email']?>">
                                  <input type="hidden" name="user" value="<?= $user['id']?>">
                                  <input type="hidden" name="mitra" value="<?= $makanan['id_mitra']?>">
                                  <input type="hidden" name="harga" value="<?= $makanan['harga'] ?>">
                                   <input type="hidden" name="id_invoice" value="<?= $invoice['no_invoice']?>">
                                    <small class="text-danger text-lg-left"> <?= form_error('email'); ?></small>
                                  </div>

                                  <div class="form-group">
                                    
                                    <input  type="password" name="pin" placeholder="pin" class="form-control">
                                    <small class="text-danger text-lg-left"> <?= form_error('password'); ?></small>
                                  </div>
                                  <p class="text-center">
                                    <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-sign-in"></i> Bayar</button>
                                  </p>
                                </form>
                              </div>
                            </div>
          </div>
        </div>
                        <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <!-- /.table-responsive-->
                  </div>
                  <div class="box-footer d-flex justify-content-between"><a href="<?= base_url('user/pembayaran2/' . $row['no_invoice'] . '/'. $user['id']) ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Back to payment method</a>
                    <a href="#" data-toggle="modal" data-target="#bayar-modal" class="btn btn-outline-secondary">Bayar<i class="fa fa-chevron-right"></i></a>
                    <!-- <button type="submit" class="btn btn-primary">Bayar<i class="fa fa-chevron-right"></i></button> -->
                  </div>
                </form>
              </div>
              </div>
              <!-- /.box-->
            
          

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
                        <td>Dp</td>
                        <th>Rp. <?= number_format($dp)?></th>
                      </tr>
                      <tr class="total">
                        <td>Total Bayar</td>
                        <th>Rp. <?= number_format($jumlah)?></th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          
            <!-- /.col-lg-3-->
          </div>
        </div>
      </div>
    </div>