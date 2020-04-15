<div class="login-box-body">
    <p class="login-box-msg">Fill you new password</p>
    <p class="login-box-msg"><?php echo $message; ?></p>
    <form action="<?=  base_url();  ?>security/auth/reset_password/<?= $code; ?>" method="post">
        <div class="form-group has-feedback">
        <?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length) ?>
            <input type="password" name="new" class="form-control" placeholder="Fill your new password">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
        <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?>
            <input type="password" name="new_confirm" class="form-control" placeholder="Confirm your password">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <?php echo form_input($user_id);?>
    	<?php echo form_hidden($csrf); ?>
        <!-- /.col -->
        <div class="form-group">
            <button type="submit" class="form-control btn btn-primary btn-block btn-flat">Submit</button>
        </div>
        <a href="<?= base_url('security/auth') ?>">Login</a><br>
        <a href="<?= base_url('security/auth/register') ?>">Register</a>
        <!-- /.col -->
    </form>
</div>