
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="col-lg-6">
          <div class="box">
                <h1>Tambah Galeri</h1>
                <p class="lead"></p>
                <p></p>
                <p class="text-muted"><a href="contact.html"></a></p>
                <hr>
                <form action="<?= base_url('admin/add')?>" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="tipe">Tipe?</label>
                    <select name="tipe" class="form-control">
                      <option name="tipe" value="1">Slide</option>                      
                    </select>
                    <small class="text-danger" > <?= form_error('tipe'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="foto">Gambar</label>
                    <input type="file" class="form-control" id="foto" placeholder="Foto" name="image">
                    <small class="text-danger"> <?= form_error('image'); ?></small>
                  </div>
                  <div class="text-center">
                  <button type="submit" value="simpan" name="simpan" class="btn btn-primary"><i class="fas fa-upload"></i> Tambah</button>
                  </div>
                  </div>      
          </div>        
          </div>
        </div>



