

    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">New account / Mitra</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1>Mitra Register</h1>
                <p class="lead"></p>
                <p>Isi data diri dibawah dengan lengkap !</p>
                
                <hr>
                <form action="<?= base_url('auth/register_mitra')?>" method="post">
                  <div class="form-group">
                    <label for="name">Nama Toko</label>
                    <input id="name"  type="text" name="nama_toko" placeholder="Nama Toko" class="form-control" value="<?= set_value('nama') ?>">
                    <small class="text-danger"> <?= form_error('nama_toko'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email"  type="text" name="email" placeholder="email" class="form-control" value="<?= set_value('email') ?>" >
                    <small class="text-danger" > <?= form_error('email'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="password1">Password</label>
                    <input type="password" name="password1" placeholder="Password" class="form-control">
                    <small class="text-danger"> <?= form_error('password1'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="password2">Repet Password</label>
                    <input id="password" type="password" name="password2" placeholder="Re Password" class="form-control" >
                    <small class="text-danger"> <?= form_error('password2'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="no_hp">No Telepon</label>
                    <input type="text" name="no_hp" placeholder="No Telepon" class="form-control" value="<?= set_value('no_hp') ?>" >
                    <small class="text-danger"> <?= form_error('no_hp'); ?></small>
                  </div>
                  <input type="hidden" name="id_mitra" value="MTR<?= $kode_mitra ?>">
                  <div class="text-center">
                    <button type="submit" value="Daftar" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Register</button>
                  </div>
                  <p class="text text-muted"><i>sudah punya akun?</i><a href="#" data-toggle="modal" data-target="#login-modal"><i> Login</i></a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
