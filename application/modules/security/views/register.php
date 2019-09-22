    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Form Pendaftaran</p>

      <form action="<?=  base_url();  ?>security/auth/register" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" name="tempat" class="form-control" placeholder="Alamat">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group ">
          <select class="form-control select2" name="id_kota" data-placeholder="Pilih Kota">
            <option ></option>
            <?php foreach ($regencies as $regency) {
              echo "<option value='{$regency->id}'>{$regency->name}</option>";
            }
            ?>
          </select>
          <!-- <input type="text" name="tempat" class="form-control" placeholder="Alamat"> -->
          <!-- <span class="glyphicon glyphicon-envelope form-control-feedback"></span> -->
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <!-- <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" value="1" name="remember" checked> Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-xs-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
      </div> -->
      <!-- /.social-auth-links -->

      <a href="<?=  base_url();  ?>security/auth/forgot">I forgot my password</a><br>
      <a href="<?=  base_url();  ?>security/auth/" class="text-center">Already have an account ? Sign In</a>

    </div>
    <!-- /.login-box-body -->