<style type="text/css">
  .quantity {
  position: relative;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button
{
  -webkit-appearance: none;
  margin: 0;
}

input[type=number]
{
  -moz-appearance: textfield;
}

.quantity input {
  width: 45px;
  height: 42px;
  line-height: 1.65;
  float: left;
  display: block;
  padding: 0;
  margin: 0;
  padding-left: 10px;
  border: 1px solid #eee;
}

.quantity input:focus {
  outline: 0;
}

.quantity-nav {
  float: left;
  position: relative;
  height: 42px;
}

.quantity-button {
  position: relative;
  cursor: pointer;
  border-left: 1px solid #eee;
  width: 20px;
  text-align: center;
  color: #333;
  font-size: 13px;
  font-family: "Trebuchet MS", Helvetica, sans-serif !important;
  line-height: 1.7;
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

.quantity-button.quantity-up {
  position: absolute;
  height: 50%;
  top: 0;
  border-bottom: 1px solid #eee;
}

.quantity-button.quantity-down {
  position: absolute;
  bottom: -1px;
  height: 50%;
}
</style>
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="<?php echo base_url()?>shopping/tampil_barang/">Kategori</a></li>
                  <li aria-current="page" class="breadcrumb-item active"  style="text-transform: capitalize; "> <?=  $detail['nama'] ?></li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3 order-2 order-lg-1">
              <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
              <?php
              $a = 0;
              $i = 0;
              $w = 0;
              foreach ($koment as $row) {
               $a += $row['rate'];
               $i++;
               $w = $a / $i;
               }
               ?>
              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Mitra</h3>
                </div>
                <div class="card-body">
                  <?php 
                  if(!$this->session->userdata('email')){

                   ?>
                  <ul class="nav nav-pills flex-column category-menu">
                    <li class="text-center"><a href="" class="nav-link" data-toggle="modal" data-target="#login-modal"><?= $mitra['nama_toko']?></a>
                      <ul class="list-unstyled">
                      <li class="text-center"><img src="<?= base_url() .'img/profile/'. $mitra['image'];?>" class="img-fluid" style="height: 100px; padding-top: 15px;"></li>
                      <li class="text-center">
                      <?php 
                      if ($detail['rating'] == 1) { ?>
                      <i class="fas fa-star"></i>
                      <?php } else if ($detail['rating'] == 2) { ?>
                      <i class="fas fa-star"></i><i class="fas fa-star"></i>
                      <?php } else if ($detail['rating'] == 3) { ?>
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 
                      <?php } else if ($detail['rating'] == 4) { ?>
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                      <?php } else if ($detail['rating'] == 5) { ?>
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                      <?php } else { ?>
                        <br><p>Belum di Rating</p>
                      <?php } ?>
                     </li>
                      </ul>
                    </li>
                  </ul>
                   </div>
              </div>

                <!-- *** MENUS AND FILTERS END ***-->
              <div class="banner"><a href="#"><img src="" alt="" class="img-fluid"></a></div>
            </div>
              <div class="col-lg-9 order-1 order-lg-2">
              <div id="productMain" class="row">
                <div class="col-md-6">
                <form method="post" action="<?php echo base_url();?>shopping/tambah" method="post" accept-charset="utf-8"> 
                
                    <div class="item" id=""> <img src="<?= base_url() .'img/product/'. $detail['image'];?>" class="img-fluid" style="height: 300px;"></div>
                  </div>

                <div class="col-md-6">
                  <div class="box">
                    <h1 class="text-center"  style="text-transform: capitalize; "><?= $detail['nama']?></h1>
                    <p class="price">Rp. <?php echo number_format($detail['harga'],0,",",".");?></p>
                    <div class="text-center">
                      <a href="" class="btn btn-primary" data-toggle="modal" data-target="#login-modal"><i class="fa fa-user-md"></i> Add to cart</a>
                    </div>
                  </div>
                  <div data-slider-id="1" class="owl-thumbs">
                    <button class="owl-thumb-item"><img src="" class="img-fluid"></button>
                  </div>
                </div>
                </div>
                </form>
              <div id="details" class="box">
              <h1 class="text"  style="text-transform: capitalize; "><?=  $detail['nama'] ?></h1>
              <p class="price"><?= $detail['deskripsi'] ?></p>
                </div>
                <div id="details" class="box">
              <h1 class="text"  style="text-transform: capitalize; ">Komentar</h1>
              <hr>
              <div id="comments">
                  <h4></h4>
              <?php 
              foreach ($koment as $row) {
                 $user_id = $this -> db ->get_where('user', ['id' => $row['id_user']])->row_array();
                      date_default_timezone_set('Asia/Jakarta');
               ?>
                  <div class="row comment">
                    <div class="col-md-3 col-lg-2 text-center text-md-center">
                      <p><img src="<?= base_url('img/profile/') . $user_id['image'];?>" alt="" class="img-fluid rounded-circle"></p>
                    </div>
                    <div class="col-md-9 col-lg-10">
                      <h5><?= $user_id['nama'] ?></h5>
                      <p class="posted"><i class="fa fa-clock-o"></i> <?= date('F d, Y' , $row['date_created']). ' at ' . date('H:i a',$row['date_created'] ) ?></p>
                      <p><?= $row['koment'] ?></p>
                    </div>
                  </div>
              <?php } ?>
              </div>
              
                </div>
                 </div>          
                </div>
              </div>

                <?php } else { ?>
                  <ul class="nav nav-pills flex-column category-menu">
                    <li class="text-center"><a href="<?= base_url('user/detail_mitra/' .$mitra['id'] . '/' . $user['id']) ?>" class="nav-link"><?= $mitra['nama_toko']?></a>
                      <ul class="list-unstyled">
                      <li class="text-center"><img src="<?= base_url() .'img/profile/'. $mitra['image'];?>" class="img-fluid" style="height: 100px; padding-top: 15px;"></li>
                      <li class="text-center">
                     <?php 
                      if ($detail['rating'] >= 5) { ?>
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> 
                      </div>
                      <?php } else if ($detail['rating'] >= 4.5) { ?>
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                      </div>
                      <?php } else if ($detail['rating'] >= 4) { ?>
                        <div style="color: #FFC107">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <?php } else if ($detail['rating'] >= 3.5) { ?>
                      <div style="color: #FFC107">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>
                        </div>
                      <?php } else if ($detail['rating'] >= 3) { ?>
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <?php } else if ($detail['rating'] >= 2.5) { ?>
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <?php } else if ($detail['rating'] >= 2) { ?> 
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <?php } else if ($detail['rating'] >= 1.5) { ?>
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <?php } else if ($detail['rating'] >= 1) { ?>
                      <div style="color: #FFC107">
                      <i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>
                      </div>
                      <?php } else { ?>
                        <br><p>Belum di Rating</p>
                      <?php } ?>
                     </li>
                      </ul>
                    </li>
                  </ul>
                  </div>
              </div>


              <!-- *** MENUS AND FILTERS END ***-->
              <div class="banner"><a href="#"><img src="" alt="" class="img-fluid"></a></div>
            </div>
              <div class="col-lg-9 order-1 order-lg-2">
              <div id="productMain" class="row">
                <div class="col-md-6">
                <form method="post" action="<?php echo base_url();?>shopping/tambah" method="post" accept-charset="utf-8"> 
                
                    <div class="item" id=""> <img src="<?= base_url() .'img/product/'. $detail['image'];?>" class="img-fluid" style="height: 255px"></div>
                  </div>

                <div class="col-md-6">
                  <div class="box">
                    <h1 class="text-center"  style="text-transform: capitalize; "><?= $detail['nama']?></h1>
                    <p class="price">Rp. <?php echo number_format($detail['harga'],0,",",".");?></p>
                    <input type="hidden" name="product_id" value="<?php echo $detail['product_id']; ?>" />
                    <input type="hidden" name="nama" value="<?php echo $detail['nama']; ?>" />
                    <input type="hidden" name="harga" value="<?php echo $detail['harga']; ?>" />
                    <input type="hidden" name="gambar" value="<?php echo $detail['image']; ?>" />
                    <input type="hidden" name="mitra" value="<?php echo $detail['id_mitra']; ?>" />
                    <input type="hidden" name="user" value="<?php echo $user['id']; ?>" />
                    <div class="text-center">
                     <div class="text-center" style="margin-left: 100px;">
                      <div class="quantity">
                      <input type="number" name="qty" min="1" max="100" step="1" value="1">
                      </div>
                     </div>                
                    <button type="submit" value="" name="simpan" class="btn btn-primary mr-5" style="margin-top: 3px;"><i class="fa fa-user-md"></i> Add to cart</button>
                    </div>
                  </div>
                  <div data-slider-id="1" class="owl-thumbs">
                    <button class="owl-thumb-item"><img src="" class="img-fluid"></button>
                  </div>
                </div>
                </div>
                </form>
              <div id="details" class="box">
              <h1 class="text"  style="text-transform: capitalize; "><?=  $detail['nama'] ?></h1>
              <p class="price"><?= $detail['deskripsi'] ?></p>
                </div>
                <div id="details" class="box">
              <h1 class="text"  style="text-transform: capitalize; ">Komentar</h1>
              <hr>
              <div id="comments">
                  <h4></h4>
              <?php 
              foreach ($koment as $row) {
                 $user_id = $this -> db ->get_where('user', ['id' => $row['id_user']])->row_array();
                      date_default_timezone_set('Asia/Jakarta');
               ?>
                  <div class="row comment">
                    <div class="col-md-3 col-lg-2 text-center text-md-center">
                      <p><img src="<?= base_url('img/profile/') . $user_id['image'];?>" alt="" class="img-fluid rounded-circle"></p>
                    </div>
                    <div class="col-md-9 col-lg-10">
                      <h5><?= $user_id['nama'] ?></h5>
                      <p class="posted"><i class="fa fa-clock-o"></i> <?= date('F d, Y' , $row['date_created']). ' at ' . date('H:i a',$row['date_created'] ) ?></p>
                      <p><?= $row['koment'] ?></p>
                    </div>
                  </div>
              <?php } ?>
              </div>
              
                </div>
                 </div>          
                </div>
              </div>
              
                <?php } ?>
                


  