<?= $this-> session ->flashdata('message');?>
<!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href=" <?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
    <!-- Font Awesome CSS-->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <!-- owl carousel-->
    <link rel="stylesheet" href=" <?php echo base_url('assets/owl.carousel/assets/owl.carousel.css' )?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/owl.carousel/assets/owl.theme.default.css') ?>">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('css/style.default.css') ?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url('css/custom.css') ?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body onLoad="setCountDown();">
    <header class="header mb-5">
      <!--
      *** TOPBAR ***
      _________________________________________________________
      -->
      <div id="top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 offer mb-3 mb-lg-0"><a href="#" class="ml-1"></a></div>
            <div class="col-lg-6 text-center text-lg-right">
              <ul class="menu list-inline mb-0">
                <li class="list-inline-item"><a href="" style="text-transform: capitalize; "><?=  $mitra['nama_toko']; ?></a></li>
                <li class="list-inline-item"><a href="<?= base_url('mitra/profil_mitra')?>">Profil</a></li>
                <?php
                $id = $mitra['id'];
                $cek = $this-> db -> get_where('user', ['id' => $id]) -> row_array();
                if($cek){
                 ?>
                <li class="list-inline-item"><a data-toggle="modal" data-target="#myModal">Kembali / Logout</a></li>
                <?php } else { ?>
                <li class="list-inline-item"><a href="<?= base_url('auth/logout/' . $admin['id'])?>">logout</a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  
                  <div class="modal-header">
                    <h4 class="modal-title">Konfirmasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                  <div class="text-center">
                    <h5>Jika anda ingin kembali manjadi Pembali tekan Kembali!</h5>
                    <h5>Jika anda ingin logout Tekan Logout!</h5>
                  </div>
                  </div>
                  <div class="modal-footer">
                    <a href="<?= base_url('auth/kembali');?>" class="btn btn-primary">Kembali</a>
                    <a href="<?= base_url('auth/logout/' . $admin['id'])?>" class="btn btn-primary">Logout</a>
                  </div>
                  </form>
                </div>
                
              </div>
              </div>
        <!-- *** TOP BAR END ***-->
        
        
      </div>
      <nav class="navbar navbar-expand-lg">
        <div class="container"><a href="<?= base_url('mitra/index_mitra/' .$mitra['id'])?>" class="navbar-brand home"><img src="<?= base_url('img/logo1.png')?>" alt="Obaju logo" class="d-none d-md-inline-block"><img src="<?= base_url('img/logo-small1.png')?>" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="<?= base_url('mitra/index_mitra/' .$mitra['id'])?>" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="<?= base_url('mitra/tambah_barang')?>" class="nav-link">Tambah Barang</a></li>
              <li class="nav-item"><a href="<?php echo base_url()?>mitra/lihat_barang/<?php echo $mitra['id'];?>" class="nav-link">lihat Barang</a></li>  
              <li class="nav-item"><a href="<?php echo base_url()?>mitra/lihat_pesanan/<?php echo $mitra['id'];?>" class="nav-link">lihat Pesanan</a></li> 
          </ul>
          </div>  
             
    </header>