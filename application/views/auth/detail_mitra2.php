    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active"><?= $mitra['nama_toko']?></li>
                </ol>
              </nav>
            </div>
            
              <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
              <div class="col-lg-3">
            <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Detail Mitra</h3>
                </div>
                <?php
                  $i = 1;
                   foreach ($nama_catering as $row) {
                  ?>
                  <?php $z = $i++;?>
                <?php } ?>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column category-menu">
                    <li class="text-center"><a  class="nav-link"><?= $mitra['nama_toko']?></a>
                      <ul class="list-unstyled">
                      <li class="text-center"><img src="<?= base_url() .'img/profile/'. $mitra['image'];?>" class="img-fluid" style="height: 100px; padding-top: 15px;"></li>
                      <li style="padding-top: 40px;"><?= $mitra['no_hp']?></li>
                      <li><p style="padding-top: 10px;">Total Produk : </p></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
              

            <div class="col-lg-9">
              <div class="box">
                <h1>Ladies</h1>
                <p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>
              </div>
              <div class="box info-bar">
                <div class="row">
                  <div class="col-md-12 col-lg-4 products-showing">
                    <ul class="list-unstyled">
                    <?php
                            foreach ($kategori as $row) 
                            {
                          ?>
                        <li><a href="<?php echo base_url()?>user/detail_mitra2/<?= $mitra['id'] ?>/<?php echo $row['id'];?>" class="nav-link"><?php echo $row['nama_katagori'];?></a></li>
                      <?php }?>
                    </ul>
                  </div>

                </div>
              </div>

              <div class="row products">       
                  <?php
                   foreach ($nama_catering as $row) {
                  ?>
                    <div class="col-lg-4 col-md-4 ">     
                    <div class="products">
                      <p></p>
                    <form action="<?= base_url('shopping/tambah')?>" method="post" enctype="multipart/form-data"> 
                    <a href="" class="front"><img src="<?= base_url('img/product/') . $row['image'];?>" class="img-fluid"></a>
                    <div class="text">
                    <h3><a href="#"><?= $row['nama']; ?></a></h3>
                    <p class="price"> 
                      <del></del>Rp. <?= number_format($row['harga'],0,",","."); ?>
                    </p>
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="nama" value="<?php echo $row['nama']; ?>">
                    <input type="hidden" name="harga" value="<?php echo $row['harga']; ?>">
                    <input type="hidden" name="gambar" value="<?php echo $row['image']; ?>">
                    <input type="hidden" name="mitra" value="<?php echo $row['id_mitra']; ?>">
                    <input type="hidden" name="qty" value="1" />
                    <input type="hidden" name="user" value="<?php echo $user['id']; ?>">
                    <p class="buttons"><a href="<?php echo base_url();?>shopping/recent/<?php echo $row['product_id'];?>" class="btn btn-outline-secondary">View detail</a>
                    <button type="submit" value="" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Add to cart</button>
                    </div>
                    </form>
                </div>
                </div>
        
              <?php
              }
              ?>     
        </div>
            </div>
            <!-- /.col-lg-9-->
            
          </div>
        </div>
      </div>
    </div>