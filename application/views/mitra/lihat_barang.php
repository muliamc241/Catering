

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Daftar Barang</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-12" style="height: auto;">
              <div class="box">
                <h1>Daftar Barang</h1>
                <div class="col-lg-12 col-md-2 ">
                 <table class="table table-bordered">
            <thead>
              <tr style="text-align: center;">
                <th scope="col" >No</th>
                <th scope="col">Nama Makanan</th>
                <th scope="col" style="width: 50px; height: 10px;">Gambar</th>
                <th scope="col" style="width: 50px; height: 10px;">Harga</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Kategori</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              
                <?php
                  $i = 1;
                   foreach ($nama_catering as $row) {
                    $kategori = $this -> db -> get_where('katagori', ['id' => $row['kategori']]) -> row_array();
                  ?>
              <tr style="text-align: center;" >
                <th scope="row"><?= $i++;?></th>
                <td><?= $row['nama']; ?></td>
                <td><a href="" class="front"><img src="<?= base_url('img/product/') . $row['image'];?>" style="width: 200px; height: 150px;"></a></td>
                <td style="width: 50px;">Rp. <?= number_format($row['harga'],0,",","."); ?> / Paket</td>
                <td><p><?= $row['deskripsi']; ?></p></td>
                <td><p><?= $kategori['nama_katagori']; ?></p></td>
                <td>
                  <p class="buttons"><a data-toggle="modal" data-target="#myModal<?= $row['product_id'] ?>" class="btn btn-outline-secondary">Edit</a></p>
                </td>
               </tr>
               <div class="modal fade" id="myModal<?= $row['product_id'] ?>" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Edit || <?= $row['nama'] ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <div>
                    <form action="<?= base_url('tambah_barang/edit')?>" method="post" enctype="multipart/form-data">
                      <input  type="hidden" name="id_mitra" class="form-control" value="<?= $row['id_mitra'] ?>">
                      <input  type="hidden" name="product_id" class="form-control" value="<?= $row['product_id'] ?>">
                  <div class="form-group">
                    <label for="name_makanan">Nama</label>
                    <input id="name_makanan"  type="nama" name="nama" placeholder="Nama Makanan" class="form-control" value="<?= $row['nama'] ?>">
                    <small class="text-danger" > <?= form_error('nama'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" placeholder="Harga" class="form-control" value="<?= $row['harga'] ?>">
                    <small class="text-danger" > <?= form_error('harga'); ?></small>
                  </div>
                    <div class="form-group">
                    <label for="kategori">Kategori?</label>
                      <select name="kategori" class="form-control" style="width: 100%;">
                        <option name="kategori" value="1">Pernikahan</option>
                        <option name="kategori" value="2">Ulang Tahun</option>
                        <option name="kategori" value="3">Kost</option>
                      </select>  
                    <small class="text-danger" > <?= form_error('kategori'); ?></small>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                     <div class="form-group">
                        <img src="<?= base_url('img/product/') . $row['image'];?>" class="img-thumbnail">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                    <label for="foto">Gambar</label>
                   <input type="file" class="form-control"  placeholder="Foto" name="image">
                  </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="keterangan">Deskripsi</label>
                    <textarea class="ckeditor" id="deskripsi" name="deskripsi"><?= $row['deskripsi'] ?></textarea>
                    <small class="text-danger" > <?= form_error('deskripsi'); ?></small>
                    <input type="hidden" name="nama_catering"  class="form-control" value="<?=  $mitra['id']; ?>">
                  </div>
                  
                  <div class="text-center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Edit</button>
                  </div>
                </form>
                  </div>
                  </div>

                  <div class="modal-footer">

                   
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
                  </div>
                  </form>
                </div>
                
              </div>
              </div>
                <?php
                }
                ?>
             
            </tbody>
          </table>
                </div>
              </div>
        </div>
</div>
</div>
