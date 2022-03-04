
    <!-- navbar-->

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">My account</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-3">
              <!--
              *** CUSTOMER MENU ***
              _________________________________________________________
              -->
              <div class="card sidebar-menu">
                <div class="card-header">
                  <h3 class="h4 card-title">Customer section</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column">
                    <a href="<?= base_url('user/dompet/'. $user['id'])?>" class="nav-link"><i class="fa fa-list"></i> Dompet</a><a href="<?= base_url('user/isi_saldo/'. $user['id'])?>" class="nav-link"><i class="fa fa-heart"></i> isi saldo</a><a href="" class="nav-link"><i class="fa fa-user"></i>  History</a><a href="<?= base_url('user/index/'. $user['id'])?>" class="nav-link"><i class="fa fa-sign-out"></i> lanjut Belanja </a>
                  </ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <?php
             foreach ($chat as $row) 
            {}
            $mitra = $this -> db -> get_where('mitra', ['id' => $row['id_penerima']]) -> row_array();
            ?>
            <div class="col-lg-9">
              <div class="box">
                <div class="card">
                <h5 class="card-header"><?= $mitra['nama_toko'] ?></h5>
                <div class="card-body">
                  <div style="overflow: auto; height: 320px;">
                  
                  <div class="text-right mt-2 mb-2">
                    <p class="card-text"></p>
                  </div>
                  <?php
                   foreach ($chat as $row) 
                  {
                  ?>
                  <div class="text-left mt-2 mb-2">
                    <p class="card-text"><?= $row['isi_chat'] ?></p>
                  </div>
                  <?php } ?>
                  </div>
                  <form>
                  <input type="text" name="isi_chat" class="form-control">
                  <div class="text-right mt-2">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                  </div>
                  </form>
                </div>
              </div>
          </div>

      </div>
    </div>
  </div>
  </div>
</div>
</div>

