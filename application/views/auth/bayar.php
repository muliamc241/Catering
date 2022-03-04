<div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Payment method</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-9">
              <div class="box">
                  <h1>Checkout - Pembayaran</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.html" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker"></i>Address</a><a href="checkout3.html" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-money"></i>Pembayaran</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye"></i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4 class="text-center">Dompet</h4>
                            <h5 class="text-center">Rp, 0</h5>
                          <div class="box-footer text-center">
                            <a href="#" data-toggle="modal" data-target="#dompet-modal" class="btn btn-outline-secondary">Dompet</a>
                          </div>
                          </form>
                        </div>
                      </div>
                        
                      </div>
                    </div>
                    <!-- /.row-->
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between"><a href="checkout2.html" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Kembali ke Alamat</a>
                    <a class="btn btn-outline-secondary" href="<?php echo base_url()?>user/review/<?php echo $user['id'];?>" style="pointer-events: none; cursor: default;">Lanjut ke Preview order<i class="fa fa-chevron-right"></i></a>
                  </div>
                <!-- /.box-->
              </div>
            </div>
            <div id="dompet-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
          <div class="modal-dialog modal-lm">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Masukkan Pin Dompet anda!</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <form method="post" action="<?= base_url()?>user/dompet_masuk" >
                  <div class="form-group">
                  <input type="hidden" name="email" value="<?= $dompet['email']?>">
                    <small class="text-danger text-lg-left"> <?= form_error('email'); ?></small>
                  </div>

                  <div class="form-group">
                    <input  type="password" name="pin" placeholder="pin" class="form-control">
                    <small class="text-danger text-lg-left"> <?= form_error('pin'); ?></small>
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-3">
              <div id="order-summary" class="card">
                <div class="card-header">
                  <h3 class="mt-4 mb-4">Order summary</h3>
                </div>
                <div class="card-body">
                  <p class="text-muted">Shipping and additional costs are calculated based on the values you have entered.</p>
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Order subtotal</td>
                          <th>$446.00</th>
                        </tr>
                        <tr>
                          <td>Shipping and handling</td>
                          <th>$10.00</th>
                        </tr>
                        <tr>
                          <td>Tax</td>
                          <th>$0.00</th>
                        </tr>
                        <tr class="total">
                          <td>Total</td>
                          <th>$456.00</th>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-lg-3-->
          </div>
        </div>
      </div>
    </div>