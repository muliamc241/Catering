<?php echo $map['js'];?>
 <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Checkout - Address</li>
                </ol>
              </nav>
            </div>
            <div id="checkout" class="col-lg-8">
              <div class="box">
                <form method="post" action="<?= base_url()?>user/cek_out">
                  <h1>Checkout - Alamat</h1>
                  <div class="nav flex-column flex-md-row nav-pills text-center"><a href="checkout1.html" class="nav-link flex-sm-fill text-sm-center active"> <i class="fa fa-map-marker">                  </i>Alamat</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-money">                      </i>Pembayaran</a><a href="#" class="nav-link flex-sm-fill text-sm-center disabled"> <i class="fa fa-eye">                     </i>Order Review</a></div>
                  <div class="content py-3">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="firstname">Nama Penerima</label>
                          <input name="nama" type="text" class="form-control">
                          <small class="text-danger"> <?= form_error('nama'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="lastname">Lastname</label>
                          <input name="last_nama" type="text" class="form-control">
                          <small class="text-danger"> <?= form_error('last_nama'); ?></small>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="company">Alamat</label>
                          <input name="alamat" type="text" class="form-control">
                          <small class="text-danger"> <?= form_error('alamat'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="street">No Hp</label>
                          <input name="no_hp" type="text" class="form-control">
                          <small class="text-danger"> <?= form_error('no_hp'); ?></small>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                    <div class="row">
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="state">Kecamatan</label>
                          <select name="kecamatan" class="form-control">
                            <small class="text-danger"> <?= form_error('kecamatan'); ?></small>
                          <option name="kecamatan" value="medan tuntungan">Medan Tuntungan</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                        <div class="form-group">
                          <label for="country">Kode Pos</label>
                          <select name="kode_pos" class="form-control">
                          <small class="text-danger"> <?= form_error('kode_pos'); ?></small>
                          <option name="kecamatan" value="20135">20135</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="street">Tanggal Acara</label>
                          <input type="date" class="form-control" id="tgl_acara" placeholder="" name="tgl_acara" value="<?= set_value('tgl_acara') ?>" >
                          <small class="text-danger"> <?= form_error('tgl_acara'); ?></small>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="street">Map</label>
                          <div class="panel-body" style="height:300px;"><?php echo $map['html'];?></div>
                          <input type="text" class="form-control" name="latitude" id="latitude">
                          <input type="text" class="form-control" name="longitude" id="longitude">
                          <br>
                          <a href="" class="btn btn-info btn-sm" id="clearmap"><span class="glyphicon glyphicon-globe"></span> Hapus tanda</a>
                        </div>
                      </div>
                    </div>
                    <!-- /.row-->
                  </div>
                  <?php
                  $x = 0 ;
                  $y = 0 ;
                  foreach ($produk as $row) {
                  $subtotal = $row['price'] *  $row['qty'] ;
                  $x += $subtotal;
                  $y = $x * 0.1;
                  $jumlah = $x + $y;
                  }
                  ?>

                  <input type="hidden" name="user" value="<?= $user['id']?>">
                  <input type="hidden" name="email" value="<?= $user['email']?>">
                  <input type="hidden" name="no_invoice" value="">
                  <input type="hidden" name="jumlah" value="">

                  <div class="box-footer d-flex justify-content-between"><a href="<?php echo base_url()?>shopping/tampil_keranjang/<?php echo $user['id'];?>" class="btn btn-outline-secondary"><i class="fa fa-chevron-left"></i>Kembali Ke keranjang</a>
                    <button type="submit" class="btn btn-primary">Lanjut ke Pembayaran<i class="fa fa-chevron-right"></i></button>
                  </div>
                </form>
              </div>
              <!-- /.box-->
            </div>
            <!-- /.col-lg-9-->
            <div class="col-lg-4">
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
                          <th>Rp. </th>
                        </tr>
                        <tr>
                          <td>Pajak</td>
                          <th>Rp. </th>
                        </tr>
                        <tr class="total">
                          <td>Total</td>
                          <th>Rp.</th>
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