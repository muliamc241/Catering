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
              <div class="box justify-content-between">
                  <h1>Checkout - Pembayaran</h1>
                  <div class="nav flex-column flex-sm-row nav-pills"><a href="checkout1.html" class="nav-link flex-sm-fill text-sm-center"> <i class="fa fa-map-marker"></i>Address</a><a href="checkout3.html" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-money"></i>Pembayaran</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye"></i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box payment-method">
                          <h4>Dompet</h4>
                          <p class="text-center">Rp, <?= number_format($dompet['saldo'])?></p>
                          <form>
                          <div class="box-footer text-center">
                            <input type="radio" name="email" value="<?= $dompet['email']?>" required>
                          </div>
                          </form>
                        </div>
                      </div>
                        
                      </div>
                    </div>
                    <!-- /.row-->
                  <!-- /.content-->
                  <div class="box-footer d-flex justify-content-between"><a href="<?= base_url('user/cek_out/' . $user['id']) ?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Kembali ke Alamat</a>
                    <a class="btn btn-outline-secondary" href="<?php echo base_url()?>user/review/<?php echo $invoice['no_invoice'];?>/<?= $user['id'] ?>"> Lanjut ke Preview order<i class="fa fa-chevron-right"></i>
                    </a>
                  </div>
                <!-- /.box-->
            </div>
            <!-- /.col-lg-9-->
            </div>
          </div>
        </div>
      </div>
    </div>