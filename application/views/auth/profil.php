
    <!-- navbar-->

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('user/index')?>">Home</a></li>
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
              <!-- <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
              <span class="sr-only">Loading…</span> -->

                <div class="card-header">
                  <h3 class="h4 card-title">Customer section</h3>
                </div>
                <div class="card-body">
                  <ul class="nav nav-pills flex-column"><a href="" class="nav-link">&nbsp;<i class="fa fa-user"></i> My account</a>
                    <?php 
                    $email = $user['email'];
                    $dompet = $this-> db -> get_where('dompet', ['email' => $email]) -> row_array();
                    if (!$dompet) {
                    ?>
                    <a class="nav-link"><i class="fa fa-google-wallet" aria-hidden="true"></i> Dompet</a>
                  <?php } else { ?>
                    <a href="<?= base_url('user/dompet/'. $user['id'])?>" class="nav-link"><i class="fa fa-google-wallet" aria-hidden="true"></i> Dompet</a>
                    <?php } ?>
                    <a href="<?= base_url('user/pesanan_user/' . $user['id'])?>" class="nav-link">&nbsp; <i class="fas fa-calendar-check"></i>&nbsp;&nbsp; Pesanan</a>
                    <a href="<?= base_url('user/index_toko/'. $user['id'])?>" class="nav-link">&nbsp;<i class="fas fa-store"></i> &nbsp;Toko</a>
                    <a href="<?= base_url('user/index')?>" class="nav-link">&nbsp;<i class="fa fa-angle-double-left"></i> &nbsp;Lanjut Belanja</a>
                  </ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9">
              <div class="box">
                <div class="row">
                <div class="card col-md-6 mr-4 ml-3">
                <div class="row no-gutters">
                <div class="col-md-4 mt-3">
                  <img src="<?= base_url('img/profile/') . $user['image'];?>" style="border: 1px solid; height: 165px;" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text"><small class="text-muted"><?= date('d F Y', strtotime($user['tgl_lahir'])); ?></small></p>
                    <p class="card-text"><?= $user['no_hp']; ?></p>
                    <p class="card-text"><small class="text-muted">Member since <?= date('d F Y', $user['date_created']); ?></small></p>
                  </div>

                </div>
              </div>
                  <div class="text-right mr-2">
                    <p class="buttons"><a href="<?php echo base_url('user/vedit_profil/' . $user['id']);?>" class="btn btn-outline-secondary"><i class="fas fa-cogs"></i></a></p>
                  </div>
            </div>
            <?php 
            $email = $user['email'];
            $dompet = $this-> db -> get_where('dompet', ['email' => $email]) -> row_array();
            if ($dompet) {
            ?>
            <div class="col-md-5" >
            </div>
          <?php } else { ?>
            <div class="card col-md-5" >
                <div class="row no-gutters">
                  <div class="col-md-4 mt-3">
                  <img src="<?= base_url('img/dompet.jpg');?>" class="card-img">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Dompet</h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <p class="card-text text-danger">Anda belum mempunyai Dompet !</p>
                    <p></p>
                    <p class="card-text"><small class="text-muted">Dompet Catering Mart © <?= Date('Y')?></small></p>
                  </div>
                   <form action="<?= base_url()?>auth/dompet" method="post" class="form-horizontal">
                  <input type="hidden" name="email" value="<?php echo $user['email']; ?>" />
                  <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>" />
                </div>
              </div>
                   <div class="text-right mr-2">
                  <button type="submit" name="simpan" class="btn btn-outline-secondary">Buat Dompet</button></div>
                  </form>
            </div>
          </div>
          <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <?php 
          if($user['toko'] > 0){
        ?>

      <?php } else { ?>
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title text-danger">Anda Belum Membuat Toko!</h5>
            <p class="card-text">Punya usaha Catering? belum mendaftar di website kami? <br/> Upgrade akun anda segera agar dapat memasarkan produk anda dengan mudah.</p>
            <a href="<?= base_url('user/register_mitra/'.$user['id'])?>" class="btn btn-primary"><i class="fas fa-store"></i> &nbsp;Daftar Sekarang</a>
          </div>
        </div>
      <?php } ?>

