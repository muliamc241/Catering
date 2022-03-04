<?= $this-> session ->flashdata('message');?>
<!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
      <script type="text/javascript">
      var centreGot = false;
    </script>
    <?php echo $map['js']; ?>
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
  <body>

    <!-- navbar-->
    <header class="header mb-5"> 
      <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <div class="container"><a href="<?= base_url('user/index')?>" class="navbar-brand home"><img src="<?= base_url('img/logoo-1.png')?>" alt="Obaju logo" class="d-none d-md-inline-block"><img src="<?= base_url('img/logo-small1.png')?>" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="<?php echo base_url()?>shopping/tampil_keranjang/<?php echo $user['id'];?>" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="<?= base_url() ?>user/index/<?= $user['id'] ?>" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="<?php echo base_url()?>shopping/tampil_barang/0/<?= $user['id'] ?>" class="nav-link">Makanan</a></li>
            </ul>
            
            <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
              <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
              <div id="basket-overview"  class="navbar-collapse collapse d-none d-lg-block"><a href="<?php echo base_url()?>shopping/tampil_keranjang/<?php echo $user['id'];?>" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span class="badge badge-danger"><?php echo ($jmlh_keranjang);?></span></a></div>
              <div class="dropdown">
                <a class="d-none d-lg-block" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="<?= base_url('img/profile/') . $user['image'];?>" class="rounded-circle" style="height: 35px; width: 35px; border: 2px solid rgb(79,191,168);"></a>
                <div class="dropdown-menu">
                  <a class="dropdown-item text-capitalize"><?=  $user['nama']; ?></a>
                  <a class="dropdown-item text-capitalize" href="<?= base_url('user/profil')?>">Profil</a>
                  <a class="dropdown-item text-capitalize" href="<?= base_url('auth/logout/'. $admin['id'])?>">logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
      <div id="search" class="collapse">
        <div class="container">
          <form action="<?php echo base_url();?>shopping/search" method="post"  role="search" class="ml-auto">
            <div class="input-group">
              <input type="text" name="keyword" placeholder="Search" class="form-control">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </header>