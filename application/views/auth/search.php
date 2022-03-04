

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Kategori</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** MENUS AND FILTERS ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Kategori</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column category-menu">
                    <li><a href="category.html" class="nav-link">Event</a>
                      <ul class="list-unstyled">
                        <?php
                            foreach ($kategori as $row) 
                            {
                          ?>
                        <li><a href="<?php echo base_url()?>shopping/tampil_barang/<?php echo $row['id'];?>" class="nav-link"><?php echo $row['nama_katagori'];?></a></li>
                      <?php }?>
                      </ul>
                    </li>
                  </ul>
                </div>
              
              </div>
              <!-- *** MENUS AND FILTERS END ***-->
              <div class="banner">
                <a href="#"><img src="" class="img-fluid"></a>
              </div>

            </div>
            <div class="col-lg-9">
              <div class="box">
                <h1>Iklan Berbayar</h1>
                <div class="col-lg-6">
                  <div id="main-slider" class="owl-carousel owl-theme" style="width: 750px;height: 150px;" >
                    <?php
                      foreach ($gambar as $row) {
                    ?>
                    <div class="item" style="width: 750px;height: 150px;"><a href="<?php echo base_url();?>admin/iklan/<?php echo $row['id'];?>"><img src="<?= base_url('img/galeri/iklan/') . $row['image'] ;?>" class="img-fluid"></a></div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <div class="row products">       
                  <?php
                   if($produk){
                   foreach ($produk as $row) {
                  ?>

                    <div class="col-lg-4 col-md-4 ">     
                    <div class="products">
                    <form action="<?= base_url('shopping/tambah')?>" method="post" enctype="multipart/form-data"> 
                    <a href="" class="front"><img src="<?= base_url('img/product/') . $row->image ;?>" class="img-fluid" style="height: 200px; width: 300px;"></a>
                    <div class="text">
                    <h3 style="text-transform: capitalize;"><a href="#"><?= $row->nama; ?></a></h3>
                    <p class="price"> 
                      <del></del>Rp. <?= number_format($row->harga,0,",","."); ?>
                    </p>
                    <input type="hidden" name="product_id" value="<?php echo $row->product_id; ?>">
                    <input type="hidden" name="nama" value="<?php echo $row->nama; ?>">
                    <input type="hidden" name="harga" value="<?php echo $row->harga; ?>">
                    <input type="hidden" name="gambar" value="<?php echo $row->image; ?>">
                    <input type="hidden" name="mitra" value="<?php echo $row->id_mitra; ?>">
                    <input type="hidden" name="qty" value="1" />
                    <input type="hidden" name="user" value="<?php echo $user['id']; ?>">
                    <p class="buttons"><a href="<?php echo base_url();?>shopping/recent/<?php echo $row->product_id;?>" class="btn btn-outline-secondary">View detail</a>
                    <button type="submit" value="" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Add to cart</button>
                    </div>
                    </form>
                </div>
                
               </div>
              <?php
              }
              } else {
              ?> 
              <div class="col-lg-12">
              <div class="box">
                <h3 class="text-center">Makanan Tidak Di Temukan</h3>
              </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
