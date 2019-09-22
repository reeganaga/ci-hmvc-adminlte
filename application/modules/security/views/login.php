<div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?=  base_url();  ?>security/auth/check" method="post">
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox" value="1" name="remember" checked> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="<?=  base_url();  ?>security/auth/forgot">I forgot my password</a><br>
      <a href="<?=  base_url();  ?>security/auth/register" class="text-center">Register a new membership</a>

    </div>