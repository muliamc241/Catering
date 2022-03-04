
    <!-- navbar-->

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Mitra / Tambah Makanan</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1>Tambah Barang</h1>
                <p class="lead"></p>
                <p></p>
                <p class="text-muted"><a href="contact.html"></a></p>
                <hr>
                <form action="<?= base_url('mitra/tambah_barang')?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_mitra" value="<?= $mitra['id'] ?>">
                  <div class="form-group">
                    <label for="name_makanan">Name</label>
                    <input id="name_makanan"  type="text" name="nama" placeholder="Nama Makanan" class="form-control" value="<?= set_value('nama') ?>">
                    <small class="text-danger" > <?= form_error('nama'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" placeholder="Harga" class="form-control" value="<?= set_value('harga') ?>">
                    <small class="text-danger" > <?= form_error('harga'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="kategori">Kategori?</label>
                    <select name="kategori" class="form-control" style="width: 100%;" value="<?= set_value('kategori') ?>">
                      <option>Pilih</option>
                      <?php 
                        foreach ($kategori as $row) {
                       ?>                  
                      <option name="kategori" value="<?= $row['id'] ?>"><?= $row['nama_katagori'] ?></option>
                      <?php } ?>
                    </select>
                    <small class="text-danger" > <?= form_error('kategori'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="foto">Gambar</label>
                    <input type="file" class="form-control" id="foto" placeholder="Foto" name="image">
                    <small class="text-danger" ><?= form_error('image'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Deskripsi Makanan</label>
                    <?=
                       $this->ckeditor->editor("deskripsi",set_value('deskripsi'));
                    ?>
                    <small class="text-danger" ><?= form_error('deskripsi'); ?></small>
                    <input type="hidden" name="nama_catering"  class="form-control" value="<?=  $mitra['id']; ?>">
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" value="simpan" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Tambah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!--
    *** FOOTER ***
    _________________________________________________________
    -->
    <div id="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Pages</h4>
            <ul class="list-unstyled">
              <li><a href="text.html">About us</a></li>
              <li><a href="text.html">Terms and conditions</a></li>
              <li><a href="faq.html">FAQ</a></li>
              <li><a href="contact.html">Contact us</a></li>
            </ul>
            <hr>
            <h4 class="mb-3">User section</h4>
            <ul class="list-unstyled">
              <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
              <li><a href="register.html">Regiter</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Top categories</h4>
            <h5>Men</h5>
            <ul class="list-unstyled">
              <li><a href="category.html">T-shirts</a></li>
              <li><a href="category.html">Shirts</a></li>
              <li><a href="category.html">Accessories</a></li>
            </ul>
            <h5>Ladies</h5>
            <ul class="list-unstyled">
              <li><a href="category.html">T-shirts</a></li>
              <li><a href="category.html">Skirts</a></li>
              <li><a href="category.html">Pants</a></li>
              <li><a href="category.html">Accessories</a></li>
            </ul>
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Where to find us</h4>
            <p><strong>Obaju Ltd.</strong><br>13/25 New Avenue<br>New Heaven<br>45Y 73J<br>England<br><strong>Great Britain</strong></p><a href="contact.html">Go to contact page</a>
            <hr class="d-block d-md-none">
          </div>
          <!-- /.col-lg-3-->
          <div class="col-lg-3 col-md-6">
            <h4 class="mb-3">Get the news</h4>
            <p class="text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            <form>
              <div class="input-group">
                <input type="text" class="form-control"><span class="input-group-append">
                  <button type="button" class="btn btn-outline-secondary">Subscribe!</button></span>
              </div>
              <!-- /input-group-->
            </form>
            <hr>
            <h4 class="mb-3">Stay in touch</h4>
            <p class="social"><a href="#" class="facebook external"><i class="fa fa-facebook"></i></a><a href="#" class="twitter external"><i class="fa fa-twitter"></i></a><a href="#" class="instagram external"><i class="fa fa-instagram"></i></a><a href="#" class="gplus external"><i class="fa fa-google-plus"></i></a><a href="#" class="email external"><i class="fa fa-envelope"></i></a></p>
          </div>
          <!-- /.col-lg-3-->
        </div>
        <!-- /.row-->
      </div>
      <!-- /.container-->
    </div>
    <!-- /#footer-->
    <!-- *** FOOTER END ***-->
    

