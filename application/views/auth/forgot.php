
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
                  <li aria-current="page" class="breadcrumb-item active">New account / Sign in</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1>Reset Password</h1>
                <p class="lead"></p>
                <p>Masukkan email anda tunggu beberapa saat sampai verifikasi dikirim ke email yang sudah tertera</p>
                
                <hr>
                <form action="<?= base_url('auth/forgotPassword')?>" method="post">
                  <div class="form-group">
                    <label for="name">Email</label>
                    <input id="email"  type="email" name="email" placeholder="Email" class="form-control">
                    <small class="text-danger" > <?= form_error('email'); ?></small>
                  </div>

                  <div class="text-right">
                    <button type="submit" value="Daftar" name="simpan" class="btn btn-primary"><i class="fa fa-user-md"></i> Reset Password</button>
                  </div>
                 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

            
 