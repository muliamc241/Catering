<div id="all">
      <div id="content">
        <div class="container">
            <div class="row">
            <div class="col-md-12">
             <div id="slider_container_2">
              <!-- <?php if($counter <=1){ echo " active ";} ?> -->
                 <div id="main-slider" class="owl-carousel owl-theme">
            
                   <?php
                   foreach ($gambar as $row) {
                   ?>
              
                    <a href="" data-toggle="modal" data-target="#login-modal"><img src="<?= base_url('img/galeri/slide/') . $row['image'] ;?>" class="img-fluid"></a>
               
               <?php } ?>
                 </div>
               </div>
              <!-- /#main-slider-->
            </div>
        </div>
        </div>
        <!--
        *** ADVANTAGES HOMEPAGE ***
        _________________________________________________________
        -->
        <div id="advantages">
          <div class="container">
            <div class="row mb-4">
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-heart"></i></div>
                  <h3><a href="#">Mengutamakan Konsumen</a></h3>
                  <p class="mb-0">Siap membantu Konsumen jika terjadi kendala</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-tags"></i></div>
                  <h3><a href="#">Harga Terjamin</a></h3>
                  <p class="mb-0">Harga dan kualitas terjamin</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box clickable d-flex flex-column justify-content-center mb-0 h-100">
                  <div class="icon"><i class="fa fa-thumbs-up"></i></div>
                  <h3><a href="#">100% Pembayar Aman</a></h3>
                  <p class="mb-0">Dengan dompet Catering Mart</p>
                </div>
              </div>
            </div>
            <!-- /.row-->
          </div>
          <!-- /.container-->
        </div>
        <!-- /#advantages-->
        <!-- *** ADVANTAGES END ***-->
        <!--
        *** HOT PRODUCT SLIDESHOW ***
        _________________________________________________________
        -->
        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0">Tentang Ceatering Mart</h2>
                </div>
              </div>
            </div>
          </div>

        <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
        <div class="container">
          <div class="col-md-12">
            <div class="box slideshow">
              <h3>Panduan Catering Mart</h3>
              <div id="get-inspired" class="owl-carousel owl-theme">
                <div class="item" style="margin-bottom: 40px;">
                  <h4>Panduan Mendaftar</h4>
                    1.  Mendaftar kan akun anda dengan cara klik daftar di atas web ini. &nbsp;<i class="fas fa-mouse-pointer" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    2.  Isi data diri pada form daftar. &nbsp;<i class="fas fa-edit" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    3.  Buka email yang anda daftar kan lalu klik link yang di berikan, anda akan menuju halam home web Catering Mart. &nbsp;<i class="fas fa-envelope-open-text" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    4.  Login dengan email dan password yang anda daftar kan. &nbsp;<i class="fas fa-sign-in-alt " style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                </div>
               <div class="item" style="margin-bottom: 40px;">
                  <h4>Panduan Membuat Dompet CeMart</h4>
                    1. Klik Profil, lalu Klik Buat dompet. &nbsp;<i class="fas fa-mouse-pointer" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    2.  Isi Pin dengan 6 digit angka. &nbsp;<i class="fas fa-edit" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    3.  Dompet anda telah di buat, ingat pin anda karena pembayaran menggunakan pin dompet. &nbsp;<i class="fas fa-envelope-open-text" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    
                </div>
                <div class="item" style="margin-bottom: 40px;">
                  <h4>Panduan Mengisi Dompet</h4>
                    1.  Kirim kan saldo yang ingin di isi ke rekening Catering mart dengan nomor 4987562458 (BCA). &nbsp;<i class="fas fa-envelope-open-text" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    2.  Klik foto Profil dibagian pojok kanan atas, lalu klik profil. &nbsp;<i class="fas fa-mouse-pointer" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                    3.  Klik Dompet, maka akan di arahkan ke Dompet Home, lalu klik isi saldo di bagian menu di sebelah kiri. &nbsp;<i class="fas fa-mouse-pointer" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>  
                    4.  Isi data yang deperlukan. &nbsp;<i class="fas fa-edit" style="font-size: 50px; color: rgb(79, 191, 168); text-align: center;"></i> <br>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>

        <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h2 class="mb-0">Beberapa Makanan DI Ceatering Mart</h2>
                </div>
              </div>
            </div>
          </div>

        <!--
        *** GET INSPIRED ***
        _________________________________________________________
        -->
                      <div class="container">
                        <div class="col-md-12">
                          <div class="row products">       
                            <?php
                            $no = 1;
                             foreach ($produk as $row) {
                              $no++;
                              if ($no > 5) {
                                break;
                              }
                            ?>
                              <div class="col-lg-3 col-md-3 ">    
                              <div class="products">
                              <form action="<?= base_url('shopping/tambah')?>" method="post" enctype="multipart/form-data"> 
                              <a href="" class="front"><img src="<?= base_url('img/product/') . $row['image'];?>" class="img-fluid" style="width: 400px; height: 150px;"></a>
                              <div class="text">
                              <h3><a href="#"><? $no++ ?><?= $row['nama']; ?></a></h3>
                              <p class="price"> 
                                <del></del>Rp. <?= number_format($row['harga'],0,",","."); ?>
                              </p>
                              <p class="buttons"><a href="<?php echo base_url('shopping/detail_produk/'. $row['product_id']);?>" class="btn btn-outline-secondary"> <i class="far fa-eye"></i> View Detail</a>
                              <a href="" class="btn btn-primary" data-toggle="modal" data-target="#login-modal"><i class="fas fa-cart-plus"></i> Add to cart</a>
                              
                              </div>
                              </form>
                          </div>
                          </div>
                  
                          <?php
                          }
                          ?>     
                      </div>
                       <?php echo $this->pagination->create_links(); ?>
            </div>
          </div>
        </div>
         <div id="hot">
          <div class="box py-4">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h3 class="mb-0 text-center" style="color: #4fbfa8 ">Punya Bisnis Yang berhubungan dengan Pesta atau acara?  <a href="<?= base_url('auth/req_iklan') ?>" class="btn btn-primary">Klik Here</a></h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        
            <!-- /#blog-homepage-->
          </div>
        </div>
        <!-- /.container-->
        <!-- *** BLOG HOMEPAGE END ***-->
      </div>
    </div>
<a href="<?= base_url('auth/req_iklan') ?>">
          <img src="<?= base_url('img/icon/iklanyuk.png');?>" class="wabutton" alt="Chat-Button">
          </a>
          <style>
          .wabutton{
          width:9em;
          height:9em;
          position:fixed;
          bottom:1.5em;
          right:1.5em;
          z-index:100;
          }
          </style>

