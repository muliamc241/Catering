
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
                  <ul class="nav nav-pills flex-column"><a href="<?= base_url('user/profil/'. $user['id']) ?>" class="nav-link"><i class="fa fa-sign-out"></i> Kembali</a></ul>
                </div>
              </div>
              <!-- /.col-lg-3-->
              <!-- *** CUSTOMER MENU END ***-->
            </div>
            <div class="col-lg-9" style="height: 400px;">
              <div class="box">
                <h3 class="mt-5">Personal details</h3>

                <form action="<?= base_url('auth/dompet_buat')?>" method="post">
                  <div class="row justify-content-center">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstname">Pin</label>
                        <input id="password" type="password" name="pin1" placeholder="Enter Pin" class="form-control" >
                        <small class="text-danger"> <?= form_error('pin1'); ?></small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="lastname">Repet Pin</label>
                        <input id="password" type="password" name="pin2" placeholder="Re Pin" class="form-control" >
                        <small class="text-danger"> <?= form_error('pin2'); ?></small>
                      </div>
                    </div>
                  </div>
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Buat </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
 