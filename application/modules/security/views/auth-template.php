<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIPPUM | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url('assets/ionicons/css/ionicons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/square/blue.css') ?>">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.min.css') ?>">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js?render=6LcgC8cUAAAAAAUBACuQT1-4mFJ6DX1hXJ2z6qYb"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LcgC8cUAAAAAAUBACuQT1-4mFJ6DX1hXJ2z6qYb', {
                action: 'homepage'
            }).then(function(token) {
                // console.log(token)
                jQuery('.google-token').val(token)
            });
        });
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url(); ?>"><b>CI ADMIN LTE </b></a>
        </div>
        <!-- /.login-logo -->

        <!-- template -->
        <?php
        $data[] = "";
        $this->load->view($page, $data);
        ?>
        <!-- template -->


        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>">
    </script>
    <!--  Select 2 -->
    <script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js') ?>"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $('.select2').select2({
                placeholder: "Pilih kota"
            })
        });
    </script>

    <script>
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php } else if ($this->session->flashdata('error')) { ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php } else if ($this->session->flashdata('warning')) { ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php } else if ($this->session->flashdata('info')) { ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
    </script>

</body>

</html>