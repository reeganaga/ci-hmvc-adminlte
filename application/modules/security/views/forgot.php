<div class="login-box-body">
    <p class="login-box-msg">Fill you email address</p>

    <form action="<?=  base_url();  ?>security/auth/process_forgot_password" method="post">
        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <!-- /.col -->
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <a href="<?= base_url('security/auth') ?>">Login</a><br>
        <a href="<?= base_url('security/auth/register') ?>">Register</a>
        <!-- /.col -->
    </form>
</div>