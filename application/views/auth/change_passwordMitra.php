
    <div id="all">
      <div id="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12">
              <!-- breadcrumb-->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li aria-current="page" class="breadcrumb-item active">Change Password</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <h1 class="text-center">Change your password for</h1>
                <p class="lead text-center"><?= $this->session->userdata('reset_email'); ?></p>

                <form action="<?= base_url('auth/changePasswordMitra')?>" method="post">
                  <div class="form-group">
                    <label for="password1">Password Baru</label>
                    <input id="password1" type="password" name="password1" placeholder="Enter new password" class="form-control">
                    <small class="text-danger text-lg-left"> <?= form_error('password1'); ?></small>
                  </div>
                  <div class="form-group">
                    <label for="password2">Repeat password</label>
                    <input id="password2" type="password" name="password2" placeholder="Enter repeat password" class="form-control">
                    <small class="text-danger text-lg-left"> <?= form_error('password2'); ?></small>
                  </div>
                  <div class="text-center">
                    <button type="submit" value="simpan" name="simpan" class="btn btn-primary">Change Password</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
            
            

    
    


