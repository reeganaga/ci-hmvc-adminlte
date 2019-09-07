<div class="login-box-body">
    <p class="login-box-msg">Fill you email address</p>

    <form action="/security/auth/process_forgot_password" method="post">
        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <!-- /.col -->
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <!-- /.col -->
    </form>
</div>