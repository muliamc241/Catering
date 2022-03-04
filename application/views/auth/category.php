

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
                        <li><a href="<?php echo base_url()?>shopping/tampil_barangkategori/<?php echo $row['id'] . '/' .$user['id']?>" class="nav-link"><?php echo $row['nama_katagori'];?></a></li>
                      <?php }?>
                      </ul>
                    </li>
                  </ul>
                </div>
              
              </div>

              <div class="card sidebar-menu mb-4">
                <div class="card-header">
                  <h3 class="h4 card-title">Filter</h3>
                </div>
                <div class="card-body">
                  <form action="<?php echo base_url('shopping/filter/');?>" method="post">
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="radio"name="filter" value="1"> Harga Termurah
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="radio"name="filter" value="2"> Harga Tertinggi
                        </label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="radio"name="filter" value="3"> Penjual Terbaik
                        </label>
                      </div>
                      
                    </div>
                    <button class="btn btn-default btn-sm btn-primary"><i class="fa fa-pencil"></i> Apply</button>
                  </form>
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
                  <div id="main-slider" class="owl-carousel owl-theme" style="width: 750px;height: 200px;" >
                    <?php
                      foreach ($gambar as $roww) {
                    ?>
                    <div class="item"><a href="<?php echo base_url();?>admin/iklan/<?php echo $roww['id'];?>"><img src="<?= base_url('img/galeri/iklan/') . $roww['image'] ;?>" class="img-fluid"></a></div>
                    <?php } ?>
                     
                    
                  </div>
                  <!-- <div id="myiklan" class="modal" tabindex="-5" role="dialog">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Iklan Berbayar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="tutup()">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="box">
                          <a href="<?php echo base_url();?>admin/iklan/<?php echo $roww['id'];?>"><img src="<?= base_url('img/galeri/iklan/') . $roww['image'] ;?>" class="img-fluid"></a></div>
                          </div>
                        </div>
                      </div>
                    </div> -->
                </div>
              </div>
              
                     <div class="row products">       
                            <?php
                             foreach ($produk as $row) {
                            ?>
                              <div class="col-lg-4 col-md-4">     
                              <div class="products">
                              <form action="<?= base_url('shopping/tambah')?>" method="post" enctype="multipart/form-data"> 
                              <a href="<?php echo base_url('shopping/recent/'. $row['product_id'].'/'.$user['id']);?>" class="front"><img src="<?= base_url('img/product/') . $row['image'];?>" class="img-fluid" style="height: 200px; width: 300px;"></a>
                              <div class="text">
                              <h3><a href="<?php echo base_url('shopping/recent/'. $row['product_id'].'/'.$user['id']);?>"><?= $row['nama'] ?></a></h3>
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
                              <p class="buttons"><a href="<?php echo base_url('shopping/recent/'. $row['product_id'].'/'.$user['id']);?>" class="btn btn-outline-secondary"> <i class="far fa-eye"></i> View Detail</a>
                              <button type="submit" value="" name="simpan" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add to cart</button>
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
                      <!-- /.col-lg-9-->
                    </div>
                  </div>
                </div>
            </div>
           
