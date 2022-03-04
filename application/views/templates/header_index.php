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
  <body id="page-top">

    <!-- navbar-->
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
                <li class="list-inline-item"><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                <li class="list-inline-item"><a href="<?= base_url('auth/register')?>">Register</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- *** TOP BAR END ***-->
        <div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
          <div class="modal-dialog modal-lm">
            <div class="modal-content">
              <div class="modal-header">
                <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                  <li class="nav-item text-lg-left">
                    <a class="btn btn-primary" data-toggle="tab" href="#user" role="tab">Login Konsumen</a>
                  </li>
                  <li class="nav-item text-lg-right">
                    <a class="btn btn-primary" data-toggle="tab" href="#mitra" role="tab">login Mitra</a>
                  </li>
                </ul>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
              </div>
              <div class="tab-content">
              <!--user-->
              <div class="tab-pane fade in show active" id="user" role="tabpanel">
              <div class="modal-body">
                <h3 class="text-lg-left">Login Konsumen</h3>
                <form action="<?= base_url('auth/index')?>" method="post">
                  <div class="form-group">
                    <input  type="text" name="email" placeholder="Email" class="form-control" value="<?= set_value('email') ?>">
                    <small class="text-danger text-lg-left"> <?= form_error('email'); ?></small>
                  </div>

                  <div class="form-group">
                    <input  type="password" name="password" placeholder="password" class="form-control">
                    <small class="text-danger text-lg-left"> <?= form_error('password'); ?></small>
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>

                <p class="text-lg-left text-muted">Belum Mempunyai Akun? <a href="<?= base_url('auth/register')?>">Daftar Sekarang</a></p>
                <p class="text-lg-left text-muted"><a href="<?= base_url('auth/forgotPassword')?>"><strong>Forgot Password</strong></a></p>
              </div>
              </div>
              <!--mitra-->
              <div class="tab-pane fade" id="mitra" role="tabpanel">
              <div class="modal-body">
                <h3 class="text-lg-left">Login Mitra</h3>
                <form action="<?= base_url('auth/loginmitra')?>" method="post">
                  <div class="form-group">
                    <input  type="text" name="email" placeholder="Email" class="form-control" value="<?= set_value('email') ?>">
                    <small class="text-danger text-lg-left"> <?= form_error('email'); ?></small>
                  </div>

                  <div class="form-group">
                    <input  type="password" name="password" placeholder="password" class="form-control">
                    <small class="text-danger text-lg-left"> <?= form_error('password'); ?></small>
                  </div>
                  <p class="text-center">
                    <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Log in</button>
                  </p>
                </form>
              
                <p class="text-lg-left text-muted">Ingin Menjadi Mitra kami? <a href="<?= base_url('auth/register_mitra');?>">Daftar Disini</a></p>
                <p class="text-lg-left text-muted"><a href="<?= base_url('auth/forgotPasswordMitra')?>"><strong>Forgot Password</strong></a></p>
              </div>
            </div>
        </div>
      </div>
    </div>
    </div>     
      </div>
<nav class="navbar navbar-expand-lg">
        <div class="container"><a href="<?= base_url('auth')?>" class="navbar-brand home"><img src="<?= base_url('img/logo1.png')?>" alt="Obaju logo" class="d-none d-md-inline-block"><img src="<?= base_url('img/logo-small1.png')?>" alt="Obaju logo" class="d-inline-block d-md-none"><span class="sr-only">go to homepage</span></a>
          <div class="navbar-buttons">
            <button type="button" data-toggle="collapse" data-target="#navigation" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <button type="button" data-toggle="collapse" data-target="#search" class="btn btn-outline-secondary navbar-toggler"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></button><a href="basket.html" class="btn btn-outline-secondary navbar-toggler"><i class="fa fa-shopping-cart"></i></a>
          </div>
          <div id="navigation" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item"><a href="<?= base_url('auth')?>" class="nav-link">Home</a></li>
              <li class="nav-item"><a href="" class="nav-link" data-toggle="modal" data-target="#login-modal">Makanan</a></li>
            </ul>
            
            <div class="navbar-buttons d-flex justify-content-end">
              <!-- /.nav-collapse-->
              <div id="search-not-mobile" class="navbar-collapse collapse"></div><a data-toggle="collapse" href="#search" class="btn navbar-btn btn-primary d-none d-lg-inline-block"><span class="sr-only">Toggle search</span><i class="fa fa-search"></i></a>
              <div id="basket-overview"  class="navbar-collapse collapse d-none d-lg-block"><a href="<?php echo base_url()?>shopping/tampil_keranjang/" disabled="" class="btn btn-primary navbar-btn"><i class="fa fa-shopping-cart"></i><span> items in cart</span></a></div>
             
            </div>
          </div>
        </div>
      </nav>
      <div id="search" class="collapse">
        <div class="container">
          <form role="search" class="ml-auto">
            <div class="input-group">
              <input type="text" placeholder="Search" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </header>